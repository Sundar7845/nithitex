@extends('admin.admin_master')
@section('admin')
@section('title')
Admin Change Password
@endsection
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5>Admin Change Password</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Master</li>
                <li class="breadcrumb-item active">Admin Change Password</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h3 class="card-title">Product Category</h3> --}}
                </div>
                <div class="card-body">
					<form method="post" action="{{ route('update.change.password') }}">
						@csrf
                  <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Current Password  <span> </span></label>
                    <input type="password" name="oldpassword" class="form-control" value="">                                
                </div>
        
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">New Password  <span> </span></label>
                    <input type="password" name="password" class="form-control" value="">                                
                </div>    
				<div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Confirm Password <span> </span></label>
                    <input type="password" name="password_confirmation" class="form-control" value="">                                
                </div> 
               
                <div class="text-xs-right">
                  <button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
              </div>
                  </form>
                </div>  
            </div>
        </div>
    </div>
</div>

 
@endsection
