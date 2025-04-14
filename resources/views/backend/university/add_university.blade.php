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
                                    Edit University
                                <a href="{{ route('all.university') }}" class="btn btn-sm btn-inverse-info"> Go Back</a>
                                @else
                                     Add University
                                @endif
                            </h6>

                            <form class="forms-sample" method="POST" action="{{ (@$editData)?route('update.university',@$editData->id):route('store.university') }}" id="myForm">
                                @csrf

                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label"> Country Name </label>
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

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label"> University Name </label>
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
                name: {
                required: true
                },
            },
            messages: {
                name: {
                     required: 'Please enter country'
                 },
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
