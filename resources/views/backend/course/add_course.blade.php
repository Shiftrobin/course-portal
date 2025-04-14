@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('all.course') }}">All Courses </a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Course</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                       <h6 class="card-title pb-3">
                            @if (@$editData)
                               Edit Course
                                    @if (Auth::user()->can('delete.course'))
                                            <a href="{{ route('delete.course',  @$editData->id) }}"
                                            class="btn btn-xs btn-inverse-danger text-white mx-2" id="delete">Delete</a>
                                    @endif
                                <a href="{{ route('all.course') }}" class="btn btn-sm btn-inverse-info"> Go Back</a>
                                @else
                                    Add Course
                                @endif
                        </h6>

                        <form method="POST" action="{{ (@$editData)?route('update.course',@$editData->id):route('store.course') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label"> Country Name</label>
                                        <select name="country_id"
                                        class="js-example-basic-single form-select select2-hidden-accessible"
                                        data-width="100%" tabindex="-1" aria-hidden="true" id="country_id">
                                             <option value="">Select Country</option>
                                            @foreach ($countries as $country )
                                                   <option value="{{ $country->id }}" {{ (@$editData->country_id==$country->id)?"selected":""}}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label"> University Name </label>
                                        <select name="university_id"
                                        class="js-example-basic-single form-select select2-hidden-accessible"
                                        data-width="100%" tabindex="-1" aria-hidden="true" id="university_id">
                                             <option value="">Select University</option>

                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label"> Campus Name </label>
                                        <select name="campus_id"
                                        class="js-example-basic-single form-select select2-hidden-accessible"
                                        data-width="100%" tabindex="-1" aria-hidden="true" id="campus_id">
                                             <option value="">Select Campus</option>

                                        </select>
                                    </div>

                                </div>


                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label"> Level Name </label>
                                        <select name="level_id"
                                        class="js-example-basic-single form-select select2-hidden-accessible"
                                        data-width="100%" tabindex="-1" aria-hidden="true" id="level_id">
                                             <option value="">Select Level</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label"> Budget Range Name </label>

                                        <select name="budget_id"
                                        class="js-example-basic-single form-select select2-hidden-accessible"
                                        data-width="100%" tabindex="-1" aria-hidden="true" id="budget_id">
                                            <option selected='' disabled=''> Select Budget Range </option>

                                        </select>
                                    </div>
                                </div>

                                @if (@$editData)
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label"> Course Name</label>
                                            <select name="name"
                                            class="js-example-basic-single form-select select2-hidden-accessible"
                                            data-width="100%" tabindex="-1" aria-hidden="true" id="course_name_id">
                                                <option value="">Select Course Name</option>
                                                <option value="{{ @$editData->name }}" {{ (@$editData->name==@$editData->name)?"selected":""}}>{{ @$editData->name }}</option>
                                                @foreach ($courses as $course )
                                                    <option value="{{ $course->name }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label"> Course Name</label>
                                            <select name="name"
                                            class="js-example-basic-single form-select select2-hidden-accessible"
                                            data-width="100%" tabindex="-1" aria-hidden="true" id="course_name_id">
                                                <option value="">Select Course Name</option>
                                                @foreach ($courses as $course )
                                                    <option value="{{ $course->name }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Fees</label>
                                        <input type="text" name="fees"
                                            class="form-control @error('fees') is-invalid  @enderror"
                                            id="fees"
                                            value="{{ @$editData->fees }}"
                                            />
                                        @error('fees')
                                            <span>{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Currency</label>
                                        <select name="currency"
                                            class="js-example-basic-single form-select select2-hidden-accessible  
                                            @error('currency') is-invalid  @enderror"
                                            data-width="100%" tabindex="-1" aria-hidden="true"           
                                            id="currency">
                                            <option selected='' disabled=''> Select Currency </option>
                                            <option value="£" {{ @$editData->currency == '£' ? 'selected' : '' }}>
                                                £
                                            </option>
                                            <option value="$" {{ @$editData->currency == '$' ? 'selected' : '' }}>
                                                $
                                            </option>
                                            <option value="€" {{ @$editData->currency == '€' ? 'selected' : '' }}>
                                                €
                                            </option>
                                            
                                            <option value="zł‎" {{ @$editData->currency == 'zł‎' ? 'selected' : '' }}>
                                                zł‎
                                            </option>

                                            <option value="Ft" {{ @$editData->currency == 'Ft' ? 'selected' : '' }}>
                                                Ft
                                            </option>
                                            
                                            <option value="kr" {{ @$editData->currency == 'kr' ? 'selected' : '' }}>
                                                kr
                                            </option>
                                            
                                            <option value="AED" {{ @$editData->currency == 'AED' ? 'selected' : '' }}>
                                                AED
                                            </option>
                                        </select>
                                        @error('currency')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Scholarship</label>
                                        <input type="text" name="scholarship"
                                            class="form-control @error('scholarship') is-invalid  @enderror"
                                            id="fees"
                                            value="{{ @$editData->scholarship }}"
                                            />
                                        @error('scholarship')
                                            <span>{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">URL </label>
                                        <input type="text"
                                            class="form-control @error('url') is-invalid  @enderror"
                                            value="{{ route('home'); }}/apply/{{ @$editData['university']['slug'] }}/{{ @$editData->slug }}/{{ @$editData->id }}"
                                            />
                                        @error('url')
                                            <span>{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Overview</label>
                                        <textarea name="overview" class="form-control" id="overview" rows="3">{{ @$editData->overview }}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Entry Requirements</label>
                                        <textarea name="entry_requirements" class="form-control" id="entry_requirements" rows="3">{{ @$editData->entry_requirements }}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Scholarship Details</label>
                                        <textarea name="scholarship_details" class="form-control" id="scholarship_details" rows="3">{{ @$editData->scholarship_details }}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3 mt-3">
                                        <h3 class="text-center">SEO Properties</h3>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Page Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ @$editData->title }}" />
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Share Title</label>
                                        <input type="text" name="share_title" class="form-control" value="{{ @$editData->share_title }}" />
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3">{{ @$editData->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Keywords</label>
                                        <textarea name="keywords" class="form-control" rows="3">{{ @$editData->keywords }}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="page_image" class="mb-2">Page Image</label>
                                      <input type="file" name="page_image" class="form-control" id="image">
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="mb-3">
                                     <img id="showImage" src="{{(!empty(@$editData->page_image))?url('public/upload/course/'.$editData->page_image):url('public/upload/no_image.jpg')}}" style="width: 150px; height: 150px; border:1px solid #000;" alt="">
                                    </div>
                                 </div>


                            </div>

                            <button type="submit" class="btn btn-primary me-2">{{ (@$editData)?"Update":"Submit" }}</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
{{--
<script type="text/javascript">
    $(document).ready(function(){
      var a1 = CKEDITOR.replace('description');
      CKFinder.setupCKEditor( a1, '/ckfinder/' );
    });
</script> --}}

<script type="text/javascript">
    $(document).ready(function(){
      var a1 = CKEDITOR.replace('overview');
      CKFinder.setupCKEditor( a1, '/ckfinder/' );
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
      var a1 = CKEDITOR.replace('entry_requirements');
      CKFinder.setupCKEditor( a1, '/ckfinder/' );
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
      var a1 = CKEDITOR.replace('scholarship_details');
      CKFinder.setupCKEditor( a1, '/ckfinder/' );
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#myForm').validate({
        rules: {
            country_id: {
            required: true
            },
            university_id: {
            required: true
            },
            campus_id: {
            required: true
            },
            level_id: {
                required: true
            },
            budget_id: {
            required: true
            },
            name: {
            required: true
            },
            fees: {
            required: true
            },
        },
        messages: {

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
        });
    });
 </script>

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
                    var university_id = "{{ @$editData->university_id }}";
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
        var country_id = "{{ @$editData->country_id }}";
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


<script>
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
</script>


@endsection
