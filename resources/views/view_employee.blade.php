@extends('includes.app')

@section('title')
    Employee | View
@endsection

@section('content')
   
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Listjs</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Listjs</li>
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
                        <h4 class="card-title mb-0">Add, Edit & Remove</h4>
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
                                            <th scope="col" > S/N </th>
                                            <th class="sort" data-sort="customer_name">Name</th>
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
                                    <tbody >
                                        @foreach ($datas as $data)
                                            
                                        
                                        <tr>
                                            <th>{{$data->id}}</th>
                                            <td >{{$data->name}}</td>
                                            <td class="customer_name">{{$data->departments->name}}</td>
                                            <td class="customer_name">{{$data->position}}</td>
                                            <td class="email">{{$data->email}}</td>
                                            <td class="phone">{{$data->dob}}</td>
                                            <td class="date">{{$data->created_at}}</td>
                                            <td class="date">{{$data->phone}}</td>
                                            <td class="date">{{$data->salary}}</td>
                                            <td>
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
                                        <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                            orders for you search.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                
                                    {{-- {{$datas->links('Pagination::bootstrap-5')}} --}}
                                
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
    
@endsection