@extends('backend.layouts.master')
@section('content')
    <!-- Content area -->
    <div class="content">
        <!-- Table header styling -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Nhóm khách hàng</h5>
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
                    <th>Tên loại</th>
                    <th>Ngày tạo</th>
                    <th>Tác vụ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $key=>$record)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$record->name}}</td>
                        
                        <td>{{$record->created_at()}}</td>
                        <td class="text-center">
                            <a href="{{route('admin.group.edit', $record->id)}}" title="{!! trans('base.show') !!}" class="success"><i class="icon-pencil"></i></a>
                            <form action="{!! route('admin.group.destroy', ['id' => $record->id]) !!}" method="POST" style="display: inline-block">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <a title="{!! trans('base.delete') !!}" class="delete text-danger" data-action="delete">
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
    <script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop
