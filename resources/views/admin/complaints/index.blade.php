@extends('admin.includes.app')

@section('title')
    Admin | Complain | View
@endsection

@push('head')
    <!-- Sweet Alert css-->
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
 <!-- JAVASCRIPT -->


    <!-- prismjs plugin -->
    <script src="{{asset('assets/libs/prismjs/prism.js')}}"></script>
    <script src="{{asset('assets/libs/list.js/list.min.js')}}"></script>
    <script src="{{asset('assets/libs/list.pagination.js/list.pagination.min.js')}}"></script>

    <!-- listjs init -->
    <script src="{{asset('assets/js/pages/listjs.init.js')}}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

@endpush


@section('content')





            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Show Complaints</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Show Complaints</li>
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
                                    <h4 class="card-title mb-0">Add, Edit & Remove Complaints</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    @if (Session::has('success'))
                                    <div class="alert alert-success"> {{Session::get('success')}} </div>
                                @endif
                                    <div class="listjs-table" id="customerList">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <a href="" class="btn btn-primary">Resolved Complaints</a>
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
                                                        <th class="sort" data-sort="customer_name" > S/N </th>
                                                         <th class="sort" data-sort="customer_name">Subject</th>
                                                        <th class="sort" data-sort="customer_name">Content</th>
                                                        <th class="sort" data-sort="customer_name">Status</th>
                                                        <th class="sort" data-sort="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($datas as $data)
                                            
                                        
                                                    <tr>
                                                        <th>{{$data->id}}</th>
                                                        <td class="customer_name" >{{$data->subject}}</td>
                                                        <td class="customer_name" >{{\Illuminate\Support\Str::words($data->content,7,'...')}}</td>
                                                        
                                                        <td >	@if($data->status == 'pending')

                                                           
                                                            <button type="button" class="btn btn-primary btn-label waves-effect waves-light"><i class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i> {{ucfirst($data->status)}}</</button>

                                                           	@elseif($data->status == 'rejected')

                                                           	<button type="button" class="btn btn-danger btn-label waves-effect waves-light"><i class="ri-error-warning-line label-icon align-middle fs-16 me-2"></i> {{ucfirst($data->status)}}</button>

                                                           	@elseif($data->status == 'resolved')

                                                           	<button type="button" class="btn btn-success btn-label waves-effect waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> {{ucfirst($data->status)}}</button>

                                                           	@endif</td>
                                                        
                                                        <td>
                                                           <a href="{{ route('complain.approve', $data->id) }}" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-bin-5-line"></i>Edit</a>
                                                           <form action="{{ route('complain.destroy', $data->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this emloyee?');">
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

           @endsection