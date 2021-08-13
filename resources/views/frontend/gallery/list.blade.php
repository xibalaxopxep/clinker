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
                    <form method="get" action="{{route('gallery.index')}}">
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



    <div class="container  list-gallery">
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
        <div class="row">
            <aside class="col-lg-3" id="sidebar">
                <div id="filters_col" class="galery-filter">
                    <form action="{{route('gallery.index')}}" method="get">
                        <input type="hidden" name="category_id" value="{{isset($search['category_id'])?$search['category_id']:\App\Category::GALLERY_ALBUM}}"/>
                        <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Lọc dữ liệu </a>
                        <div class="collapse show" id="collapseFilters">
                            <div class="filter_type">
                                <h6><b>{{$current_category->title}}</b></h6>
                                @if($current_category->children)
                                <ul>
                                    @foreach($current_category->children as $children)
                                    <li>
                                        <label class="container_check"><a href="{{route('gallery.index', ['category_id' => $children->id])}}">{{$children->title}} <small>{{$children->galleries->count()}}</small></a></label>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            <input type="hidden" class="attribute_id" name="attribute_id" value=" @if(isset($search['attribute_id'])) {{$search['attribute_id']}} @endif">

                            @foreach($attribute_arr as $attribute)
                            <div class="filter_type">
                                <h6>{{$attribute->title}}</h6>
                                <ul class="list-attribute">
                                    @foreach($attribute->children as $children)
                                    @if ($children->galleries->count() > 0)
                                    <li>
                                        <label class="container_check">{{$children->title}}<small>{{$children->galleries()->whereIn('id', $gallery_ids)->count()}}</small>
                                            <input type="checkbox" class="attribute_select" value="{{$children->id}}" @if(isset($search['attribute_id']) && in_array($children->id, $search['attribute_arr']))checked @endif>
                                                   <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                        <!--/collapse -->
                    </form>
                </div>
                <!--/filters col-->
            </aside>
            <!-- /aside -->

            <div class="col-lg-9">
                <div class="row">
                    @if($records->count() > 0)
                    @foreach ($records as $record)
                    <div class="col-md-4">
                        <article class="blog">
                            <figure>
                                <a href="{{$record->url()}}"><img src="{{$record->getImage()}}" alt="{{$record->title}}">
                                    <div class="preview"><span>Xem thêm</span></div>
                                </a>
                            </figure>
                            <div class="post_info">
                                <h3><a href="{{$record->url()}}">{{$record->title}}</a></h3>
                                <ul>
                                    <li>
                                        <div class="thumb"><img src="{{$record->avatar}}" alt="{{$record->full_name}}"></div>{{$record->full_name}}
                                    </li>
                                    <li><i class="ti-eye"></i>{{$record->view_count}}</li>
                                </ul>
                            </div>
                        </article>
                    </div>
                    @endforeach
                    @else
                    <div class="col-md-12">
                        <h4>Không tìm thấy kết quả nào</h4>
                    </div>
                    @endif
                </div>
                <!-- /row -->
                {!!$records->appends($search)->links()!!}
            </div>
            <!-- /col -->
        </div>
    </div>
    <!-- /container -->

</main>
<!--/main-->
@stop
