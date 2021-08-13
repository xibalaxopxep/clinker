<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div class="navbar navbar-expand-lg navbar-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>

</div>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
    @media print {
     .hide-from-printer {
          display: none;
      }
</style>
<script type="text/javascript">
    $(document).ready(function(){
              $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            //  alert(matp);
            //   alert(_token);

            if(action=='city'){
                result = 'district';
            }else if(action=='district'){
                result = 'wards';
            }
            $.ajax({
                url : '{{route('api.select_address')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        }); 
    });
</script>


<script src="{!! asset('assets/global_assets/js/main/jquery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/main/bootstrap.bundle.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/loaders/blockui.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/visualization/d3/d3.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/visualization/d3/d3_tooltip.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/ui/moment/moment.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/daterangepicker.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/bootbox/bootbox.min.js') !!}"></script>
<script src="{!!asset('assets/frontend/js/sweetalert.min.js')!!}"></script> 
<script src="{!! asset('assets/backend/js/common.js') !!}"></script>
<script src="{!! asset('assets/js/app.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/dashboard.js') !!}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>