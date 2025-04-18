<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

               


                        <div class="dropdown ms-1 topbar-head-dropdown header-item">

                          <a href="{{ route('single.employee.leaves.view') }}" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
                            <span class="d-none d-xl-inline-block ms-5 fw-medium user-name-text">Leave</span>                        </a>
                        </div>
               
                        <div class="dropdown ms-1 topbar-head-dropdown header-item">

                            <a href="{{ route('single.employee.complain.view') }}" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
                            <span class="d-none d-xl-inline-block ms-5 fw-medium user-name-text ">Complain</span>                        </a>
                        </div>

                        <div class="dropdown ms-1 topbar-head-dropdown header-item">

                            <a href="{{ route('employees.profile') }}" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
                            <span class="d-none d-xl-inline-block ms-5 fw-medium user-name-text">Profile</span>                        </a>
                        </div>
               
                        <div class="dropdown ms-1 topbar-head-dropdown header-item">

                            <a href="{{ route('change_password') }}" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
                            <span class="d-none d-xl-inline-block ms-5 fw-medium user-name-text ">Change Password</span>                        </a>
                        </div>

                        <div class="dropdown ms-1 topbar-head-dropdown header-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item notify-item language py-2" data-lang="en" title="Logout">
                            <span class="d-none d-xl-inline-block ms-5 fw-medium user-name-text">Logout</span>
                            </button>
                            </form>
                        </div>

            
             
                   </div>

                <div class="d-flex align-items-center">

             
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

              

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="/{{Auth::guard('employee')->user()->image == NULL? 'assets/images/users/user-dummy-img.jpg': 'images/'.Auth::guard('employee')->user()->image }}" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{Auth::guard('employee')->user()->name}}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{Auth::guard('employee')->user()->position}}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{Auth::guard('employee')->user()->name}}!</h6>
                        <a class="dropdown-item" href="{{ route('employees.profile') }}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                       
                       
                        <a class="dropdown-item" href="{{ route('change_password') }}"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Change Password</span></a>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf

                    <button type="submit" class="dropdown-item "> <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>Logout</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>