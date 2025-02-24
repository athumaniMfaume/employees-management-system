@extends('employees.includes.app')

@section('title')
    Employee | Edit Employee
@endsection


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Employee</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('employees.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Employee</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Edit Employee Information</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <a href="{{route('employees.show')}}" class="btn btn-primary">View Employee</a>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        @if (Session::has('error'))
                            <div class="alert alert-danger"> {{Session::get('error')}} </div>
                        @endif
                        <div class="live-preview">
                            <form action="{{route('employees.profile.update',$datas->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <div class="row gy-4">
                                
                                
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$datas->name}}">
                                        
                                    </div>
                                   
                                </div>
                                <!--end col-->

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Department</label>
                                        <select name="department_id" class="form-control" >
                                            <option value="" disabled selected> Select Department</option>
                                            @foreach ($deps as $dep)
                                                <option value="{{$dep->id}}" {{$datas->departments->id == $dep->id ? 'selected':''}}>{{$dep->name}}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                  
                                </div>



                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{$datas->email}}">
                                       
                                    </div>
                                  
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control"  value="{{$datas->phone}}">
                                    </div>
                                  
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">Date of birth</label>
                                        <input type="date" name="dob" class="form-control" value="{{$datas->dob}}" >
                                    </div>
                                 
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="readonlyPlaintext" class="form-label">Position</label>
                                        <input type="text" name="position" class="form-control" value="{{$datas->position}}">
                                    </div>
                                    
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="readonlyInput" class="form-label">Salary</label>
                                        <input type="text" name="salary" class="form-control"  value="{{$datas->salary}}">
                                    </div>
                                    
                                </div>
                                <!--end col-->

                                    <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="readonlyInput" class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control"  >
                                    </div>
                                   
                                </div>

                               <div class="col-xxl-3 col-md-6">
                    <label>Current image</label>
                  <img height="70" width="120" src="/{{$datas->image == NULL? 'assets/images/users/user-dummy-img.jpg': 'images/'.$datas->image }}">
                </div>
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
        <!--end row-->




   



    </div> <!-- container-fluid -->
</div>
@endsection