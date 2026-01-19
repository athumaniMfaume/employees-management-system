<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/material/auth-signup-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Aug 2024 20:03:47 GMT -->
<head>

    <meta charset="utf-8" />
    <title> Employee Management System | Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Layout config Js -->
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />


</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden m-0">
                            <div class="row justify-content-center g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" This system makes employee management seamless and efficient. A game-changer for our HR team! "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" User-friendly interface and excellent features for tracking employee records. Highly recommended! "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Managing employees, leave requests, and payroll has never been easier. A must-have for any company! "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        @if (Session::has('error'))
                                         <div class="alert alert-danger"> {{Session::get('error')}} </div>
                                        @endif

                                        @if (Session::has('success'))
                                          <div class="alert alert-success"> {{Session::get('success')}} </div>
                                        @endif
                                        <div>
                                            <h5 class="text-primary">Login Account</h5>

                                        </div>

                                        <div class="mt-4">
                                            <form  action="{{route('loginPost')}}" method="POST">
                                                @csrf

                                                <div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input type="email" 
           name="email" 
           id="email"
           class="form-control @error('email') is-invalid @enderror" 
           value="{{ old('email') }}"  
           placeholder="e.g. athumani@example.com">
    
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


                                                <div class="mb-3">
    <label class="form-label" for="password-input">Password</label>
    <div class="position-relative auth-pass-inputgroup">
        <input type="password" 
               name="password" 
               id="password-input" 
               class="form-control pe-5 @error('password') is-invalid @enderror" 
               placeholder="Enter password">
        
        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon" 
                type="button" 
                id="password-addon">
            <i class="ri-eye-fill align-middle"></i>
        </button>

        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>




                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Login</button>
                                                </div>

                                           <div class="mt-5 text-center">
                                            <p class="mb-0">Forgot Password? <a href="{{route('password.forgot')}}" class="fw-semibold text-primary text-decoration-underline"> Click here...</a> </p>
                                        </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
         @include('admin.includes.footer')
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>

    <!-- validation init -->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
    <!-- password create init -->
    <script src="{{asset('assets/js/pages/passowrd-create.init.js')}}"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/material/auth-signup-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Aug 2024 20:03:47 GMT -->
</html>
