@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1>Checkout</h1>
            <h4>Your total: ${{ number_format($total) }}</h4>
            <form action="{{ route('product.checkout') }}" method="post" id="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-xs-12">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" required>
                    </div>
                    <div class="col-xs-12">
                        <label for="address">Address</label>
                        <input type="text" id="address" class="form-control" required>
                    </div>
                    <div class="col-xs-12">
                        <label for="card-name">Card Holder Name</label>
                        <input type="text" id="card-name" class="form-control" required>
                    </div>
                    <div class="col-xs-12">
                        <label for="card-number">Credit Card Number</label>
                        <input type="text" id="card-number" class="form-control" required>
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="card-expiry-month">Expiration Month</label>
                                    <input type="text" id="card-expiry-month" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="card-expiry-year">Expiration Year</label>
                                    <input type="text" id="card-expiry-year" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Buy now</button>
            </form>
        </div>
    </div>
@endsection
