@extends('frontEnd.layouts.master')
@section('content')
<div class="breadcumb-wrapper p-5" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Event's</h1>
            <ul class="breadcumb-menu">
                <li><a href="{{route('home')}}">Home</a></li>
                <li>Event</li>
            </ul>
        </div>
    </div>
</div>
<section class="th-blog-wrapper space-extra-bottom">
    <div class="container">
        <div class="col-xxl-12 col-lg-12 py-3" hidden>
            <aside class="sidebar-area">
                <div class="widget widget_search">
                    <form class="search-form">
                        <input type="text" id="search-input" placeholder="Enter Keyword">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </aside>
        </div>
        <section class="pb-5" style="display: none;" id="content">

        </section>
        <div class="row py-3">

            @foreach ($events as $key=>$value)
            <div class="col-xxl-6 col-lg-6">
                <div class="th-blog blog-single has-post-thumbnail">
                    <div class="blog-img"><a href="{{route('home.event.view',$value->id)}}">
                        <img src="{{!empty($value['Gallery']) ? $value['Gallery']->image :'public\back-end-assets\images\events\blog-s-1-3.jpg'}}"
                             alt="Blog Image" style="height:300px; object-fit:cover; width: 100%;"></a></div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <a class="author" href="{{route('home.event.view',$value->id)}}">
                                <img src="{{!empty($value['Member']->image)?asset($value['Member']->image):''}}" alt="avater"> By {{$value['Member']->name}}</a>
                            <a href="{{route('home.event.view',$value->id)}}"><i class="fa-light fa-calendar-days"></i>{{!empty($value->date)?\Carbon\Carbon::parse($value->date)->format('d M, Y'):''}}</a>

                        </div>
                        <h2 class="blog-title"><a href="{{route('home.event.view',$value->id)}}">{{!empty($value->title)?$value->title:''}}</a></h2>
                        <p class="blog-text">{{!empty($value->sort_description)?$value->sort_description:''}}</p>
                        <p class="blog-text">{{!empty($value->description)?$value->description:''}}</p>
                        <a href="{{route('home.event.view',$value->id)}}"
                            class="line-btn">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('customeJS')
<script>
    $(document).ready(function() {
        const defaultImage = `{{ asset('back-end-assets/images/members/member.jpeg') }}`; // Default image URL

        $('#search-input').on('input', function() {
            let query = $(this).val();

            if (query.length > 1) { // Minimum characters before searching
                $.ajax({
                    url: '{{ route("home.event.search") }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        // Get results container and clear it
                        let resultsDiv = $('#content');
                        resultsDiv.empty().show(); // Clear results and show the container

                        if (data.length > 0) {
                            // Append results dynamically
                            data.forEach(item => {
                                let imageUrl = (item.Gallery && item.Gallery.image) ?
                                    `{{ asset('${item.Gallery.image}') }}` :
                                    defaultImage;
                                let title = item.title || 'N/A';
                                let description = item.sort_description || 'N/A';
                                let eventDate = item.date || 'N/A';
                                let prizeMoney = item.prize_money || 'N/A';

                                resultsDiv.append(`
<section class="space-top">
  <div class="container">
    <div class="row gy-40 align-items-center">
      <div class="col-xl-4">
        <div class="team-featured-img">
          <img src="${imageUrl}" alt="Event Image">
        </div>
      </div>
      <div class="col-xl-8">
        <div class="team-featured">
          <h2 class="team-title">${title}</h2>
          <p class="team-desig">Event Date</p>
          <p class="team-bio">${description}</p>
          <div class="team-contact-wrap">
            <div class="team-contact">
              <div class="icon-btn"><i class="fa-solid fa-calendar"></i></div>
              <div class="media-body">
                <h6 class="team-contact_label">Date</h6>
                <p class="team-contact_link">${eventDate}</p>
              </div>
            </div>
            <div class="team-contact">
              <div class="icon-btn"><i class="fa-solid fa-trophy"></i></div>
              <div class="media-body">
                <h6 class="team-contact_label">Prize Money</h6>
                <p class="team-contact_link">${prizeMoney}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
                                `);
                            });
                        } else {
                            resultsDiv.append('<p>No results found.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Search request failed:', error);
                        $('#content').empty().append('<p>An error occurred while searching. Please try again later.</p>');
                    }
                });
            } else {
                $('#content').hide().empty(); // Hide and clear results if the query is too short
            }
        });
    });
</script>

@endsection