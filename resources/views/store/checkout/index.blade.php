@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>{{__('checkout_index')}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>{{__('checkout_index_name')}}</th>
                    <th>{{__('checkout_index_document')}}</th>
                    <th>{{__('checkout_index_document_type')}}</th>
                    <th>{{__('checkout_index_value')}}</th>
                    <th>{{__('checkout_index_status')}}</th>
                    <th>{{__('checkout_index_options')}}</th>
                    </thead>
                    @foreach($checkouts as $checkout)
                        <tr>
                            <td>{{ $checkout->name }}</td>
                            <td>{{ $checkout->document }}</td>
                            <td>{{ $checkout->document_type }}</td>
                            <td>${{ number_format($checkout->value) }}</td>
                            <td>{{ $checkout->status }}</td>
                            <td>
                                <a href="{{ route('consult.checkout', $checkout->reference) }}"><button class="btn btn-info">{{__('checkout_detail_button')}}</button></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{ $checkouts->links() }}
        </div>
    </div>
@endsection
