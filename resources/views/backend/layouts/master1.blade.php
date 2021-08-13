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
            
            <!-- /main sidebar -->
            <!-- Main content -->
            <div class="content-wrapper">


                @yield('content1')
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

