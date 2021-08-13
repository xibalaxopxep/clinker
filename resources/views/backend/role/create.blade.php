@extends('backend.layouts.master')
@section('content')
<div class="content">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Tạo mới</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-body row">
            <div class="col-lg-2 col-md-2 col-sm-2">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="body">
                        <form action="{!!route('admin.role.store')!!}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <div class="form-group row">
                                <label class="col-md-1 text-right">Vai trò</label>
                                <input type="text" class="form-control col-md-9" name="name">
                            </div>
                            <div class="form-group row">
                                <div class="form-check col-md-3 form-check-left">
                                    <label class="form-check-label float-left">
                                       <b>Chọn tất cả</b>
                                        <input type="checkbox" id="all" class="form-check-input-styled" data-fouc>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                @foreach ($public_route as $key => $value)
                                <div class="form-check col-md-3 form-check-left">
                                    <label class="form-check-label float-left">
                                       <b>{{trans('route.admin.'.$value.'.index')}}</b>
                                        <input type="checkbox" class="form-check-input-styled custom-control-input" name="route[]" value="{{$value}}" data-fouc>
                                    </label>
                                </div>
                                <div class="col-md-1"></div>
                                @endforeach
                            </div>
                            <div class="text-left">
                                <button type="submit" class="btn btn-m btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/uniform.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switch.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/validation/validate.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/touchspin.min.js') !!}"></script>
<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
<script>
    $("#all").change(function(){
        var status = this.checked;
        $('.custom-control-input').each(function(){
        if (status == true){
        $(this).parents('span').addClass("checked");
        this.checked =true;
        } else{
        $(this).parents('span').removeClass("checked");
        this.checked =false;
    }
    });
    });
</script>
@stop
