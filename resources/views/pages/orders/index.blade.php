@extends('layouts.main')

@section('title', 'Order History')

@section('content')

<style>
    .orders-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .order-card {
        background: var(--bg-secondary);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border: 1px solid var(--border-color);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .order-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cfe2ff; color: #084298; }
    .status-shipped { background: #d1e7dd; color: #0f5132; }
    .status-delivered { background: #d1e7dd; color: #0a3622; }
    .status-cancelled { background: #f8d7da; color: #842029; }

    .order-items {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin: 1rem 0;
    }

    .order-item-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
    }

    .view-details-btn {
        background: var(--accent-color);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        margin-top: 1rem;
    }

    .view-details-btn:hover {
        opacity: 0.9;
    }
</style>

<div class="orders-container">
    <h1>Order History</h1>

    @if($orders->isEmpty())
        <div class="order-card">
            <p style="text-align: center; opacity: 0.7;">You haven't placed any orders yet.</p>
        </div>
    @else
        @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <h3>Order #{{ $order->id }}</h3>
                        <p style="opacity: 0.7;">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <span class="order-status status-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                <div class="order-items">
                    @foreach($order->items->take(3) as $item)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="order-item-img">
                    @endforeach
                    @if($order->items->count() > 3)
                        <span style="opacity: 0.7; align-self: center;">+{{ $order->items->count() - 3 }} more</span>
                    @endif
                </div>

                <p style="margin-top: 1rem;"><strong>Total:</strong> £{{ number_format($order->total, 2) }}</p>

                <a href="{{ route('orders.show', $order->id) }}" class="view-details-btn">View Details</a>
            </div>
        @endforeach
    @endif
</div>

@endsection