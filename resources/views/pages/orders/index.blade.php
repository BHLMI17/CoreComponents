@extends('layouts.main')

@section('title', 'Order History')

@section('content')

<link rel="stylesheet" href="{{ asset('css/orders.css') }}">

<div class="orders-page-wrapper">
    <div class="orders-container">

        <div class="glass-card">
            <h1 class="page-title">Order History</h1>

            @if($orders->isEmpty())
                <div class="glass-card" style="text-align:center; opacity:0.7;">
                    You haven't placed any orders yet.
                </div>
            @else
                <div class="orders-list">
                    @foreach($orders as $order)
                        <div class="order-card">

                            <div class="order-main-info">
                                <div class="order-id">Order #{{ $order->id }}</div>
                                <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                                <div class="order-total">£{{ number_format($order->total, 2) }}</div>
                            </div>

                            <div class="order-preview-images">
                                @foreach($order->items->take(3) as $item)
                                    <img src="{{ asset(str_replace(' ', '%20', $item->image)) }}" alt="{{ $item->name }}">
                                @endforeach

                                @if($order->items->count() > 3)
                                    <span class="order-preview-more">
                                        +{{ $order->items->count() - 3 }} more
                                    </span>
                                @endif
                            </div>

                            <span class="order-status-badge status-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>

                            <a href="{{ route('orders.show', $order->id) }}" class="btn-primary">
                                View Details
                            </a>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>

    </div>
</div>

@endsection