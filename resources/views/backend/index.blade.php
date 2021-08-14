@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<style type="text/css">
    p.title_thongke{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }
    p.title_donut{
        text-align: center;
        font-size: 14px;
        font-weight: bold;
    }
</style>


<head>
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

    <script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
     <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

</head>



<div class="content"> 

    <div class="row">
        <div class="col-sm-4">
            <a href="{{route('admin.product.index')}}">
                <div class="tile-stats tile-red"> 
                    <div class="icon"><i class="icon-bag"></i>
                    </div> 
                    <div class="num" data-start="0" data-end="3350" data-postfix="" data-duration="1500" data-delay="0">
                        1                    </div>
                    <h3>Dự án</h3>
                </div>
            </a>
        </div>
     <!--    <div class="col-sm-4">
            <a href="{{route('admin.bill.index1')}}">
                <div class="tile-stats tile-aqua"> 
                    <div class="icon"><i class="icon-newspaper"></i>
                    </div> 
                    <div class="num" data-start="0" data-end="85" data-postfix="" data-duration="1500" data-delay="0">
                        {{$news}}</div>
                    <h3>Tin tức</h3>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('admin.import.index')}}">
                <div class="tile-stats tile-green"> 
                    <div class="icon"><i class="icon-bubble-dots4"></i>
                    </div> 
                    <div class="num" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="0">
                        {{$contact}}
                    </div>
                    <h3>Liên hệ</h3>
                </div>
            </a>
        </div> -->
    </div>
    <!-- Table header styling -->
   

             
          
         
    
   
  </div>
    <!-- /table header styling -->
    
</div>

<!-- /content area -->
@stop
@section('script')
@parent
@stop
  
  