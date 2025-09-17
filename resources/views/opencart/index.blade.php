@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>@lang('opencart.fields.order_details')</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('opencart.get_order') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="order_id">@lang('opencart.fields.order_id')</label>
                <input type="number" class="form-control" id="order_id" name="order_id" required>
            </div>
            <button type="submit" class="btn btn-primary">@lang('opencart.fields.get_order_details')</button>
        </form>

        @isset($orderData)
            <h2>@lang('opencart.fields.order_information')</h2>
            @if (isset($orderData['error']))
                <div class="alert alert-warning">
                    <p>@lang('opencart.fields.error_from_api') {{ is_array($orderData['error']) ? implode(', ', $orderData['error']) : $orderData['error'] }}</p>
                </div>
            @else
                @php
                    $order = $orderData['order'];
                @endphp
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">@lang('opencart.fields.order_title', ['order_id' => $order['order_id'], 'order_status' => $order['order_status']])</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>@lang('opencart.fields.customer_details')</h4>
                                <p><strong>@lang('opencart.fields.name')</strong> {{ $order['firstname'] }} {{ $order['lastname'] }}</p>
                                <p><strong>@lang('opencart.fields.email')</strong> {{ $order['email'] }}</p>
                                <p><strong>@lang('opencart.fields.telephone')</strong> {{ $order['telephone'] }}</p>
                            </div>
                            <div class="col-md-6">
                                <h4>@lang('opencart.fields.order_summary')</h4>
                                <p><strong>@lang('opencart.fields.total')</strong> {{ $order['currency_code'] }} {{ number_format($order['total'], 2) }}</p>
                                <p><strong>@lang('opencart.fields.date_added')</strong> {{ $order['date_added'] }}</p>
                                <p><strong>@lang('opencart.fields.payment_method')</strong> {{ $order['payment_method']['name'] }}</p>
                                <p><strong>@lang('opencart.fields.shipping_method')</strong> {{ $order['shipping_method']['name'] }}</p>
                            </div>
                        </div>

                        <hr>

                        <h4>@lang('opencart.fields.shipping_address')</h4>
                        <p>
                            {{ $order['shipping_firstname'] }} {{ $order['shipping_lastname'] }}<br>
                            {{ $order['shipping_company'] }}<br>
                            {{ $order['shipping_address_1'] }}<br>
                            {{ $order['shipping_address_2'] }}<br>
                            {{ $order['shipping_city'] }}, {{ $order['shipping_zone'] }} {{ $order['shipping_postcode'] }}<br>
                            {{ $order['shipping_country'] }}
                        </p>

                        <hr>

                        <h4>@lang('opencart.fields.products')</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('opencart.fields.image')</th>
                                    <th>@lang('opencart.fields.product_name')</th>
                                    <th>@lang('opencart.fields.model')</th>
                                    <th>@lang('opencart.fields.quantity')</th>
                                    <th>@lang('opencart.fields.unit_price')</th>
                                    <th>@lang('opencart.fields.total')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order['products'] as $product)
                                    <tr>
                                        <td>
                                            @if (isset($product['image']) && !empty($product['image']))
                                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                @lang('opencart.fields.n_a')
                                            @endif
                                        </td>
                                        <td>{{ $product['name'] }}</td>
                                        <td>{{ $product['model'] }}</td>
                                        <td>{{ $product['quantity'] }}</td>
                                        <td>{{ $order['currency_code'] }} {{ number_format($product['price'], 2) }}</td>
                                        <td>{{ $order['currency_code'] }} {{ number_format($product['total'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>

                        <h4>@lang('opencart.fields.order_totals')</h4>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                @foreach ($order['totals'] as $total)
                                    <tr>
                                        <td><strong>{{ $total['title'] }}:</strong></td>
                                        <td>{{ $order['currency_code'] }} {{ number_format($total['value'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endisset
    </div>
@endsection