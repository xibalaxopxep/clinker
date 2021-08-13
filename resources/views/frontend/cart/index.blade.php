@extends('frontend.layouts.master')
@section('content')
<div id="mm-0" class="mm-page mm-slideout"><div id="page">
        <div class="sub_header_in sticky_header">
            <div class="container">
                <h1>Giỏ hàng</h1>
            </div>
            <!-- /container -->
        </div>
        <main>
            <div class="container margin_60_35">
                <div class="box_booking">
                    @if(session('cart'))
                    @foreach(session('cart') as $key=>$val)
                    <div class="strip_booking" id='product_{{$key}}'>
                        <div class="row mb-10">
                            <div class="col-lg-2 col-md-2 ">
                                <h3 class="text-bold">Hình ảnh</h3>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h3 class="text-bold">Tên sản phẩm</h3>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <h3 class="text-bold">Giá</h3>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <h3 class="text-bold">Số lượng</h3>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <h3 class="text-bold">Thao tác</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2">
                                <div class="date">
                                    <img src="{{$val['image']}}" alt="{{$val['title']}}" class="cart-image"/>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h3>{{$val['title']}}</h3>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                @if ($val['price'] > 0){{number_format($val['price'])}} đ @else Liên hệ @endif
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <input class='quantity form-control' data-product_id='{{$key}}' type='number' value='{{$val['quantity']}}'/>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="booking_buttons">
                                    <a href="javascript:void(0)" class="btn_2 delete" data-product_id='{{$key}}'>Xóa</a>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    @endforeach
                    <!-- /strip booking -->
                    @endif
                    @if(session('cart'))
                    <h6>Tổng tiền:  <span id="total">@if ($total > 0){{number_format($total)}} đ @else Liên hệ @endif</span></h6>
                    @else
                    <h6>Bạn chưa chọn mua sản phẩm nào</h6>
                    @endif
                    <!-- /strip booking -->
                </div>
                <!-- /box_booking -->
                @if(session('cart'))
                <p class="text-right"><a href="/checkout" class="btn_1">Thanh toán</a></p>
                @endif
            </div>
        </main>
    </div>
    <div id="toTop"></div></div>

@stop

