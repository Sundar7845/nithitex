@extends('admin.admin_master')
@section('admin')
@section('title')
Product Out Of Stock Report
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5>Product Out Of Stock Report </h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Master</li>
                <li class="breadcrumb-item active">Product Out Of Stock Report</li>
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
                                        <th>Product Sku</th>
                                        <th>MRP</th>
                                        <th>Customer Price</th>
                                        <th>Reseller Price</th>
                                        <th>Product  Out Of Stock</th>
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
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->product_sku}}</td>               
                                        <td>{{round($item->product_price)}}</td>
                                        <td>{{round($item->product_discount)}}</td>
                                        <td>{{round($item->seller_discount)}}</td>
                                        <td>{{$item->current_stock}}</td>
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
