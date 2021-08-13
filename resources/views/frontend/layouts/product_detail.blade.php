<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <link href="{!!asset('assets/frontend/css/product-detail.css')!!}" rel="stylesheet">
        <link href="{!!asset('assets/frontend/css/font-awesome.css')!!}" rel="stylesheet">
        <link href="{!!asset('assets/frontend/css/sweetalert.min.css')!!}" rel="stylesheet">

        @include('frontend/layouts/__head')
    </head>

    <body>
        <!-- Page content -->
        <div id="page">
            <!-- Main content -->
            <div class="content-wrapper">
                @include('frontend/layouts/__header')
                @yield('content')
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </body>
    <aside id="login" class="zoom-anim-dialog mfp-hide register-form">
    <figure>
        <a href="/"><img src="{!!$share_config->image!!}" width="165" height="35" alt="" class="logo_sticky"></a>
    </figure>
    <form autocomplete="off" id="frmRegister">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Họ tên <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="full_name" required="">
                    <i class="ti-user"></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên đăng nhập <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="username" id="username1" required>
                    <i class="ti-user"></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mật khẩu <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" id="password1" name="password" required>
                    <i class="icon_lock_alt"></i>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nhập lại mật khẩu <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" id="password2" required>
                    <i class="icon_lock_alt"></i>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Số điện thoại <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="mobile" required>
                    <i class="ti-mobile"></i>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input class="form-control" type="email" name="email" required>
                    <i class="ti-email"></i>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Địa chỉ </label>
                    <input class="form-control" type="text" name="address" >
                    <i class="ti-location-pin"></i>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên công ty </label>
                    <input class="form-control" type="text" name="company_name" >
                    <i class="ti-user"></i>
                </div>
            </div>
            <div class="col-md-12">

                <div class="clearfix add_bottom_15">
                    <div class="radios float-left">
                        <label class="container_radio">Khách hàng
                            <input type="radio" name="type" value="3" checked="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="radios float-left" style="margin-left:10px;">
                        <label class="container_radio">Tiếp thị liên kết
                            <input type="radio" name="type" value="1">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="radios float-left" style="margin-left:10px;">
                        <label class="container_radio">Đơn vị thi công
                            <input type="radio" name="type" value="2">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div id="pass-info" class="clearfix"></div>
        <div class="load">
            <img src="{!! asset('/assets/frontend/img/loading.gif') !!}">
        </div>
        <button type="submit" class="register-btn btn_1 rounded full-width add_top_30">Đăng ký!</button>
        <div class="text-center add_top_10">Bạn đã có tài khoản? <strong><a href="#sign-in-dialog" class="login">Đăng nhập</a></strong></div>
    </form>
</aside>
<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Đăng nhập</h3>
    </div>
    <form method="post" id="frmLogin">
        <div class="sign-in-wrapper">
            <div class="form-group">
                <label>Tên đăng nhập</label>
                <input type="username" class="form-control" name="username" id="username">
                <i class="icon-user"></i>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                <i class="icon_lock_alt"></i>
                <span class="help-block"></span>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="radios float-left">
                    <label class="container_radio">Khách hàng
                        <input type="radio" name="type_login" value="3" checked>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="radios float-left">
                    <label class="container_radio">Tiếp thị liên kết
                        <input type="radio" name="type_login" value="1">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="radios float-left">
                    <label class="container_radio">Đơn vị thi công
                        <input type="radio" name="type_login" value="2">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="checkboxes float-left">
                    <label class="container_check">Ghi nhớ tài khoản
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="text-center"><input type="submit" value="Đăng nhập" class="btn_1 full-width"></div>
            <div class="text-center">
                Bạn chưa có tài khoản? <a href="#login" id="sign-in" class="register" title="Đăng ký">Đăng ký</a>
            </div>
        </div>
    </form>
    <!--form -->
</div>
    <script src="{!!asset('assets/frontend/js/jquery.js')!!}"></script>
    <script src="{!!asset('assets/frontend/js/sweetalert.min.js')!!}"></script> 
    <script src="{!!asset('assets/frontend/js/jquery.elevatezoom.js')!!}"></script>
    <script src="{!!asset('assets/frontend/js/owl.carousel.min.js')!!}"></script>
    <script src="{!!asset('assets/frontend/js/jquery.magnific-popup.min.js')!!}"></script>
    <script src="{!! asset('assets/frontend/js/product.js') !!}"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0"></script>
    @yield('script')
</html>

