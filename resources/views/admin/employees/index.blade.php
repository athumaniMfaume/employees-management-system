<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/material/tables-listjs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Aug 2024 20:05:08 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Employees | View Employees</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Sweet Alert css-->
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

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

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('admin.includes.header')


        <!-- ========== App Menu ========== -->
              <!-- ========== App Menu ========== -->
              <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <!-- Dark Logo-->
                    <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="17">
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="{{route('admin.dashboard')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="17">
                        </span>
                    </a>
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>
    
               {{-- sidebar --}}
               @include('admin.includes.side')
    
                <div class="sidebar-background"></div>
            </div>
            <!-- Left Sidebar End -->
            <!-- Vertical Overlay-->
            <div class="vertical-overlay"></div>
        <!-- Vertical Overlay-->
      

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">View Employee</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">View Employee</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Add, Edit & Remove Employee</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    @if (Session::has('success'))
                                    <div class="alert alert-success"> {{Session::get('success')}} </div>
                                @endif
                                    <div class="listjs-table" id="customerList">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <a href="{{route('employees.create')}}" class="btn btn-primary">Add Employee</a>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <div class="search-box ms-2">
                                                        <input type="text" class="form-control search" placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th> S/N </th>
                                                        <th class="sort" data-sort="customer_name">Image</th>
                                                        <th class="sort" data-sort="customer_name">Name</th>
                                                         <th class="sort" data-sort="customer_name">Gender</th>
                                                        <th class="sort" data-sort="email">Department</th>
                                                        <th class="sort" data-sort="email">Position</th>
                                                        <th class="sort" data-sort="phone">Email</th>
                                                        <th class="sort" data-sort="date">Birthday</th>
                                                        <th class="sort" data-sort="date">Join Date</th>
                                                        <th class="sort" data-sort="date">Phone</th>
                                                        <th class="sort" data-sort="status">Salary</th>
                                                        <th class="sort" data-sort="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($datas as $data)
                                            
                                        
                                                    <tr>
                                                        <th>{{$data->id}}</th>
                                                        <td><img height="70" width="120" src="/{{$data->image == NULL? 'assets/images/users/user-dummy-img.jpg': 'images/'.$data->image }}"></td>
                                                          <td class="customer_name" >{{ $data->name}}</td>
                                                        <td class="customer_name" >{{ $data->gender ?? ' ' }}</td>
                                                        <td class="date">{{$data->departments->name}}</td>
                                                        <td class="customer_name">{{$data->position}}</td>
                                                        <td class="email">{{$data->email}}</td>
                                                        <td class="phone">{{$data->dob}}</td>
                                                        <td class="date">{{$data->created_at}}</td>
                                                        <td class="date">{{$data->phone}}</td>
                                                        <td class="date">{{$data->salary}}</td>
                                                        <td>
                                                            <a href="{{ route('single.employees', $data->id) }}" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-edit-bin-5-line"></i>View</a>
                                                           <a href="{{ route('employees.edit', $data->id) }}" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-bin-5-line"></i>Edit</a>
                                                           <form action="{{ route('employees.destroy', $data->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this emloyee?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            
                                                            <button type="submit" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>                                            </form>
            
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                    </lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                   
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                                    Previous
                                                </a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next" href="javascript:void(0);">
                                                    Next
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                  


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <!-- prismjs plugin -->
    <script src="{{asset('assets/libs/prismjs/prism.js')}}"></script>
    <script src="{{asset('assets/libs/list.js/list.min.js')}}"></script>
    <script src="{{asset('assets/libs/list.pagination.js/list.pagination.min.js')}}"></script>

    <!-- listjs init -->
    <script src="{{asset('assets/js/pages/listjs.init.js')}}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/app.js')}}"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/material/tables-listjs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Aug 2024 20:05:08 GMT -->
</html>