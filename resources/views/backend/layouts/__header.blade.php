<!-- Page header -->
@if($parent_route!=='admin.index')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style type="text/css">
    @media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  
}
 @page 
    {
        /*//size: auto;*/   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
    
    <div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i>
                <span class="font-weight-semibold">Dashboard</span> - {{trans('route.'.$parent_route)}}
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                @if($method == 'index')
                @if (\Route::has(str_replace('index', 'create', $current_route)))
                @if(isset($type))
                <a href="{!!route(str_replace('index', 'create', $current_route), ['type'=>$type])!!}" class="btn btn-link btn-float text-default"><i class="icon-googleplus5 text-primary"></i><span>Thêm mới</span></a>
                @else
                <a href="{!!route(str_replace('index', 'create', $current_route))!!}" class="btn btn-link btn-float text-default"><i class="icon-googleplus5 text-primary"></i><span>Thêm mới</span></a>
                @endif

                @endif
                @else
                @if(isset($type))
                <a href="{!!route($parent_route, ['type'=>$type])!!}" class="btn btn-link btn-float text-default"><i class="icon-square-left text-primary"></i><span>Back</span></a>
                @else
                <a href="{!!route($parent_route)!!}" class="btn btn-link btn-float text-default"><i class="icon-square-left text-primary"></i><span>Back</span></a>
                @endif
                @endif
            </div>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{!!route('admin.index')!!}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
                @if($method == 'index')
                <span class="breadcrumb-item active">{{trans('route.'.$parent_route)}}</span>
                @else
                @if(isset($type))
                <span class="breadcrumb-item"><a class="text-default" href="{!!route($parent_route, ['type'=>$type])!!}">{{trans('route.'.$parent_route)}}</a></span>
                @else
                <span class="breadcrumb-item"><a class="text-default" href="{!!route($parent_route)!!}">{{trans('route.'.$parent_route)}}</a></span>
                @endif

                <span class="breadcrumb-item active">{{trans('route.'.$method)}}</span>
                @endif
                  @if($method == 'index1')
                  <span class="breadcrumb-item active">{{trans('route.'.$parent_route)}}</span>@endif
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

    </div>
</div>

@endif
<!-- /page header -->
