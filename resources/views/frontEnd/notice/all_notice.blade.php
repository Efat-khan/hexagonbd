@extends('frontEnd.layouts.master')
@section('content')
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">All Notice's</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">All Notice's</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="th-blog-wrapper space-extra-bottom">
    <div class="container z-index-common">

        <!-- Search Box -->
        <div class="row justify-content-center pb-4">
            <div class="col-lg-6">
                <aside class="sidebar-area">
                    <div class="widget widget_search">
                        <form class="search-form position-relative">
                            <input type="text" id="search-input" class="form-control" placeholder="Enter Keyword" autocomplete="off">
                            <button type="submit" class="search-btn">
                                <i class="far fa-search"></i>
                            </button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>

        <!-- Hidden Content Placeholder -->
        <section class="pb-3" style="display: none;" id="content"></section>

        <!-- Notices Grid -->
        <section class="pb-5">
            <div class="row gy-4">
                @foreach ($notices as $key => $value)
                @php
                $filePath = $value->file ? asset($value->file) : null;
                $fileExtension = $value->file ? pathinfo($value->file, PATHINFO_EXTENSION) : '';
                $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $allowedViewExtensions = array_merge($allowedImageExtensions, ['pdf']);
                @endphp

                <div class="col-md-6 col-xl-3">
                    <div class="blog-style-one bg-white p-3 rounded shadow-sm h-100">
                        <!-- Date Badge -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="date-box text-center me-3">
                                <div class="day-month">{{ \Carbon\Carbon::parse($value->created_at)->format('d M') }}</div>
                                <div class="year">{{ \Carbon\Carbon::parse($value->created_at)->format('Y') }}</div>
                            </div>
                            <!-- Title -->
                            <h5 class="mb-0">
                                <a href="{{ route('home.notice.show', $value->id) }}" class="text-dark">
                                    {{ \Illuminate\Support\Str::words($value->title, 5, '...') }}
                                </a>
                            </h5>
                        </div>

                        <!-- Action Buttons -->
                        @if($filePath)
                        <div class="d-flex justify-content-start gap-3">
                            @if(in_array(strtolower($fileExtension), $allowedViewExtensions))
                            <a href="{{ $filePath }}" target="_blank" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                            @endif
                            <a href="{{ $filePath }}" download class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-download me-1"></i> Download
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Custom Styles -->
            <style>
                .search-form {
                    position: relative;
                }

                .search-form .search-btn {
                    position: absolute;
                    top: 50%;
                    right: 10px;
                    transform: translateY(-50%);
                    background: transparent;
                    border: none;
                    font-size: 16px;
                    color: #333;
                }

                .date-box {
                    background-color: #00a651;
                    color: #fff;
                    font-weight: bold;
                    min-width: 60px;
                    border-radius: 4px;
                    overflow: hidden;
                    font-size: 13px;
                }

                .date-box .day-month {
                    background-color: #e6f3e6;
                    color: #00a651;
                    padding: 4px;
                    font-size: 11px;
                    text-transform: uppercase;
                }

                .date-box .year {
                    padding: 4px;
                    font-size: 13px;
                }

                .blog-style-one {
                    transition: 0.3s ease;
                }

                .blog-style-one:hover {
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
                }
            </style>
        </section>
    </div>

    <!-- Decorative Shape (from template) -->
    <div class="shape-mockup" data-bottom="0" data-left="0">
        <div class="particle-2" id="particle-2"></div>
    </div>
</section>

@endsection

@section('customeJS')
<script>
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            let query = $(this).val().trim(); // Trim whitespace

            // Check if the query length is valid
            if (query.length > 1) {
                $.ajax({
                    url: '{{ route("home.notice.search") }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        let resultsDiv = $('#content');
                        resultsDiv.empty().show(); // Clear results and show the container

                        if (data.length > 0) {
                            data.forEach(item => {
                                let title = item.title || 'N/A';
                                let message = item.message || 'N/A';
                                let createdAt = item.created_at ? new Date(item.created_at) : null;

                                // Format date
                                let dayMonth = 'N/A';
                                let year = 'N/A';
                                if (createdAt instanceof Date && !isNaN(createdAt)) {
                                    dayMonth = createdAt.toLocaleDateString('en-US', {
                                        day: '2-digit',
                                        month: 'short'
                                    }).toUpperCase();
                                    year = createdAt.getFullYear();
                                }

                                // Truncate strings
                                let truncatedTitle = title.length > 30 ? title.substring(0, 30) + '...' : title;
                                let truncatedMessage = message.length > 50 ? message.substring(0, 50) + '...' : message;

                                resultsDiv.append(`
                                <div class="comment-item d-flex align-items-center col-md-3">
                                    <div class="date-box text-center">
                                        <div class="day-month">${dayMonth}</div>
                                        <div class="year">${year}</div>
                                    </div>
                                    <div class="comment-content ms-3">
                                        <h4 class="title mb-1">${truncatedTitle}</h4>
                                        <p class="category mb-0">${truncatedMessage}</p>
                                    </div>
                                </div>
                                <hr>
                            `);
                            });
                        } else {
                            resultsDiv.append('<p>No results found.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Search request failed:', error);
                    }
                });
            } else {
                $('#content').hide().empty(); // Hide and clear results if the query is too short
            }
        });
    });
</script>


@endsection