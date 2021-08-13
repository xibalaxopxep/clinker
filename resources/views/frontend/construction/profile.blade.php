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
        <div class="construction-detail bg-white row no-gutters">

            <div class="offset-2 col-md-8 col-xs-12 plr-15 ">
                <div id="main-edit-content" scopeid="main-edit-content" class="comp-box">
                    <form method="post" id="editProfile" action="{!!route('construction.update_profile',$record->alias)!!}" name="editProfile" enctype="multipart/form-data" class="withSaveAndExit clearfix" >
                        @if (false)
                        <div class="alert alert-success">
                            {$message.message}
                        </div>
                        @endif
                        <h4 class="mt-15 mb-20 top pull-left">Thông tin tài khoản</h4>
                        <section class="editProfileSection ">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <div class="fieldGroup">                                
                                <div class="form-group">
                                    <label class="mandatory" for="user_name">Tên đăng nhập</label>
                                    <input type="text" id="user_name" name="username" value="{{$record->username}}" class="form-control  input-lg edit-profile-input"> 
                                </div>
                                <div class="form-group" id="groupdomain">
                                    <label class="" for="full_name">Họ và tên </label>
                                    <input class="form-control input-lg edit-profile-input hzUrlInput" type="text" id="full_name" name="full_name" value="{{$record->full_name}}">
                                </div>
                                <div class="form-group" id="groupdomain">
                                    <label class="" for="full_name">Mô tả </label>
                                    <textarea class="form-control input-lg edit-profile-input hzUrlInput" id="description" name="description">{{$record->description}}</textarea>
                                </div>
                                <div class="form-group" id="groupdomain">
                                    <label class="" for="mobile">Điện thoại</label>
                                    <input class="form-control input-lg edit-profile-input hzUrlInput" type="text" id="mobile" name="mobile" value="{{$record->mobile}}" >
                                </div>
                                <div class="form-group" id="groupdomain">
                                    <label class="" for="email">Email</label>
                                    <input class="form-control input-lg edit-profile-input hzUrlInput" type="text" id="email" name="email" value="{{$record->email}}">
                                </div>
                                <div class="form-group" id="groupdomain">
                                    <label class="" for="email">Website</label>
                                    <input class="form-control input-lg edit-profile-input hzUrlInput" type="text" id="website" name="website" value="{{$record->website}}">
                                </div>
                                <div class="form-group" id="groupdomain">
                                    <label class="" for="address">Địa chỉ</label>
                                    <input class="form-control input-lg edit-profile-input hzUrlInput" type="text" id="address" name="address" value="{{$record->address}}">
                                </div>
                                <div class="form-group">
                                    <label class="" for="address">Danh mục</label>
                                    <select multiple="multiple" class="select-munti" name="category_id[]" required>
                                        {!!$category_html!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title_post">Ảnh đại diện</label>
                                <div class="input-field">
                                    <div class="form-group box-set-avt">                                
                                        <input type="file"  id="avatar" class="file-input-extensions" data-show-upload="false" data-show-remove="true" onclick="BrowseServer('avatar')">
                                        <input type="hidden" value="{{$record->avatar}}" name="avatar" />
                                        <span class="help-block">Chỉ cho phép các file ảnh có đuôi <code>jpg</code>, <code>gif</code> và <code>png</code>. Khuyến cáo nên upload ảnh có kích cỡ 173x173</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title_post">Banner</label>
                                <div class="input-field">
                                    <div class="form-group box-set-avt">                                
                                        <input type="file"  id="cover" class="file-input-extensions" data-show-upload="false" data-show-remove="true" onclick="BrowseServer('cover')">
                                        <input type="hidden" value="{{$record->cover}}" name="cover" />
                                        <span class="help-block">Chỉ cho phép các file ảnh có đuôi <code>jpg</code>, <code>gif</code> và <code>png</code>. Khuyến cáo nên upload ảnh có kích cỡ 1220x249s</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg" name="btnSubmit">Lưu lại</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
