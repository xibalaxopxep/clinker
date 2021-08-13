@extends('frontend.layouts.construction')
@section('content')
<div class="bg-grey">
    @include('frontend.construction.cover')
    <div class="container">
        <div class="construction-detail bg-white row no-gutters">
            <div class="col-md-12 col-xs-12 plr-15 ">
                <div class="hz-main-contents">
                    <div id="rightSideContent" class="comp-box">
                        <h1 class="header-1 top">{{$project->title}}</h1>
                        <div id="projectSpaces" class="reloadMe browseListBody rimg">
                            <div class="row">
                                <div class="wall">
                                    @foreach ($project->gallery()->orderBy('id','desc')->get() as $gallery)
                                        <a class="wall-item" href="{{$gallery->url()}}">
                                            <img class="gallery-image" src="{{$gallery->getImage()}}" alt="{{$project->title}}">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div style="margin-bottom:10px">
                                <h6>Chia sẻ ngay: </h6>
                                <button class=" btn-lg" style="background:#627aad;border: none;" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{$project->url()}}', 'Facebook', 'width=600,height=400');" href="javascript:void(0)" class="rounded-circle tw" data-toggle="tooltip" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></button>
                                <button class=" btn-lg" style="background:#4d9ed8;border: none;" onclick="window.open('https://twitter.com/intent/tweet?text={{$project->url()}}', 'Google', 'width=600,height=400');" href="javascript:void(0)" class="rounded-circle ff" data-toggle="tooltip" title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
@parent
<script src="{!!asset('assets/frontend/js/wookmark.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/wookmark.min.js')!!}"></script>
<script src="{!!asset('assets/frontend/js/jaliswall.js')!!}""></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<!-- or -->
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>
<script>
    
   
    $('.wall').jaliswall({
        item : '.wall-item',
        columnClass : '.wall-column'

    });

</script>
@stop

