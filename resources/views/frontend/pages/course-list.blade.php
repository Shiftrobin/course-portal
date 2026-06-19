@extends('frontend.layouts.master')
@section('title', 'Course List')
@section('content')
    <section class="breadcrumb breadcrumb-img">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img style="display: none;" src="{{ asset('public/frontend') }}/assets/img/courses-cover.webp" alt="courses cover image" fetchpriority="high" loading="eager" />
                    <h1 class="header_title">Course Finder</h1>                   
                </div>
            </div>
        </div>
    </section>
    <section class="curriculum pb80 mt-70">
        <div class="container-fluid">

            <div class="row curriculum-search bxw p-4">

                <div class="col-md-12 text-center">
                    <input type="search" class="form-control mb-3" id="search" placeholder="Search course name here..">
                </div>

                <div class="col-md-3">
                    <div class="pt-2">
                        <label class="form-label">Country</label>
                        <select id="country_id" class="js-example-basic-single form-select select2-hidden-accessible"
                            data-width="100%" tabindex="-1" aria-hidden="true">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country )
                                <option value="{{ $country->id }}" >{{ $country->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="pt-2">
                        <label class="form-label">University</label>
                        <select id="university_id" class="js-example-basic-single form-select select2-hidden-accessible"
                            data-width="100%" tabindex="-1" aria-hidden="true">
                            <option value="">Select University</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pt-2">
                        <label class="form-label">Campus</label>
                        <select id="campus_id" class="js-example-basic-single form-select select2-hidden-accessible"
                            data-width="100%" tabindex="-1" aria-hidden="true">
                            <option value="">Select Campus</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pt-2">
                        <label class="form-label">Level</label>
                        <select id="level_id" class="js-example-basic-single form-select select2-hidden-accessible"
                            data-width="100%" tabindex="-1" aria-hidden="true">
                            <option value="">Select Level Name</option>

                        </select>
                    </div>
                </div>

                {{-- <div class="col-md-2">
                    <div class="pt-2">
                        <label class="form-label">Budget Range</label>
                        <select id="budget_id" class="js-example-basic-single form-select select2-hidden-accessible"
                            data-width="100%" tabindex="-1" aria-hidden="true">
                            <option value="">Select Budget</option>

                        </select>
                    </div>
                </div> --}}

            </div>

            <div id="course_data"">
                @include('frontend.components.course_data')
            </div>

        </div>
    </section>



<script>
    $(function(){
        $(document).on('change','#country_id',function(){
            var country_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('default.get-university') }}",
                data: {country_id:country_id},
                success: function (data) {
                    var html = '<option value=""> Select University</option>';
                    $.each(data,function(key,v){
                        html += '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                    $('#university_id').html(html);
                    var university_id = "";
                    if(university_id !=''){
                        $('#university_id').val(university_id).trigger('change');
                    }
                }
            });
        });
    });
</script>

<script>
    $(function(){
        var country_id = "";
        if(country_id){
            $('#country_id').val(country_id).trigger('change');
        }
    });
</script>

<script>
    $(function(){
        $(document).on('change','#university_id',function(){
            var university_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('default.get-campus') }}",
                data: {university_id:university_id},
                success: function (data) {
                    var html = '<option value=""> Select Campus</option>';
                    $.each(data,function(key,v){
                        html += '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                    $('#campus_id').html(html);
                    var campus_id = "{{ @$editData->campus_id }}";
                    if(campus_id !=''){
                        $('#campus_id').val(campus_id).trigger('change');
                    }
                }
            });
        });
    });
</script>

<script>
    $(function(){
        $(document).on('change','#campus_id',function(){
            var campus_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('default.get-level') }}",
                data: {campus_id:campus_id},
                success: function (data) {
                    var html = '<option value=""> Select Level</option>';
                    $.each(data,function(key,v){
                        html += '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                    $('#level_id').html(html);
                    var level_id = "{{ @$editData->level_id }}";
                    if(level_id !=''){
                        $('#level_id').val(level_id).trigger('change');
                    }
                }
            });
        });
    });
</script>


{{-- <script>
    $(function(){
        $(document).on('change','#level_id',function(){
            var level_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('default.get-budget') }}",
                data: {level_id:level_id},
                success: function (data) {
                    var html = '<option value=""> Select Budget Range</option>';
                    $.each(data,function(key,v){
                        html += '<option value="'+v.id+'">'+v.range+'</option>';
                    });
                    $('#budget_id').html(html);
                    var budget_id = "{{ @$editData->budget_id }}";
                    if(budget_id !=''){
                        $('#budget_id').val(budget_id);
                    }
                }
            });
        });
    });
</script> --}}

@endsection


@push('scripts')
    <script>
        $(document).ready(function () {
            let searchTimer = null;
            let courseAjaxRequest = null;
            const debounceDelay = 2000; // 2000 = 2 seconds, 3000 = 3 seconds

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getMoreCourses(page);
            });

            $('#search').on('input', function () {
                clearTimeout(searchTimer);

                searchTimer = setTimeout(function () {
                    getMoreCourses(1);
                }, debounceDelay);
            });

            $('#country_id').on('change', function () {
                getMoreCourses(1);
            });

            $('#university_id').on('change', function () {
                getMoreCourses(1);
            });

            $('#campus_id').on('change', function () {
                getMoreCourses(1);
            });

            $('#level_id').on('change', function () {
                getMoreCourses(1);
            });

            function getMoreCourses(page = 1) {
                var search = $('#search').val();

                var selectedCountry = $("#country_id option:selected").val();
                var selectedUniversity = $("#university_id option:selected").val();
                var selectedCampus = $("#campus_id option:selected").val();
                var selectedLevel = $("#level_id option:selected").val();

                if (courseAjaxRequest) {
                    courseAjaxRequest.abort();
                }

                courseAjaxRequest = $.ajax({
                    type: "GET",
                    data: {
                        'search_query': search,
                        'country_id': selectedCountry,
                        'university_id': selectedUniversity,
                        'campus_id': selectedCampus,
                        'level_id': selectedLevel
                    },
                    url: "{{ route('course.get-more-courses') }}" + "?page=" + page,
                    success: function (data) {
                        $('#course_data').html(data);
                    },
                    complete: function () {
                        courseAjaxRequest = null;
                    }
                });
            }
        });
    </script>
@endpush
