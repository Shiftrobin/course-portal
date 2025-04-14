<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <title>Admin Login</title>
    <style>
        .authlogin-side-wrapper {
            width: 100%;
            height: 100%;
            background-image: url({{ asset('public/upload/login.png') }} );
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/demo2/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('public/backend/assets/images/favicon.png') }}" />
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="mx-0 row w-100 auth-page">
                    <div class="mx-auto col-md-8 col-xl-6">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pe-md-0">
                                    <div class="authlogin-side-wrapper">

                                    </div>
                                </div>
                                <div class="col-md-8 ps-md-0">
                                    <div class="px-4 py-5 auth-form-wrapper">
                                        <a href="#" class="mb-2 noble-ui-logo logo-light d-block">AIMS<span>
                                                Education</span></a>
                                        <h5 class="mb-4 text-muted fw-normal">Welcome back! Log in to your account.</h5>


                                        <form class="forms-sample" method="post" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="login" class="form-label">Email Address </label>
                                                <input type="email" class="form-control" id="login" name="login"
                                                    placeholder="Email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="userPassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" autocomplete="current-password"
                                                    placeholder="Password" value="" required>
                                            </div>
                                            <div class="mb-3">
                                                {{-- google captcha v2 --}}
                                                {{-- {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!} --}}
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="mb-2 btn btn-outline-primary btn-icon-text mb-md-0">
                                                    Login
                                                </button>
                                            </div>
                                            <div>
                                                <br>
                                                <input type="checkbox" onclick="passShow()"> Show Password

                                                <script>
                                                    function passShow() {
                                                        var x = document.getElementById("password");
                                                        if (x.type === "password") {
                                                            x.type = "text";
                                                        } else {
                                                            x.type = "password";
                                                        }
                                                    }
                                                </script>

                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('public/backend/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('public/backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

</body>

</html>
