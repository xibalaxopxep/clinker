@extends('frontend.layouts.master')
@section('content')
<div class="sub_header_in sticky_header">
    <div class="container">
        <h1>Tin tức</h1>
    </div>
    <!-- /container -->
</div>
<!-- /sub_header -->
<main>
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-9">
                <div class="singlepost">
                    <figure><img alt="{{$record->title}}" class="img-fluid" src="{{$record->getImage()}}"></figure>
                    <h1>{{$record->title}}</h1>
                    <div class="postmeta">
                        <ul>
                            <li>
                                <i class="ti-folder">
                                @foreach ($record->categories as $key => $category)
                                </i><a href="{{$category->urlNews()}}">@if($key != 0), @endif{{$category->title}}</a>
                                @endforeach
                            </li>
                            <li><i class="ti-calendar"></i> {{$record->created_at() }}</li>
                            <li><i class="ti-user"></i> {{$record->createdBy->full_name}}</li>
                        </ul>
                    </div>
                    <div class="post-content">
                          {!! $record->content !!}
                    </div>
                    <div class="share">
                        <ul class="share-buttons">
                            <li><a class="fb-share" href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={!! $record->url() !!}', 'Facebook', 'width=600,height=400');"><i class="social_facebook"></i> Facebook</a></li>
                            <li><a class="twitter-share" href="javascript:void(0)" onclick="window.open('https://twitter.com/share?text=&url={!! $record->url() !!}', 'Twitter', 'width=600,height=400')"><i class="social_twitter"></i> Twitter</a></li>
                            <li><a class="pinterest-share" href="javascript:void(0)" onclick="window.open('http://pinterest.com/pin/create/button/?url={!! $record->url() !!}', 'Pinterest', 'width=600,height=400')"><i class="fa fa-pinterest-p"></i> Pinterest</a></li>
                            <li><a class="linkedin-share" href="javascript:void(0)" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url={!! $record->url() !!}', 'Linkedin', 'width=600,height=400')"><i class="fa fa-linkedin"></i> Linkedin</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /single-post -->

                <div id="comments">
                    <h5>Bình luận</h5>
                    <div class="fb-comments" data-href="{{$record->url()}}" data-width="100%" data-numposts="5"></div>
                </div>


            </div>
            <!-- /col -->            
            @include('frontend.news.sidebar')    
            <!-- /aside -->
        </div>
        <!-- /row -->
        @if($related_news->count()>0)
        <div class="related-news">
            <h5>Tin tức liên quan</h5>

            <div class="news-owl-carousel owl-carousel owl-theme">
                @foreach($related_news as $item)
                <div class="item">
                    <article class="blog">
                        <figure>
                            <a href="{{route('news.detail', ['alias' => $item->alias])}}"><img src="{{$item->images}}" alt="{{$item->title}}">
                                <div class="preview"><span>Xem thêm</span></div>
                            </a>
                        </figure>
                        <div class="post_info">
                            <h2 class="post-title"><a href="{{route('news.detail', ['alias' => $item->alias])}}">{{$item->title}}</a></h2>
                            <ul>
                                <li>
                                    <div class="thumb"><img src="{{$item->createdBy->avatar}}" alt="{{$item->createdBy->full_name}}"></div> {{$item->createdBy->full_name}}
                                </li>
                                <li><i class="ti-eye"></i>{{$item->view_count}}</li>
                            </ul>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>

        </div>
        @endif
    </div>
    <!-- /container -->
</main>
<!--/main-->
@stop