@extends('layouts.default')

@section('content')
    <div class="card row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>{{__('category_create_title')}}</h3>
            @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="card-body" action="/store/category" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">{{__('category_create_name')}}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{__('category_create_name')}}" autofocus>
                </div>
                <div class="form-group">
                    <label for="description">{{__('category_create_description')}}</label>
                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" placeholder="{{__('category_create_description')}}">
                </div>
                <div class="form-group">
                    <label for="price">{{__('category_create_price')}}</label>
                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="{{__('category_create_price')}}">
                </div>
                <div class="form-group">
                    <label for="formFile" class="form-label">{{__('category_upload_file')}}</label>
                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="formFile">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">{{__('category_create_submit')}}</button>
                    <button class="btn btn-danger" type="reset">{{__('category_create_cancel')}}</button>
                </div>
            </form>
        </div>
    </div>
@stop
