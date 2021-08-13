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
                        <form method="get" action="{{route('video.search')}}">
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
                                            <option value="{!!$category->id!!}" @if (isset($search['category_id']) && $category->id==$search['category_id']) selected @endif>{!!$category->title!!}</option>
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
        <div class="container margin_60_35 video">
            <div class="row">
                @if($records->count() > 0)
                    @foreach ($records as $record)
                        <div class="col-md-3">
                            <div class="item">
                                <a href="{{route('video.detail', ['alias' => $record->alias])}}" class="grid_item small">
                                    <figure>
                                        <img src="{{$record->getImage()}}" alt="{{$record->title}}">
                                        <div class="info">
                                            <h3>{{$record->title}}</h3>
                                        </div>
                                    </figure>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <h4>Không tìm thấy kết quả nào</h4>
                    </div>
                @endif
            </div>
        </div>
    </main>
@stop