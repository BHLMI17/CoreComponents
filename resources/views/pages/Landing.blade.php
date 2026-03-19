@extends('layouts.main')

@section('title', 'CoreComponents')

@section('content')
<link rel="stylesheet" href="/css/samistyles.css">
{{-- Reusing the Listing Page Styles --}}
<link rel="stylesheet" href="{{ asset('css/productoverview.css') }}">

<style>
    /* 1. PREVENT VERTICAL STRETCHING */
    .featured-carousel {
        display: flex;
        gap: 25px;
        overflow-x: auto;
        padding: 40px 20px;
        align-items: flex-start; /* CRITICAL: Stops cards from stretching to the bottom */
        scroll-behavior: smooth;
        scrollbar-width: none; 
    }
    .featured-carousel::-webkit-scrollbar { display: none; }

    /* 2. LOCK CARD SIZE */
    .featured-card {
        width: 280px !important;
        min-width: 280px !important;
        max-width: 280px !important;
        flex-shrink: 0;
        height: auto !important; /* Let content decide height */
    }

    /* 3. FIX CAROUSEL BUTTONS */
    .featured-carousel-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
</style>

<main>
    {{-- Hero and Categories remain the same --}}
    <section id="welcome-hero">
        <div class="hero-content">
            <h1>Welcome to CoreComponents!</h1>
            <h5>Your ultimate destination for high-performance PC parts and upgrades.</h5>
            <img class="main-thumbnail" src="/images/main-thumbnail.png" alt="Main Thumbnail">
            <div class="hero-actions">
                <a href="{{ route('products.list') }}" class="hero-button">Our Stock</a>
            </div>
        </div>
    </section>

  {{-- Updated Category Quick-Links --}}

<section id="category-grid-section">
    <div class="category-header">
        <h1>Shop by Category</h1>
         <h5>
            find the perfect component for your build
        </h5>
    </div>
    
    <div class="cat-row-top">
        <a href="{{ route('products.list', ['type' => 'CPU']) }}" class="cat-card">
            <div class="cat-icon"><i class="fa-solid fa-microchip"></i></div>
            <span>CPU</span>
        </a>
        <a href="{{ route('products.list', ['type' => 'GPU']) }}" class="cat-card">
            <div class="cat-icon"><i class="fa-solid fa-memory"></i></div>
            <span>GPU</span>
        </a>
        <a href="{{ route('products.list', ['type' => 'Monitor']) }}" class="cat-card">
            <div class="cat-icon"><i class="fa-solid fa-desktop"></i></div>
            <span>Monitor</span>
        </a>
    </div>

    <div class="cat-row-bottom">
        <a href="{{ route('products.list', ['type' => 'Mouse']) }}" class="cat-card">
            <div class="cat-icon"><i class="fa-solid fa-computer-mouse"></i></div>
            <span>Mouse</span>
        </a>
        <a href="{{ route('products.list', ['type' => 'Keyboard']) }}" class="cat-card">
            <div class="cat-icon"><i class="fa-solid fa-keyboard"></i></div>
            <span>Keyboard</span>
        </a>
    </div>
</section>

    {{-- REWORKED FEATURED PRODUCTS SECTION --}}
    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        <section id="featured-products" class="featured-section">
            <h2 class="featured-title">Featured Products</h2>

            <div class="featured-carousel-wrapper">
                <button class="carousel-btn prev" type="button" onclick="scrollFeatured(-1)">&#10094;</button>

                <div class="featured-carousel" id="featuredCarousel">
                    @foreach($featuredProducts as $product)
                        <div class="about-glass-card featured-card" style="padding: 15px; border-radius: 15px;">
                            
                            {{-- Image Area - FIXED HEIGHT FROM 60px TO 160px --}}
                            <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                                <div class="product-image-area" style="height: 3px; margin-bottom: 12px; background: var(--inner-bg); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-height: 130px; object-fit: contain;">
                                </div>
                                <span style="color: #4a90e2; font-size: 0.65rem; text-transform: uppercase; font-weight: 700;">{{ $product->type }}</span>
                                <h3 style="margin: 8px 0; font-size: 0.95rem; height: 2.6em; overflow: hidden; font-weight: 600; color: #fff;">{{ $product->name }}</h3>
                            </a>

                            <div style="margin-top: auto; padding-top: 10px; border-top: 1px solid rgba(255,255,255,0.05);">
                                <p style="font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 10px;">£{{ number_format($product->price, 2) }}</p>
                                
                                <button type="button" class="btn-bottleneck-glass" style="width: 100%; margin-bottom: 8px; padding: 6px; font-size: 0.75rem;" 
                                        onclick='openQuickView(@json($product))'>
                                    <i class="fa-solid fa-eye"></i> Quick View
                                </button>
                                
                                <form action="{{ route('basket.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn-gradient-add" style="width: 100%; padding: 10px; font-size: 0.8rem;">
                                        <i class="fa-solid fa-cart-shopping"></i> Add to Basket
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-btn next" type="button" onclick="scrollFeatured(1)">&#10095;</button>
            </div>
        </section>
    @endif

    <footer id="footer"><br><br></footer>
</main>

{{-- QUICK VIEW MODAL (Same as listing page for consistency) --}}
<div id="quickview-modal" class="modal-overlay" onclick="closeQuickView(event)">
    <div class="modal-content card" style="max-width: 800px; display: flex; gap: 30px; flex-direction: row; padding: 30px;" onclick="event.stopPropagation()">
        <div style="flex: 1; background: var(--inner-bg); border-radius: 12px; display: flex; align-items: center; justify-content: center; padding: 20px; overflow: hidden;">
            <img id="qv-img" src="" style="max-width: 100%; max-height: 300px; object-fit: contain; transition: 0.5s;">
        </div>
        <div style="flex: 1; text-align: left;">
            <span id="qv-type" class="category-label" style="font-size: 0.7rem;"></span>
            <h2 id="qv-name" style="margin: 10px 0;"></h2>
            <div id="qv-price" class="price-display" style="font-size: 1.8rem; margin: 10px 0; color: #fff;"></div>
            <p id="qv-desc" style="font-size: 0.9rem; color: var(--text-sub); height: 100px; overflow-y: auto;"></p>
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <a id="qv-link" href="" class="btn-bottleneck-glass" style="flex: 1; text-decoration: none; display: flex; align-items: center; justify-content: center;">Full Details</a>
                <form action="{{ route('basket.add') }}" method="POST" style="flex: 1;">
                    @csrf
                    <input type="hidden" name="product_id" id="qv-id" value="">
                    <button type="submit" class="btn-gradient-add" style="width: 100%; height: 45px;">Add to Basket</button>
                </form>
            </div>
        </div>
        <button onclick="closeQuickView(event)" style="position: absolute; top: 15px; right: 15px; background: none; border: none; color: #fff; cursor: pointer; opacity: 0.5;"><i class="fa-solid fa-xmark"></i></button>
    </div>
</div>

<script>
    // --- CAROUSEL LOGIC ---
    function scrollFeatured(direction) {
        const carousel = document.getElementById('featuredCarousel');
        const scrollAmount = 305 * 3; // Card width + gap
        carousel.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
    }

    // --- QUICK VIEW LOGIC ---
    function openQuickView(product) {
        document.getElementById('qv-img').src = product.image_url;
        document.getElementById('qv-name').innerText = product.name;
        document.getElementById('qv-type').innerText = product.type.toUpperCase();
        document.getElementById('qv-price').innerText = '£' + parseFloat(product.price).toFixed(2);
        document.getElementById('qv-desc').innerText = product.description;
        document.getElementById('qv-id').value = product.id;
        document.getElementById('qv-link').href = "/products/" + product.id;
        document.getElementById('quickview-modal').classList.add('show');
    }

    function closeQuickView(event) {
        document.getElementById('quickview-modal').classList.remove('show');
    }

    // --- THEME INITIALIZATION ---
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) { document.documentElement.setAttribute('data-theme', currentTheme); }

    function toggleTheme() {
        const html = document.documentElement;
        const current = html.getAttribute('data-theme');
        const next = current === 'light' ? 'dark' : 'light';
        html.setAttribute('data-theme', next);
        localStorage.setItem('theme', next);
    }
</script>

@endsection