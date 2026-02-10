@extends('layouts.main')

@section('title', 'Search Results')

@section('content')

<h2>Search results for "{{ $query }}"</h2>

@if($products->isEmpty())
    <p>No products found.</p>
@else
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>£{{ number_format($product->price, 2) }}</p>
                <a href="{{ route('products.show', $product->id) }}" class="btn">View</a>
            </div>
        @endforeach
    </div>
@endif

@endsection
