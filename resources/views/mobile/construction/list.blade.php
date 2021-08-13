@extends('mobile.layouts.construction-project')
@section('content')
    <div class="page-content header-clear-large gallery-page">
        <div class="contruction-page">
        <div class="filter-attribute">
            <form action="{{route('construction.index')}}" method="get" id="filterGallery">
{{--                <input type="hidden" id="category_id" name="category_id" value=" @if(isset($search['category_id'])) {{$search['category_id']}}@endif"/>--}}
                <div class=" select-box select-box-2 bottom-15">
                    <select class="chosen-select" id="province_select" name="province">
                        <option value="0">Khu vực</option>
                        @foreach($province_arr as $province)
                            <option value="{{$province->title}}" @if(isset($search['province'])&& ($province->title==$search['province'])) selected @endif">{{$province->title}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" id="item_id" name="item_id" value=" @if(isset($search['item_id'])) {{$search['item_id']}}@endif"/>
                <div class=" select-box select-box-2 bottom-15">
                    <select class="chosen-select" id="item_select">
                        <option value="0">Hạng mục</option>
                        @foreach($item_arr as $item)
                            <option value="{{$item->id}}" @if(isset($search['item_id']) && $item->id == $search['item_id']) selected @endif>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="construction-list">
                <div class="main-block bg-white">
                   <ul>
                        @foreach ($records as $record)
                            <li class="construction-item">
                                <div class="row">
                                    <div class="col-md-5 col-xs-12">
                                        <a href="{{$record['url']}}">
                                            <img src="{{$record['cover']}}" alt="{{$record['full_name']}}" class="hz-responsive-img">
                                        </a>
                                    </div>
                                    <div class=" col-md-7 col-xs-12 mtbm-10">
                                        <div class="clearfix name-info">
                                            <div class="construction-avatar">
                                                <img itemprop="image" src="{{$record['avatar']}}" width="70" height="70" alt="{{$record['full_name']}}">
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
                                        </div>
                                        <button class="text-bold contact-button" data-toggle="modal" data-target="#mdlContact" type="button"><span class=" btn__label ">Liên hệ</span></button>

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

@stop
