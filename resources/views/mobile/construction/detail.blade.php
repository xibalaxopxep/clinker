@extends('mobile.layouts.construction-project')
@section('content')
    <div class="page-content header-clear-large gallery-page">
        <div class="bg-grey">
            @include('mobile.construction.cover')
            <div class="container">
                <div class="construction-detail bg-white row no-gutters">
                    <div class=" plr-15 ">
                        <div class="profile-content-wide-redesign" id="about_us">
                            <div class="description">
                                {{$record->description}}
                            </div>
                            <div style="margin-top: 10px;">
                                <span><i class="fa fa-map-marker" style="margin-right: 8px;"></i>{{$record->address}}</span>
                            </div>
                        </div>
                        <div class="horizontal-divider"></div>
                        <div class="project-section profile-content-wide__section" id="project">
                            <div class="header-6 mtb-10">{{$record->projects->count()}} Dự án</div>
                            <div class="projects-wrapper row pad-left-15">
                                @foreach($record->projects as $project)
                                    <div class="col-md-6 col-lg-4 pad-right-15 mtb-15">
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
                            <div class="header-6 mtb-10">{{$record->reviews->count()}} đánh giá</div>

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
                                                        <div class="image-name">
                                                            <div class="review-item__reviewer_left_side">
                                                                <img class="thumb-border thumb-round-corner" title="{{$review->construction->full_name}}" src="/upload/images/no_user_image.png" alt="{{$review->construction->full_name}}">
                                                            </div>
                                                            <div class="name-reviews">
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
        </div>
    </div>
@stop
