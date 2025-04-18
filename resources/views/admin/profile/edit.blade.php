@extends('admin.includes.app')

@section('title')
    Admin | Profile | Edit 
@endsection


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Admin</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Admin</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Edit Admin Information</h4>
                       
                    </div><!-- end card header -->
                    <div class="card-body">
                        @if (Session::has('error'))
                            <div class="alert alert-danger"> {{Session::get('error')}} </div>
                        @endif
                        <div class="live-preview">
                            <form action="{{route('admin.profile.update',$user->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                            <div class="row gy-4">
                                
                                
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                        
                                    </div>
                                    @error('name')
                                           <p class="text-danger">{{$message}}</p>
                                        @enderror
                                   
                                </div>
                                <!--end col-->

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                       
                                    </div>
                                    @error('email')
                                           <p class="text-danger">{{$message}}</p>
                                        @enderror
                                  
                                </div>
                                <!--end col-->
                                
                     
                                <!--end col-->

                                <center>
                                    <button type="submit" class="btn btn-primary"> Submit</button>
                                </center>

                        </div>
                    </form>
                    </div>
                </div>
            
            </div>
            <!--end col-->
        </div>
      
    </div> <!-- container-fluid -->
</div>
@endsection