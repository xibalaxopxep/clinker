<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        @include('frontend/layouts/__head')
        <link href="{!!asset('assets/frontend/css/product-detail.css')!!}" rel="stylesheet">
        <link href="{!!asset('assets/frontend/css/font-awesome.css')!!}" rel="stylesheet">
        <link href="{!!asset('assets/frontend/css/flexslider.css')!!}" rel="stylesheet">
        <link href="{!!asset('assets/frontend/taggd/taggd.css')!!}" rel="stylesheet">
        <link href="{!!asset('assets/frontend/taggd/taggd-classic.css')!!}" rel="stylesheet">
        <link href="{!!asset('assets/frontend/css/gallery.css')!!}" rel="stylesheet">

    </head>

    <body>
        <!-- Page content -->
        <div id="page">
            <!-- Main content -->
            <div class="content-wrapper">
                @include('frontend/layouts/__header')
                @yield('content')
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    <script src="{!!asset('assets/frontend/js/jquery.js')!!}"></script>
    <script src="{!!asset('assets/frontend/js/jquery.elevatezoom.js')!!}"></script>
    <script src="{!!asset('assets/frontend/js/owl.carousel.min.js')!!}"></script>
    <script src="{!!asset('assets/frontend/js/jquery.flexslider-min.js')!!}"></script>
    <script src="{!!asset('assets/frontend/taggd/taggd.min.js')!!}"></script>
    <script src="{!! asset('assets/frontend/js/product.js') !!}"></script>
    <script src="{!! asset('assets/frontend/js/gallery.js') !!}"></script>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0"></script>
    @yield('script')
    
    </body>
</html>

