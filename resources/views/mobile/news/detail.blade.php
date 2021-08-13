@extends('mobile.layouts.news')
@section('content')
    <div class="page-content header-clear-large">
        <div class="content reading-time-box bottom-70">
            <img class="preload-image responsive-image bottom-30 shadow-medium rounded-image" src="{{$record->getImage()}}" data-src="{{$record->getImage()}}">
            <h4 class="bolder">{{$record->title}}</h4>

            <h4 class="color-gray-dark font-12 bottom-30">
                <i class="fa fa-user" aria-hidden="true"></i> <strong> {{$record->createdBy->full_name}}</strong> | <span><i class="fas fa-clock"></i> {{$record->created_at() }}</span> | <span><i class="fas fa-fw select-all "></i> {{$record->view_count}}</span>
            </h4>
            <div class="blog-content">{!! $record->content !!}</div>
            <div class="decoration"></div>
            <div id="menu-share" data-height="420">
                <h4>Chia sẻ bài viết</h4>
                <div class="sheet-share-list">
                    <a class="fb-share" href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={!! $record->url() !!}', 'Facebook', 'width=600,height=400');"><i class="fab fa-facebook-f bg-facebook"></i></a>
                    <a class="twitter-share" href="javascript:void(0)" onclick="window.open('https://twitter.com/share?text=&url={!! $record->url() !!}', 'Twitter', 'width=600,height=400')"><i class="fab fa-twitter bg-twitter"></i></a>
                    <a class="linkedin-share" href="javascript:void(0)" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url={!! $record->url() !!}', 'Linkedin', 'width=600,height=400')"><i class="fab fa-linkedin-in bg-linkedin"></i></a>
                </div>
            </div>
            <div id="comments" class="top-20">
                <h4>Bình luận</h4>
                <div class="fb-comments" data-href="{{$record->url()}}" data-width="100%" data-numposts="5"></div>
            </div>
        </div>
    </div>
@stop
