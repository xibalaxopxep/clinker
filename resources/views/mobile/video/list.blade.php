@extends('mobile.layouts.master')
@section('content')
<div class="page-content header-clear-medium">
    <div class="gallery gallery-albums">
        <div class="video-slider owl-carousel owl-no-dots">
            @foreach ($hot_video_arr as $item)
            <div class="item">
                <a class="show-gallery" href="{{$item->url()}}" title="{{$item->title}}">
                    <img src="{{$item->getImage()}}" data-src="{{$item->getImage()}}" class="preload-image" alt="{{$item->title}}">
                    <strong>{{$item->title}}</strong>
                    <u class="overlay overlay-gradient"></u>
                </a>
            </div>
            @endforeach
        </div>
        <div class="clear"></div>
    </div>
    <div class="list-video top-10">
        @if($records->count() > 0)
        @foreach ($records as $record)
        <div class="store-slide-1">
            <a href="{{$record->url()}}" class="store-slide-image"><img src="{{$record->getImage()}}" alt="{{$record->title}}"></a>
            <div class="store-slide-title bottom-15">
                <h5 class="bottom-0">{{$record->title}}</h5>
            </div>
        </div>
        @endforeach
        {!!$records->render()!!}
        @else
        <div class="col-md-12">
            <h4>Không tìm thấy kết quả nào</h4>
        </div>
        @endif
    </div>
    
</div>

@stop