@extends('employees.includes.app')

@section('title')
    Employee | Complain | Add
@endsection


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Complaints</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('employees.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Complaints</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Write Complain</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <a href="{{route('single.employee.complain.view')}}" class="btn btn-primary">View Complain</a>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        @if (Session::has('error'))
                            <div class="alert alert-danger"> {{Session::get('error')}} </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success"> {{Session::get('success')}} </div>
                        @endif
                        <div class="live-preview">
                            <form action="{{route('complain.store')}}" method="POST">
                                @csrf
                            <div class="row gy-4">

                              <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Subject</label>
                                        <input type="text" name="subject" class="form-control" >
                                       
                                    </div>
                                    @error('subject')
                                    <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>
                                


                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Content</label>
                                        <textarea name="content" id="" cols="100" rows="10" class="form-control"></textarea>
                                       
                                    </div>
                                    @error('content')
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