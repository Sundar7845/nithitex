
@extends('admin.admin_master')
@section('admin')
@section('title')
Product Stock Report
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5>Product  Stock Report </h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Master</li>
                <li class="breadcrumb-item active">Product Stock Report</li>
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
                    <div class="col-md-6">
                      <div>
                          <label for="Category">Category</label>
                          <select id="category_id" name="category_id" class="form-control">
                            <option value="">Choose Category</option>
                              @foreach($categories as $categorie)
                              <option value="{{$categorie->id}}">{{$categorie->category_name}}</option>
                              @endforeach
                          </select><br>
                      </div>
                    </div>
                    <div class="col-md-6">       
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="dataTablestock" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Image </th>
                                        <th>Product Sku</th>
                                        <th>MRP</th>
                                        <th>Customer Price</th>
                                        <th>Reseller Price</th>
                                        <th>Product Stock</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyList">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript">
   var table = "";
   $(document).ready(function(){

    $("#category_id").change(function()
        {
          table.destroy();
            listproductstockreport();
        });
        listproductstockreport();
  });


  function listproductstockreport(){ 
    var category_id=$("#category_id").val();
    $.ajax({
        url: '/product/stock-wise-report',
        method: 'POST',
        data: '&category_id=' + category_id 
    
    }).done(function(products){ 
         
    $('#tbodyList tr').empty();
	var List="";
    $.each(products.data,function(idx,val){  

		List +="<tr>";
		List +="<td>"+val.product_name+"</td>";
		List +="<td>"+'<img src="../'+val.product_image+'" style="height:50px; width:50px;">'+"</td>";
		List +="<td>"+val.product_sku+"</td>";
		List +="<td>"+Math.round(val.product_price)+"</td>";
		List +="<td>"+Math.round(val.product_discount)+"</td>";
		List +="<td>"+Math.round(val.seller_discount)+"</td>";
		List +="<td>"+val.current_stock+"</td>";
		List +="</tr>";	
        });
				
		$('#tbodyList').html(List);

    table =  $('#dataTablestock').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "All"]
      ],
      "iDisplayLength": 10,
      "language": {
        search: ""
      }
    });
    });
}
</script>
@endsection
