<div id="menu-hider"></div>
<div class="header header-scroll-effect">
    <div class="header-line-1 header-hidden header-logo-left">
        <div class="header-search" style="transition: all 300ms ease 0s;">
            <div style="width: 40%;position: absolute;left: -65px;top: 7px;">
                <a href="/" title="A.L.A GREEN Việt Nam cung ứng thiết kế thi công nội thất">
                    <img src="{!!$share_config->image!!}" width="110px" height="auto" alt="A.L.A GREEN Việt Nam" class="logo_normal">
                </a>
            </div>
            <form action="{{route('product.index')}}" method="get" style="width:60%;float:right;">
                <i class="fa fa-search" style="line-height: 26px; "></i>
                <input type="text" placeholder="Tìm kiếm" name="keyword" style="width: calc(100% - 43px);">
            </form>
        </div>
        <a href="{{route('product.sale')}}" class="menu-sale" style="right: 78px;color: #fff;">Sale</a>
        <a href="javascript:void(0)" data-link="{!!route('product.cart')!!}" style="right: 5px;" class="cart header-icon header-icon-3"><i class="fa fa-shopping-cart"></i><span class="badge badge-light cart_count carts">{{$count_cart}}</span></a>
        @if(! is_null(\Auth::guard('marketing')->user()))
            {{--<li class="dropdown-toggle" style="line-height: 38px;position: relative;">--}}
                <a data-menu="account" href="#" class="account"><i class="fa fa-user"></i></a>
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{!!route('marketing.index',\Auth::guard('marketing')->user()->alias)!!}">Thông tin cá nhân</a></li>--}}
                    {{--<li><a href="{!!route('api.logout-marketing')!!}">Đăng xuất</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        @elseif(! is_null(\Auth::guard('construction')->user()))
            {{--<li class="dropdown-toggle" style="line-height: 38px;position: relative;">--}}
                <a data-menu="account" href="#" class="account"><i class="fa fa-user"></i></a>
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{!!route('construction.edit_profile', \Auth::guard('construction')->user()->alias)!!}">Thông tin cá nhân</a></li>--}}
                    {{--<li><a href="{!!route('api.logout-construction')!!}">Đăng xuất</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        @else
            <a data-menu="menu-list-modal" id="sign-in" class="login" title="Đăng nhập" style="right: 38px;"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
        @endif
        {{--<a href="#" id="sign-out" class="logout" title="Đăng xuất"><i class="fa fa-sign-out" aria-hidden="true"></i></a>--}}
        <div class="menu">
            <div class="menu-item">
                <a href="{!!route('gallery.index')!!}"><img src="{!! asset('assets/mobile/images/icons/gallery.png') !!}"></a>
            </div>
            <div class="menu-item">
                <a href="{!!route('product.index')!!}"><img src="{!! asset('assets/mobile/images/icons/002-chair.png') !!}"></a>
            </div>
            <div class="menu-item">
                <a href="{!!route('home.index')!!}" class="active-menu"><i class="fa fa-home"></i></a>
            </div>
            <div class="menu-item">
                <a href="{!!route('construction.index')!!}"><img src="{!! asset('assets/mobile/images/icons/003-files-and-folders_1.png') !!}"></a>
            </div>
            <div class="menu-item">
                <a href="{!!route('video.index')!!}"><img src="{!! asset('assets/mobile/images/icons/005-television_1.png') !!}"></a>
            </div>
        </div>
    </div>
    <div class="header-line-2 header-scroll-effect">
        <div class="menu">
            <div class="menu-item">
                <a href="{!!route('gallery.index')!!}"><img src="{!! asset('assets/mobile/images/icons/001-photo_1.png') !!}"><span>Hình ảnh</span></a>
            </div>
            <div class="menu-item">
                <a href="{!!route('product.index')!!}"><img src="{!! asset('assets/mobile/images/icons/002-chair.png') !!}"><span>Sản phẩm</span></a>
            </div>
            <div class="menu-item">
                <a href="{!!route('home.index')!!}" class="active-menu"><i class="fa fa-home"></i><span>Trang chủ</span></a>
            </div>
            <div class="menu-item">
                <a href="{!!route('construction.index')!!}"><img src="{!! asset('assets/mobile/images/icons/003-files-and-folders_1.png') !!}"><span>Thi công</span></a>
            </div>
            <div class="menu-item">
                <a href="{!!route('video.index')!!}"><img src="{!! asset('assets/mobile/images/icons/005-television_1.png') !!}"><span>Alagreen TV</span></a>
            </div>
        </div>
        @if(! is_null(\Auth::guard('marketing')->user()))
            {{--<li class="dropdown-toggle" style="line-height: 38px;position: relative;">--}}
                <a data-menu="account" href="#" class="account"><i class="fa fa-user"></i></a>
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{!!route('marketing.index',\Auth::guard('marketing')->user()->alias)!!}">Thông tin cá nhân</a></li>--}}
                    {{--<li><a href="{!!route('api.logout-marketing')!!}">Đăng xuất</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        @elseif(! is_null(\Auth::guard('construction')->user()))
            {{--<li class="dropdown-toggle" style="line-height: 38px;position: relative;">--}}
                <a data-menu="account" href="#" class="account"><i class="fa fa-user"></i></a>
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><a href="{!!route('construction.edit_profile', \Auth::guard('construction')->user()->alias)!!}">Thông tin cá nhân</a></li>--}}
                    {{--<li><a href="{!!route('api.logout-construction')!!}">Đăng xuất</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        @else
            <a data-menu="menu-list-modal" id="sign-in" class="login" title="Đăng nhập"><i class="fa fa-sign-in" aria-hidden="true" style="right: 35px;"></i></a>
        @endif

        {{--<a href="#" id="sign-out" class="logout" title="Đăng xuất"><i class="fa fa-sign-out" aria-hidden="true"></i></a>--}}
        <a href="{{route('product.sale')}}" class="menu-sale">Sale</a>
        <a href="javascript:void(0)" data-link="{!!route('product.cart')!!}" class="cart header-icon header-icon-2"><i class="fa fa-shopping-cart"></i><span class="badge badge-light cart_count">{{$count_cart}}</span></a>
        <div class="header-search" style="transition: all 300ms ease 0s;">
            <form action="{{route('product.index')}}" method="get">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Tìm kiếm" name="keyword">
            </form>
        </div>
        <div id="logo">
            <a href="/" title="A.L.A GREEN Việt Nam cung ứng thiết kế thi công nội thất">
                <img src="{!!$share_config->image!!}" width="auto" height="45" alt="A.L.A GREEN Việt Nam" class="logo_normal">
            </a>
        </div>
    </div>

</div>
