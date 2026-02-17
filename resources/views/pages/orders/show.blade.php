@extends('layouts.main')

@section('title', 'Order Details')

@section('content')

<link rel="stylesheet" href="{{ asset('css/orders.css') }}">

<div class="orders-page-wrapper">
    <div class="orders-container">

        <div class="glass-card">
            <h1 class="page-title">Order #{{ $order->id }}</h1>
            <p class="order-date">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
        </div>

        <!-- Status -->
        <div class="glass-card">
            <h2 class="section-title">Order Status</h2>
            <span class="order-status-badge status-{{ $order->status }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <!-- Shipping Info -->
        <div class="glass-card">
            <h2 class="section-title">Shipping Information</h2>

            <div class="order-meta">
                <div>
                    <div class="order-meta-label">Name</div>
                    <div class="order-meta-value">{{ $order->first_name }} {{ $order->last_name }}</div>
                </div>

                <div>
                    <div class="order-meta-label">Email</div>
                    <div class="order-meta-value">{{ $order->email }}</div>
                </div>

                <div>
                    <div class="order-meta-label">Address</div>
                    <div class="order-meta-value">{{ $order->shipping_address }}</div>
                </div>

                <div>
                    <div class="order-meta-label">City</div>
                    <div class="order-meta-value">{{ $order->city }}</div>
                </div>

                <div>
                    <div class="order-meta-label">Postcode</div>
                    <div class="order-meta-value">{{ $order->postcode }}</div>
                </div>

                <div>
                    <div class="order-meta-label">Payment Method</div>
                    <div class="order-meta-value">{{ ucfirst($order->payment_method) }}</div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="glass-card">
            <h2 class="section-title">Order Items</h2>

            <table class="order-items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="order-item-product">
                                    <img src="{{ asset(str_replace(' ', '%20', $item->image)) }}" alt="{{ $item->name }}">
                                    <div class="order-item-name">{{ $item->name }}</div>
                                </div>
                            </td>

                            <td>{{ $item->quantity }}</td>

                            <td>£{{ number_format($item->price, 2) }}</td>

                            <td>
                                <strong>£{{ number_format($item->price * $item->quantity, 2) }}</strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="order-totals">
                <div class="order-totals-row">
                    <div class="order-totals-label">Grand Total</div>
                    <div class="order-totals-grand">£{{ number_format($order->total, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="order-actions-row">
            <a href="{{ route('orders.index') }}" class="btn-secondary">← Back to Orders</a>
        </div>

    </div>
</div>

@endsection