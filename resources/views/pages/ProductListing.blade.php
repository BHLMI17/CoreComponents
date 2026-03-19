@extends('layouts.main')

@section('title', 'Product Listing')

@section('content')

<link rel="stylesheet" href="/css/seanstyles.css">
<script src="/js/seanscript.js"></script>

<section class="filter-bar">

    {{-- Search box (controller reads ts as q so if u needa fw sum shi use q) --}}
   <form method="GET" action="{{ route('products.list') }}" class="filter-bar">
    <div class="filter-group">
        <label for="q">Search:</label>
        <input id="q" name="q" type="text" value="{{ request('q') }}" placeholder="Search products..." />
    </div>

    {{-- Category dropdown (DB column is type) --}}
    <div class="filter-group">
        <label for="type">Category:</label>
        <select id="type" name="type">
            <option value="">All</option>
            @foreach ($types as $t)
                <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>
                    {{ ucfirst($t) }}
                </option>
            @endforeach
        </select>
    </div>

     {{-- Min/Max price (controller reads min_price + max_price) --}}
    <div class="filter-group">
        <label>Price Range:</label>
        <input type="number" step="0.01" name="min_price" placeholder="Min" value="{{ request('min_price') }}" />
        <input type="number" step="0.01" name="max_price" placeholder="Max" value="{{ request('max_price') }}" />
    </div>

    {{-- Sort dropdown (newest / price asc / price desc) --}}
    <div class="filter-group">
        <label for="sort">Sort:</label>
        <select id="sort" name="sort">
            <option value="newest" {{ request('sort','newest') === 'newest' ? 'selected' : '' }}>Newest</option>
            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low → High</option>
            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High → Low</option>
        </select>
    </div>

     {{-- Submit + reset --}}
    <button type="submit" class="apply-filter">Apply Filters</button>

    <a href="{{ route('products.list') }}" class="apply-filter" style="text-decoration:none;">
        Reset
    </a>
</form>
</section>


{{-- Success Toast Notification --}}
@if(session('success'))
    <div class="success-toast">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<main class="product-listing">


    {{-- Show "No results" msg if search finds nothin --}}
    @if($products->count() === 0)
        <div class="no-results-msg" style="text-align:center; padding:2rem; width:100%;">
            <h3>No results found{{ isset($query) ? ' for "' . $query . '"' : '' }}</h3>
            <p>Try checking your spelling or using different keywords.</p>
        </div>
    @else

        {{-- Loop thru products normally --}}
        {{-- Loop thru products normally --}}
@foreach ($products as $product)
    <div class="product-card">
        
        {{-- --- ADD THIS LINK START --- --}}
       <a href="{{ route('products.show', $product->id) }}">
            <img 
                src="{{ $product->image_url }}"
                alt="{{ $product->name }}"
                class="{{ $product->type === 'mouse' || $product->type === 'keyboard' ? 'product-img' : 'product-img2' }}"
            />

            <h3 class="product-title">{{ $product->name }}</h3>
        </a>
        {{-- --- ADD THIS LINK END --- --}}

        <p class="product-price">£{{ number_format($product->price, 2) }}</p>

        {{-- Add to Basket Form --}}
        <form action="{{ route('basket.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="add-to-cart">Add to Basket</button>
        </form>
    </div>
@endforeach
        
       
    @endif

</main>

@endsection