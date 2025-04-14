@extends('frontend.layouts.master')
@section('title', 'Apply by university and Course')
@section('content')
    <section class="breadcrumb breadcrumb-img">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="header_title">Apply by University and Course</h1>                   
                </div>
            </div>
        </div>
    </section>
    <section class="curriculum pb80 mt-70">
        <div class="container-fluid">

            <div class="row curriculum-search bxw p-4 m-4">

                <div class="col-md-12 text-center d-none">
                    <input type="search" class="form-control mb-3" id="search" placeholder="Search course name here..">
                </div>              

            </div>

       
            <div class="row">

                @foreach ($courses as $key => $course)
                    <div class="col-md-4 px-10" item="{{ ++$key }}">
                            <div class="curriculum-subject wow fadeInDown all-course-box" data-wow-delay=".2s">

                                @php
                                    $campus = App\Models\CampusModel::where('id', $course->campus_id)->first();
                                    $university = App\Models\UniversityModel::where('id', $course->university_id)->first();
                                    $level = App\Models\LevelModel::where('id', $course->level_id)->first();
                                @endphp

                                <h2 class="all-coourse-title">{{ $course->name }}</h2>
                                <p><b>University:</b> {{ $university->name }}</p>
                                <p><b>Campus:</b> {{ $campus->name }}</p>
                                <p><b>Level:</b> {{ $level->name }}</p>
                                @if ($course->scholarship)
                                    <p><b>Scholarship:</b> {{ $course->scholarship  }}</p>
                                @else  
                                    <p><b>Scholarship:</b> Not Available right now</p>                  
                                @endif                   
                                <p class="course-item-author mt-3 mr-5 rounded-pill px-4 py-2 text-dark all-tuition-fees-title">Tuition Fees: {{ $course->currency }}{{ $course->fees }}</p>
                                <a href="{{
                                    url('/apply',
                                    [
                                        'universitySlug' => $university->slug,
                                        'courseSlug' => $course->slug,
                                        'id' => $course->id,
                                    ])
                                    }}"
                                class="link2 mt-2">
                                    Apply Now
                                <i class="ti-angle-right"></i>
                                </a>

                            </div>
                    </div>
                @endforeach

                <div class="col-md-12 text-center mt40">
                    {{-- {{ $courses->links() }} --}}
                </div> 

            </div>

         
        </div>
    </section>

@endsection



