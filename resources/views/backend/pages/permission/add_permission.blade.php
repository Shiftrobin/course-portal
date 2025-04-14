@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">

                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add Permission </h6>

                            <form id="myForm" class="forms-sample" method="POST" action="{{ route('store.permission') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="exampleInputUsername1" class="form-label"> Permission Name </label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputUsername1" class="form-label"> Group Name </label>
                                    <select name="group_name" class="form-select" id="exampleFormControlSelect1">
                                        <option selected='' disabled=''> Select Group </option>
                                        <option value="homeseo"> Home SEO </option>
                                        <option value="country"> Country </option>
                                        <option value="course"> Course </option>
                                        <option value="course_name"> Course Name</option>
                                        <option value="university"> University</option>
                                        <option value="level"> Level</option>
                                        <option value="campus"> Campus</option>
                                        <option value="budget"> Budget</option>
                                        <option value="application"> Application</option>
                                        <option value="role"> Role & Permission </option>
                                        <option value="admin"> Admin </option>

                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Submit</button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
            <!-- middle wrapper end -->
        </div>

    </div>


    {{-- validate  --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    amenities_name: {
                        required: true,
                    },

                },
                messages: {
                    amenities_name: {
                        required: 'Please Enter Amenitie Name',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
