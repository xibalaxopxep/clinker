@extends('frontend.layouts.construction')
@section('content')
<div id="results" class="sub_header_in">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-10 pl-0">
                <h1>Nhà thầu thi công</h1>
            </div>
            <div class="col-lg-9 nopadding">
                <form action="{{route('construction.index')}}" method="get">
                    <div class="row">
                        <div class="col-md-4 col-xs-12 first-input">
                            <input class="form-control" name="keyword" placeholder="Nhập từ khóa" value="@if(isset($search['keyword'])) {{$search['keyword']}} @endif"/>
                        </div>
                        <!--<div class="col-md-2 col-xs-12 third-input">
                            <select class="form-control" name="construction_category_id" id="construction_category">
                                <option value="0">Chọn danh mục</option>
                                @foreach($category_arr as $category)
                                <option value="{{$category->id}}" @if(isset($search['construction_category_id'])&& ($category->id==$search['construction_category_id'])) selected @endif">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>-->
                        <div class="col-md-3 col-xs-12 third-input">
                            <select class="form-control" name="province" id="province_list">
                                <option value="0">Chọn khu vực</option>
                                @foreach($province_arr as $province)
                                <option value="{{$province->title}}" @if(isset($search['province'])&& ($province->title==$search['province'])) selected @endif">{{$province->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-12 last-input" >
                            <select class="form-control" name="item_id" id="construction_list">
                                <option value="0">Chọn hạng mục</option>
                                @foreach($item_arr as $item)
                                <option value="{{$item->id}}" @if(isset($search['item_id']) && ($item->id == $search['item_id'])) selected @endif">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-12 submit-input">
                            <input class="form-control" type="submit" value="Tìm kiếm">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<div  class="margin-mobile-top-165 bg-grey pt-140" id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3 pl-0">
                <aside class="ant-sidebar sidebar left-content col-md-pull-9 bg-white construction">
                    <aside class="aside-item collection-category">
                        <div class="aside-content">
                            <nav class="nav-category navbar-toggleable-md">
                                <ul class="nav navbar-pills">
                                    @foreach($category_arr as $category)
                                    <li class="nav-item nav-dropdown category">
                                        <a data-toggle="collapse" class="accordion-toggle" aria-expanded="true" href="#{{$category->alias}}">
<!--                                            <i class="fa fa-angle-down"></i>-->
                                            {{$category->title}}
                                        </a>
                                        <div id="{{$category->alias}}" class="panel-collapse collapse show" aria-expanded="true">
                                            <ul class="nav-dropdown-items active list-category">
                                                @foreach($category->items as $item)
                                                <li class="nav-item ">
                                                    <a class="nav-link " href="{{route('construction.index', ['item_id' => $item->id])}}">{{$item->title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                    <div class="horizontal-divider"></div>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </aside>
                </aside>
            </div>
            <div class="col-md-9 construction-list">
                <div class="main-block bg-white">
                    <div class="construction-breadcrumb">
                        <ul>
                            <li class="active"><a>Nhà thầu thi công</a></li>
                        </ul>
                    </div>
                    <div class="title-block"><h6>Có<span class="text-bold"> {{count($records)}}</span> đơn vị thi công</h6></div>
                    <ul>
                        @foreach ($records as $record)
                        <li class="construction-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    <a href="{{$record['url']}}">
                                        <img src="{{$record['cover']}}" alt="{{$record['full_name']}}" class="hz-responsive-img">
                                    </a>
                                </div>
                                <div class=" col-md-7 col-xs-12 pl-0">
                                    <div class="clearfix">
                                        <div class="construction-avatar">
                                            <img itemprop="image" src="{{$record['avatar']}}" width="50" height="50" alt="{{$record['full_name']}}">
                                        </div>
                                        <div class="construction-info">
                                            <a href="{{$record['url']}}" class="header-5 construction-fullname" itemprop="url">
                                                <span itemprop="name" class="">{{$record['full_name']}}</span>
                                            </a>
                                            <div class="mts">
                                                <a href="" data-compid="review">
                                                    <span class="hz-star-rating">
                                                        @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $record['star'])
                                                        <i class="fa fa-star"></i>
                                                        @else
                                                        <i class="fa fa-star-o"></i>
                                                        @endif
                                                        @endfor
                                                        <span>
                                                            {{count($record['reviews'])}} đánh giá
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <button class="text-bold contact-button" data-toggle="modal" data-target="#mdlContact" type="button"><span class=" btn__label ">Liên hệ</span></button>

                                    </div>
                                    <div class="description">{{$record['description']}}</div>
                                    <div class="mb-10">
                                        <a class="text-bold" href="{{$record['url']}}" data-compid="more">
                                            <span>Xem thêm <i class="fa fa-angle-right"></i>
                                                <span class="icon-chevron_thin_right " aria-hidden="true"></span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="construction-address">
                                        <i class="fa fa-map-marker"></i> {{$record['address']}}
                                    </div>
                                </div>
                            </div>
                            <div class="hz-horizontal-divider "></div>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@stop
