@extends('layouts.main')

@section('title', 'Checkout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/checkoutstyle.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="container">

    <div class="order-summary">
        <h2>Order Summary</h2>

        <div class="card">

            @if($items->isEmpty())
                <p style="text-align:center; padding:1rem; opacity:0.7;">
                    Your basket is empty.
                </p>
            @else

                @foreach($items as $item)
                    <div class="cart-item">
                        <div class="item-info">
                            {{-- Uses OG CSS: .item-img --}}
                            <div class="item-img" style="background-image: url('{{ $item->image }}');"></div>

                            <div class="item-details">
                                <h4>{{ $item->name }}</h4>
                                <p>£{{ number_format($item->price, 2) }}</p>
                                <p>Quantity: {{ $item->quantity }}</p>
                            </div>
                        </div>

                        {{-- Remove button (right side) --}}
                        <form action="{{ route('basket.remove', $item->id) }}" method="POST" class="remove-item-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-item-btn" title="Remove item">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                @endforeach

                <div class="summary-totals">
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>£{{ number_format($items->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
                    </div>
                </div>

            @endif

            <a href="{{ route('checkout') }}" class="btn-checkout">Complete Order</a>

        </div>
    </div>

</div>

@endsection
