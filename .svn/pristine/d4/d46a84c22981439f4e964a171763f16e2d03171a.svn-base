@extends('admin.admin_master')
@section('admin')
@section('title')
Slider
@endsection
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5>Edit Home Slider</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Settings</li>
                <li class="breadcrumb-item active">Slider</li>
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
                    <div class="row">
                        <div id="divCategory" class="col-lg-4 col-md-4">
                            <form method="post" action="{{ route('slider.update') }}" enctype="multipart/form-data">
                                @csrf      
                                <input type="hidden" name="id" value="{{ $slider->id }}">
                                <input type="hidden" name="old_img" value="{{ $slider->slider_image }}">                          
                            <div class="form-group">
                                <label>Slider Image</label>
                                <input type="file" id="slider_image" name="slider_image" class="form-control" onChange="mainThamUrl(this)"  />
                                    @error('slider_image') 
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror<br>
                                    <img src="{{ asset($slider->slider_image) }}"  height="100" width="220" id="mainThmb">
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
<script type="text/javascript">
    function mainThamUrl(input){
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e){
              $('#mainThmb').attr('src',e.target.result).width(220).height(100);
          };
          reader.readAsDataURL(input.files[0]);
      }
  }
</script>