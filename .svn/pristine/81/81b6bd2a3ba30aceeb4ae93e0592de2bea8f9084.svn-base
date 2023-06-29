@extends('admin.admin_master')
@section('admin')
@section('title')
User
@endsection
<style>
    ul {
        list-style: none;
        margin: 5px 10px;
    }
    li {
        margin: 10px 0;
    }
</style>
<div class="page-content">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5>User</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Master</li>
                <li class="breadcrumb-item active">User</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        <form action = "{{url('role')}}"  method ="POST">
                            @csrf
                        <div class="md-8">
                          <label for="exampleInputName" class="form-label">Role Name</label>
                            <input name ="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <ul><li><input type="checkbox">All<ul>
                            @if($permissionGroups->count())
                        
                            @foreach($permissionGroups as $permissionGroup)
                            <li>                             
                            <input type="checkbox" class="">                  
                                <h4> {{$permissionGroup->name}}</h4>                                  
                                @if($permissionGroup->permissions->count())
                                @foreach($permissionGroup->permissions as $permission)
                                <ul>
                                <li><input value="{{$permission->id}}" name = "permission_ids[]" class="" type="checkbox">
                                <label>{{$permission->name}}</label></li>
                               </ul>
                                @endforeach                        
                                @endif                  
                            @endforeach                      
                            @endif
                            </ul>
                            </li>
                        </ul>
        
                    <button type="submit" class="btn btn-primary">Create Role</button>
                              </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="bootstrap.min.js"></script> 
<script>
$('input[type="checkbox"]').change(function(e) {
    var checked = $(this).prop("checked"),
        container = $(this).parent(),
        siblings = container.siblings();

    container.find('input[type="checkbox"]').prop({
        indeterminate: false,
        checked: checked
    });

    function checkSiblings(el) {
        var parent = el.parent().parent(),
            all = true;


        el.siblings().each(function() {
            return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);

        });

        if (all && checked) {
            parent.children('input[type="checkbox"]').prop({
                indeterminate: false,
                checked: checked
            });
            checkSiblings(parent);

        } else if (all && !checked) {
            parent.children('input[type="checkbox"]').prop("checked", checked);
            parent.children('input[type="checkbox"]').prop("indeterminate",
            (parent.find('input[type="checkbox"]:checked').length > 0));

        } else {
            el.parents("li").children('input[type="checkbox"]').prop({
                indeterminate: true,
                checked: false
            });
        }

    }
    
    checkSiblings(container);
});
</script>  
 
@endsection