
@extends('backend.layouts.master')
@section('content')
<div class="content">

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
            @if (Session::has('success'))
            <div class="alert bg-success alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">{{ Session::get('success') }}</span>
            </div>
            @endif
            <form action="{!!route('admin.user.update', $record->id)!!}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                <input type="hidden" name="role_id" value="{!!$record->role_id!!}" />
                <div class="panel panel-body results">
                    <div class="row">
                        <div class="col-md-10 offset-1">
                            <fieldset>
                                <legend class="text-semibold"><i class="icon-reading position-left"></i> Cập nhật</legend>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required">Username <span class="text-danger">*</span></label>
                                        <input name="username" type="text" class="form-control" value="{!!!is_null(old('username'))?old('username'):$record->username!!}" required="">
                                        {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Họ tên</label>
                                        <input name="full_name" type="text" class="form-control" value="{!!!is_null(old('full_name'))?old('full_name'):$record->full_name!!}">
                                        {!! $errors->first('full_name', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required">Password</label>
                                        <input name="password" type="password" class="form-control">
                                        {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Nhập lại password</label>
                                        <input name="password_confirmation" type="text" class="form-control">
                                        {!! $errors->first('password_confirm', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <label class="required">Email</label>
                                        <input name="email" type="text" class="form-control" value="{!!!is_null(old('email'))?old('email'):$record->email!!}">
                                        {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Số điện thoại</label>
                                        <input name="mobile" type="text" class="form-control" value="{!!!is_null(old('mobile'))?old('mobile'):$record->mobile!!}">
                                        {!! $errors->first('mobile', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Địa chỉ</label>
                                        <input name="address" type="text" class="form-control" value="{!!!is_null(old('address'))?old('address'):$record->address!!}">
                                        {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required">Quyền hạn <span class="text-danger"></span></label>
                                        <select name="role_id" class="form-control select-search" data-placeholder="Chọn quyền hạn" required="">
                                            {!!$role_html!!}
                                        </select>
                                        {!! $errors->first('role_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-2">
                                        <div class="form-check  form-check-right">
                                            <label class="form-check-label float-right">
                                                Kích hoạt
                                                <div class=""><span><input type="checkbox" class="form-check-input-styled" {{($record->status == 1)?'checked':''}} name="status" data-fouc=""></span></2div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-left">
                                <a type="button" href="{{route('admin.user.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                                <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/uniform.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switch.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/validation/validate.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/touchspin.min.js') !!}"></script>
<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>

@stop

