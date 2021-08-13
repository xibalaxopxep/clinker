@extends('mobile.layouts.construction-project')
@section('content')
<div class="bg-grey">
    @include('mobile.construction.cover')
    <div class="container">
        <div class="bg-white full-width" style="margin: 0;">
            <div class="hz-main-contents">
                <div id="main-edit-content" scopeid="main-edit-content" class="comp-box">
                    @if (false)
                    <div class="alert alert-success">
                        {$message.message}
                    </div>
                    @endif
                    <form method="post"  name="editProfile" action="{!!route('construction.update_project',$project->id)!!}" enctype="multipart/form-data" class="withSaveAndExit clearfix">
                        <section class="editProfileSection first clearfix">
                            <h4 class="mt-15 mb-20 pull-left">Đăng dự án</h4>
                        </section>
                        <section class="editProfileSection ">
                            <div class="fieldGroup">
                                <div class="mbxl"></div>
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <div class="form-group">
                                    <label class="mandatory" for="title">Tiêu đề</label>
                                    <input type="text" id="title" name="title" value="{{$project->title}}" class="form-control  input-lg edit-profile-input" required>
                                </div>
                                <div class="form-group" id="groupdomain">
                                    <label class="" for="description">Mô tả</label>
                                    <textarea rows="5" class="form-control input-lg edit-profile-input hzUrlInput" id="description" name="description" required>{{$project->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class=" required control-label text-semibold" for="images">Hình ảnh</label>
                                    <div class="">
                                        <input type="file" id="images" value='{{$project->images}}' class="file-input-extensions" multiple="" data-show-upload="false" data-show-remove="true" onclick="BrowseServer('images')">
                                        <input type="hidden" value="{{$project->images}}" name="images" />
                                        <span class="help-block">Chỉ cho phép các file ảnh có đuôi <code>jpg</code>, <code>gif</code> và <code>png</code></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg" name="btnSubmit">Lưu lại</button>
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
