@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">

                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Edit Permission </h6>

                            <form id="myForm" class="forms-sample" method="POST" action="{{ route('update.permission') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $permission->id }}" />

                                <div class="form-group mb-3">
                                    <label for="exampleInputUsername1" class="form-label"> Permission Name </label>
                                    <input type="text" name="name" value="{{ $permission->name }}"
                                        class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputUsername1" class="form-label"> Group Name </label>
                                    <select name="group_name" class="form-select" id="exampleFormControlSelect1">
                                        <option selected='' disabled=''> Select Group </option>
                                        <option value="homeseo" {{ $permission->group_name == 'homeseo' ? 'selected' : '' }}>
                                            Home SEO
                                        </option>
                                        <option value="country" {{ $permission->group_name == 'country' ? 'selected' : '' }}>
                                            Country
                                        </option>
                                        <option value="course" {{ $permission->group_name == 'course' ? 'selected' : '' }}>
                                            Course
                                        </option>
                                        <option value="course_name"
                                            {{ $permission->group_name == 'course_name' ? 'selected' : '' }}>
                                            Course Name
                                        </option>
                                        <option value="university"
                                            {{ $permission->group_name == 'university' ? 'selected' : '' }}>
                                            University
                                        </option>
                                        <option value="level" {{ $permission->group_name == 'level' ? 'selected' : '' }}>
                                            Level
                                        </option>
                                        <option value="campus"
                                            {{ $permission->group_name == 'campus' ? 'selected' : '' }}>
                                            Campus
                                        </option>
                                        <option value="budget" {{ $permission->group_name == 'budget' ? 'selected' : '' }}>
                                            Budget
                                        </option>
                                         <option value="application" {{ $permission->group_name == 'application' ? 'selected' : '' }}>
                                            Application
                                        </option>
                                        <option value="role" {{ $permission->group_name == 'role' ? 'selected' : '' }}>
                                            Role & Permission
                                        </option>
                                        <option value="admin" {{ $permission->group_name == 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
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
