<!--Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
  <script type="text/javascript" src="//s.trackingmore.com/plugins/v1/buttonCurrent.js"></script>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
        <div class="media-body">
                        <img style="width:48px; height: 48px;" src="{{asset('upload/images2/nhanh3.jpg')}}" alt="picture" class="">
                    </div>
    <div class="collapse navbar-collapse" id="navbar-mobile">
        

        <span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

        <ul class="navbar-nav">
            

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img style="object-fit: cover" src="{{\Auth::user()->avatar}}" class="rounded-circle mr-2" height="34" width="34" alt="">
                    <span>{{\Auth::user()->full_name}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.user.index_profile', ['id' => \Auth::user()->id])}}" class="dropdown-item"><i class="icon-user-plus"></i> Thông tin tài khoản</a>
                    <a href="javascript:void(0)" data-action="logout" class="dropdown-item"><i class="icon-switch2"></i> Đăng xuất</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->



