@extends('layouts.default')

@section('content')
    <div class="card row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>{{__('category_edit_title')}}: {{ $category->name }}</h3>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="card-body" action="{{ route('category.update', $category->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">{{__('category_create_name')}}</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" placeholder="{{__('category_create_name')}}" autofocus>
                </div>
                <div class="form-group">
                    <label for="description">{{__('category_create_description')}}</label>
                    <input type="text" name="description" class="form-control" value="{{ $category->description }}" placeholder="{{__('category_create_description')}}">
                </div>
                <div class="form-group">
                    <label for="price">{{__('category_create_price')}}</label>
                    <input type="text" name="price" class="form-control" value="{{ $category->price }}" placeholder="{{__('category_create_price')}}">
                </div>
                <div class="form-group">
                    <label for="disabled" class="checkbox">
                    <input type="checkbox" name="disabled" class="form-control" @if ($category->disabled) checked @endif>
                        {{__('category_create_disabled')}}
                    </label>
                </div>
                @if($category->image)
                    <image height="100px" src="{{ asset('/storage/images/products/' . $category->image) }}" />
                @endif
                <div class="form-group">
                    <label for="formFile" class="form-label">{{__('category_upload_file')}}</label>
                    <input class="form-control" name="image" type="file" id="formFile">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">{{__('category_create_submit')}}</button>
                    <button class="btn btn-danger" type="reset">{{__('category_create_cancel')}}</button>
                </div>
            </form>
        </div>
    </div>
@stop
