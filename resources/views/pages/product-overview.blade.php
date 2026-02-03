@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/productoverview.css') }}">

<div class="product-container">
    
    {{-- HERO SECTION --}}
    <div class="product-hero-card">
        <div class="product-image-area">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        </div>

        <div class="product-info-area">
            <span class="category-label">{{ ucfirst($product->type) }}</span>
            <h1>{{ $product->name }}</h1>
            
            <div class="stock-status">
                {{-- Updated Pill-style In Stock Badge --}}
                <span class="{{ $product->stock > 0 ? 'in-stock-pill' : 'out-stock-pill' }}">
                    @if($product->stock > 0)
                        <i class="fa-solid fa-check"></i> In Stock
                    @else
                        <i class="fa-solid fa-xmark"></i> Out of Stock
                    @endif
                </span>
            </div>

            <div class="price-display">£{{ number_format($product->price, 2) }}</div>

            <p class="product-description">{{ $product->description }}</p>

            <div class="action-row">
                <div class="quantity-input-box">
                    <button type="button" onclick="changeQty(-1)">-</button>
                    <input type="text" id="qty" value="1" readonly>
                    <button type="button" onclick="changeQty(1)">+</button>
                </div>

                <form action="{{ route('basket.add') }}" method="POST" style="flex-grow:1; display:flex;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn-gradient-add">
                        <i class="fa-solid fa-cart-shopping"></i> Add to Basket
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- REVIEWS SECTION --}}
    <div class="reviews-wrapper-card">
        <h2>Customer Reviews</h2>
        <div class="reviews-split-layout">
            <div class="reviews-left-stats">
                <div class="large-number">4.8</div>
                {{-- Large Yellow Stars --}}
                <div class="stars-row-yellow">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <p>Based on 139 reviews</p>

                {{-- Completed Rating Bar Stack (5 to 1) --}}
                <div class="rating-bar-stack">
                    <div class="rating-line"><span>5 ★</span><div class="bar-bg"><div class="bar-fill" style="width: 83%"></div></div><span>83%</span></div>
                    <div class="rating-line"><span>4 ★</span><div class="bar-bg"><div class="bar-fill" style="width: 12%"></div></div><span>12%</span></div>
                    <div class="rating-line"><span>3 ★</span><div class="bar-bg"><div class="bar-fill" style="width: 3%"></div></div><span>3%</span></div>
                    <div class="rating-line"><span>2 ★</span><div class="bar-bg"><div class="bar-fill" style="width: 1%"></div></div><span>1%</span></div>
                    <div class="rating-line"><span>1 ★</span><div class="bar-bg"><div class="bar-fill" style="width: 1%"></div></div><span>1%</span></div>
                </div>

                <button class="btn-write-review-grad">Write a Review</button>
            </div>

            <div class="reviews-right-list">
                {{-- Example Individual Review Card --}}
                <div class="individual-review-box">
                    <div class="review-user-icon">U</div>
                    <div class="review-body">
                        <strong>Verified User</strong>
                        {{-- Small Yellow Star Logic --}}
                        <div class="stars-row-yellow-sm">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <span class="review-date">Jan 31, 2026</span>
                        <h4>Great Quality</h4>
                        <p>This works exactly as expected. Highly recommend!</p>
                    </div>
                </div>
                
                {{-- You can repeat the .individual-review-box here using a @foreach loop --}}
            </div>
        </div>
    </div>

</div>


<script>
    // --- 1. THEME INITIALIZATION (From Prototype) ---
    // Check localStorage on load to apply the user's preferred theme
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) {
        document.documentElement.setAttribute('data-theme', currentTheme);
    }

    // --- 2. THEME TOGGLE FUNCTION (From Prototype) ---
    // This function should be called by your Navbar's theme button
    function toggleTheme() {
        const html = document.documentElement;
        const current = html.getAttribute('data-theme');
        
        if (current === 'light') {
            html.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        } else {
            html.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
    }

    // --- 3. QUANTITY LOGIC ---
    function changeQty(n) {
        let q = document.getElementById('qty');
        let v = parseInt(q.value) + n;
        if(v > 0 && v <= 10) {
            q.value = v;
        }
    }
</script>
@endsection