@extends('frontend.layouts.master')
@section('content')
<main>
    <div id="results">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-10">
                    <h4><strong>{{$current_category->title}}</strong></h4>
                </div>
                <div class="col-lg-9 col-md-8 col-2">
                    <a href="#0" class="side_panel btn_search_mobile"></a> <!-- /open search panel -->
                    <form method="get" action="{{route('product.index')}}">
                        <div class="row no-gutters custom-search-input-2 inner nomargin">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" autocomplete="off" id="autoComplete" type="text" name="keyword" value="{{isset($search['keyword'])?$search['keyword']:''}}" placeholder="Nhập từ khóa tìm kiếm">
                                    <i class="icon_search"></i>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <select class="wide" id="category_id" name="category_id">
                                    <option value="0">Tất cả</option>
                                    @foreach ($category_arr as $category)
                                    <option value="{!!$category->id!!}" >{!!$category->title!!}</option>
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


    <div class="container list-product">
        <form action="@if(isset($sale)){{route('product.sale')}} @else {{route('product.index')}} @endif" method="get">
            <div id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">Trang chủ</a>
                    </li>
                    @foreach ($parent_arr as $key => $category)
                        @if($key < count($parent_arr) - 1)
                            <li class="breadcrumb-item"><a href="{{$category['url']}}">{{ $category['title'] }}</a></li>
                        @else
                            <li class="breadcrumb-item current">{{ $category['title'] }}</li>
                        @endif
                    @endforeach

                </ol>
                <div class="count_display">
                    <div class="text-count">Hiển thị:</div>
{{--                    <form id="count_product" method="get" action="{{route('product.index')}}">--}}
                        <input type="hidden" name="count_product" class="count_product">
                        <select id="number-select">
                            @for($i=10; $i<=100; $i=$i+10)
                                <option value="{{$i}}" @if(isset($search['count_product']) && $search['count_product']==$i) selected @elseif(!isset($search['count_product']) && $i==80) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
{{--                    </form>--}}
                </div>
            </div>

            <div class="row">
            <aside class="col-lg-3" id="sidebar">
                <div id="filters_col">
{{--                    <form action="{{route('product.index')}}" method="get">--}}
                        <input type="hidden" class="category_id" name="category_id" value="{{isset($search['category_id'])?$search['category_id']:\App\Category::PRODUCT_SHOP_ID}}"/>
                        <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Lọc dữ liệu </a>
                        <div class="collapse show" id="collapseFilters">
                            <div class="filter_type">
                                <h6><b>{{$current_category->title}}</b></h6>
                                @if($current_category->children)
                                <ul>
                                    @foreach($current_category->children as $children)
                                    <li>
                                        <label class="container_check"><a href="@if(isset($sale)) {{route('product.sale', ['category_id' => $children->id])}} @else {{route('product.index', ['category_id' => $children->id])}} @endif">{{$children->title}} <small>@if(isset($sale)) {{$children->products->where('sale_price','>',0)->count()}} @else {{$children->products->count()}} @endif</small></a>

                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                                @else

                                @endif
                            </div>
                            <input type="hidden" class="attribute_id" name="attribute_id" value=" @if(isset($search['attribute_id'])) {{$search['attribute_id']}} @endif">
                            <div class="@if(isset($sale)) all-sale-product @else all-attributes @endif">
                            </div>
                        </div>
                        <!--/collapse -->
{{--                    </form>--}}
                </div>
                <!--/filters col-->
            </aside>
            <!-- /aside -->

            <div class="col-lg-9">
                <div class="row">
                    @if($records->count() > 0)
                    @foreach ($records as $record)
                    <div class="col-md-4">
                        <div class="strip grid">
                            <figure>
                                <a href="{{$record->url()}}"><img src="{{$record->getImage()}}" class="img-fluid" alt="">
                                    <div class="read_more"><span>Xem thêm</span></div>
                                </a>
                                @if ($record->sale_price)
                                <small>SALE</small>
                                @endif
                            </figure>
                            <div class="wrapper">
                                <h3 class="product-title"><a href="{{$record->url()}}">{{$record->title}}</a></h3>
                                <!--<small><i class="fa fa-calendar"></i> {{$record->getPostSchedule()}}</small>-->
                                @if ($record->sale_price)
                                <p>Giá: <span class="price">{{$record->getSalePrice()}}</span> <span class="original-price">{{$record->getPrice()}}</span></p>
                                @else
                                <p>Giá: <span class="price">{{$record->getPrice()}}</span> </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-md-12">
                        <h4>Không tìm thấy kết quả nào</h4>
                    </div>
                    @endif
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-md-10">
                        {!!$records->appends($search)->links()!!}
                    </div>
                    
                </div>
            </div>
            <!-- /col -->
        </div>
        </form>
    </div>
    <!-- /container -->

</main>
<!--/main-->
@stop
