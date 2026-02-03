@extends('layouts.main')

@section('title', 'CoreComponents')

@section('content')

<link rel="stylesheet" href="/css/samistyles.css">

<main>

    <section id="main-thumbnail">
        <img class="main-thumbnail" src="/images/main-thumbnail.png" alt="Main Thumbnail">
    </section>

    <section id="welcome-text">
        <h1>Welcome to CoreComponents!</h1>
        <br><br>
        <h5>
            Your ultimate destination for high-performance PC parts and upgrades.
            We provide everything you need to power your build. Click below to explore our stock 👀👇
        </h5>
    </section>

    <section>
        <a id="welcome-button" href="{{ route('products.list') }}" class="button">Our Stock</a>
    </section>

   {{-- Featured products preview --}}
    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
    <section id="featured-products" style="margin-top: 3rem;">
        <h2 style="text-align:center;">Featured Products</h2>

        <div style="display:flex; flex-wrap:wrap; gap:1.5rem; justify-content:center; margin-top:1.5rem;">
            @foreach($featuredProducts as $product)
                <div style="width:220px; background:#1e1e1e; border:1px solid #333; border-radius:8px; padding:1rem; text-align:center;">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                         style="width:100%; height:140px; object-fit:contain;" />

                    <h4 style="margin-top:0.75rem;">{{ $product->name }}</h4>
                    <p style="margin:0.5rem 0;">£{{ number_format($product->price, 2) }}</p>

                    <a href="{{ route('products.list', ['type' => $product->type]) }}" class="button">
                        View more {{ $product->type }}
                    </a>
                </div>
            @endforeach
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
                    <a href="{{ route('products.list', ['type' => $cat]) }}" class="button">
                        View all
                    </a>
                </div>

                <div style="display:flex; flex-wrap:wrap; gap:1.5rem; justify-content:center; margin-top:1.5rem;">
                    @foreach($catProducts as $product)
                        <div style="width:220px; background:#1e1e1e; border:1px solid #333; border-radius:8px; padding:1rem; text-align:center;">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                 style="width:100%; height:140px; object-fit:contain;" />

                            <h4 style="margin-top:0.75rem;">{{ $product->name }}</h4>
                            <p style="margin:0.5rem 0;">£{{ number_format($product->price, 2) }}</p>

                            <a href="{{ route('products.list', ['type' => $cat]) }}" class="button">
                                Browse {{ $cat }}
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

@endsection