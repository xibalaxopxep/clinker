@extends('mobile.layouts.construction-project')
@section('content')
    <div class="page-content header-clear-large gallery-page">
        <div class="bg-grey">
        @include('mobile.construction.cover')
        <div class="container">
            <div class="construction-detail bg-white row no-gutters">
                <div class="col-md-2 col-xs-12">
                    <div class="hz-sidebar plr-15 ">
                        <div id="LeftSideBar" class="comp-box">
                            <div class="sidebar">
                                <div class="sidebar-header">Dự án</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12 plr-15 ">
                    <div class="profile-content-wide-redesign" id="about_us">
                        <div class="description">
                            {{$record->description}}
                        </div>
                        <div style="margin-top: 10px;">
                            <span><i class="fa fa-map-marker" style="margin-right: 8px;"></i>355 Bình Quới, Phường 28, Q. Bình Thạnh, Tp. Hồ Chí Minh (TPHCM), Việt Nam</span>
                        </div>
                    </div>
                    <div class="horizontal-divider"></div>
                    @if (!is_null(\Auth::guard('construction')->user()))
                        <div class="header-6 mt0">{{$record->projects->count()}} Dự án</div>
                        <div class="filter-view row">
                            @foreach($record->projects as $project)
                                <div class="m6 l4 xl3 card-post col-md-4 col-xs-12">
                                    <div class="card-image">
                                        <a href="{{$project->url()}}">
                                            <div class="img-holder">
                                                <div class="img-ratio-fill" ></div>
                                                <div class="img-progressive">
                                                    <img src="{{$project->gallery[0]->images}}" class=" responsive-img progressive-img loaded" alt="{{$project->title}}">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card-content">
                                        <h4 class="card-title">
                                            <a href="{{$project->url()}}">{{$project->title}}</a>
                                        </h4>
                                        <div class="post-status">
                                <span class="status">
                                    Tác vụ:</span>
                                            <ul>
                                                <li>
                                                    <a href="{!!route('construction.edit_project',$project->alias)!!}"><i class="fa fa-edit" style="cursor: pointer;color:blue;" title="Chỉnh sửa"></i></a>
                                                </li>
                                                <li>
                                                    <a href="{!!route('construction.delete_project',$project->alias)!!}" style="cursor: pointer;color:red;" title="Xóa"><i class="fa fa-trash"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="project-section profile-content-wide__section" id="project">
                            <div class="header-6 mt0">{{$record->projects->count()}} Dự án</div>
                            <div class="projects-wrapper row pad-left-15">
                                @foreach($record->projects as $project)
                                    <div class="col-md-4 my-no-padding pad-right-15">
                                        <a class="whiteCard project-card" href="{{$project->url()}}">
                                            <img class=" hz-image-container" src="{{$project->gallery[0]->images}}" width="247" height="247" alt="{{$project->title}}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="horizontal-divider"></div>
                    <div class="project-section profile-content-wide__section" id="reviews">
                        <div class="header-6 mt0">{{$record->reviews->count()}} đánh giá</div>
                        <div class="horizontal-divider"></div>
                        <div class="projects-wrapper row">
                            <div class="col-md-12">
                                @foreach ($record->reviews as $review)
                                    <div class="review-item">
                                        <div class="float-left">
                                            <div class="review-item__reviewer_left_side">
                                                <img class="thumb-border thumb-round-corner" title="{{$review->construction->full_name}}" src="/upload/images/no_user_image.png" alt="{{$review->construction->full_name}}">
                                            </div>
                                            <div class="float-right">
                                                <span class="hz-user-name" >{{$review->review_person->full_name}}</span>
                                                <div class="reviews">
                                            <span class="hz-star-rating">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $review->star)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endfor                            
                                            </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="review-item__info d-none">
                                            <div class="review-item__section">
                                                <div class="text-bold">Email: </div>
                                                <div>{{$review->review_person->email}}</div>
                                            </div>
                                            <div class="review-item__section">
                                                <div class="text-bold">Ngày tạo: </div>
                                                <div>{{$review->created_at()}}</div>
                                            </div>
                                        </div>
                                        <div class="review-item__body">
                                            {{$review->content}}
                                        </div>
                                    </div>
                                    <div class="horizontal-divider"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
