<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link href="{!!asset('assets/frontend/css/product-detail.css')!!}" rel="stylesheet">
    <link href="{!!asset('assets/frontend/css/font-awesome.css')!!}" rel="stylesheet">

    @include('frontend/layouts/__head')
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
</body>
<script src="{!!asset('assets/frontend/js/jquery.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/jquery.elevatezoom.js')!!}"></script>
<script src="{!! asset('assets/frontend/js/product.js') !!}"></script>

@yield('script')
</html>

