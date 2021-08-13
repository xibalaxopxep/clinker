@extends('frontend.layouts.master')
@section('content')
    <main>
        <div id="results">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-10">
                        <h4><strong>Alagreen TV</strong></h4>
                    </div>
                    <div class="col-lg-9 col-md-8 col-2">
                        <a href="#0" class="side_panel btn_search_mobile"></a> <!-- /open search panel -->
                        <form method="get" action="{{route('video.search')}}">
                            <div class="row no-gutters custom-search-input-2 inner nomargin">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" autocomplete="off" id="autoComplete" type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
                                        <i class="icon_search"></i>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <select class="wide" id="category_id" name="category_id">
                                        <option value="0">Tất cả</option>
                                        @foreach ($category_arr as $category)
                                            <option value="{!!$category->id!!}">{!!$category->title!!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <input type="submit" value="Tìm kiếm" class="submit">
                                </div>
                            </div>
                            <!-- /row -->
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /results -->
        <div class="container margin_60_35 video pt-140">
            <div class="feature-video row">
                <div class="col-lg-9">
                    <div class="singlepost">
                        <div class="content-video">
                            <iframe width="100%"  src="https://www.youtube.com/embed/{{$hot_video_arr[0]->getVideo($hot_video_arr[0]->video_url)}}" autoplay="true" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        </div>
                        <a href="{{route('video.detail', ['alias' => $hot_video_arr[0]->alias])}}">
                            <h1>{{$hot_video_arr[0]->title}}</h1>
                        </a>
                        <div class="postmeta">
                            <ul>
                                <li><i class="ti-calendar"></i> {{$hot_video_arr[0]->getPostSchedule() }}</li>
                                <li><i class="ti-eye"></i> {{$hot_video_arr[0]->view_count}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <aside class="col-lg-3">
                    <!-- /widget -->
                    <div class="widget video-list">
                        <ul class="comments-list item-list">
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
            </div>
            @foreach($category_arr as $category)
            <div class="main_title_3">
                <span></span>
                <h2>{{$category->title}}</h2>
            </div>

                @if($category->videos->count() == 0)

                    <div class="row">
                        <div class="col-md-12">
                            Nội dung đang được cập nhật.
                            <br><br>
                        </div>
                    </div>
                @else
                    <div class="video-owl-carousel owl-carousel owl-theme">
                    @foreach($category->videos as $video)
                        <div class="item">
                            <a href="{{route('video.detail', ['alias' => $video->alias])}}" class="grid_item small">
                                <figure>
                                    <img src="{{$video->getImage()}}" alt="{{$video->title}}">
                                    <div class="info">
                                        <h3>{{$video->title}}</h3>
                                    </div>
                                </figure>
                            </a>
                        </div>
                    @endforeach

                    </div>
                @endif
            <!-- /row -->
            @endforeach

        </div>
    </main>
@stop
