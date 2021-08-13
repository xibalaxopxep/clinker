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
                <div class="row">
                    @foreach($records as $record)
                    <div class="col-md-6">
                        <article class="blog">
                            <figure>
                                <a href="{{$record->url()}}"><img src="{{$record->getImage()}}" alt="{{$record->title}}">
                                    <div class="preview"><span>Xem thêm</span></div>
                                </a>
                            </figure>
                            <div class="post_info">
                                <small>{{$record->created_at()}}</small>
                                <h2 class="post-title"><a href="{{$record->url()}}">{{$record->title}}</a></h2>
                                <p class="post-description">{{$record->description}}</p>
                                <ul>
                                    <li>
                                        <div class="thumb"><img src="{{$record->createdBy->avatar}}" alt="{{$record->createdBy->full_name}}"></div> {{$record->createdBy->full_name}}
                                    </li>
                                    <li><i class="ti-eye"></i>{{$record->view_count}}</li>
                                </ul>
                            </div>
                        </article>
                        <!-- /article -->
                    </div>
                    @endforeach
                </div>
                <!-- /row -->

                {!!$records->render()!!}
                <!-- /pagination -->

            </div>
            <!-- /col -->
            @include('frontend.news.sidebar')    
            
            <!-- /aside -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
<!--/main-->
@stop