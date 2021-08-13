@extends('mobile.layouts.home')
@section('content')
<div id="notification-success" class="notification-fixed bg-green-dark">
    <div class="notification-icon">
        <em><i class="fa fa-bell"></i></em>
        <span>Thông báo</span>
        <a href="#"><i class="fa fa-times-circle"></i></a>
    </div>
    <p id="notification">Đơn hàng được gửi thành công</p>
</div>
<div id="notification-error" class="notification-fixed bg-red-dark">
    <div class="notification-icon">
        <em><i class="fa fa-bell"></i></em>
        <span>Thông báo</span>
        <a href="#"><i class="fa fa-times-circle"></i></a>
    </div>
    <p id="notification-err">Đơn hàng gửi thất bại</p>
</div>
<div class="page-content page-cart header-clear-medium" style="transition: all 300ms ease 0s;">
    <div class="content-title bottom-0 top-30">
        <h2 style="margin-bottom: 20px;padding-bottom: 10px;border-bottom: 1px solid #908e8ec7;">Thông tin khách hàng</h2>
    </div>
    <div class="content">
        <form method='POST' action="{!!route('product.checkout-sucess')!!}" >
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <div class="container">
                <div class="input-simple-1 has-icon input-green bottom-30">
                    <em class="color-highlight">Họ tên</em>
                    <i class="fa fa-user color-highlight"></i>
                    <input type="text" name="contact" required id="full_name"  placeholder=""/>
                </div>
                <div class="clear"></div>
                <div class="input-simple-1 has-icon input-green bottom-30">
                    <em class="color-highlight">Số điện thoại</em>
                    <i class="fa fa-phone color-highlight"></i>
                    <input type="text" name="mobile" required id="mobile" />
                </div>
                <div class="input-simple-1 has-icon input-green bottom-30">
                    <em class="color-highlight">Email</em>
                    <i class="fa fa-credit-card color-highlight"></i>
                    <input type="text" name="email" required id="email" />
                </div>
                <div class="select-box select-box-1">
                    <em class="color-highlight">Phương thức thanh toán</em>
                    <select name="payment_method" id="payment_method">
                        <option value="Chuyển khoản (Chuyển khoản 50% và nhận hàng thanh toán 50% còn lại)">Chuyển khoản (Chuyển khoản 50% và nhận hàng thanh toán 50% còn lại)</option>
                        <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                    </select>
                </div>
                <div class="select-box select-box-1">
                    <em class="color-highlight">Phương thức vận chuyển</em>
                    <select name="transport_method" id="transport_method">
                        <option value="Viettelpost">Viettelpost</option>
                        <option value="Giao hàng nhanh">Giao hàng nhanh</option>
                        <option value="Giao hàng tiết kiệm">Giao hàng tiết kiệm</option>
                    </select>
                </div>
                <div class="input-simple-1 has-icon input-green bottom-30">
                    <em class="color-highlight">Địa chỉ</em>
                    <i class="fa fa-globe color-highlight"></i>
                    <input type="text" required name="address" id="address"/>
                </div>
                <div class="input-simple-1 input-green bottom-30">
                    <em class="color-highlight">Ghi chú</em>
                    <input type="text" placeholder="" name="note" id="note"/>
                </div>
                <strong class="font-16 ultrabold">Tổng tiền: </strong>
                <span class="font-16 ultrabold bottom-0">{{number_format($total)}} Đ</span>
            </div>
            <a href="{!!route('product.index')!!}" class="button button-green bg-highlight button-full button-rounded button-sm uppercase ultrabold shadow-small">Tiếp tục mua sắm</a>
            <button type="submit" class="button button-green bg-highlight button-full button-rounded button-sm uppercase ultrabold shadow-small">Đặt hàng</button>
        </form>
    </div>
</div>
@stop