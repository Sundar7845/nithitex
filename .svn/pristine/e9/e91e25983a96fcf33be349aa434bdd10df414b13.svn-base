@extends('admin.admin_master')
@section('admin')
@section('title')
    Product Category Update
@endsection
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Product Category</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Product Category Update</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Product Category</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div id="divCategory" class="col-md-4">
                            <form method="post" action="{{ route('category.update', $categories->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $categories->id }}">
                                <input type="hidden" name="old_image" value="{{ $categories->category_image }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Product Category Name</label>
                                    <input type="text" id="category" name="category" class="form-control"
                                        title="Please Enter Category Name" value="{{ $categories->category_name }}"
                                        required />
                                    @error('Category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Category Image</label>
                                    <input type="file" id="category_image" name="category_image" class="form-control"
                                        onChange="mainThamUrl(this)" />
                                    @error('category_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror <br>
                                    <img src="{{ asset($categories->category_image) }}" height="100" width="100"
                                        id="mainThmb">
                                </div>
                                <div class="form-group">
                                    <label>Category Description</label>
                                    <textarea id="category_description" name="category_description" class="form-control" autocomplete="off">{{ $categories->category_description }}</textarea>
                                    @error('category_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="btnSave" class="btn btn-success">Save</button>
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
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
