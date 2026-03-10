@extends('layouts.main')

@section('title', 'CoreComponents')

@section('content')

<link rel="stylesheet" href="/css/samistyles.css">

<main>

    <section id="welcome-hero">
        <div class="hero-content">
            <h1>Welcome to CoreComponents!</h1>
            <h5>
                Your ultimate destination for high-performance PC parts and upgrades.
                We provide everything you need to power your build.
            </h5>
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
            <a href="{{ route('products.list', ['type' => 'cpu']) }}" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-microchip"></i></div>
                <span>CPU</span>
            </a>
            <a href="{{ route('products.list', ['type' => 'gpu']) }}" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-memory"></i></div>
                <span>GPU</span>
            </a>
            <a href="{{ route('products.list', ['type' => 'monitor']) }}" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-desktop"></i></div>
                <span>Monitor</span>
            </a>
        </div>

        <div class="cat-row-bottom">
            <a href="{{ route('products.list', ['type' => 'mouse']) }}" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-computer-mouse"></i></div>
                <span>Mouse</span>
            </a>
            <a href="{{ route('products.list', ['type' => 'keyboard']) }}" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-keyboard"></i></div>
                <span>Keyboard</span>
            </a>
        </div>
    </section>

    {{-- Featured products preview --}}
    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        <section id="featured-products" class="featured-section">
            <h2 class="featured-title">Featured Products</h2>

            <div class="featured-carousel-wrapper">
                <button class="carousel-btn prev" type="button" onclick="scrollFeatured(-1)">
                    &#10094;
                </button>

                <div class="featured-carousel" id="featuredCarousel">
                    @foreach($featuredProducts as $product)
                        <div class="landing-product-card featured-card">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="landing-product-img" />

                            <h4 class="landing-product-title">{{ $product->name }}</h4>
                            <p class="landing-product-price">£{{ number_format($product->price, 2) }}</p>

                            <a href="{{ route('products.show', $product->id) }}" class="landing-button">
                                View {{ $product->type }}
                            </a>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-btn next" type="button" onclick="scrollFeatured(1)">
                    &#10095;
                </button>
            </div>
        </section>
    @endif

    {{-- Products by category (mini sections) --}}
    @if(isset($categories) && isset($productsByCategory))
        @foreach($categories as $cat)
            @php $catProducts = $productsByCategory[$cat] ?? collect(); @endphp

            @if($catProducts->count() > 0)
                <section style="margin-top: 3rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center; max-width:1100px; margin:0 auto;">
                        <h2 style="margin:0;">{{ ucfirst($cat) }}</h2>
                        <a href="{{ route('products.list', ['type' => $cat]) }}" class="landing-button">
                            View more {{ $cat }}
                        </a>
                    </div>

                    <div class="landing-products-row">
                        @foreach($catProducts as $product)
                            <div class="landing-product-card">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="landing-product-img" />

                                <h4 class="landing-product-title">{{ $product->name }}</h4>
                                <p class="landing-product-price">£{{ number_format($product->price, 2) }}</p>

                                <a href="{{ route('products.show', $product->id) }}" class="landing-button">
                                    View {{ $product->type }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    <footer id="footer">
        <br><br>
    </footer>

</main>

<script>
    function scrollFeatured(direction) {
        const carousel = document.getElementById('featuredCarousel');
        const card = carousel.querySelector('.featured-card');

        if (!card) return;

        const carouselStyles = window.getComputedStyle(carousel);
        const gap = parseInt(carouselStyles.columnGap || carouselStyles.gap || 0);
        const cardWidth = card.offsetWidth;

        const scrollAmount = (cardWidth + gap) * 3;

        carousel.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
</script>

@endsection