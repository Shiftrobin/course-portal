@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">

                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">
                                @if (@$editData)
                                    Edit Level
                                <a href="{{ route('all.level') }}" class="btn btn-sm btn-inverse-info"> Go Back</a>
                                @else
                                     Add Level
                                @endif
                            </h6>

                            <form class="forms-sample" method="POST" action="{{ (@$editData)?route('update.level',@$editData->id):route('store.level') }}" id="myForm">
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

                                            <select name="name" class="form-select  @error('name') is-invalid  @enderror" id="name">

                                                <option selected='' disabled=''> Select Level </option>
                                                <option value="Foundation" {{ @$editData->name == 'Foundation' ? 'selected' : '' }}>
                                                    Foundation
                                                </option>
                                                <option value="Undergraduate" {{ @$editData->name == 'Undergraduate' ? 'selected' : '' }}>
                                                    Undergraduate
                                                </option>
                                                <option value="Postgraduate" {{ @$editData->name == 'Postgraduate' ? 'selected' : '' }}>
                                                    Postgraduate
                                                </option>
                                                <option value="Research" {{ @$editData->name == 'Research' ? 'selected' : '' }}>
                                                    Research
                                                </option>

                                            </select>
                                            @error('name')
                                                <span>{{ $message }}</span>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary me-2">{{ (@$editData)?"Update":"Submit" }}</button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
            <!-- middle wrapper end -->
        </div>

    </div>


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
            name: {
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
                        $('#campus_id').val(campus_id);
                    }
                }
            });
        });
    });
</script>
{{--
<script>
    $(function(){
        var university_id = "{{ @$editData->university_id }}";
        if(university_id){
            $('#university_id').val(university_id).trigger('change');
        }
    });
</script> --}}

@endsection
