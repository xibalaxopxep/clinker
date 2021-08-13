<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        @include('backend/layouts/__head')
    </head>

    <body>
        @include('backend/layouts/__navbar')
    <!-- Page content -->
        <div class="page-content">
            <!-- Main sidebar -->
            @include('backend/layouts/__sidebar')
            <!-- /main sidebar -->
            <!-- Main content -->
            <div class="content-wrapper">
                @include('backend/layouts/__header')
                @yield('content')
                <!-- Footer -->
                @include('backend/layouts/__footer')
                <!-- /footer -->
            </div>
            <!-- /main content -->
        </div>
    <!-- /page content -->
    </body>
    @yield('script')   
</html>

