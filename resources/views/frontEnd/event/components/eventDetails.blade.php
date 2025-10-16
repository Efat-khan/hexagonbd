<section class="space-top space-extra-bottom">
  <div class="container">
    <div class="row">
      <div class="col-xxl-12 col-lg-12">
        <div class="page-single">

          <div class="page-content">
            <h2 class="h3 page-title text-center">Event Description</h2>
            <p>
              {{ !empty($event->description)?$event->description:'N/A' }}
            </p>
            @if ($event['EventTimeline']->isNotEmpty())
            <h3 class="title mb-20 text-center">Timeline</h3>
            <div style="display: flex; justify-content: center; ">
              <table class="table table-striped mb-0 " style="width: 50%;">
                <thead class="title">
                  <tr>
                    <th scope="col">Event</th>
                    <th scope="col">Location</th>
                    <th scope="col">Date & Time</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($event['EventTimeline'] as $key=>$data)
                  <tr>
                    <td>{{!empty($data->event)?$data->event:'N/A'}}</td>
                    <td>{{!empty($data->location)?$data->location:'N/A'}}</td>
                    <td>{{!empty($data->date)?\Carbon\Carbon::parse($data->date)->format('d, M'):'N/A'}} ({{!empty($data->date)?\Carbon\Carbon::parse($data->time)->format('h:i A'):'N/A'}})</td>
                  </tr>
                  @endforeach
              </table>
            </div>
            @endif

            @if ($event['EventPrizeMoney']->isNotEmpty())
            <div style="display: flex; justify-content: center; ">
              <div class="widget widget_info my-50" style="width: 50%; justify-content: center;">
                <h3 class="title text-center">Prize Money</h3>
                <div class="project-info-list">
                  @php
                  // Fetch prize money data in descending order (highest to lowest)
                  $prize_money = $event->EventPrizeMoney()->orderBy('prize_money', 'desc')->get();
                  @endphp
                  @foreach ($prize_money as $key => $data)
                  <div class="contact-feature">
                    <div class="icon-btn">
                      <i class="fa-light fa-trophy"
                        style="color:{{ ($key == 0) ? '#FFD43B':($key == 1 ? '#7e8a9d':($key == 2 ? '#fb923c':'ffffff'))}};">
                      </i>
                    </div>
                    <div class="media-body">
                      <p class="contact-feature_label">
                        {{ !empty($data->place) ? $data->place : 'N/A' }} Place
                      </p>
                      <h3 class="contact-feature_link">
                        {{ !empty($data->prize_money) ? $data->prize_money : 'N/A' }}
                      </h3>
                    </div>
                  </div>
                  @endforeach

                </div>
              </div>
            </div>
            @endif
            @if ($event['EventFaq']->isNotEmpty())
            <h3 class="h4 mt-35 mb-4 text-center">Frequently Asked Questions</h3>
            <div class="accordion-area accordion" id="faqAccordion">
              @foreach ($event['EventFaq'] as $key => $data)
              @if ($data->status == 'active')
              @php
              // Generate unique ID for each accordion item
              $accordionId = "collapse-" . $loop->index;
              @endphp
              <div class="accordion-card style2 {{ $key == 0 ? 'active' : '' }}">
                <div class="accordion-header" id="collapse-item-{{ $loop->index }}">
                  <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#{{ $accordionId }}"
                    aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                    aria-controls="{{ $accordionId }}">
                    {{ !empty($data->question) ? $data->question : 'N/A' }}
                  </button>
                </div>
                <div id="{{ $accordionId }}"
                  class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                  aria-labelledby="collapse-item-{{ $loop->index }}"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <p class="faq-text">{{ !empty($data->answer) ? $data->answer : 'N/A' }}</p>
                  </div>
                </div>
              </div>
              @endif
              @endforeach
            </div>
            @endif
            @if ($event['EventResource']->isNotEmpty())
            <h2 class="h4 mt-50 mb-4 text-center">Resources & Workshops</h2>
            <div class="row">
              @foreach ($event['EventResource'] as $key=>$data)
                <div class="col-md-6 mb-30">
                  <div class="th-video"><img class="w-100"
                      src="{{asset('frontEndAssets/img/service/service_inner_1.jpg')}}" alt="service"> <a
                      href="{{!empty($data->video_link)?$data->video_link:'#'}}"
                      class="play-btn popup-video"><i class="fas fa-play"></i></a></div>
                </div>
              @endforeach
              
            </div>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
</section>