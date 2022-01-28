@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>{{__('web_checkout_title')}}</h3>
            @if($transaction_error ?? '')
                <div class="alert alert-danger">
                    <h4>{{ $transaction_error ?? '' }}</h4>
                </div>
            @endif
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h4>Your total: ${{ number_format($total) }}</h4>
            <form class="card-body" action="{{ route('request.checkout') }}" method="post" id="checkout-form">
                @csrf
                <div class="form-group">
                    <label for="name">{{__('web_checkout_name')}}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="surname">{{__('web_checkout_surname')}}</label>
                    <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="document">{{__('web_checkout_document')}}</label>
                    <input type="text" name="document" class="form-control @error('document') is-invalid @enderror" value="{{ old('document') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="documentType">{{__('web_checkout_document_type')}}</label>
                    <select class="form-control" name="documentType">
                        @foreach(["CC" => "CC", "CE" => "CE", "TI" => "TI", "NIT" => "NIT", "RUT" => "RUT"] AS $documentType => $documentTypeLabel)
                            <option value="{{ $documentType }}" {{ old("documentType") }}>{{ $documentTypeLabel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="company">{{__('web_checkout_company')}}</label>
                    <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="email">{{__('web_checkout_email')}}</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="mobile">{{__('web_checkout_mobile')}}</label>
                    <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="address">{{__('web_checkout_address')}}</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" autofocus>
                </div>
                <div class="form-group">
                    <input type="hidden" name="totalValue" class="form-control" value="{{ $total }}" autofocus>
                    <h4>Your total: ${{ number_format($total) }}</h4>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">{{__('web_checkout_buy')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
