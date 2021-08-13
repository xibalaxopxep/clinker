@extends('mobile.layouts.news')
@section('content')
    <div class="page-content header-clear-medium top-30">
        <div class="content-title bottom-20">
            <h4>Danh mục tin tức</h4>
        </div>
        <div class="content">
            <ul class="cats">
                @foreach($category_arr as $category)
                    <li><a href="{{$category->urlNews()}}">{{$category->title}} <span>({{$category->news->count()}})</span></a></li>
                @endforeach
            </ul>
        </div>

        <div class="content-title bottom-20">
            <h4>Tin tức</h4>
        </div>
        <div class="content">
            @foreach($records as $key => $record)
            <div class="blog-list-item one-half @if($key % 2 == 1) last-column @endif">
                <a href="{{$record->url()}}">
                    <img class="preload-image rounded-image shadow-small" src="{{$record->getImage()}}" data-src="{{$record->getImage()}}" alt="{{$record->title}}">
                    <strong>{{$record->title}}</strong>
                </a>
                <span><i class="fas fa-clock"></i>{{$record->created_at()}}</span>
            </div>
            @endforeach
        </div>
    </div>
@stop