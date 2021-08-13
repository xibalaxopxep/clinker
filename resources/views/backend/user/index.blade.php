@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content"> 
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Thành viên hệ thống</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!--The <code>DataTables</code> is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table. DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function. Searching, ordering, paging etc goodness will be immediately added to the table, as shown in this example. <strong>Datatables support all available table styling.</strong>-->
        </div>

        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tên đăng nhập</th>
                    <th>Họ tên</th>
                    <th>Quyền hạn</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)
                <tr>
                    <td>{{$record->id}}</td>
                    <td>{{$record->username}}</td>
                    <td>{{$record->full_name}}</td>
                    <td>{{$record->role->title}}</td>
                    <td>{{$record->created_at()}}</td>
                    <td class="text-center">
                        <a href="{{route('admin.user.edit', $record->id)}}" title="Chỉnh sửa" class="success"><i class="icon-pencil"></i></a>   
                        <form action="{!! route('admin.user.destroy', $record->id) !!}" method="POST" style="display: inline-block">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <a title="Xóa" class="delete text-danger" data-action="delete">
                                <i class="icon-close2"></i>
                            </a>              
                        </form>
                    </td>
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