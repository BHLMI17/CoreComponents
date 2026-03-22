@extends('layouts.main')

@section('title', 'CoreComponents')

@section('content')
<link rel="stylesheet" href="/css/samistyles.css">
<link rel="stylesheet" href="{{ asset('css/productoverview.css') }}">

<style>
    .featured-section {
        margin-top: 5rem;
        padding: 3rem 2rem 4rem;
    }

    .featured-title {
    margin-bottom: 3rem;
    text-align: center;
    font-size: 3rem;
    font-weight: 800;
    letter-spacing: -1.5px;
}

    .featured-carousel-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 20px;
        max-width: 1400px;
        margin: 0 auto;
        overflow: visible;
    }

    .featured-carousel {
        display: flex;
        gap: 2rem;
        overflow-x: hidden;
        overflow-y: visible;
        width: 100%;
        padding: 0.5rem 0 2rem 0;
        scroll-behavior: smooth;
        align-items: flex-start;
    }

    .featured-carousel::-webkit-scrollbar {
        display: none;
    }

    .featured-card {
        flex: 0 0 calc((100% - 4rem) / 3) !important;
        max-width: calc((100% - 4rem) / 3) !important;
        min-width: calc((100% - 4rem) / 3) !important;
        box-sizing: border-box;
        margin-bottom: 0 !important;
        display: flex;
    }

    .featured-card .about-glass-card {
        width: 100%;
        margin-bottom: 0 !important;
    }

    .carousel-btn {
        flex-shrink: 0;
    }
</style>

<main>
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

    <section id="category-grid-section">
        <div class="category-header">
            <h1>Shop by Category</h1>
            <h5>find the perfect component for your build</h5>
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

    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        <section id="featured-products" class="featured-section">
         <h2 class="featured-title">Featured Products</h2>

            <div class="featured-carousel-wrapper">
             <button class="carousel-btn prev" type="button" onclick="scrollFeatured(-1)">&#10094;</button>

             <div class="featured-carousel" id="featuredCarousel">
                  @foreach($featuredProducts as $product)
                     <div class="featured-card">
                         <div class="about-glass-card" style="padding: 22px; display: flex; flex-direction: column; min-height: 620px; border-radius: 15px; position: relative; margin-bottom: 0; text-align: center;">

                               @if($product->created_at->diffInDays() < 7)
                                   <div class="product-badge badge-new">New</div>
                              @elseif(($product->reviews->avg('rating') ?: 0) >= 4.8)
                                    <div class="product-badge badge-hot">Best Seller</div>
                             @endif

                                <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; color: inherit; flex-grow: 1; display: flex; flex-direction: column;">
                                 <div class="product-image-area" style="min-height: 220px; height: 220px; margin-bottom: 18px; background: var(--inner-bg); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                     <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-width: 90%; max-height: 170px; object-fit: contain;">
                                 </div>
                                
                                 <div style="display: flex; justify-content: center; align-items: center; gap: 16px; margin-bottom: 14px;">
                                     <span style="color: #4a90e2; font-size: 0.8rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">
                                            {{ $product->type }}
                                     </span>
                                     <div style="color: #FFD700; font-size: 0.9rem; display: flex; align-items: center; gap: 4px;">
                                           <i class="fa-solid fa-star"></i> 
                                           <span style="color: var(--text-sub); font-size: 0.9rem;">{{ number_format($product->reviews->avg('rating') ?: 0, 1) }}</span>
                                     </div>
                                 </div>

                                <h3 style="margin: 0 0 18px 0; font-size: 1.25rem; line-height: 1.45; min-height: 3.2em; display: flex; align-items: center; justify-content: center; text-align: center; font-weight: 700; padding: 0 10px;">
                                    {{ $product->name }}
                                </h3>
                            </a>

                            <div style="margin-top: auto; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px;">
                                <p style="font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 18px; text-align: center;">
                                    £{{ number_format($product->price, 2) }}
                                </p>
                                
                                <div style="display: flex; flex-direction: column; gap: 12px;">
                                    <button type="button" class="btn-bottleneck-glass" style="width: 100%; padding: 12px; font-size: 0.95rem; font-weight: 600;" onclick='openQuickView(@json($product))'>
                                        <i class="fa-solid fa-eye"></i> Quick View
                                    </button>
                                    
                                    <form action="{{ route('basket.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn-gradient-add" style="width: 100%; padding: 14px; font-size: 1rem; display: flex; align-items: center; justify-content: center; gap: 8px; font-weight: 700;">
                                            <i class="fa-solid fa-cart-shopping"></i> Add to Basket
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-btn next" type="button" onclick="scrollFeatured(1)">&#10095;</button>
         </div>
     </section>
    @endif

<div id="quickview-modal" class="modal-overlay" onclick="closeQuickView(event)">
    <div class="modal-content card" style="max-width: 800px; display: flex; gap: 30px; flex-direction: row; padding: 30px;" onclick="event.stopPropagation()">
        <div style="flex: 1; background: var(--inner-bg); border-radius: 12px; display: flex; align-items: center; justify-content: center; padding: 20px;">
            <img id="qv-img" src="" style="max-width: 100%; max-height: 350px; object-fit: contain;">
        </div>

        <div style="flex: 1.2; text-align: left;">
            <span id="qv-type" class="category-label" style="font-size: 0.7rem;"></span>
            <h2 id="qv-name" style="margin: 10px 0; font-size: 1.8rem;"></h2>
            <div id="qv-price" class="price-display" style="font-size: 2rem; margin: 15px 0; color: #fff;"></div>
            
            <p id="qv-desc" style="font-size: 0.9rem; color: var(--text-sub); line-height: 1.6; margin-bottom: 25px; height: 120px; overflow-y: auto; padding-right: 10px;"></p>

            <div style="display: flex; gap: 12px;">
                <a id="qv-link" href="" class="btn-bottleneck-glass" style="flex: 1; text-decoration: none; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">Full Details</a>
                <form action="{{ route('basket.add') }}" method="POST" style="flex: 1.2;">
                    @csrf
                    <input type="hidden" name="product_id" id="qv-id" value="">
                    <button type="submit" class="btn-gradient-add" style="width: 100%; height: 50px;">Add to Basket</button>
                </form>
            </div>
        </div>
        
        <button onclick="document.getElementById('quickview-modal').classList.remove('show')" 
            style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #fff; cursor: pointer; font-size: 1.5rem; opacity: 0.5;">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>

<script>
    function scrollFeatured(direction) {
        const carousel = document.getElementById('featuredCarousel');
        carousel.scrollBy({
            left: direction * carousel.clientWidth,
            behavior: 'smooth'
        });
    }

    function openQuickView(product) {
        document.getElementById('qv-img').src = product.image_url;
        document.getElementById('qv-name').innerText = product.name;
        document.getElementById('qv-type').innerText = product.type.toUpperCase();
        document.getElementById('qv-price').innerText = '£' + parseFloat(product.price).toFixed(2);
        document.getElementById('qv-desc').innerText = product.description;
        document.getElementById('qv-id').value = product.id;
        document.getElementById('qv-link').href = "/product/" + product.id;
        document.getElementById('quickview-modal').classList.add('show');
    }

    function closeQuickView(event) {
        document.getElementById('quickview-modal').classList.remove('show');
    }
</script>

@endsection