@extends('frontend.layouts.construction')
@section('content')
<div id="results" class="sub_header_in">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-10">
                <h1>Thi công</h1>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<div class="bg-grey">
    @include('frontend.construction.cover')
    <div class="container">
        <div class="bg-white row" style="margin: 0;">
            <div class="hz-main-contents offset-2 col-md-8">
                <div id="main-edit-content" scopeid="main-edit-content" class="comp-box">
                    @if (false)
                    <div class="alert alert-success">
                        {$message.message}
                    </div>
                    @endif
                    <form method="post"  name="editProfile" action="{!!route('construction.create_project')!!}" enctype="multipart/form-data" class="withSaveAndExit clearfix">
                        <section class="editProfileSection first clearfix">
                            <h4 class="mt-15 mb-20 pull-left">Đăng dự án</h4>
                        </section>
                        <section class="editProfileSection ">
                            <div class="fieldGroup">
                                <div class="mbxl"></div>
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group">
                                    <label class="mandatory" for="title">Tiêu đề</label>
                                    <input type="text" id="title" name="title" value="" class="form-control  input-lg edit-profile-input"> 
                                </div>
                                <div class="form-group" id="groupdomain">
                                    <label class="" for="description">Mô tả</label>
                                    <textarea rows="5" class="form-control input-lg edit-profile-input hzUrlInput ckeditor" id="content" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class=" control-label text-right text-semibold" for="images">Hình ảnh:</label>
                                    <div class=" div-image">
                                        <div class="file-input file-input-ajax-new">
                                            <div class="file-preview ">
                                                <div class=" file-drop-zone">
                                                </div>
                                            </div>
                                            <div class="input-group file-caption-main">
                                                <div class="file-caption form-control kv-fileinput-caption" tabindex="500">
                                                </div>
                                                <div class="input-group-btn input-group-append">
                                                    <div tabindex="500" class="btn btn-primary btn-file"><i class="icon-folder-open"></i>&nbsp; <span class="hidden-xs">Chọn</span>
                                                        <input type="file" id="images" class="upload-images" name="file_upload[]" multiple="multiple" data-fouc="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="images" class="image_data" value="">
                                        <span class="help-block">Chỉ cho phép các file ảnh có đuôi <code>jpg</code>, <code>gif</code> và <code>png</code>. File có dung lượng tối đa 20M.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg" name="btnSubmit">Lưu lại</button>
                                </div>
                            </div>
                        </section>

                    </form>

                </div>

            </div>
        </div>
    </div>

</div>

@stop
@section('script')
@parent
<script src="{!! asset('assets/backend/ckeditor/ckeditor.js') !!}"></script>
<script>
if ($('.ckeditor').length) {
    if (typeof (CKEDITOR) !== 'undefined' && $('#content').length)
        CKEDITOR.replace('content');
    if (typeof (CKEDITOR) !== 'undefined' && $('#description').length)
        CKEDITOR.replace('description');
}
</script>
@stop
