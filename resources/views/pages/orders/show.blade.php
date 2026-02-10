@extends('layouts.main')

@section('title', 'Order Details')

@section('content')

<style>
    .order-details-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .detail-card {
        background: var(--bg-secondary);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border: 1px solid var(--border-color);
    }

    .order-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cfe2ff; color: #084298; }
    .status-shipped { background: #d1e7dd; color: #0f5132; }
    .status-delivered { background: #d1e7dd; color: #0a3622; }
    .status-cancelled { background: #f8d7da; color: #842029; }

    .item-row {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
        align-items: center;
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }

    .item-details {
        flex: 1;
    }

    .back-btn {
        background: var(--accent-color);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        margin-top: 1rem;
    }

    .back-btn:hover {
        opacity: 0.9;
    }
</style>

<div class="order-details-container">
    <h1>Order #{{ $order->id }}</h1>
    <p>Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>

    <div class="detail-card">
        <h3>Order Status</h3>
        <span class="order-status status-{{ $order->status }}">
            {{ ucfirst($order->status) }}
        </span>
    </div>

    <div class="detail-card">
        <h3>Shipping Information</h3>
        <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
        <p><strong>City:</strong> {{ $order->city }}</p>
        <p><strong>Postcode:</strong> {{ $order->postcode }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
    </div>

    <div class="detail-card">
        <h3>Order Items</h3>
        @foreach($order->items as $item)
            <div class="item-row">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="item-img">
                <div class="item-details">
                    <h4>{{ $item->name }}</h4>
                    <p>Quantity: {{ $item->quantity }}</p>
                    <p>£{{ number_format($item->price, 2) }} each</p>
                </div>
                <div>
                    <strong>£{{ number_format($item->price * $item->quantity, 2) }}</strong>
                </div>
            </div>
        @endforeach

        <div style="text-align: right; margin-top: 1rem; font-size: 1.2rem;">
            <strong>Total: £{{ number_format($order->total, 2) }}</strong>
        </div>
    </div>

    <a href="{{ route('orders.index') }}" class="back-btn">← Back to Orders</a>
</div>

@endsection