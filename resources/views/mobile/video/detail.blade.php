@extends('mobile.layouts.news')
@section('content')
<div class="page-content header-clear-medium">
    <div class="video-detail content reading-time-box bottom-30">
        <iframe width="100%" height="auto" src="https://www.youtube.com/embed/{{$record->getVideo($record->video_url)}}?autoplay=1" autoplay="true" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        <h4 class="bolder top-10 bottom-10">{{$record->title}}</h4>
        <div class="blog-content">{!! $record->content !!}</div>
        <div class="decoration"></div>
    </div>
    <div class="content-title bottom-0 top-20">
        <h1>Video liên quan</h1>
    </div>
    <div class="video-detail-slider owl-carousel owl-has-dots bottom-15 pad-left-right" id="sale-product">
        @foreach($related_video as $val)
        <div class="store-featured-1">
            <a href="{{$val->url()}}">
                <img src="{{$val->getImage()}}" alt="{{$val->title}}">
                <strong>{{$val->title}}</strong>
            </a>
        </div>
        @endforeach
    </div>
    @if($related_products->count() >0)
    <div class="content-title bottom-0 top-20">
        <h1>Sản phẩm liên quan</h1>
    </div>
    <div class="video-detail-slider owl-carousel owl-has-dots bottom-15 pad-left-right" id="sale-product">
        @foreach($related_products as $val)
        <div class="store-featured-1">
            <a href="{{$val->url()}}">
                <img src="{{$val->getImage()}}" alt="{{$val->title}}">
                <strong>{{$val->title}}</strong>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>
@stop
