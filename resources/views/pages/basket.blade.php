@extends('layouts.main')

@section('title', 'Checkout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/checkoutstyle.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="container">



    {{-- ✅ Order Summary (empty — no filler data) --}}
    <div class="order-summary">
        <h2>Order Summary</h2>
        <div class="card">

            @if($items->isEmpty())
                <p style="text-align:center; padding:1rem; opacity:0.7;">
                    Your basket is empty.
                </p>
            @else
                @foreach($items as $item)
                    <div class="checkout-item">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="checkout-item-image">

                        <div class="checkout-item-details">
                            <h4>{{ $item->name }}</h4>
                            <p>£{{ number_format($item->price, 2) }}</p>
                            <p>Quantity: {{ $item->quantity }}</p>
                        </div>
                    </div>
                @endforeach

                <hr>

                <div class="checkout-total">
                    <strong>Total:</strong>
                    £{{ number_format($items->sum(fn($i) => $i->price * $i->quantity), 2) }}
                </div>
            @endif

            <a href="{{ route('checkout') }}" class="btn-checkout">Complete Order</a>
        </div>
    </div>

</div>





@endsection