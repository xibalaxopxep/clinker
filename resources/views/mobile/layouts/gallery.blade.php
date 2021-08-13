<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="{!!asset('assets/mobile/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('assets/mobile/css/jquery.lighter.css')!!}" />
    <link href="{!!asset('assets/frontend/css/flexslider.css')!!}" rel="stylesheet">
    <link rel="stylesheet" href="{!!asset('assets/mobile/js/taggd/taggd.css')!!}" />
    <link rel="stylesheet" href="{!!asset('assets/mobile/js/taggd/taggd-classic.css')!!}" />
    <link rel="stylesheet" href="{!!asset('assets/frontend/css/gallery.css')!!}" />
    @include('mobile/layouts/__head')


</head>

<body>
<!-- Page content -->
<div id="page">
    <!-- Main content -->
    <div class="content-wrapper">
    {{--@include('mobile/layouts/__header')--}}
    @yield('content')
    <!-- Footer -->
    @include('mobile/layouts/__footer')
    <!-- /footer -->
    </div>
    <!-- /main content -->
</div>
<!-- /page content -->
</body>
<script type="text/javascript" src="{!!asset('assets/mobile/js/custom.js')!!}"></script>

<script src="{!!asset('assets/frontend/js/jquery.flexslider-min.js')!!}"></script>
<script src="{!!asset('assets/mobile/js/jquery.lighter.js')!!}"></script>
<script src="{!!asset('assets/mobile/js/taggd/taggd.min.js')!!}"></script>
<script src="{!!asset('assets/mobile/js/gallery.js')!!}"></script>
<script src="{!!asset('assets/mobile/js/html2canvas/html2canvas.js')!!}"></script>
<script src="{!!asset('assets/mobile/js/screenshot/filesaver.js')!!}"></script>
<script src="{!!asset('assets/mobile/js/screenshot/screenshot.js')!!}"></script>

@yield('script')
</html>

