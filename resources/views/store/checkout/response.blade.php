@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>{{__('web_checkout_response')}} {{ $checkout->status }}</h3>
            <div class="card-body">
                <hh4>{{ $checkout->name }} {{ $checkout->surname }}</hh4>
                <div class="form-group">
                    <h4>{{__('web_checkout_label')}} {{ $checkout->reference }}</h4>
                </div>
                <div class="form-group">
                    <p>{{__('web_checkout_found')}} {{ $checkout->message }}</p>
                </div>
                @if($checkout->status === 'REJECTED')
                    <div clas="form-group">
                        <a href="{{ route('retry.checkout', $checkout->reference) }}"><button class="btn btn-info">{{__('web_checkout_retry')}}</button></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
