@extends('admin.admin_master')
@section('admin')
@section('title')
    Product
@endsection
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Edit Product</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-sm-12">
            <form method="post" action="{{ route('product.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $products->id }}">
                <input type="hidden" name="old_img" value="{{ $products->product_image }}">

                <div class="card">
                    <div class="nav-tabs-custom card-box" id="divLed">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#information" data-toggle="tab">Product Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#imagevideo" data-toggle="tab">Images & Videos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pricestock" data-toggle="tab">Product Price</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#description" data-toggle="tab">Description &
                                    Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#seo" data-toggle="tab">SEO</a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="show active tab-pane" id="information">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-xs-4">
                                            <div class="form-group">
                                                <label for="txtDesignationName">
                                                    Product Name<span class="text-danger">*</span></label>
                                                <input type="text" id="product_name"
                                                    title="Please Enter Product Name" name="product_name"
                                                    placeholder="Enter Product Name"
                                                    value="{{ $products->product_name }}" class="form-control"
                                                    autocomplete="off" required />
                                                @error('product_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-4">
                                            <div class="form-group">
                                                <label for="txtDepartmentName">
                                                    Category Type<span class="text-danger">*</span></label>
                                                <select id="ddlCategoryType" name="ddlCategoryType" class="form-control"
                                                    title="Please Select Category Type" required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $products->category_id ? 'selected' : '' }}>
                                                            {{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('ddlCategoryType')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-4">
                                            <div class="form-group">
                                                <label>Tag</label>
                                                <input type="text" id="tags" name="tags"
                                                    value="{{ $products->tags }}" data-role="tagsinput"
                                                    class="form-control" width="100%">
                                                @error('tags')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-xs-4">
                                            <div class="form-group">
                                                <label>Current Stock<span class="text-danger">*</span></label>
                                                <input type="text" id="stock" name="stock" class="form-control"
                                                    title="Please enter Current Stock" autocomplete="off"
                                                    value="{{ $products->current_stock }}" required />
                                                @error('stock')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-4">
                                            <div class="form-group">
                                                <label>Product SKU<span class="text-danger">*</span></label>
                                                <input type="text" id="product_sku" name="product_sku"
                                                    class="form-control" title="Please enter SKU value"
                                                    autocomplete="off" value="{{ $products->product_sku }}"
                                                    required />
                                                @error('product_sku')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customSwitch1" name="is_featured" value="1"
                                                        {{ $products->is_featured == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="customSwitch1">Featured</label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customSwitch2" name="is_newArrival" value="1"
                                                        {{ $products->is_newArrival == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customSwitch2">New
                                                        Arrival</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customSwitch3" name="is_offers" value="1"
                                                        {{ $products->is_offers == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="customSwitch3">Offer</label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customSwitch4" name="is_bestSelling" value="1"
                                                        {{ $products->is_bestSelling == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customSwitch4">Best
                                                        Selling</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="imagevideo">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class="form-group">
                                                <label>
                                                    Product Images<span class="text-danger">*</span>
                                                    <div class="text-muted"><small>(Multiple images allowed)</small>
                                                    </div>
                                                </label>
                                                <div class="upload__box">
                                                    <div class="upload__btn-box">
                                                        <label class="upload__btn">
                                                            <p>Upload</p>
                                                            <input type="file" id="multiImg" name="multi_img[]"
                                                                multiple="" data-max_length="20"
                                                                class="form-control upload__inputfile">
                                                        </label>
                                                        @error('multi_img')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="upload__img-wrap">
                                                        @foreach ($multiImgs as $img)
                                                            <div class='upload__img-box'>
                                                                <div style='background-image: url({{ asset($img->product_mult_image) }})'
                                                                    class='img-bg'>
                                                                    <div class='upload__img-close'
                                                                        id={{ $img->id }}
                                                                        onclick="deleteimg({{ $img->id }});">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-6">
                                            <div class="form-group">
                                                <label>
                                                    Product Video Link
                                                </label>
                                                <input type="text" id="video_link"
                                                    value="{{ $products->product_video_url }}" name="video_link"
                                                    class="form-control">
                                                @error('video_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-4">
                                            <div class="form-group">
                                                <label> Choose Color </label>
                                                <select id="color" name="color" class="form-control"
                                                    title="Please Select Color">
                                                    <option value="">Select Color</option>
                                                    @foreach ($colors as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $products->color_id ? 'selected' : '' }}>
                                                            {{ $item->color_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <div class="tab-pane" id="pricestock">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    MRP<span class="text-danger">*</span>
                                                </label>
                                                <input type="text" id="price" name="price"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $products->product_price }}" required />
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div id="div6" class="form-group">
                                                <label>
                                                    Customer - Selling Price<span class="text-danger">*</span></label>
                                                <input type="text" control="int" class="form-control"
                                                    autocomplete="off" id="discountprice" name="discountprice"
                                                    value="{{ $products->product_discount }}" required />
                                                @error('discountprice')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div id="div6" class="form-group">
                                                <label>
                                                    Reseller - Selling Price<span class="text-danger">*</span></label>
                                                <input type="text" control="int" class="form-control"
                                                    autocomplete="off" id="sellerdiscount" name="sellerdiscount"
                                                    value="{{ $products->seller_discount }}" required />
                                                @error('sellerdiscount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <div class="tab-pane" id="description">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label>
                                                    Short Description<span class="text-danger">*</span>
                                                </label>
                                                <input id="shortdescription" name="shortdescription"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $products->short_description }}">
                                                @error('shortdescription')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div id="div6" class="form-group">
                                                <label>
                                                    Long Description<span class="text-danger">*</span></label>
                                                <textarea id="longdescription" name="longdescription" rows="10" class="form-control" autocomplete="off">{{ $products->long_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <div class="tab-pane" id="seo">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>
                                                    Meta Title
                                                </label>
                                                <input type="text" id="metaname" name="metaname"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $products->meta_title }}" />
                                            </div>
                                            <div id="div6" class="form-group">
                                                <label>
                                                    Meta Description</label>
                                                <input type="text" control="int" class="form-control"
                                                    autocomplete="off" id="metadescription" name="metadescription"
                                                    value="{{ $products->meta_description }}" />
                                            </div>

                                            <div id="div19" class="form-group">
                                                <label>
                                                    Meta Keywords</label>
                                                <input type="text" id="metakeywords" name="metakeywords"
                                                    value="{{ $products->meta_keywords }}" class="form-control"
                                                    title="Enter Meta Keywords" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="div2" class="form-group text-right">
                                            <button type="submit" id="btnSave"
                                                class="btn btn-flat btn-success">Save</button>
                                            <a href="{{ route('product.list') }}"
                                                class="btn btn-dark btn btn-flat">Goto
                                                List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
