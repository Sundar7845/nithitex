@extends('admin.admin_master')
@section('admin')
@section('title')
About Us
@endsection
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5>About Us</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Settings</li>
                <li class="breadcrumb-item active">About Us</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div id="divCategory" class="col-lg-12 col-md-12">
                            <form method="post" action="{{ route('about.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>About Description</label>                                    
                                    <textarea  id="about_description" name="about_description" class="form-control" autocomplete="off"> @if($about) {{$about->about_description}}  @endif </textarea>
                                        @error('about_description') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            <div class="form-group">
                                <label>About Image</label>
                                <input type="file" id="about_image" name="about_image" class="form-control" onChange="mainThamUrl(this)"/>
                                    @error('about_image') 
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror<br>
                                    <img src="@if($about) {{asset($about->about_image)}}  @endif" id="mainThmb">
                            </div>
                            <div class="form-group">
                                <button type="submit" id="btnSave" class="btn btn-success">Save</button>
                                {{-- <button type="button" class="btn btn-danger" id="btnClear" onclick="ClearData();">Clear</button> --}}
                            </div>
                        </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
 
@endsection