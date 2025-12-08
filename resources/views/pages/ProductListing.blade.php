@extends('layouts.main')

@section('title', 'Product Listing')

@section('content')

<link rel="stylesheet" href="/css/seanstyles.css">
<script src="/js/seanscript.js"></script>

<section class="filter-bar">

    <!-- Category Dropdown -->
    <div class="filter-group">
        <label for="category">Category:</label>
        <select id="category" name="category">
            <option value="">All</option>
            <option value="mouse">Mice</option>
            <option value="keyboard">Keyboards</option>
            <option value="monitor">Monitors</option>
            <option value="accessories">Accessories</option>
        </select>
    </div>

    <!-- Price Range -->
    <div class="filter-group">
        <label for="price">Price Range:</label>
        <input type="range" id="price" name="price" min="0" max="400" step="10" />
        <span id="price-value">£0 - £400</span>
    </div>

    <!-- Compatibility Checkbox -->
    <div class="filter-group">
        <label>Compatibility:</label>
        <div class="checkboxes">
            <label><input type="checkbox" name="compatibility" value="windows" /> Windows</label>
            <label><input type="checkbox" name="compatibility" value="mac" /> Mac</label>
            <label><input type="checkbox" name="compatibility" value="linux" /> Linux</label>
        </div>
    </div>

    <button class="apply-filter">Apply Filters</button>

</section>

<main class="product-listing">

    {{-- ✅ Show "No results" message if search returned nothing --}}
    @if($products->isEmpty())
        <div class="no-results-msg" style="text-align:center; padding:2rem; width:100%;">
            <h3>No results found{{ isset($query) ? ' for "' . $query . '"' : '' }}</h3>
            <p>Try checking your spelling or using different keywords.</p>
        </div>
    @else

        {{-- ✅ Loop through products normally --}}
        @foreach ($products as $product)
            <div class="product-card">
                <img 
                    src="{{ $product->image_url }}"
                    alt="{{ $product->name }}"
                    class="{{ $product->type === 'mouse' || $product->type === 'keyboard' ? 'product-img' : 'product-img2' }}"
                />

                <h3 class="product-title">{{ $product->name }}</h3>

                <p class="product-price">£{{ number_format($product->price, 2) }}</p>

                {{-- ✅ Add to Basket Form (Basket Model) --}}
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