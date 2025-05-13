@extends('admin.includes.app')

@section('title')
    Admin | Salaries | Show
@endsection

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="profile-foreground position-relative mx-n4 mt-n4">
            <div class="profile-wid-bg">
                <img height="70" width="120" src="/{{ $salary->employee->image == NULL ? 'assets/images/users/user-dummy-img.jpg' : 'images/'.$salary->employee->image }}" class="profile-wid-img" />
            </div> 
        </div>
        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="avatar-lg">
                        <img src="/{{ $salary->employee->image == NULL ? 'assets/images/users/user-dummy-img.jpg' : 'images/'.$salary->employee->image }}" width="80%" height="100%" alt="user-img" class="img-thumbnail rounded-circle" />
                    </div>
                </div>
                <div class="col">
                    <div class="p-2">
                        <h3 class="text-white mb-1">{{ $salary->employee->name }}</h3>
                        <p class="text-white text-opacity-75">{{ $salary->employee->position }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="d-flex profile-wrapper">
                        <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#salary-tab" role="tab">
                                    <i class="ri-money-dollar-circle-line d-inline-block d-md-none"></i> 
                                    <span class="d-none d-md-inline-block">Salary Info</span>
                                </a>
                            </li>
                        </ul>
                        <div class="flex-shrink-0">
                            <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-success">
                                <i class="ri-edit-box-line align-bottom"></i> Edit Salary
                            </a>
                        </div>
                    </div>

                    <div class="tab-content pt-4 text-muted">
                        <div class="tab-pane active" id="salary-tab" role="tabpanel">
                            <div class="row">
                                <div class="col-xxl-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Salary Details</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Employee Name :</th>
                                                            <td class="text-muted">{{ $salary->employee->name }}</td>
                                                        </tr>
                                                                                                                <tr>
                                                            <th class="ps-0" scope="row">Department :</th>
                                                            <td class="text-muted">{{ $salary->employee->departments->name ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Position :</th>
                                                            <td class="text-muted">{{ $salary->employee->position }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th class="ps-0" scope="row">Base Salary :</th>
                                                            <td class="text-muted">{{ number_format($salary->basic_salary, 2) }} TZS</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Allowances :</th>
                                                            <td class="text-muted">{{ number_format($salary->allowance, 2) }} TZS</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Deductions :</th>
                                                            <td class="text-muted">{{ number_format($salary->deductions, 2) }} TZS</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Net Pay :</th>
                                                            <td class="text-muted">{{ number_format($salary->net_salary, 2) }} TZS</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Last Paid On :</th>
                                                            <td class="text-muted">{{ $salary->pay_date }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                            </div><!-- end row -->
                        </div>
                    </div><!-- end tab-content -->
                </div>
            </div>
        </div>
    </div><!-- container-fluid -->
</div><!-- End Page-content -->
@endsection
