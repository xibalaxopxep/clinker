@extends('backend.layouts.master')
@section('content')
<div class="container">
    <div class="col-md-12" style="margin-top:25px;">
        @foreach($records as $key=>$value)
        <div class="card card-collapsed">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">@if(isset($value['title'])) {{$value['title']}} @endif</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item rotate-180" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <ul class="media-list" data-form="true">
                    <form method="post">
                        <input type="hidden" name="name" value="{{$key}}"/>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        @foreach($value as $attribute_name=>$setting_value)
                        <li class="media">
                            @switch($attribute[$attribute_name]['type'])
                            @case('image')
                            {!! \App\Helpers\StringHelper::getImageInput($attribute[$attribute_name]['id'],$setting_value,$options=array('guid'=>$key))!!}
                            @break;
                            @case('number')
                            {!! \App\Helpers\StringHelper::getNumberInput($attribute[$attribute_name]['id'],$setting_value)!!}
                            @break;
                            @case('html')
                            {!! \App\Helpers\StringHelper::getHtmlInput($attribute[$attribute_name]['id'],$setting_value)!!}
                            @break;
                            @case('color')
                            {!! \App\Helpers\StringHelper::getColorInput($attribute[$attribute_name]['id'],$setting_value)!!}
                            @break;
                            @case('radio')
                            {!! \App\Helpers\StringHelper::getRadioInput($attribute[$attribute_name]['id'],$setting_value)!!}
                            @break;
                            @default
                            {!! \App\Helpers\StringHelper::getTextInput($attribute[$attribute_name]['id'],$setting_value)!!}
                            @break;
                            @endswitch
                        </li>
                        @endforeach
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Lưu<i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>
                </ul>
            </div>

        </div>
        @endforeach
        <!-- /accordion with controls -->


    </div>
</div>
@stop
@section('script')
@parent
<script>
    $(function () {
        $('body').delegate('[data-form="true"] form', 'submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/api/edit_template_setting',
                data: new FormData(this), contentType: false, processData: false,
                method: 'POST', dataType: 'json',
                success: function (resp) {
                    swal({
                        title: resp.message,
                        icon: "success"
                       })
                }
            });
        });
    });
</script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
@stop