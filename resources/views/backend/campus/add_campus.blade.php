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
                                    Edit Campus
                                <a href="{{ route('all.campus') }}" class="btn btn-sm btn-inverse-info"> Go Back</a>
                                @else
                                     Add Campus
                                @endif
                            </h6>

                            <form class="forms-sample" method="POST" action="{{ (@$editData)?route('update.campus',@$editData->id):route('store.campus') }}" id="myForm">
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
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid  @enderror"
                                                value="{{@$editData->name}}"
                                                >
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
                        $('#university_id').val(university_id);
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

@endsection
