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
   {{-- Featured products preview --}}
    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
    <section id="featured-products" style="margin-top: 3rem;">
        <h2 style="text-align:center;">Featured Products</h2>

    <div class="landing-products-row">
        @foreach($featuredProducts as $product)
            <div class="landing-product-card">
              <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                 class="landing-product-img" />

             <h4 class="landing-product-title">{{ $product->name }}</h4>
             <p class="landing-product-price">£{{ number_format($product->price, 2) }}</p>

             <a href="{{ route('products.list', ['type' => $product->type]) }}" class="landing-button">
                 View more {{ $product->type }}
             </a>
            </div>
         @endforeach
    </div>
    </section>
  
    @endif



    <footer id="footer">
        <br><br>
    </footer>

</main>

@endsection