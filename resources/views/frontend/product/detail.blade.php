@extends('frontend.layouts.product_detail')
@section('content')
<div id="full-view">
    <div class="row">
        <div class="col-lg-8 col-md-12 pdr0">
            <div class="demo">
                <div id="image-slide">
                    <div id="gallery_01">
                        @foreach($image_arr as $image)
                            <a href="#" data-image="{!! $image !!}" data-zoom-image="{!! $image !!}">
                                <img src="{!! $image !!}"/>
                            </a>
                        @endforeach
                    </div>
                    <img id="zoom_03" src="{!! $record->getImage() !!}" data-zoom-image="{!! $record->getImage() !!}"/>
                </div>
                @if ($sale_product->count() > 0)
                <div class="body-info" style="padding-bottom: 0px;padding-top:0px; position: absolute; bottom: 0px;width:100%;padding-right: 0px;">
                    <h5 style="text-align: left;">Sản phẩm đang sale cùng loại</h5>
                    <div class="sale-product owl-carousel row" style="margin-left: -5px;">
                        @foreach($sale_product as $key=>$item)
                        <div class="item" style="padding:3px;">
                            <div class="strip grid">
                                <figure>
                                    <a href="{{$item->url()}}"><img src="{{$item->getImage()}}" class="img-fluid" alt="">
                                        <div class="read_more"><span>Xem thêm</span></div>
                                    </a>
                                    @if ($item->sale_price)
                                    <small>SALE</small>
                                    @endif
                                </figure>
                                <div class="wrapper">
                                    <h3 class="product-title"><a class="title-product" href="{{$item->url()}}">{{$item->title}}</a></h3>
                                    <!--<small><i class="fa fa-calendar"></i> {{$record->getPostSchedule()}}</small>-->
                                    <p>Giá: <span class="price">{{$item->getSalePrice()}}</span></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div id="container-social" style="bottom:220px;">
                    <a id="btnSave" type="button" href="{!! $record->getImage() !!}" download=""><i class="fa fa-camera margin-right-5"></i>Lưu ảnh</a>
                    <div class="sharethis-inline-share-buttons st-center  st-inline-share-buttons st-animated" id="st-1">
                        <div class="st-btn st-first st-remove-label" data-network="facebook" style="display: inline-block;" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={!! $url !!}', 'Facebook', 'width=600,height=400');">
                            <img src="https://platform-cdn.sharethis.com/img/facebook.svg">
                        </div>
                        <div class="st-btn st-remove-label" data-network="twitter" style="display: inline-block;" onclick="window.open('https://twitter.com/share?text=&url={!! $url !!}', 'Twitter', 'width=600,height=400')">
                            <img src="https://platform-cdn.sharethis.com/img/twitter.svg">
                        </div>
                        <div class="st-btn st-remove-label" data-network="pinterest" style="display: inline-block;" onclick="window.open('http://pinterest.com/pin/create/button/?url={!! $url !!}', 'Pinterest', 'width=600,height=400')">
                            <img src="https://platform-cdn.sharethis.com/img/pinterest.svg">
                        </div><div class="st-btn st-last st-remove-label" data-network="linkedin" style="display: inline-block;" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url={!! $url !!}', 'Linkedin', 'width=600,height=400')">
                            <img src="https://platform-cdn.sharethis.com/img/linkedin.svg">
                        </div>
                    </div>
                </div>
                @else
                <div id="container-social">
                    <a id="btnSave" type="button" href="{!! $record->getImage() !!}" download=""><i class="fa fa-camera margin-right-5"></i>Lưu ảnh</a>
                    <div class="sharethis-inline-share-buttons st-center  st-inline-share-buttons st-animated" id="st-1">
                        <div class="st-btn st-first st-remove-label" data-network="facebook" style="display: inline-block;" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={!! $url !!}', 'Facebook', 'width=600,height=400');">
                            <img src="https://platform-cdn.sharethis.com/img/facebook.svg">
                        </div>
                        <div class="st-btn st-remove-label" data-network="twitter" style="display: inline-block;" onclick="window.open('https://twitter.com/share?text=&url={!! $url !!}', 'Twitter', 'width=600,height=400')">
                            <img src="https://platform-cdn.sharethis.com/img/twitter.svg">
                        </div>
                        <div class="st-btn st-remove-label" data-network="pinterest" style="display: inline-block;" onclick="window.open('http://pinterest.com/pin/create/button/?url={!! $url !!}', 'Pinterest', 'width=600,height=400')">
                            <img src="https://platform-cdn.sharethis.com/img/pinterest.svg">
                        </div><div class="st-btn st-last st-remove-label" data-network="linkedin" style="display: inline-block;" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url={!! $url !!}', 'Linkedin', 'width=600,height=400')">
                            <img src="https://platform-cdn.sharethis.com/img/linkedin.svg">
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-4 col-md-12 pdl0" style="height: 100%">
            <div class="info">
                <div class="navigation">
                    <a href="#info" class="active"><i class="fa fa-picture-o"></i></a>
                    <a href="#tags"><i class="fa fa-tags"></i></a>
                    <a href="#comments"><i class="fa fa-comments-o"></i></a>
                    <a class="close-view" href="@if($record->categories()->exists()){{route('product.index', ['category_id' => $category_id])}} @else {{route('product.index')}} @endif"><i class="fa fa-times"></i></a>
                </div>
                <div id="info" class="body-info">
                    <div class="row">
                        @if(!is_null(\Auth::guard('marketing')->user()))
                        <div class="col-md-6">
                            <h6>{!! $record->title !!}</h6>
                            <p>Trạng thái: <span class="in-stock">{!! ($record->status)==1?'Còn hàng':'Hết hàng' !!}</span></p>
                            <p class="price">Giá: {!! ($record->price)==0?'Liên hệ': $record->getPrice()!!} </p>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <a>Link tiếp thị: {{url()->current()}}/?ref={{\Auth::guard('marketing')->user()->ref}}</a>
                            </div>
                        </div>
                        @else
                        <div class="col-md-12">
                            <h6>{!! $record->title !!}</h6>
                            <p>Trạng thái: <span class="in-stock">{!! ($record->status)==1?'Còn hàng':'Hết hàng' !!}</span></p>
                            <p class="price">
                            @if($record->sale_price >0)
                                Giá: {{$record->getSalePrice()}}
                                <del>{{$record->getPrice()}}</del>
                            @elseif($record->price > 0)
                                Giá: {{$record->getPrice()}}
                            @else
                                Giá: Liên hệ
                            @endif
                            </p>
                            {{--<p class="price">Giá: {!! ($record->price)==0?'Liên hệ': $record->getPrice()!!} </p>--}}
                        </div>
                        @endif
                    </div>
                </div>
                <div style="display: inline-flex; width: 100%;" class="body-info flex">
                    <div class="inline-dropdown-container col-xs-5">
                        <div class="dropdown-wrapper-2" style="width: 100%;">
                            <span class="dropdown-icon"></span>
                            <select id="quantity" class="form-control" style="width: 100%; height: 100%;">
                                <option value="1">Số lượng: 1</option><option value="2">Số lượng: 2</option>
                                <option value="3">Số lượng: 3</option><option value="4">Số lượng: 4</option>
                                <option value="5">Số lượng: 5</option><option value="6">Số lượng: 6</option>
                                <option value="7">Số lượng: 7</option><option value="8">Số lượng: 8</option>
                                <option value="9">Số lượng: 9</option><option value="10">10+</option>
                            </select>
                        </div>
                    </div>
                    <a class="btn btn-addtocart col-xs-7 hidden-xs" href="javascript:void(0);" data-action="add-to-cart" data-product_id="{{$record->id}}"><i class="fa fa-cart-plus" aria-hidden="true"></i>Thêm giỏ hàng</a>
                </div>
                <div class="body-info">
                    <h6>Có câu hỏi về sản phẩm này?</h6>
                    <p>Hãy gọi chúng tôi vào giờ hành chính của các ngày trong tuần</p>
                    <a class="phone" href="tel:0868 505 707"><i class="flaticon-operator margin-right-10"></i>0868 505 707</a>
                </div>
                <div class="body-info">
                    <h5>Chi tiết sản phẩm</h5>
                    <div class="product-detail">
                        {!! $record->content !!}
                    </div>
                    <a id="read-detail" class="read-more" href="javascript:;">Đọc thêm <i class="fa fa-angle-down"></i></a>
                    <a id="collapse-detail" style="display: none;" class="read-more" href="javascript:;">Rút gọn <i class="fa fa-angle-up"></i></a>
                </div>
                <div id="tags" class="body-info">
                    <table class="table-borders-dark store-product-table">
                        @foreach ($attribute_arr as $attribute)
                        <tr>
                            <td class="bold color-black">{!! $attribute['title'] !!}</td>
                            <td> {!! $attribute['value'] !!}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="body-info">
                    <h5>Sản phẩm tương tự</h5>
                    <div class="row" style="margin-left: -5px;">
                        @foreach($related_product as $item)
                        <div class="product col-sm-4 padding-0">
                            <article style="border:  none;">
                                <a href="{{$item->url()}}"><img src="{{$item->getImage()}}" alt="{{$item->title}}" /></a>
                                <!--<a href="{{$item->url()}}" class="tittle">{{$item->title}}</a>-->
                                <div class="price">
                                    @if($item->sale_price >0)
                                        {{$item->getSalePrice()}}
                                        <del class="litle_price">{{$item->getPrice()}}</del>
                                    @elseif($item->price > 0)
                                        {{$item->getPrice()}}
                                    @else
                                        Liên hệ
                                    @endif
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="body-info">
                    <h5>Hình ảnh liên quan</h5>
                    <div class="row" style="margin-left: -5px;">
                        @foreach($gallery as $image)
                        <div class="product col-sm-4 padding-0">

                            <article style="border:  none;">
                                <a href="{{route('gallery.detail', ['alias' => $image->alias])}}"><img class="img-responsive" src="{{$image->images}}" alt="{{$record->title}}" /></a>
                                <!--<h6 class="mt-15">{{$image->title}}</h6>-->
                            </article>

                        </div>
                        @endforeach
                    </div>

                </div>
                <div class="body-info">
                    <h5>Sản phẩm đã xem</h5>
                    <div class="row" style="margin-left: -5px;">
                        @foreach($viewed_products as $item)
                        <div class="product col-sm-4 padding-0">
                            <article style="border:  none;">
                                <a href="{{$item->url()}}"><img class="img-responsive" src="{{$item->getImage()}}" alt="{{$item->title}}" /></a>
                                <a href="{{$item->url()}}" class="tittle">{{$item->title}}</a>
                                <div class="price">
                                    @if($item->sale_price >0)
                                        {{$item->getSalePrice()}}
                                        <del class="litle_price">{{$item->getPrice()}}</del>
                                    @elseif($item->price > 0)
                                        {{$item->getPrice()}}
                                    @else
                                        Liên hệ
                                    @endif
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div id="comments" class="body-info">
                    <h5>Bình luận</h5>
                    <div class="fb-comments"  data-width="100%" data-href="{{$url}}" data-numposts="5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
@parent
<script>
    //    image zoom
    $('#zoom_03').ezPlus({
        gallery: 'gallery_01', cursor: 'pointer', galleryActiveClass: 'active',
        imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif',
        zoomWindowHeight: 600,
        zoomWindowWidth: 600,
    });

    //pass the images to Fancybox
    $('#zoom_03').bind('click', function (e) {
        var ez = $('#zoom_03').data('ezPlus');
        $.fancyboxPlus(ez.getGalleryList());
        return false;
    });
    if($('.product-detail').find('.row').length){
        $('.product-detail').find('.row').removeClass('row');
    }
</script>
@stop
