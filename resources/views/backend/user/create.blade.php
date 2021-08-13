
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
            <form action="{!!route('admin.user.store')!!}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                <div class="panel panel-body results">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend class="text-semibold"><i class="icon-reading position-left"></i> Tạo mới</legend>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required">Username</label>
                                        <input name="username" type="text" class="form-control" value="{!!old('username')!!}">
                                        {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Họ tên</label>
                                        <input name="full_name" type="text" class="form-control" value="{!!old('full_name')!!}">
                                        {!! $errors->first('full_name', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required">Password</label>
                                        <input name="password" type="password" class="form-control" value="{!!old('password')!!}">
                                        {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Nhập lại password</label>
                                        <input name="password_confirmation" type="password" class="form-control" value="{!!old('password_confirmation')!!}">
                                        {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <label class="required">Email</label>
                                        <input name="email" type="text" class="form-control" value="{!!old('email')!!}">
                                        {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Số điện thoại</label>
                                        <input name="mobile" type="text" class="form-control" value="{!!old('mobile')!!}">
                                        {!! $errors->first('mobile', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Địa chỉ</label>
                                        <input name="address" type="text" class="form-control" value="{!!old('address')!!}">
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
                                                <div class=""><span><input type="checkbox" class="form-check-input-styled" name="status" data-fouc=""></span></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-right">
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

