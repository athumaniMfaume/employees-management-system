@extends('admin.includes.app')

@section('title')
   Admin | Salary | Edit
@endsection

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Salary</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Salary</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Edit Salary Information</h4>
                        <div class="flex-shrink-0">
                            <a href="{{ route('salaries.index') }}" class="btn btn-primary">View Salaries</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('error'))
                            <div class="alert alert-danger"> {{ Session::get('error') }} </div>
                        @endif
                        <div class="live-preview">
                            <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row gy-4">

                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label class="form-label">Basic Salary</label>
                                            <input type="number" name="basic_salary" class="form-control" 
                                                value="{{ old('basic_salary', $salary->basic_salary) }}">
                                        </div>
                                        @error('basic_salary')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label class="form-label">Employee</label>
                                            <select name="employee_id" class="form-control">
                                                <option value="" disabled>Select employee</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}" {{ $salary->employee_id == $employee->id ? 'selected' : '' }}>
                                                        {{ $employee->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('employee_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label class="form-label">Allowance</label>
                                            <input type="number" name="allowance" class="form-control" 
                                                value="{{ old('allowance', $salary->allowance) }}">
                                        </div>
                                        @error('allowance')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label class="form-label">Deductions</label>
                                            <input type="number" name="deductions" class="form-control" 
                                                value="{{ old('deductions', $salary->deductions) }}">
                                        </div>
                                        @error('deductions')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <center>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </center>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
@endsection
