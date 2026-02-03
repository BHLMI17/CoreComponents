@extends('layouts.main') {{-- Matches your listing page layout --}}

@section('title', $product->name)

@section('content')
<link rel="stylesheet" href="{{ asset('css/productoverview.css') }}">

<div class="product-container">
    
    <div class="product-hero card">
        <div class="product-image-area">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        </div>

        <div class="product-info-area">
            {{-- Using 'type' as the brand tag if brand isn't in your DB --}}
            <span class="brand-tag">{{ $product->brand ?? $product->type }}</span>
            <h1>{{ $product->name }}</h1>
            
            {{-- Dynamic Stock Badge --}}
            <div class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                <i class="fa-solid {{ $product->stock > 0 ? 'fa-check' : 'fa-xmark' }}"></i>
                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
            </div>

            <div class="price-tag">£{{ number_format($product->price, 2) }}</div>

            <p class="desc-text">{{ $product->description }}</p>

            <div class="purchase-actions">
                {{-- Form to link to your existing BasketController logic --}}
                <form action="{{ route('basket.add') }}" method="POST" style="display: flex; gap: 15px; flex-grow: 1;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="qty-selector">
                        <button type="button" onclick="changeQty(-1)">-</button>
                        <input type="text" name="quantity" id="qty" value="1" readonly>
                        <button type="button" onclick="changeQty(1)">+</button>
                    </div>

                    <button type="submit" class="btn-add-cart btn-checkout" style="border:none; cursor:pointer;">
                        <i class="fa-solid fa-cart-plus"></i> Add to Basket
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- The Reviews Section stays static for now as per your original file --}}
    <div class="reviews-section card">
        <h2>Customer Reviews</h2>
        <div class="reviews-grid-layout">
            <div class="review-stats">
                <div class="big-rating">4.8</div>
                <div class="stars-gold">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <p>Based on 139 reviews</p>
                {{-- ... Rating bars code ... --}}
                <button class="btn-write-review">Write a Review</button>
            </div>

            <div class="review-comments">
                <div class="comment-card">
                    <div class="comment-header">
                        <div class="avatar">H</div>
                        <div class="user-meta"><strong>Harry</strong><div class="stars-gold-sm">★★★★★</div></div>
                        <span class="date">July 18, 2025</span>
                    </div>
                    <h4>Beast of a GPU</h4>
                    <p>Absolutely amazing performance. Runs all my games at 4k without breaking a sweat.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function changeQty(amount) {
        const input = document.getElementById('qty');
        let val = parseInt(input.value);
        val += amount;
        if(val < 1) val = 1;
        if(val > 10) val = 10;
        input.value = val;
    }
</script>
@endsection