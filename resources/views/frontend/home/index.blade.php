@extends('frontend.layouts.master')
@section('content')
<main class="pattern">
    <section class="hero_single version_2">
        <div class="wrapper">
            <div class="container">
                <h3>TÌM KIẾM SẢN PHẨM ALAGREEN</h3>
                <p>Hàng ngàn sản phẩm nội thất chất lượng, giá cả phải chăng chỉ có ở Alagreen</p>
                <form method="get" action="{{route('product.index')}}">
                    <div class="row no-gutters custom-search-input-2">
                        <div class="col-lg-5 col-sm-5 offset-1">
                            <div class="form-group">
                                <input class="form-control" id="autoComplete" autocomplete="off" type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
                                <i class="icon_search"></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <select class="wide" id="category_id" name="category_id">
                                <option value="0">Tất cả</option>	
                                @foreach ($category_arr as $category)
                                <option value="{!!$category->id!!}">{!!$category->title!!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <input type="submit" value="Tìm kiếm">
                        </div>
                    </div>
                    <p class="f-14 mt-15">Gần đây: 
                        @foreach ($keyword_arr as $value)
                        <a href="{{route('product.index', ['keyword' => $value->keyword])}}" class="product-keyword">{{$value->keyword}},</a>
                        @endforeach ...
                    </p>
                    <!-- /row -->
                </form>
            </div>
        </div>
    </section>
    <!-- /hero_single -->
    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <a href="{{$template['about1']['link']}}" class="box_cat_home">
                        <img src="{{$template['about1']['image_src']}}" width="65" height="65" alt="">
                        <h3>{{$template['about1']['title']}}</h3>
                        <p>{{$template['about1']['description']}}</p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="{{$template['about2']['link']}}" class="box_cat_home">
                        <img src="{{$template['about2']['image_src']}}" width="65" height="65" alt="">
                        <h3>{{$template['about2']['title']}}</h3>
                        <p>{{$template['about2']['description']}} </p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="{{$template['about3']['link']}}" class="box_cat_home">
                        <img src="{{$template['about3']['image_src']}}" width="65" height="65" alt="">
                        <h3>{{$template['about3']['title']}}</h3>
                        <p>{{$template['about3']['description']}} </p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="{{$template['about4']['link']}}" class="box_cat_home">
                        <img src="{{$template['about4']['image_src']}}" width="65" height="65" alt="">
                        <h3>{{$template['about4']['title']}}</h3>
                        <p>{{$template['about4']['description']}} </p>
                    </a>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->	
    </div>
    <!-- /bg_color_1 -->


    <div class="container margin_60_35">
        <div class="main_title_3">
            <span></span>
            <h2 class="category-title">Danh mục sản phẩm</h2>
            <p>Hàng ngàn sản phẩm chất lượng được cập nhật xu hướng liên tục</p>
            <a href="{{route('product.index')}}">Xem tất cả</a>
        </div>
        <div class="row add_bottom_30">
            @foreach ($category_arr as $category)
            <div class="col-lg-3 col-sm-6">
                <a href="{{route('product.index', ['category_id' => $category->id])}}" class="grid_item small">
                    <figure>
                        <img src="{{$category->image}}" alt="{{$category->title}}">
                        <div class="info">
                            <h3>{{$category->title}}</h3>
                        </div>
                    </figure>
                </a>
            </div>
            @endforeach
        </div>
        <!-- /row -->

    </div>
    <!-- /container -->
    <div class="container margin_60_35">
        <div class="main_title_3">
            <span></span>
            <h2 class="category-title">Nhà thầu thi công nổi bật</h2>
            <p>Nhà thầu thi công uy tín chất lượng của alagreen sẽ giúp bạn thiêt kế một ngôi nhà tuyệt vời</p>
            <a href="{!! route('construction.index') !!}">Xem tất cả</a>
        </div>
        <div class="row add_bottom_30">
            @foreach ($construction_arr as $construction)
            <div class="col-lg-3 col-sm-6">
                <a href="{{$construction->url()}}" class="grid_item small">
                    <figure>
                        <img src="{{$construction->avatar}}" alt="{{$construction->full_name}}">
                        <div class="info">
                            <div class="cat_star">
                                @for($i = 0; $i < 5; $i++) 
                                @if ($i < $construction->star())
                                <i class="icon_star"></i>
                                @else
                                <i class="icon_star_alt"></i>
                                @endif
                                @endfor
                            </div>
                            <h3>{{$construction->full_name}}</h3>
                        </div>
                    </figure>
                </a>
            </div>
            @endforeach
        </div>
        <!-- /row -->

    </div>
    <!-- /container -->
    <div class="call_section">
        <img src="{{$template['home_banner']['image_src']}}" width="100%" alt="Quảng cáo trang chủ">
        <!-- /wrapper -->
    </div>
    <!--/call_section-->


    <div class="container margin_60_35">
        <div class="main_title_3">
            <span></span>
            <h2 class="category-title">Album ảnh</h2>
            <p>Xem hình ảnh các nhà thầu thi công để lấy ý tưởng cho ngôi nhà của bạn</p>
        </div>
        <div class="row add_bottom_30 recent-post">
            
        </div>
        <!-- /row -->

    </div>
    <!-- /container -->
</main>
<!-- /main -->

@stop

