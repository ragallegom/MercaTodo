@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>{{__('list_category')}} <a href="category/create"><button class="btn btn-success">{{__('category_button')}}</button></a></h3>
            @include('store.category.search')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>{{__('category_index_id')}}</th>
                        <th>{{__('category_index_name')}}</th>
                        <th>{{__('category_index_description')}}</th>
                        <th>{{__('category_index_disabled')}}</th>
                        <th>{{__('category_index_options')}}</th>
                    </thead>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <th>
                                @if( $category->disabled_at == null)
                                    {{__('category_index_no')}}
                                @else
                                    {{__('category_index_yes')}}
                                @endif
                            </th>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}"><button class="btn btn-info">{{__('category_edit_button')}}</button></a>
                                <a href="" data-target="#modal-delete-{{ $category->id }}" data-toggle="modal"><button class="btn btn-danger">{{__('category_delete_button')}}</button></a>
                            </td>
                        </tr>
                        @include('store.category.modal')
                    @endforeach
                </table>
            </div>
            {{ $categories->links() }}
        </div>
    </div>
@endsection
