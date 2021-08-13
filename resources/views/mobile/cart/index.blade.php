@extends('mobile.layouts.home')
@section('content')
    <div class="page-content page-cart header-clear-medium" style="transition: all 300ms ease 0s;">
    <form method="post" id="frmCart">
        <div class="content-title bottom-0 top-30">
             <h2 style="margin-bottom: 20px;padding-bottom: 10px;border-bottom: 1px solid #908e8ec7;">Giỏ hàng</h2>
        </div>
        <div class="content">
            @if(session('cart'))
            @foreach(session('cart') as $key=>$val)
           <div class="store-cart-1" id="product{{$key}}">
              <img class="preload-image" src="{{$val['image']}}" data-src="{{$val['image']}}" alt="img">
              <strong>{{$val['title']}}</strong>
              <!--{if $cart_arr[sec].sale_price gt 0}<span class="color-green-dark"><del class="color-gray-dark">{$cart_arr[sec].price}</del> {$cart_arr[sec].sale_price / $cart_arr[sec].sale_price} Giảm giá</span>{/if}-->
              <em class="price123" data-price="{{$val['price']}}"> @if ($val['price'] > 0){{number_format($val['price'] * $val['quantity'])}} đ @else Liên hệ @endif</em>
              <div class="store-cart-qty">
                 <a href="javascript:void(0);" class="btn-number" data-type="min" ><i class="fa fa-minus"></i></a>
                 <input type="text" class="qty" data-product_id="{{$key}}" value="{{$val['quantity']}}"/>
                 <a href="javascript:void(0);" class="btn-number" data-type="max" ><i class="fa fa-plus"></i></a>
              </div>
              <a href="javascript:void(0);" data-action="remove-cart-item" data-product_id="{{$key}}" class="store-cart-1-remove color-orange-dark ">Xóa </a>
           </div>
           <div class="decoration top-30"></div>
           @endforeach
            @endif
            @if(session('cart'))
               <div class="content-fullscreen bottom-0">
                  <div class="store-cart-total half-top bottom-20">
                     <strong class="font-15 uppercase ultrabold">Tổng tiền</strong>
                     <span class="font-15 uppercase ultrabold" id="amount_total">@if ($total > 0){{number_format($total)}} đ @else Liên hệ @endif</span>
                     <div class="clear"></div>
                  </div>
                  <div class="decoration"></div>
                  <a href="{!!route('product.checkout')!!}" class="button button-green button-rounded button-full button-sm ultrabold uppercase shadow-small">Xác nhận đơn hàng</a>
                  <a href="{!!route('product.index')!!}" class="button button-green button-rounded button-full button-sm ultrabold uppercase shadow-small">Tiếp tục mua sắm</a>
               </div>
            @else
                <h6>Bạn chưa chọn mua sản phẩm nào</h6>
            @endif
        </div>
    </form>
</div>
@stop