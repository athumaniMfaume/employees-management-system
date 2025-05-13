@extends('admin.includes.app')

@section('title')
   Admin | Salary | Add
@endsection


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Employee</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Employee</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Enter Employee Information</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <a href="{{route('salaries.index')}}" class="btn btn-primary">View Employee</a>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        @if (Session::has('error'))
                            <div class="alert alert-danger"> {{Session::get('error')}} </div>
                        @endif
                        <div class="live-preview">
                            <form action="{{ route('salaries.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="row gy-4">
                                
                                
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Basic Salary</label>
                                        <input  type="number" name="basic_salary"  class="form-control" placeholder="Enter Basic Salary">
                                        
                                    </div>
                                    @error('basic_salary')
                                           <p class="text-danger">{{$message}}</p>
                                        @enderror
                                </div>

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">employee</label>
                                        <select name="employee_id" class="form-control" >
                                            <option value="" disabled selected> Select employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    @error('employee->id')
                                           <p class="text-danger">{{$message}}</p>
                                        @enderror
                                </div>
                                
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Allowance</label>
                                        <input type="number" name="allowance" class="form-control" placeholder="Enter Allowance">
                                       
                                    </div>
                                    @error('allowance')
                                    <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Deductions</label>
                                        <input type="number" name="deductions" class="form-control"  placeholder="Enter Deductions">
                                    </div>
                                    @error('deductions')
                                    <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>


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