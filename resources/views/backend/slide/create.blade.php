
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
                    <form action="{!!route('admin.slide.store')!!}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Tiêu đề <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="title" value="{!!old('title')!!}">
                                    {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Mô tả: </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="caption">{!!old('caption')!!}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Url:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="url" value="{!!old('url')!!}">
                                    {!! $errors->first('url', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Button text:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="button_text" value="{!!old('button_text')!!}">
                                    {!! $errors->first('button_text', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Vị trí:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="position" value="{!!old('position')!!}" >
                                    {!! $errors->first('position', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Hình ảnh: <span class="text-danger">*</span></label>
                                <div class="col-md-9 div-image">
                                    <input type="hidden" class="image_data" name="image" value="{!!old('image')!!}"/>
                                    <input type="file" id="image" onclick="openKCFinder(this)" data-value="{!!old('image')!!}" class="file-input-overwrite" data-field="image">
                                    {!! $errors->first('image', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 text-right">Sắp xếp </label>
                                <div class="col-md-5">
                                    <input type="text" name="ordering" class="form-control touchspin text-center" value="0">
                                </div>

                                <div class="form-check col-md-4 form-check-right">
                                    <label class="form-check-label float-right">
                                        Hiển thị
                                        <div class=""><span><input type="checkbox" class="form-check-input-styled" name="status" data-fouc=""></span></div>
                                    </label>
                                </div>

                            </div>

                        </fieldset>
                        <div class="text-right">
                            <a type="button" href="{{route('admin.slide.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
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

@stop
