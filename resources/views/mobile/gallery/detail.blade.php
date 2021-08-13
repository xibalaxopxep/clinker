@extends('mobile.layouts.gallery')
@section('content')
    <div id="page-transitions" class="page-build light-skin highlight-blue">
        <div class="page-content page-content-full">
            <div class="coverpage thumb-img">
                <a href="@if($record->project_id > 0) {{$record->project->url()}}" @else {{route('gallery.index')}}" @endif class="cover-back-button back-button"><i class="fa fa-chevron-left font-18 color-white"></i> Back</a>
                <a href="{!! route('home.index') !!}" class="cover-back-button cover-home-button"><i class="fa fa-home font-18 color-white"></i></a>

                <div class="cover-item">
                    <img id="image" src="{{$record->getImage()}}" class="gallery-basic taggd__image" data-key="{{$record->id}}" >
                    @if($record->next)
                    <div class="image-back">
                        <a class="url-prev" href="{{$record->next->url()}}"><i class="fa fa-angle-left"></i></a>
                    </div>
                    @endif
                    @if($record->prev)
                    <div class="image-next">
                        <a class="url-next" href="{{$record->prev->url()}}">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    @endif
                    <div class="cover-content cover-content-bottom">
                        <a href="#" ><i style="font-size: 25px" class="show fa fa-angle-up" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="image-info">
        <div class="image-info-container">
            <div class="image-info-heading">
                <a href="javascript:void(0)" class="image-info-close"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
            <div class="image-info-content">
                <div class="single-slider owl-carousel owl-has-dots gallery bottom-20">
                    @foreach($image_arr as $image)
                        <a class="show-gallery" href="{{$image}}"><img src="{{$image}}" alt="{{$record->title}}" style="object-fit: contain;"></a>
                    @endforeach
                </div>
                <div class="content">
                    <div class="store-product">
                        <h2 class="image-title">{{$record->title}}</h2>
                    </div>
                    <div class="decoration top-20 bottom-20"></div>
                </div>
                <div class="content bottom-20 top-30">
                    <h2>Mô tả chi tiết</h2>
                </div>
                <div class="content">
                    <div class="product-content">
                        {!! $record->content !!}
                    </div>
                    <a href="#" class="read-more-show top-15 color-alagreen">Đọc thêm <i class="fa fa-caret-down"></i></a>
                    <a href="#" class="read-less-show top-15 color-alagreen" style="display:none">Rút gọn <i class="fa fa-caret-up"></i></a>
                    <div class="decoration"></div>
                </div>
                <div class="content bottom-20 top-30">
                    <h2>Thông số kĩ thuật</h2>
                </div>
                <div class="content">
                    <table class="table-borders-dark store-product-table">
                        @foreach ($attribute_arr as $attribute)
                            <tr>
                                <td class="bold color-black">{!! $attribute['title'] !!}</td>
                                <td> {!! $attribute['value'] !!}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="bold color-black">Danh mục:</td>
                            <td>@foreach($record->categories as $category){{$category->title}}, @endforeach ...</td>
                        </tr>

                    </table>
                    <div class="decoration"></div>
                </div>
                <div class="content-title bottom-20 top-20">
                    <h1>Hình ảnh tương tự</h1>
                </div>
                <div class="slider-margins bottom-70">
                    <div class="double-slider owl-carousel owl-no-dots">
                        @foreach($related_arr as $val)
                            <div class="item bottom-10 shadow-small">
                                <div class="above-overlay above-overlay-bottom bottom-10">
                                    <a href="{{$val->url()}}"><h5 class="color-white">{{$val->title}}</h5></a>
                                </div>
                                <div class="overlay overlay-gradient"></div>
                                <a href="{{$val->url()}}"><img src="{{$val->getImage()}}" alt="{{$val->title}}"></a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="image-info-overlay"></div>

    <!--<div class="page-content header-clear-large">
        <div class="thumb-img">
            <article class="slider-item on-nav">
                <div class="gallery-title">
                    <h4 class="bolder center-text">Biệt thự 3 tầng tân cổ điển đẹp</h4>
                </div>
                <div class="thumb-slider">
                    <div class="s-slides">
                        @foreach($image_arr as $image)
                            <div data-thumb="{{$image}}"> <img src="{{$image}}" alt="{{$record->title}}" data-key="{{$record->id}}" class="gallery-basic taggd__image" > </div>
                        @endforeach
                    </div>
                    <ul class="url-direction-nav">
                        @if($record->prev)
                            <li class="url-nav-prev">
                                <a class="url-prev" href="{{$record->prev->url()}}"><i class="fa fa-angle-left"></i></a>
                            </li>
                        @endif
                        @if($record->next)
                            <li class="url-nav-next">
                                <a class="url-next" href="{{$record->next->url()}}">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

            </article>
        </div>

    </div>-->
@stop
@section('script')
@parent
<script type="text/javascript" src="{!!asset('assets/mobile/js/swipe.js')!!}"></script>
<script>
    
        $(document).on('swiperight', '#image', function(event){
            if($('.url-prev').length){
                window.location.href= $('.url-prev').attr('href');
            }
        });
       document.addEventListener('swiped-left', function(e) {
        if($('.url-next').length){
            window.location.href= $('.url-next').attr('href');
        }
       });
</script>
@stop