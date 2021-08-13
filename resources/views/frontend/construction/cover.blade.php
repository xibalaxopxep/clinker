<div class="container profile-carded">
    <div class="hz-profile-header">
        <div id="profile-header" class="comp-box">
            <div class="short-header profile-header edit">
                <div class="profile-cover">
                    <div class="profile-pic-container">
                        <a class="profile-pic-border" href="{{$record->url()}}">
                            <img class="profile-pic" width="173" height="173" id="mainUserProfilePic" alt="{{$record->full_name}}" src="{{$record->avatar}}">
                        </a>
                    </div>
                    <img id="coverImage" class="cover-image custom-cover " src="{{$record->cover}}" alt="{{$record->full_name}}">
                    <div class="profile-info">
                        <div class="profile-title">
                            <h1>
                                <a class="profile-full-name text-bold" href="{{$record->url()}}">{{$record->full_name}}</a>
                            </h1>
                        </div>
                        <div class="reviews">
                            <a href="" data-compid="review">
                                <span class="hz-star-rating">
                                    @for($i = 0; $i < 5; $i++)
                                    @if($i < $record->star())
                                    <i class="fa fa-star"></i>
                                    @else
                                    <i class="fa fa-star-o"></i>
                                    @endif
                                    @endfor
                                    <span class="hz-star-rate__review-string">{{$record->reviews->count()}} đánh giá</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="profile-pro-actions">
                        <button class=" btn-lg" style="background:#627aad;border: none;" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{route('construction.detail', $record->alias)}}', 'Facebook', 'width=600,height=400');" href="javascript:void(0)" class="rounded-circle tw" data-toggle="tooltip" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></button>
                        <button class=" btn-lg" style="background:#4d9ed8;border: none;" onclick="window.open('https://twitter.com/intent/tweet?text={{route('construction.detail', $record->alias)}}', 'Google', 'width=600,height=400');" href="javascript:void(0)" class="rounded-circle ff" data-toggle="tooltip" title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></button>
                        <button class="btn btn-primary btn-lg trackMe " id="emailPro" data-toggle="modal" data-target="#mdlContact">Liên hệ</button>
                        <div class="hz-profile-header__contact-info text-center mrm" style="margin-top:5px">
                            <a href="tel:{{$record->mobile}}" class="hz-profile-header__contact-method hz-track-me" data-compid="Profile_Phone">
                                <i class="fa fa-phone" style="margin-right: 8px;"></i>
                                <span>Gọi ngay</span></a>
                                <a href="{{$record->website}}" rel="nofollow noopener noreferrer" data-compid="Profile_Website" target="_blank" class="hz-profile-header__contact-info-item hz-track-me ">
                                <i class="fa fa-home" style="margin-right: 8px;"></i>
                                Website
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-group-inline sidebar profile-tabs">
                        <ul class="list-inline list-unstyled touch-scroll-list">
                            <li>
                                <div class="profile-pic-placeholder"></div>
                            </li>
                            @if(\Auth::guard('construction')->user())
                            <li class="@if(str_contains(url()->current(),$record->alias)) selected @endif sidebar-item">
                                <a class="sidebar-item-labels" href="{{route('construction.edit_profile', ['alias' => \Auth::guard('construction')->user()->alias])}}" title="Tài khoản">
                                    <span class="option-text">Tài khoản</span>
                                </a>
                            </li>
                            <li class="@if(str_contains(url()->current(), '/du-an/')) selected @endif sidebar-item">
                                <a class=" sidebar-item-labels scroll-from" href="{{route('construction.list_project')}}" title="Dự án">
                                    <span class="option-text">Dự án</span>
                                </a>
                            </li>
                            <li class="@if(str_contains(url()->current(), '/tao-moi/du-an')) selected @endif sidebar-item">
                                <a class="sidebar-item-labels scroll-from" href="{{route('construction.add_project')}}" title="Đăng dự án">
                                    <span class="option-text">Đăng dự án</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-item-labels scroll-from" href="{!!route('api.logout-construction')!!}" title="Đăng xuất">
                                    <span class="option-text">Đăng xuất</span>
                                </a>
                            </li>
                            @else
                            <li class="@if(str_contains(url()->current(), '/thi-cong/')) selected @endif sidebar-item">
                                <a class="sidebar-item-labels" href="@if(str_contains(url()->current(), '/du-an/')) {{$record->url()}}#about_us @else #about_us @endif" title="Giới thiệu">
                                    <span class="option-text">Giới thiệu</span>
                                </a>
                            </li>
                            <li class=" @if(str_contains(url()->current(), '/du-an/')) selected @endif sidebar-item">
                                <a class="sidebar-item-labels scroll-from" href="#project" title="Dự án">
                                    <span class="option-text">Dự án</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-item-labels scroll-from" href="@if(str_contains(url()->current(), '/du-an/')) {{$record->url()}}#reviews @else #reviews @endif" title="đánh giá">
                                    <span class="option-text">Đánh giá</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
