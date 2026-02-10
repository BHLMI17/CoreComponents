@extends('layouts.main')

@section('title', 'Basket')

@section('content')

<link rel="stylesheet" href="{{ asset('css/checkoutstyle.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="container">

    <div class="order-summary">
        <h2>Your Basket</h2>
        <div class="card">

            @if($items->isEmpty())
                <p style="text-align:center; padding:1rem; opacity:0.7;">
                    Your basket is empty.
                </p>
            @else
                @php $netTotal = 0; @endphp

                @foreach($items as $item)
                    @php
                        $product = $item->product;
                        $lineTotal = $item->line_total;
                        $netTotal += $lineTotal;
                    @endphp

                    <div class="checkout-item">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="checkout-item-image">

                        <div class="checkout-item-details">
                            <h4>{{ $product->name }}</h4>
                            <p>Price: £{{ number_format($product->price, 2) }}</p>

                            {{-- Auto-update quantity --}}
                            <input 
                                type="number"
                                value="{{ $item->quantity }}"
                                min="1"
                                class="qty-input"
                                data-id="{{ $item->id }}"
                                style="width:60px;"
                            >

                            {{-- Remove Item (Trash Icon) --}}
                            <form action="{{ route('basket.remove', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-small btn-danger" style="background:none; border:none; color:#ff4d4d; cursor:pointer;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                            <p>Line Total: £{{ number_format($lineTotal, 2) }}</p>
                        </div>
                    </div>
                @endforeach

                <hr>

                <div class="checkout-total">
                    <strong>Net Total (before VAT):</strong>
                    £{{ number_format($netTotal, 2) }}
                </div>

                <a href="{{ route('checkout') }}" class="btn-checkout">
                    Proceed to Checkout
                </a>
            @endif

        </div>
    </div>

</div>

{{-- Auto-update quantity script --}}
<script>
document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('change', function () {
        const id = this.dataset.id;
        const quantity = this.value;

        fetch(`/basket/update/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Refresh totals + line totals
            }
        });
    });
});
</script>

@endsection