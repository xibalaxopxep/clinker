@extends('backend.layouts.master')
@section('content')
<div class="content">  
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Tạo mới</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form action="{!!route('admin.construction.store')!!}" class="form-validate-jquery" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Hạng mục</label>
                                <div class="col-md-9">
                                    <select class="form-control select-search" multiple="" data-placeholder="Chọn hạng mục" data-fouc name="item_id[]" required="">
                                        {!!$item_html!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Họ tên <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="full_name" value="{!!old('full_name')!!}" required="">
                                    {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Điện thoại <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="mobile" value="{!!old('mobile')!!}" required="">
                                    {!! $errors->first('mobile', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Email <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="email" value="{!!old('email')!!}" required="">
                                    {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Mô tả</label>
                                <div class="col-md-9">
                                    <textarea class="form-control ckeditor" name="description">{!!old('description')!!}</textarea>
                                </div>
                            </div>
                            <div class="form-group row" data-field="avatar">
                                <label class="col-md-3 col-form-label text-right">Ảnh đại diện</label>
                                <div class="col-md-9 div-image">
                                    <input type="hidden" class="image_data" name="avatar" value="{!!old('avatar')!!}"/>
                                    <input type="file" id="avatar" onclick="openKCFinder(this)" data-value="{!!old('avatar')!!}" class="file-input-overwrite" data-field="avatar">
                                    {!! $errors->first('avatar', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row" data-field="image">
                                <label class="col-md-3 col-form-label text-right">Ảnh nền</label>
                                <div class="col-md-9 div-image">
                                    <input type="hidden" class="image_data" name="cover" value="{!!old('cover')!!}"/>
                                    <input type="file" id="cover" onclick="openKCFinder(this)" data-value="{!!old('cover')!!}" class="file-input-overwrite" data-field="cover">
                                    {!! $errors->first('cover', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Địa chỉ</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="address" value="{!!old('address')!!}">
                                    {!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="form-check col-md-3 form-check-right">
                                    <label class="form-check-label float-right">
                                        Hiển thị
                                        <input type="checkbox" class="form-check-input-styled" name="state" data-fouc="">
                                    </label>
                                </div>
                                <div class="form-check col-md-2 form-check-right">
                                    <label class="form-check-label float-right">
                                        Vip
                                        <input type="checkbox" class="form-check-input-styled" name="vip" data-fouc="">
                                    </label>
                                </div>

                            </div>

                        </fieldset>
                        <div class="text-right">
                            <a type="button" href="{{route('admin.construction.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                        </div>


                    </form>
                </div>  
            </div>
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

<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
@stop