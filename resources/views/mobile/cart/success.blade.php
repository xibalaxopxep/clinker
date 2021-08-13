@extends('mobile.layouts.home')
@section('content')
    <div id="mm-0" class="mm-page mm-slideout"><div id="page">
        <!-- /header -->
        <div class="sub_header_in sticky_header">
            <div class="container">
                <h1></h1>
            </div>
            <!-- /container -->
        </div>
        <!-- /sub_header -->

        <main>
            <div class="container margin_60">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div id="confirm">
                            <div class="icon icon--order-success svg add_bottom_15">
                                <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                                    <g fill="none" stroke="#8EC343" stroke-width="2">
                                        <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                        <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                    </g>
                                </svg>
                            </div>
                            <h2>Chúc mừng bạn đã mua hàng thành công</h2>
                             <a href="{!!route('product.index')!!}" class="button button-blue button-rounded button-full button-sm ultrabold uppercase shadow-small">Quay lại mua hàng</a>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
            <!-- /bg_color_1 -->
        </main>
        <!--/main-->


        <!--/footer-->
    </div>
@stop