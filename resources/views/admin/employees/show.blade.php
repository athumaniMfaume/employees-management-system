@extends('admin.includes.app')

@section('title')
    Employee | Profile
@endsection


@section('content')

<div class="page-content">
    
                <div class="container-fluid">
                    <div class="profile-foreground position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg">
                            <img height="70" width="120" src="/{{$employee->image == NULL? 'assets/images/users/user-dummy-img.jpg': 'images/'.$employee->image }}" class="profile-wid-img" />
                        </div> 
                    </div>
                    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
                        <div class="row g-4">
                            <div class="col-auto">
                                <div class="avatar-lg">
                                    <img src="/{{$employee->image == NULL? 'assets/images/users/user-dummy-img.jpg': 'images/'.$employee->image }}"alt="user-img" class="img-thumbnail rounded-circle" />
                                </div> -->
                            </div>
                            <!--end col-->
                            <div class="col">
                                <div class="p-2">
                                   
                                    <h3 class="text-white mb-1">{{$employee->name}}</h3>
                                    <p class="text-white text-opacity-75">{{$employee->position}}</p>
                              
                                </div>
                            </div>
                     

                        </div>
                        <!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <div class="d-flex profile-wrapper">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Overview</span>
                                            </a>
                                        </li>
                              
                                    </ul>
                                    <div class="flex-shrink-0">
                                        <a href="{{route('employees.edit',$employee->id)}}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Employee</a>
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content pt-4 text-muted">
                                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                        <div class="row">
                                            <div class="col-xxl-3">
                                               
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">Info</h5>
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Full Name :</th>
                                                                        <td class="text-muted">{{$employee->name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Gender :</th>
                                                                        <td class="text-muted">{{$employee->gender}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Mobile :</th>
                                                                        <td class="text-muted">{{$employee->phone}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">E-mail :</th>
                                                                        <td class="text-muted">{{$employee->email}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Department :</th>
                                                                        <td class="text-muted">{{$employee->departments->name}}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Joining Date</th>
                                                                        <td class="text-muted">{{$employee->created_at}}</td>
                                                                    </tr>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->

                                               
                                            </div>
                                            <!--end col-->
                                           
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                  
                                </div>
                                <!--end tab-content-->
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->
@endsection