@extends('frontend.layouts.construction')
@section('content')
<div class="bg-grey">
    @include('frontend.construction.cover')
    <div class="container">
        <div class="construction-detail bg-white row no-gutters" style="margin-right: 0">
            <div class="col-md-2 col-xs-12">
                <div class="hz-sidebar plr-15 ">
                    <div id="LeftSideBar" class="comp-box">
                        <div class="sidebar">
                            <div class="sidebar-header">Dự án</div>
                            <div class="sidebar-body">
                                <ul>
                                    @foreach($data as $project)
                                    <li class="sidebar-item">
                                        <a class="" style="color: #555" href="{{route('project.detail', ['alias' => $project->alias])}}">
                                            <span class="option-text">{{$project->title}}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
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
                        <span><i class="fa fa-map-marker" style="margin-right: 8px;"></i>{{$record->address}}</span>
                    </div>
                </div>
                <div class="horizontal-divider"></div>
                <div class="col-md-12">
                    <form action="{{route('construction.detail',['alias' => $record->alias])}}" method="get">
                        <div class="row">
                            <div class="col-md-7 first-input">
                                <input class="form-control" name="keyword" placeholder="Nhập từ khóa" value="@if(isset($search['keyword'])) {{$search['keyword']}} @endif"/>
                            </div>
                            <!--<div class="col-md-2 col-xs-12 third-input">
                            <select class="form-control" name="construction_category_id" id="construction_category">
                                <option value="0">Chọn danh mục</option>

                                </select>
                            </div>-->
                            <div class=" submit-input">
                                <input class="form-control" type="submit" value="Tìm kiếm">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="project-section profile-content-wide__section" id="project">
                    @if(isset($_GET['keyword']))
                        <div class="header-6 mt0">{{$data->count()}} Dự án</div>
                    @else
                        <div class="header-6 mt0">{{$record->projects->count()}} Dự án</div>
                    @endif

                    <div class="projects-wrapper row pad-left-15">

                        @foreach($data as $project)
                        <div class="col-md-6 col-lg-4 my-no-padding" style="padding-right: 0; padding-bottom: 10px">
                            <a class="whiteCard project-card" href="{{$project->url()}}">
                                <img class=" hz-image-container" src="@if($project->gallery) {{$project->gallery[0]->images}} @endif" width="247" height="247" alt="{{$project->title}}">
                                <div class="project-meta-container">
                                    <div class="project-meta">
                                        <div class="text-bold project-meta__name">{{$project->title}}</div>
                                        <div class="mtb-10">{{$project->gallery->count()}} ảnh</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="horizontal-divider"></div>
                <div class="project-section profile-content-wide__section" id="reviews">
                    <div class="header-6 mt0">{{$record->reviews->count()}} đánh giá</div>

                    @if(!count($review_person))
                    <a class="btn btn-primary review-button button-signup " data-toggle="modal"
                       data-target="#loginModal" data-href="{{route('construction.detail', ['alias' => $record->alias])}}">Viết đánh giá</a>
                    <div class="add-reviews  d-none">
                    @else
                    <div class="add-reviews">
                    @endif
                        <form id="frmReviews" method="POST">
                            <input type="hidden" name="construction_id" id="construction_id" value="{{$record->id}}">
                            <input type="hidden" name="review_person_id" id="review_person_id" @if(count($review_person)) value="{{$review_person['facebook_id']}}" @endif>
                            <div class="reviews">
                                <ul class="list-inline rating-list">
                                    <li><i class="fa fa-star yellow"></i></li>
                                    <li><i class="fa fa-star yellow"></i></li>
                                    <li><i class="fa fa-star yellow"></i></li>
                                    <li><i class="fa fa-star yellow"></i></li>
                                    <li><i class="fa fa-star gray"></i></li>
                                </ul>
                            </div>
                            <textarea class="form-control" name="content" id="content_review"></textarea>
                            <input class="submit-reviews" type="submit" value="Lưu lại">
                        </form>
                    </div>
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

<div class="modal fade" role="dialog" id="loginModal" style="top: 100px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Đăng nhập để viết đánh giá</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" style="text-align: center;">
                <form action="#" class="sign-in">
                    <a class="login-fb" onclick="facebook_login()" href="javascript:void(0)" data-href="/">
                        <div class="logo-fb" style="display: inline-block;">
                            <i class="fa fa-facebook-f"></i>
                        </div>
                        <span>Đăng nhập bằng facebook</span>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
