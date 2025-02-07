@extends('includes.app')

@section('title')
    Employee | Add
@endsection


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Basic Elements</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Basic Elements</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Input Example</h4>
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
                            <form action="{{route('employees.store')}}" method="POST">
                                @csrf
                            <div class="row gy-4">
                                
                                
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Type of Leave</label>
                                        <select name="type" class="form-control" >
                                            <option value="" disabled selected> Select Type</option>
                                            
                                            <option value="sick">Sick Leave</option>
                                            <option value="vacation">Vacation</option>
                                              
                                        </select>
                                        
                                    </div>
                                    @error('type')
                                           <p class="text-danger">{{$message}}</p>
                                        @enderror
                                </div>

                                 <!--end col-->
                               
                             
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" >
                                    </div>
                                    @error('start_date')
                                    <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control" >
                                    </div>
                                    @error('end_date')
                                    <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Reason</label>
                                        <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                                       
                                    </div>
                                    @error('reason')
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