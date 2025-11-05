@php
$layout_setting = \App\Models\LandingPage::first();
@endphp

@extends('frontEnd.layouts.master')

@section('content')

<!-- ===========================
     Page Header
=========================== -->
<div class="page-header title-area">
    <div class="header-title" style="background:url({{ asset('images/bg/page-header1.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title">Career</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumb-area py-2">
        <div class="container">
            <nav class="breadcrumb d-flex justify-content-center">
                <span><a class="home" href="{{ route('home') }}"><span>Home</span></a></span>
                <i class="fa fa-angle-right mx-2" aria-hidden="true"></i>
                <span>Career</span>
            </nav>
        </div>
    </div>
</div>

<!-- Achievement Section -->
<section style="padding-top: 20px; padding-bottom: 60px;">
    <div class="container">
        <style>
            #search-input {
                transition: all 0.3s ease;
            }

            #search-input:focus {
                box-shadow: 0 0 8px rgba(111, 66, 193, 0.3);
                transform: scale(1.02);
            }
        </style>
        <!-- Search Box -->
        <div class="row justify-content-center" style="margin-top: 20px; margin-bottom: 40px;">
            <div class="col-lg-12 col-md-12">
                <div class="search-box position-relative shadow-sm rounded-pill overflow-hidden mx-auto">
                    <input
                        type="text"
                        id="search-input"
                        class="form-control border-0 py-3 px-4 text-center"
                        placeholder="Search Carrer..."
                        autocomplete="off"
                        style="font-size: 17px;" />
                </div>
            </div>
        </div>
        <!-- Search Results -->
        <div class="pb-4" id="content" style="display:none;"></div>
        <!-- Career List -->
        <div class="row gy-4 justify-content-center">
            @if(!empty($careers) && $careers->count() > 0)
            @foreach ($careers as $value)
            @php
            $filePath = $value->file ? asset($value->file) : null;
            $fileExtension = $value->file ? pathinfo($value->file, PATHINFO_EXTENSION) : '';
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if(in_array(strtolower($fileExtension), ['pdf'])) $icon = 'fas fa-file-pdf text-danger';
            elseif(in_array(strtolower($fileExtension), ['doc', 'docx'])) $icon = 'fas fa-file-word text-primary';
            elseif(in_array(strtolower($fileExtension), ['xls', 'xlsx'])) $icon = 'fas fa-file-excel text-success';
            elseif(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) $icon = 'fas fa-file-image text-info';
            @endphp
            <div class="col-md-4 mb-3 achievement-item" data-title="{{ strtolower($value->title) }}">
                <div class="card border-0 shadow-sm p-3 achievement-card h-100">
                    <div class="row g-0">

                        <!-- Left: File Preview -->
                        <div class="col-sm-4" style="padding-right:0; margin-right:-40px;">
                            <img src="{{ asset('images/default/file.png')}}" alt="file"
                                class="rounded img-fluid"
                                style="height:60px;  display:block; background:none; border:none;">
                        </div>

                        <!-- Right: Title + Buttons -->
                        <div class="col-md-8" style="padding-left:0px;">
                            <div class="justify-content-between h-100">
                                <div>
                                    <a href="{{ route('home.achievement.show', $value->id) }}"
                                        class="text-decoration-none text-dark fw-semibold d-block text-truncate hover-purple"
                                        title="{{ $value->title }}">
                                        {{ \Illuminate\Support\Str::limit($value->title ?? 'Untitled', 60) }}
                                    </a>
                                    <small class="text-muted d-block mt-1">
                                        {{ \Carbon\Carbon::parse($value->created_at ?? now())->format('d M, Y') }}
                                    </small>
                                </div>
                                @if($filePath)
                                <div class="mt-2 d-flex flex-wrap gap-2">
                                    <a href="{{ $filePath }}" target="_blank"
                                        class="btn">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                    <a href="{{ $filePath }}" download
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                </div>
                                @else
                                <span class="text-danger small mt-2">No file available</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">No careers found.</h5>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Optional: Search Filter Script -->
<script>
    document.getElementById('search-input').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const cards = document.querySelectorAll('.achievement-card');

        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.parentElement.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>

<style>
    .hover-purple:hover {
        color: #6f42c1 !important;
    }

    .search-box input:focus {
        box-shadow: none;
    }

    .achievement-card {
        transition: all 0.3s ease;
    }

    .achievement-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }
</style>


<!-- ===========================
     Custom Styles
=========================== -->
<style>
    /* Search Bar */
    .search-bar input:focus {
        box-shadow: none;
    }

    .search-bar {
        transition: 0.3s;
    }

    .search-bar:hover {
        box-shadow: 0 4px 15px rgba(111, 66, 193, 0.15);
    }

    /* File Card */
    .file-card {
        transition: 0.3s ease;
    }

    .file-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    /* File Preview */
    .file-preview {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .file-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
    }

    .file-icon {
        width: 80px;
        opacity: 0.8;
    }

    /* Buttons */
    .btn-outline-success:hover {
        background-color: #6f42c1;
        border-color: #6f42c1;
        color: #fff;
    }

    .btn-outline-primary:hover {
        background-color: #563d7c;
        border-color: #563d7c;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .file-preview {
            height: 120px;
        }
    }
</style>
@endsection

<!-- ===========================
     Custom JS
=========================== -->
@section('customeJS')
<script>
    $(document).ready(function() {
        // Client-side live search
        $('#search-input').on('input', function() {
            let query = $(this).val().toLowerCase();
            let items = $('.achievement-item');

            if (query.length > 0) {
                items.each(function() {
                    let title = $(this).data('title');
                    $(this).toggle(title.includes(query));
                });
            } else {
                items.show();
            }
        });
    });
</script>
@endsection