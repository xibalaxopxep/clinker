
<script type="text/javascript" src="{!!asset('assets/mobile/js/jquery.min.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/jquery.magnific-popup.min.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/sweetalert.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/mobile/js/plugins.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/mobile/js/custom.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/mobile/js/cart.js')!!}"></script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=2277712365846590&autoLogAppEvents=1"></script>

<!-- Sign In Popup -->
<div id="menu-list-modal"
     data-selected="menu-components"
     data-title="Modal Menu"
     data-subtitle="This Effect Is"
     data-width="300"
     data-height="500"
     class="menu-box menu-load menu-modal">
    <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
        <div class="small-dialog-header">
            <h3>Đăng nhập</h3>
        </div>
        <form method="post" id="frmLogin">
            <div class="sign-in-wrapper">
                <div class="form-group">
                    <label>Tên đăng nhập</label>
                    <input type="username" class="form-control" name="username" id="username" required>
                    <i class="icon-user"></i>
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" name="password" id="password" value="" required>
                    <i class="icon_lock_alt"></i>
                </div>
                <div class="clearfix add_bottom_15">
                    <div class="radios">
                        <label class="container_radio">Khách hàng
                            <input type="radio" name="type_login" value="3" checked="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="clearfix add_bottom_15">
                    <div class="radios">
                        <label class="container_radio">Tiếp thị liên kết
                            <input type="radio" name="type_login" value="1">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="clearfix add_bottom_15">
                    <div class="radios">
                        <label class="container_radio">Đơn vị thi công
                            <input type="radio" name="type_login" value="2">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="clearfix add_bottom_15">
                    <div class="checkboxes">
                        <label class="container_check">Ghi nhớ tài khoản
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="text-center"><input type="submit" value="Đăng nhập" class="btn_1 full-width"></div>
                <div class="text-center">
                    Bạn chưa có tài khoản? <a href="#sign-up" data-menu="sign-up"  id="sign-in" class="register" title="Đăng ký">Đăng ký</a>
                </div>
            </div>
        </form>
        <!--form -->
    </div>
</div>

<div id="sign-up"
     data-selected="menu-components"
     data-title="Modal Menu"
     data-subtitle="This Effect Is"
     data-width="300"
     data-height="580"
     class="menu-box menu-load menu-modal">
    <aside class="zoom-anim-dialog mfp-hide register-form">
        <form autocomplete="off" id="frmRegister">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{--<label>Họ tên</label>--}}
                        <input class="form-control" type="text" name="full_name" required="" placeholder="Họ tên">
                        <i class="ti-user"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{--<label>Tên đăng nhập</label>--}}
                        <input class="form-control" type="text" name="username" id="username1" required placeholder="Tên đăng nhập">
                        <i class="ti-user"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{--<label>Mật khẩu</label>--}}
                        <input class="form-control" type="password" id="password1" name="password" required placeholder="Mật khẩu">
                        <i class="icon_lock_alt"></i>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{--<label>Nhập lại mật khẩu</label>--}}
                        <input class="form-control" type="password" id="password2" required placeholder="Nhập lại mật khẩu">
                        <i class="icon_lock_alt"></i>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{--<label>Số điện thoại</label>--}}
                        <input class="form-control" type="text" name="mobile" required placeholder="Số điện thoại">
                        <i class="ti-mobile"></i>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{--<label>Email</label>--}}
                        <input class="form-control" type="email" name="email" required placeholder="Email">
                        <i class="ti-email"></i>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{--<label>Địa chỉ</label>--}}
                        <input class="form-control" type="text" name="address" required placeholder="Địa chỉ">
                        <i class="ti-location-pin"></i>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{--<label>Tên công ty</label>--}}
                        <input class="form-control" type="text" name="company_name" required placeholder="Tên công ty">
                        <i class="ti-user"></i>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="clearfix add_bottom_15">
                        <div class="radios">
                            <label class="container_radio">Khách hàng
                                <input type="radio" name="type" value="3" checked="">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="radios">
                            <label class="container_radio">Tiếp thị liên kết
                                <input type="radio" name="type" value="1">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="radios">
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
            <div class="text-center add_top_10">Bạn đã có tài khoản? <strong><a href="#sign-in-dialog" data-menu="menu-list-modal" class="login">Đăng nhập</a></strong></div>
        </form>
    </aside>
</div>

<div id="account"
     data-selected="menu-components"
     data-title="Modal Menu"
     data-subtitle="This Effect Is"
     data-width="200"
     data-height="90"
     class="menu-box menu-load menu-modal">
    @if(! is_null(\Auth::guard('marketing')->user()))
        {{--<li class="dropdown-toggle" style="line-height: 38px;position: relative;">--}}
            {{--<a href="#" class="account"><i class="fa fa-user"></i></a>--}}
            <ul class="account-item">
                <li><a href="{!!route('marketing.index',\Auth::guard('marketing')->user()->alias)!!}">Thông tin cá nhân</a></li>
                <li><a href="{!!route('api.logout-marketing')!!}">Đăng xuất</a></li>
            </ul>
        {{--</li>--}}
    @elseif(! is_null(\Auth::guard('construction')->user()))
        {{--<li class="dropdown-toggle" style="line-height: 38px;position: relative;">--}}
            {{--<a href="#" class="account"><i class="fa fa-user"></i></a>--}}
            <ul class="account-item">
                <li><a href="{!!route('construction.edit_profile', \Auth::guard('construction')->user()->alias)!!}">Thông tin cá nhân</a></li>
                <li><a href="{!!route('api.logout-construction')!!}">Đăng xuất</a></li>
            </ul>
        {{--</li>--}}
    @else
        {{--<a data-menu="menu-list-modal" id="sign-in" class="login" title="Đăng nhập"><i class="fa fa-sign-in-alt" aria-hidden="true"></i></a>--}}
    @endif
</div>