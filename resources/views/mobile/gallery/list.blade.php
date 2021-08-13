@extends('mobile.layouts.master')
@section('content')
    <div class="page-content header-clear-large gallery-page">
        <div class="gallery gallery-albums">
        <div class="filter-attribute">
            <form action="{{route('gallery.index')}}" method="get" id="filterGallery">
                <input type="hidden" id="category_id" name="category_id" value=" @if(isset($search['category_id'])) {{$search['category_id']}}@endif"/>
                <div class=" select-box select-box-2 bottom-15" style="width:100%">
                    <select class="chosen-select" id="category_select">
                        <option value="0">Danh mục hình ảnh</option>
                        @foreach($category_arr as $category)
                            <option value="{{$category->id}}" @if(isset($search['category_id']) && $category->id == $search['category_id']) selected @endif>{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>

               <!-- <input type="hidden" class="attribute_id" name="attribute_id" value=" @if(isset($search['attribute_id'])) {{$search['attribute_id']}}@endif"/>
                @foreach($attribute_arr as $attribute)
                    <div class="select-box select-box-2 bottom-15" >
                        <select class="chosen-select attribute_select">
                            <option value="0">{{$attribute->title}}</option>
                            @foreach($attribute->children as $children)
                                <option value="{{$children->id}}" @if(isset($search['attribute_arr']) && in_array($children->id, $search['attribute_arr'])) selected @endif>{{$children->title}}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach -->
            </form>
        </div>
        <div class="gallery gallery-albums top-15">
            @foreach ($records as $record)
            <a class="show-gallery" href="{{$record->url()}}" title="{{$record->title}}">
                <img src="{{$record->getImage()}}" data-src="{{$record->getImage()}}" class="preload-image" alt="{{$record->title}}">
                {{--<strong>{{$record->title}}</strong>--}}
                {{--<u class="overlay overlay-gradient"></u>--}}
            </a>
            @endforeach
            <div class="clear"></div>
        </div>
        {!!$records->render()!!}
    </div>
@stop