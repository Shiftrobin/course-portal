@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">

                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">

                                @if (@$editData)
                                    Edit Course Name
                                <a href="{{ route('all.course_name') }}" class="btn btn-sm btn-inverse-info"> Go Back</a>
                                @else
                                    Add Course Name
                                @endif
                            </h6>

                            <form class="forms-sample" method="POST" action="{{ (@$editData)?route('update.course_name',@$editData->id):route('store.course_name') }}" id="myForm">
                                @csrf

                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label"> Course Name </label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid  @enderror"
                                        value="{{@$editData->name}}"
                                        id="name"
                                        >
                                    @error('name')
                                        <span>{{ $message }}</span>
                                    @enderror
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

@endsection
