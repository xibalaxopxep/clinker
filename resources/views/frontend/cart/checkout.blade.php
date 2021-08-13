@extends('frontend.layouts.master')
@section('content')
<div id="mm-0" class="mm-page mm-slideout"><div id="page">
        <div class="sub_header_in sticky_header">
            <div class="container">
                <h1>Thanh toán</h1>
            </div>
        </div>
        <main>
            <div class="container margin_60">
                <form method='POST' action="{!!route('product.checkout-sucess')!!}" name="form" onsubmit="return validate_select()">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="step first">
                                <h3>1. Thông tin khách hàng</h3>

                                <div class="tab-content checkout">
                                    <div class="tab-pane fade active show" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                                        <div class="form-group input-name">
                                            <input type="text" name="contact" class="form-control" placeholder="Họ tên" >
                                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group input-mobile">
                                            <input type="number" name="mobile" class="form-control" placeholder="Số điện thoại" >
                                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                        </div> 
                                        <div class="form-group input-email">
                                            <input type="email" name="email" class="form-control" placeholder="Email" >
                                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                        </div> 
                                        <!-- /row -->
                                        <div class="row no-gutters">
                                            <div class="col-md-12 form-group">
                                                <div class="custom-select-form select_payment">
                                                    <select class="wide add_bottom_15" name="payment_method" id="country" style="display: none;" >
                                                        <option value="0" selected="">Phương thức thanh toán</option>
                                                        <option value="Chuyển khoản (Chuyển khoản 50% và nhận hàng thanh toán 50% còn lại)">Chuyển khoản </option>
                                                        <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                                                    </select>
                                                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col-md-12 form-group">
                                                <div class="custom-select-form select_transport">
                                                    <select class="wide add_bottom_15" name="transport_method" id="country" style="display: none;" >
                                                        <option value="0" selected="">Phương thức vận chuyển</option>
                                                        <option value="Viettelpost">Viettelpost</option>
                                                        <option value="Giao hàng nhanh">Giao hàng nhanh</option>
                                                        <option value="Giao hàng tiết kiệm">Giao hàng tiết kiệm</option>
                                                    </select>
                                                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                        <div class="form-group input-address">
                                            <input type="text" class="form-control" name='address' placeholder="Địa chỉ" >
                                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /step -->
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="step last">
                                <h3>2. Thông tin đơn hàng</h3>
                                <div class="box_general summary">
                                    <ul>
                                        @foreach(session('cart') as $key=>$val)
                                        <li>{{$val['title']}} <span class="float-right">Số lượng: {{$val['quantity']}} </span></li>
                                        @endforeach
                                        <li>Tổng tiền <span class="float-right">{{number_format($total)}} đ</span></li>
                                    </ul>
                                    <textarea class="form-control add_bottom_15" name='note' placeholder="Ghi chú.." style="height: 100px;"></textarea>

                                    <button type='submit' class="btn_1 full-width cart" id="btn-submit"  name="btn-submit">Xác nhận đơn hàng</button>
                                </div>
                                <!-- /box_general -->
                            </div>
                            <!-- /step -->
                        </div>
                    </div>
                </form>
                <!-- /row -->
            </div>
            <!-- /container -->
        </main>
        <!--/main-->
        <!--/footer-->
    </div>
    <div id="toTop" style="display: none;"></div></div>
@stop
