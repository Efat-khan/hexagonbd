@extends('frontEnd.layouts.master')
@section('content')
<style>
    .stock {
        font-weight: bold;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status.paid {
        color: green;
    }

    .status.unpaid {
        color: red;
    }

    .status.pending {
        color: orange;
    }

    .badge-status {
        font-size: 0.875rem;
        padding: 0.4rem 0.6rem;
        border-radius: 0.25rem;
    }

    .badge-complete {
        background-color: #28a745;
        color: #fff;
    }

    .badge-pending {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-failed {
        background-color: #dc3545;
        color: #fff;
    }
</style>

<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Enrolled Student List</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Selected Student</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp mb-4" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Filter</h6>
            <h2 class="mb-4">Check Your <span class="text-primary">Enrollment</span> Status</h2>
        </div>
        <!-- Filter/Search Start -->
<div class="container mb-4">
    <form method="GET" action="{{ route('home.course') }}" class="row g-3">
        <div class="col-md-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search Courses...">
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="course" class="form-select" onchange="this.form.submit()">
                <option value="">All Course</option>
                @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                    {{ $course->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-grid">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>
</div>
<!-- Filter/Search End -->
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <input type="text" id="teamSearch" class="form-control" placeholder="Search by name or institute...">
            </div>
        </div>

        <div class="table-responsive wow fadeInUp" data-wow-delay="0.3s">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Student Name</th>
                        <th>Institute Name</th>
                        <th>Course</th>
                        <th>Enroll ID</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody id="teamTableBody">
                    @if (count($order_list) == 0)
                        <tr>
                            <td colspan="4" class="text-center">No data published yet</td>
                        </tr>
                    @else
                        @foreach($order_list as $key => $value)
                        <tr>
                            <td class="team-name">{{ $value['student']->full_name ?? '-' }}</td>
                            <td class="institute-name">{{ $value['student']->institute ?? '-' }}</td>
                            <td class="institute-name">{{ $value['course']->name ?? '-' }}</td>
                            <td class="coach-email">{{ $value->order_tracking_id ?? '-' }}</td>
                            <td>
                                @if($value->status == 'completed')
                                    <span class="badge badge-status badge-complete"><i class="fas fa-check-circle me-1"></i> Complete</span>
                                @elseif($value->status == 'pending')
                                    <span class="badge badge-status badge-pending"><i class="fas fa-hourglass-half me-1"></i> Pending</span>
                                @else
                                    <span class="badge badge-status badge-failed"><i class="fas fa-times-circle me-1"></i> Failed</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('customeJS')
<script>
    $(document).ready(function () {
        $('#teamSearch').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('#teamTableBody tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>
@endsection
