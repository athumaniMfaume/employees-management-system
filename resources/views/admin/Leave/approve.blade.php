@extends('admin.includes.app')

@section('title')
    Admin | Leave | Approve 
@endsection


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Approve Leaves</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Approve Leaves</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Approve Leave</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <a href="{{route('leave.show')}}" class="btn btn-primary">Back</a>
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
                            <form action="{{route('approve_leave_post',$datas->id)}}"
                             method="POST">
                                @csrf
                                @method('PUT')
                            <div class="row gy-4">
                                
                                
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Type of Leave</label>
                                        <select name="type" class="form-control" >
                                            <option value="" disabled selected> Select Type</option>

                                            <option value="sick" {{$datas->type=='sick' ? 'selected' :'' }}>Sick</option>
                                            <option value="vacation" {{$datas->type=='vacation' ? 'selected' :'' }}>Vacation</option>
                                          
                                              
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
                                        <input type="date" name="start_date" class="form-control" value="{{$datas->start_date}}" >
                                    </div>
                                    @error('start_date')
                                    <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control" 
                                        value="{{$datas->end_date}}">
                                    </div>
                                    @error('end_date')
                                    <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>
                                   <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Status</label>
                                        <select  name="status" class="form-control" >
                                            <option value="" disabled selected> Select Type</option>
                                            
                                            <option value="pending" {{$datas->status=='pending' ? 'selected' :'' }}>Pending</option>
                                            
                                             <option value="rejected" {{$datas->status=='rejected' ? 'selected' :'' }}>Rejected</option>

                                              <option value="resolved" {{$datas->status=='resolved' ? 'selected' :'' }}>Resolved</option>

                                            
                                            

                                              
                                        </select>
                                        
                                    </div>
                                    @error('status')
                                           <p class="text-danger">{{$message}}</p>
                                        @enderror
                                </div>

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Reason</label>
                                        <textarea name="reason" id="" cols="30" rows="10" class="form-control">{{$datas->reason}}</textarea>
                                       
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