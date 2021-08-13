@extends('frontend.layouts.master')
@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0"></script>
    <div class="sub_header_in sticky_header">
        <div class="container">
            <h1>Alagreen TV</h1>
        </div>
        <!-- /container -->
    </div>
    <!-- /sub_header -->
    <main>
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-9">
                    <div class="singlepost">
                        <div class="content-video">
                            <iframe width="100%"  src="https://www.youtube.com/embed/{{$record->getVideo($record->video_url)}}" autoplay="true" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        </div>
                        <h1>{{$record->title}}</h1>
                        <div class="postmeta">
                            <ul>
                                <li><i class="ti-calendar"></i> {{$record->getPostSchedule() }}</li>
                                <li><i class="ti-eye"></i> {{$record->view_count}}</li>
                            </ul>
                        </div>
                        <!-- /post meta -->
                        <div class="post-content">
                            {!! $record->content !!}
                        </div>
                        <!-- /post -->
                    </div>
                </div>
                <!-- /col -->
                <aside class="col-lg-3">
                    <!-- /widget -->
                    <div class="widget">
                        <div class="widget-title">
                            <h4>Video liên quan</h4>
                        </div>
                        <ul class="comments-list">
                            @foreach($related_video as $val)
                                <li>
                                <div class="alignleft">
                                    <a href="{{$val->url()}}"><img src="{{$val->getImage()}}" alt="{{$val->title}}"></a>
                                </div>
                                <h3><a href="{{$val->url()}}" title="">{{$val->title}}</a></h3>
                                <small>{{$val->getPostSchedule()}}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            <!-- /aside -->
            </div>
            <!-- /row -->
            @if($related_products->count() >0)
            <div class="related-news">
                <h5>Sản phẩm liên quan</h5>

                <div class="news-owl-carousel owl-carousel owl-theme">
                    @foreach($related_products as $item)
                        <div class="item">
                            <article class="blog">
                                <figure>
                                    <a href="{{$item->url()}}"><img src="{{$item->getImage()}}" alt="{{$item->title}}">
                                        <div class="preview"><span>Xem thêm</span></div>
                                    </a>
                                </figure>
                                <div class="post_info">
                                    <h2 class="post-title"><a href="{{$item->url()}}">{{$item->title}}</a></h2>
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