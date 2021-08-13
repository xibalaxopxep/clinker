@extends('mobile.layouts.home')
@section('content')
    <div class="page-content header-clear-large home-page">
        <div class="category ptb-15 bottom-15">
            <div class="content-title bottom-15">
                <h1>Danh mục sản phẩm</h1>
                <a href="{{route('product.index')}}" class="color-highlight">Xem tất cả</a>
            </div>
            <div class="pad-left-right">
                <div class="product-slider owl-carousel owl-no-dots">
                    @foreach($category_arr as $category)
                        <div class="item">
                            <article class="item-content">
                                <figure>
                                    <a href="{{route('product.index', ['category_id' => $category->id])}}">
                                        <img src="{{$category->image}}" alt="{{$category->title}}">
                                    </a>
                                </figure>
                                <div class="post_info">
                                    <h2 class="post-title text-center"><a href="{{route('product.index', ['category_id' => $category->id])}}">{{$category->title}}</a></h2>
                                </div>
                            </article>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
        <div class="category ptb-15 bottom-15">
            <div class="content-title">
                <h1>Danh mục hình ảnh</h1>
                <a href="{{route('gallery.index')}}" class="color-highlight">Xem tất cả</a>
            </div>
            <div class="bottom-15 pad-left-right">
                <div class="product-slider owl-carousel owl-no-dots">
                    @foreach($gallery_arr as $gallery)
                        <div class="item">
                            <article class="item-content">
                                <figure>
                                    <a href="{{route('gallery.index', ['category_id' => $gallery->id])}}">
                                        <img src="{{$gallery->image}}" alt="{{$gallery->title}}">
                                    </a>
                                </figure>
                                <div class="post_info">
                                    <h2 class="post-title text-center"><a href="{{route('gallery.index', ['category_id' => $gallery->id])}}">{{$gallery->title}}</a></h2>
                                </div>
                            </article>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
        <div class="category ptb-15 bottom-15">
            <div class="content-title">
                <h1>Nhà thầu thi công</h1>
                <a href="{{route('construction.index')}}" class="color-highlight">Xem tất cả</a>
            </div>
            <div class="bottom-15 pad-left-right">
                <div class="product-slider owl-carousel owl-no-dots">
                    @foreach($construction_arr as $construction)
                        <div class="item">
                            <article class="item-content">
                                <figure>
                                    <a href="{{$construction->url()}}">
                                        <img src="{{$construction->avatar}}" alt="{{$construction->full_name}}">
                                    </a>
                                </figure>
                                <div class="post_info">
                                    <h2 class="post-title text-center">
                                        <a href="{{$construction->url()}}">{{$construction->full_name}}</a>
                                    </h2>

                                </div>
                            </article>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>


        <div class="recent-post-mobile padding-top-15">
            
        </div>

    </div>

    @stop

