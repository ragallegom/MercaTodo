@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>{{__('list_shopping')}}</h3>
        </div>
    </div>
    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($products as $key => $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary rounded-pill">{{ $product['qty'] }}</span>
                            <strong>{{ $product['item']['name'] }}</strong>
                            <span class="label label-success">${{ number_format($product['price'], 2) }}</span>
                            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <a href="{{ route('product.decreaseProduct', $key) }}"><button type="button" class="btn btn-primary">-</button></a>
                                    <a href="{{ route('product.increaseProduct', $key) }}"><button type="button" class="btn btn-primary">+</button></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>{{__('shopping_total')}}: ${{ number_format($totalPrice) }}</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('product.checkout') }}"><button class="btn btn-success">{{__('shopping_checkout')}}</button></a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>{{__('shopping_no_items')}}</h2>
            </div>
        </div>
    @endif
@endsection
