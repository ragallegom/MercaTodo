@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>{{__('list_category')}}</h3>
            @include('store.products.search')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>{{__('category_index_name')}}</th>
                        <th>{{__('category_index_description')}}</th>
                        <th>{{__('category_index_image')}}</th>
                        <th>{{__('category_index_price')}}</th>
                    </thead>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                @if($category->image)
                                    <image height="100px" src="{{ asset('/storage/images/products/' . $category->image) }}" />
                                @endif
                            </td>
                            <td>{{ $category->price }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{ $categories->links() }}
        </div>
    </div>
@endsection
