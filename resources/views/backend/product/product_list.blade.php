@extends('admin.admin_master')
@section('admin')
@section('title')
Product List 
@endsection
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5>Product List </h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Master</li>
                <li class="breadcrumb-item active">Product List</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image </th>
                                        <th>Product</th>
                                        <th>MRP</th>
                                        <th>Customer Price</th>
                                        <th>Reseller Price</th>
                                        <th>Discount (Customer/Reseller)</th>
                                        <th>Avl Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyList">
                                    @php
                                        $serialNo = 1;
                                    @endphp
                                    @foreach ($products as $item )
                                    <tr id="emptyRow" style="height: 25px;">
                                        <td>{{$serialNo}}</td>
                                        <td><img src="{{ asset($item->product_image) }}" style="width: 60px; height: 50px;"></td>
                                        <td>{{$item->product_name}}
                                            <div class="text-muted bg-light p-1"><small>{{$item->category->category_name}}</small></div>
                                            <div class="text-muted bg-light p-1 mt-1"><small>{{$item->product_sku}}</small></div>
                                        </td>
                                        <td>{{round($item->product_price)}}</td>
                                        <td>{{round($item->product_discount)}}</td>
                                        <td>{{round($item->seller_discount)}}</td>
                                        <td>
                                            @if($item->product_discount == NULL)
                                            <span class="badge badge-pill badge-danger">No Discount</span>
                                            @else
                                            @php
                                            $amount = $item->product_price - $item->product_discount;
                                            $discount = ($amount/$item->product_price) * 100;
                                            
                                            @endphp
                                            <span class="badge badge-pill badge-warning">{{ round($discount)  }} %</span>
                                            @endif
                                            <span>/</span>
                                            @if($item->seller_discount == NULL)
                                            <span class="badge badge-pill badge-danger">No Discount</span>
                                            @else
                                            @php
                                            $seller_amount = $item->seller_price - $item->seller_discount;
                                            $seller_discount = ($seller_amount/$item->seller_price) * 100;                                            
                                            @endphp
                                            <span class="badge badge-pill badge-warning ">{{ round($seller_discount)  }} %</span>
                                            @endif

                                        </td>
                                        <td>{{$item->current_stock}}</td>
                                        <td>
                                            <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info btn-sm btn-flat" title="Edit Data">Edit </a>
                                            <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger btn-sm btn-flat" title="Delete Data" id="delete">Delete</a>
                                        </td>
                                    </tr>
                                    @php
                                        $serialNo++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection