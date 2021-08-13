@extends('backend.layouts.master')
@section('content')
<!-- Content area -->

<head>
  

</head>
<div class="content">
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Thông kê sản phẩm tồn </h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if (Session::has('success'))
            <div class="alert bg-success alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">{{ Session::get('success') }}</span>
            </div>
            @endif
        </div>

        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Thống kê</th>
                    <th>Thực tế</th>
                    <th>Chênh lệch</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($inventory_products as $key=>$inventory_product)
                <tr>
                    <td>{{++$key}}</td>
                   @foreach($products as $key => $product) 
                    @if($inventory_product->product_id==$product->id)
                    <td>{{$product->id}}</td>
                    <td>{{$product->title}}</td>
                    @endif
                    @endforeach
                    <td>{{$inventory_product->exist}}</td>
                    <td>{{$inventory_product->real}}</td>
                    <td>{{$inventory_product->difference}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /table header styling -->

</div>

<!-- /content area -->
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop
  
  