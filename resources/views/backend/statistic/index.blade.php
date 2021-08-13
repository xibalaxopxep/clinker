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
    #panigate {
        text-align: center;
      display: inline-block;
    }
    #panigate a:focus {
      background-color: #2196f3;
    }
    #panigate a:visited {
      background-color: red;
    }
    #panigate a:hover {
      background-color: #DCDCDC;
    }
    
    #panigate a {
      border-radius: 5px;
      color: black;
      padding: 8px 16px;
      text-decoration: none;
      float: left;
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

    <script type="text/javascript">
        
        $( document ).ready(function() {







            $('#btn-dashboard-filter').click(function()
    {
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        
        $.ajax({
            url:'{{route("admin.statistic.filter1")}}',
            method: "POST",
            dataType: "JSON",
            data:{from_date:from_date,_token:_token,to_date:to_date},
            success:function(data){
                var trHTML = '';
                var trHTML1 = '';
                $.each(data.import, function (i, item) {
                    trHTML += '<tr><td>' + i + '</td><td>' + item.import_id + '</td><td>' + item.payment_type + '</td><td>' + item.total + '</td><td>' + item.discount + '</td><td>' + item.total_payment + '</td><td>' + item.paid + '</td><td>' + item.payment_day + '</td></tr>';
                });
                        trHTML1 += '<a class="panigate "  href="javascript:void(0)" at="'+data.curent_page+'"><</a>';
                     for (var i = 1; i <= data.total_page; i++) {
                           trHTML1 += '<a class="panigate "  href="javascript:void(0)" at="'+i+'">'+i+'</a>';
                        }
                           trHTML1 += '<a href="javascript:void(0)" aria-label="Next"><span aria-hidden="true">></span>';
                    
                $('#show_data').html(trHTML);
                $('#panigate').html(trHTML1);
                
                        

            }
        });
    });


            $('.dashboard-filter').change(function(){
                
                var dashboard_value = $(this).val();
                var _token = $('input[name = "_token"]').val();
                $('#loading').show();
                $.ajax({
                    url:'{{route("admin.fixed.filter1")}}',
                    method:"POST",
                    dataType: "JSON",
                    data:{dashboard_value:dashboard_value, _token:_token},
                    
                    success:function(data){
                        $('#loading').hide();
                        
                        var trHTML = '';
                        var trHTML1 = '';
                        $.each(data.import, function (i, item) {
                            trHTML += '<tr><td>' + i + '</td><td>' + item.import_id + '</td><td>' + item.payment_type + '</td><td>' + item.total + '</td><td>' + item.discount + '</td><td>' + item.total_payment + '</td><td>' + item.paid + '</td><td>' + item.payment_day + '</td></tr>';
                        });
                        trHTML1 += '<a class="panigate "  href="javascript:void(0)" at="'+data.curent_page+'"><</a>';
                        for (var i = 1; i <= data.total_page; i++) {
                           trHTML1 += '<a class="panigate "  href="javascript:void(0)" at="'+i+'">'+i+'</a>';
                        }
                           trHTML1 += '<a href="javascript:void(0)" aria-label="Next"><span aria-hidden="true">></span>';
                            
                        $('#show_data').html(trHTML);
                        $('#panigate').html(trHTML1);
                        
                        
                      
                    }


                });

                 
            });
            
       
            chart60daysorder();

            function chart60daysorder(){
                var _token = $('input[name = "_token"]').val();
                
                $.ajax({

                    url:'{{route("admin.statistic.days_order1")}}',
                    method:"POST",
                    dataType: "JSON",
                    data:{_token:_token},
                    
                    success:function(data){
                        
                        
                    }


                });
             
            
                $.ajax({
                    url:'{{route("admin.statistic.days_order1")}}',
                    method:"POST",
                    data:{_token:_token},
                    
                    success:function(data){
                       var trHTML1 = '';
                        var trHTML = '';
                        $.each(data.import, function (i, item) {
                            trHTML += '<tr><td>' + i + '</td><td>' + item.import_id + '</td><td>' + item.payment_type + '</td><td>' + item.total + '</td><td>' + item.discount + '</td><td>' + item.total_payment + '</td><td>' + item.paid + '</td><td>' + item.payment_day + '</td></tr>';
                        });
                           trHTML1 += '<a class="panigate "  href="javascript:void(0)" at="'+data.curent_page+'"><</a>';
                        for (var i = 1; i <= data.total_page; i++) {
                           trHTML1 += '<a class="panigate "  href="javascript:void(0)" at="'+i+'">'+i+'</a>';
                        }
                           trHTML1 += '<a href="javascript:void(0)" aria-label="Next"><span aria-hidden="true">></span>';
                            
                        $('#show_data').html(trHTML);
                        $('#panigate').html(trHTML1);
                    }
 
                });
           
          
        }
                          $(document).on("click",".panigate",function()
    {          
                var page = $(this).attr('at');
                var _token = $('input[name = "_token"]').val();
              
                $.ajax({
                    
                     url:'{{route("api.panigate","page")}}',
                    method:"POST",
                    dataType:"JSON",
                    data:{_token:_token,page:page},
                    
                    success:function(data){
                        var trHTML = '';
                        var trHTML1 = '';
                        $.each(data.import, function (i, item) {
                            trHTML += '<tr><td>' + i + '</td><td>' + item.import_id + '</td><td>' + item.payment_type + '</td><td>' + item.total + '</td><td>' + item.discount + '</td><td>' + item.total_payment + '</td><td>' + item.paid + '</td><td>' + item.payment_day + '</td></tr>';
                        });
                       
                            
                        $('#show_data').html(trHTML);
                        
                    }


                });
                });


            //chart30daysorder();

             

        });


</script>
<script type="text/javascript">
    $(document).ready(function() {
  var pageItem = $(".pagination li").not(".prev,.next");
  var prev = $(".pagination li.prev");
  var next = $(".pagination li.next");

  pageItem.click(function() {
    pageItem.removeClass("active");
    $(this).not(".prev,.next").addClass("active");
  });

  next.click(function() {
    $('li.active').removeClass('active').next().addClass('active');
  });

  prev.click(function() {
    $('li.active').removeClass('active').prev().addClass('active');
  });


});
</script>



<script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"yy-mm-dd",
            dayNamesMin:["Thứ 2", "Thứ 3","Thứ 4","Thứ 5", "Thứ 6","Thứ 7","Chủ nhật"],
            duration:"slow",
        });

        $( "#datepicker2" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"yy-mm-dd",
            dayNamesMin:["Thứ 2", "Thứ 3","Thứ 4","Thứ 5", "Thứ 6","Thứ 7","Chủ nhật"],
            duration:"slow",
        });
  } );

</script>
</head>


<div id="result"></div>
<div class="content"> 

    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Thống kê</h5>.
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!--The <code>DataTables</code> is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table. DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function. Searching, ordering, paging etc goodness will be immediately added to the table, as shown in this example. <strong>Datatables support all available table styling.</strong>-->
        </div>

          <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert bg-success alert-styled-left">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ Session::get('success') }}</span>
                    </div>
                @endif
            </div>


            <p class="title_thongke">Thông kế phiếu kiểm kho</p>
         
            <form autocomplete="off">
                @csrf
            <div class="row">
                <div style="margin-left: 10px;" class="col-md-2">
                    <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                    

                </div>

                <div class="col-md-2" >
                    <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                    
                </div>

                
                <div style="margin-top: 23px;" class="col-md-1"><input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả"></div>
                <div style="margin-top: 27px;" class="col-md-1">Hoặc</div>
                <div class="col-md-2" >
                    <p>
                        Lọc theo: 
                        <select class="dashboard-filter form-control">
                            <option>--Chọn--</option>
                            <option value="7ngay">7 ngày qua </option>
                            <option value="thangtruoc">tháng trước </option>
                            <option value="thangnay">tháng này </option>
                            <option value="365ngayqua">365 ngày qua </option>
                            
                            
                        </select>

                    </p>
                    

                </div>
                <div style="display: none;color:#00BFFF;" id=loading>Loading ...</div>
                </div>
            </form>

            


            <br><br>
        
            
            
        <table style="text-align: center;" class="table datatable-basic" id="show_table">
                <thead>
            <tr >
                <th>ID</th>
                <th>ID phiếu nhập</th>
                <th>Phương thức thanh toán </th>
                <th>Tổng gốc</th>
                <th>Chiếu khấu</th>
                <th>Tổng sau chiết khấu</th>
                <th>Đã thanh toán</th>
                <th>Hẹn ngày thanh toán</th>
            </tr>
                </thead>
                <tbody id="show_data">
               
                    
                </tbody>
            </table>
            
        <!-- Content area -->   
          
            <div  id="panigate">
            </div>

             
          
         
    
   
  </div>
    <!-- /table header styling -->
    
</div>

<!-- /content area -->
@stop
@section('script')
@parent
@stop
  
  