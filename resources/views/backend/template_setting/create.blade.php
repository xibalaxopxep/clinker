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
                    <form method="post" action="{!!route('admin.template_setting.store')!!}" class="form-horizontal form-validate-jquery">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Tên<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" value="{!!old('name')!!}" required="">
                                    {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Danh mục <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="select-search form-control" name="attribute_id"data-placeholder="Chọn kiểu" required>
                                        {!!$attribute_html!!}
                                    </select>
                                    {!! $errors->first('attribute_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Giá trị:<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="value" value="{!!old('value')!!}">
                                    {!! $errors->first('value', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </fieldset>
                        <div class="text-right">
                            <a type="button" href="{{route('admin.template_setting.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


