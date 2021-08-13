@extends('frontend.layouts.gallery_detail')
@section('content')
<div id="full-view">
    <div class="row">
        <div class="col-lg-8 col-md-12 pdr0">
            <div class="thumb-img">
                <article class="slider-item on-nav">
                    <div class="thumb-slider">
                        <div class="s-slides" style="display:flex; justify-content: center">
                            @foreach($image_arr as $image)
                            <div data-thumb="{{$image}}" class="thumb-galery"> <img src="{{$image}}" alt="{{$record->title}}" data-key="{{$record->id}}" class="gallery-basic taggd__image" > </div>
                            @endforeach
                        </div>
                        <ul class="url-direction-nav">
                            @if($record->prev)
                            <li class="url-nav-prev">
                                <a class="url-prev" data-href='{{$record->prev->url()}}' href="{{$record->prev->url()}}"><i class="fa fa-angle-left"></i></a>
                            </li>
                            @endif
                            @if($record->next)
                            <li class="url-nav-next">
                                <a class="url-next" data-href='{{$record->next->url()}}' href="{{$record->next->url()}}">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </article>
                <div id="container-social">
                    <a id="btnSave" href="{{$record->getImage()}}" download><i class="fa fa-camera margin-right-5"></i>Lưu ảnh</a>
                    <div class="sharethis-inline-share-buttons st-center  st-inline-share-buttons st-animated" id="st-1">
                        <div class="st-btn st-first st-remove-label" data-network="facebook" style="display: inline-block;" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={!! $record->url() !!}', 'Facebook', 'width=600,height=400');">
                            <img src="https://platform-cdn.sharethis.com/img/facebook.svg">
                        </div>
                        <div class="st-btn st-remove-label" data-network="twitter" style="display: inline-block;" onclick="window.open('https://twitter.com/share?text=&url={!! $record->url() !!}', 'Twitter', 'width=600,height=400')">
                            <img src="https://platform-cdn.sharethis.com/img/twitter.svg">
                        </div>
                        <div class="st-btn st-remove-label" data-network="pinterest" style="display: inline-block;" onclick="window.open('http://pinterest.com/pin/create/button/?url={!! $record->url() !!}', 'Pinterest', 'width=600,height=400')">
                            <img src="https://platform-cdn.sharethis.com/img/pinterest.svg">
                        </div><div class="st-btn st-last st-remove-label" data-network="linkedin" style="display: inline-block;" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url={!! $record->url() !!}', 'Linkedin', 'width=600,height=400')">
                            <img src="https://platform-cdn.sharethis.com/img/linkedin.svg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 pdl0" style="height: 100%">
            <div class="info">
                <div class="navigation">
                    <a href="#info" class="active"><i class="fa fa-picture-o"></i></a>
                    <a href="#tags"><i class="fa fa-tags"></i></a>
                    <a href="#comments"><i class="fa fa-comments-o"></i></a>
                    <a href="@if($record->categories()->exists()){{route('gallery.index', ['category_id' => $record->categories()->orderBy('id', 'desc')->first()->id])}} @elseif($record->project) {{route('project.detail',$record->project->alias)}} @else  {{route('gallery.index')}} @endif" class="close-view"><i class=" fa fa-close"></i></a>
                </div>
                <div id="info" class="body-info">
                    <h5>{{$record->title}}</h5>
                </div>
                <!-- end -->
                <div class="body-info">
                    <h5>Nội dung</h5>
                    <div class="product-detail">
                        <!--{$data.project.description}-->
                        {!!$record->content!!}
                        <span class="maskcontent" style="position: absolute; bottom: 0%; height: 2.78em; width: 100%; background: linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.78) 50%, rgb(255, 255, 255));"></span>

                    </div>
                    <a id="read-detail" class="read-more" href="javascript:;">Xem thêm <i class="fa fa-angle-down"></i></a>
                    <a id="collapse-detail" style="display: none;" class="read-more" href="javascript:;">Thu gọn <i class="fa fa-angle-up"></i></a>
                </div>
                <div id="tags" class="body-info">
                    @foreach($attribute_arr as $attribute)
                    <p class="mb-10"><b>{{$attribute['title']}}:</b> {{$attribute['value']}}</p>
                    @endforeach
                    <p class="mb-0"><b>Danh mục:</b> @foreach($record->categories as $category){{$category->title}}, @endforeach ...</p>
                </div>
                @if(count($image_project) > 0)
                <div class="body-info" style="margin-left: -5px;">
                    <h5>Hình ảnh cùng dự án</h5>
                    <div class="row">
                        @foreach($image_project as $val)
                        <div class="product col-md-3 col-sm-6  padding-0">
                            <article style="border:  none;">
                                <a href="{{$val->url()}}"><img class="img-responsive" src="{{$val->getImage()}}" alt="{{$val->title}}" style="height:90px;"/></a>
                                <!--<a href="{{$val->url()}}" class="tittle">{{$val->title}}</a>-->
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if(count($related_arr) > 0)
                <div class="body-info">
                    <h5>Hình ảnh tương tự</h5>
                    <div class="row" style="margin-left: -5px;">
                        @foreach($related_arr as $val)
                        <div class="product related-galleries col-md-3 col-sm-6 padding-0">
                            <article style="border:  none;">
                                <a href="{{$val->url()}}"><img class="img-responsive" src="{{$val->getImage()}}" alt="{{$val->title}}"/></a>
                                <!--<a href="{{$val->url()}}" class="tittle">{{$val->title}}</a>-->
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if(count($related_products) > 0)
                <div class="body-info">
                    <h5>Sản phẩm liên quan</h5>
                    <div class="row" style="margin-left: -5px;">
                        @foreach($related_products as $item)
                        <div class="product col-sm-4 padding-0">
                            <article style="border:  none;">
                                <a href="{{$item->url()}}"><img class="img-responsive" src="{{$item->getImage()}}" alt="{{$item->title}}" /></a>
                                <!--<a href="{{$item->url()}}" class="tittle">{{$item->title}}</a>-->
                                <div class="price">
                                    Giá: {{($item->price == 0)?'Liên hệ':$item->getPrice()}}
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div id="comments" class="body-info">
                    <h5>Bình luận</h5>
                    <div class="fb-comments" style="width: 100%;" data-width="100%" data-href="{{$record->url()}}" data-numposts="5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
@parent
<script>
    $(document).keydown(function(e){
       if (e.keyCode == 37 && $('.url-prev').length){
         window.location.href= $('.url-prev').data('href');
       }
    });
</script>
@stop
