@extends('admin.includes.app')

@section('title')
    Admin | Complain | Approve 
@endsection


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Approve Complaint</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Approve Complaint</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Approve Complain</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <a href="{{route('complain.show')}}" class="btn btn-primary">View Complain</a>
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
                            <form action="{{route('approve_complain_post',$datas->id)}}" method="POST">
                                @csrf
                                 @method('PUT')
                            <div class="row gy-4">

                              <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{$datas->subject}}" >
                                       
                                    </div>
                                    @error('subject')
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
                                        <label for="labelInput" class="form-label">Content</label>
                                        <textarea name="content" id="" cols="100" rows="10" class="form-control">{{$datas->content}}</textarea>
                                       
                                    </div>
                                    @error('content')
                                    <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Remark</label>
                                        <textarea name="remarks" id="" cols="100" rows="10" class="form-control">{{$datas->remarks == $datas->remarks ? $datas->remarks : '' }}</textarea>
                                       
                                    </div>
                                    @error('remarks')
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