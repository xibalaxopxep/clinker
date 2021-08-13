<!--/footer-->

<div id="toTop"></div><!-- Back to top button -->

<footer class="plus_border">
    <div class="margin_60_35 mlr-50">
        <div class="row">
            <div class="col-lg-2 col-md-6 col-sm-6">
                <h3 data-target="#collapse_ft_1">Liên kết</h3>
                <div class="collapse dont-collapse-sm" id="collapse_ft_1">
                    <ul class="links">
                        @foreach($news_footer1 as $key=>$val)
                        <li><a href="/tin-tuc/{{$val->alias}}">{{$val->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <h3 data-target="#collapse_ft_2">Về chúng tôi</h3>
                <div class="collapse dont-collapse-sm" id="collapse_ft_2">
                    <ul class="links">
                        
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3 data-target="#collapse_ft_3">Cộng đồng Alagreen</h3>
                        <div class="collapse dont-collapse-sm" id="collapse_ft_2">
                            <ul class="links">
                                @foreach($news_footer2 as $key=>$val)
                                <li><a href="/tin-tuc/{{$val->alias}}">{{$val->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3 data-target="#collapse_ft_3">Thanh toán</h3>
                        <div class="collapse dont-collapse-sm" id="collapse_ft_3">
                            <img src="/assets/frontend/img/visa.png" alt="Visa" height="30">
                            <img src="/assets/frontend/img/mastercard.png" alt="Mastercard" height="30">
                            <img src="/assets/frontend/img/momo.jpg" alt="Momo" height="30">
                            <img src="/assets/frontend/img/viettelpay.png" alt="Viettelpay" height="30">
                        </div>
                        <h3 class="mt-15">Vận chuyển</h3>
                        <div class="collapse dont-collapse-sm" id="collapse_ft_3">
                            <img src="/assets/frontend/img/vnpost.png" alt="VNPOST" height="30">
                            <img src="/assets/frontend/img/viettelpost.png" alt="ViettelPost" height="30">
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <div class="collapse dont-collapse-sm" id="collapse_ft_3">
                            <img src="/assets/frontend/img/bct.png" alt="Chứng nhận bộ công thương" height="60">
                            <img src="/assets/frontend/img/f1.png" alt="f1" height="60">
                            <img src="/assets/frontend/img/f3.png" alt="f3" height="60">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <h3 data-target="#collapse_ft_4">Đăng ký nhận tin</h3>
                <div class="collapse dont-collapse-sm" id="collapse_ft_4">
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email" id="email_newsletter" class="form-control" placeholder="Nhập email">
                                <input type="submit" value="Đăng ký" id="submit-newsletter">
                            </div>
                        </form>
                    </div>
                    <p>Đăng ký và nhận email cung cấp các thông tin mới nhất của Alagreen về dịch vụ, chương trình khuyến mãi, khảo sát và ưu đãi từ đối tác. Bạn có thể hủy đăng ký bất cứ khi nào bằng cách nhấn vào liên kết ở cuối email</p>
                    <p>Liên hệ với Alagreen <a href="#">tại đây</a>. Xem chính sách bảo mật <a href="#">tại đây</a></p>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <img src="{!!$share_config->image!!}" alt="{!!$share_config->company_name!!}" height="50">
                <ul id="additional_links">
                    <li><a href="#0">Về chúng tôi</a></li>
                    <li><a href="#0">Chính sách và điều khoản hoạt động</a></li>
                    <li><a href="#">Bảo mật</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <p class="nomargin">© 2019 Alagreen. Bản quyền thuộc về Công ty TNHH Thương mại Dịch vụ Alagreen. Mọi hành vi sao chép đều là phạm pháp nếu không có sự cho phép bằng văn bản của chúng tôi</p>
            </div>
        </div>
    </div>
</footer>
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
<!-- /Sign In Popup -->
<script src="{!!asset('assets/frontend/js/jquery.js')!!}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
<script src="{!!asset('assets/frontend/js/owl.carousel.min.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/jquery.nice-select.min.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/jquery.slimscroll.min.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/jquery.magnific-popup.min.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/jquery.auto-complete.min.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/sweetalert.min.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/custom.js')!!}"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0"></script>

