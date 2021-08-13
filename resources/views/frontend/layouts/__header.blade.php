
<header class="header menu_fixed">
    <div id="logo">
        <a href="/" title="{!!$share_config->title!!}">
            <img src="{!!$share_config->image!!}" width="auto" height="70" alt="{!!$share_config->company_name!!}" class="logo_normal">
            <img src="{!!$share_config->image!!}" width="165" height="70" alt="{!!$share_config->company_name!!}" class="logo_sticky">
        </a>
    </div>
    <div id="top-search" class="float-left">
        <form method="get" action="{{route('product.index')}}">
            <input type="text" placeholder="Tìm kiếm" class="form-control" id="topAutoComplete" autocomplete="off" name="keyword">
            <button type="submit" class="button-search"><i class="icon_search"></i></button>
        </form>
    </div>
    <ul id="top_menu">
        <li><a href="{{route('construction.index')}}" class="btn_add" target="_blank">Nhà thầu thi công</a></li>
        @if(! is_null(\Auth::guard('marketing')->user()))
        <li class="dropdown-toggle" style="line-height: 38px;position: relative;">
            <a href="#" class="account"><i class="fa fa-user"></i> {!! \Auth::guard('marketing')->user()->full_name !!}</a>
            <ul class="dropdown-menu">
                <li><a href="{!!route('marketing.index',\Auth::guard('marketing')->user()->alias)!!}">Thông tin cá nhân</a></li>
                <li><a href="{!!route('api.logout-marketing')!!}">Đăng xuất</a></li>
            </ul>
        </li>
        @elseif(! is_null(\Auth::guard('construction')->user()))
        <li class="dropdown-toggle" style="line-height: 38px;position: relative;">
            <a href="#" class="account"><i class="fa fa-user"></i> {!! \Auth::guard('construction')->user()->full_name !!}</a>
            <ul class="dropdown-menu">
                <li><a href="{!!route('construction.edit_profile', \Auth::guard('construction')->user()->alias)!!}">Thông tin cá nhân</a></li>
                <li><a href="{!!route('api.logout-construction')!!}">Đăng xuất</a></li>
            </ul>
        </li>
        @elseif(! is_null(\Auth::guard('member')->user()))
        <li class="dropdown-toggle" style="line-height: 38px;position: relative;">
            <a href="#" class="account"><i class="fa fa-user"></i> {!! \Auth::guard('member')->user()->full_name !!}</a>
            <ul class="dropdown-menu">
                <li><a href="{!!route('api.logout-member')!!}">Đăng xuất</a></li>
            </ul>
        </li>
        @else
        <li><a href="#sign-in-dialog" id="sign-in" class="login" title="Đăng nhập">Đăng nhập</a></li>
        @endif
        <li class="dropdown-toggle">
            <a href="/cart" class="shop-cart"  title="giỏ hàng"><span class="itm-cont">{{$count_cart}}</span><i class="fa fa-cart-plus" style="font-size: 25px;"></i>
            </a>
        </li>
    </ul>
    <!-- /top_menu -->
    <a href="#menu" class="btn_mobile">
        <div class="hamburger hamburger--spin" id="hamburger">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </a>

    <nav id="menu" class="main-menu">
        <ul>
            @foreach($menu as $key=>$val)
                <li><span><a href="/{{$val->link}}" target="_blank" class="font-weight-bold">{{$val->title}}</a></span>
                    @if(count($val->children) > 0)
                            <ul>
                                @foreach($val->children as $k=>$value)
                                    <li><a href="/{{$value->link}}" target="_blank" class="font-weight-bold">{{$value->title}}</a></li>
                                @endforeach
                            </ul>
                    @endif
                </li>
           @endforeach
        </ul>
    </nav>
    <div class="menu-sidebar">
        <div class="menu-sidebar-container">
            <div class="menu-sidebar-heading">
                <h4>Menu</h4>
                <a href="javascript:void(0)" class="menu-sidebar-close"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
            <div class="menu-sidebar-content">
                <ul>
                    <li>
                        <span><a href="{!!route('home.index')!!}">Trang chủ</a></span>
                    </li>
                @foreach($menu as $key=>$val)
                    <li class="has-menu"><span><a href="/{{$val->link}}">{{$val->title}}</a></span>
                        @if(count($val->children) > 0)
                            <ul class="menu-child">
                                @foreach($val->children as $k=>$value)
                                    <li><a href="/{{$value->link}}">{{$val->title}}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="menu-sidebar-footer">
                <div class="menu-sidebar-inner">
                    <!-- Cart Total -->
                    <!-- End Cart Buttons -->
                </div>
            </div>
            <!-- Cart Footer -->
        </div>
    </div>

    <div class="menu-sidebar-overlay"></div>

</header>
<!-- /header -->
