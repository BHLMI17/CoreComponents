




@section('content')
{{-- resources/views/frontend/index.blade.php --}}
@extends('layouts.frontend')
<div class="container mt-5">
    <h2 class="mb-4">Our Products</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    {{-- Product Image --}}
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">

                    <div class="card-body d-flex flex-column">
                        {{-- Product Name --}}
                        <h5 class="card-title">{{ $product->name }}</h5>

                        {{-- Product Price --}}
                        <p class="card-text text-success fw-bold">
                            ${{ number_format($product->price, 2) }}
                        </p>

                        {{-- Product Stock --}}

                        
                        @if($product->stock > 0)
                        <p class="card-text text-success fw-bold">
                            <h5>Remaining Stock: {{ $product->stock }}</h5>
                        </p>
                        {{-- Link to purchase page --}}
                        <a href="{{ route('products.show', $product->id) }}" 
                           class="btn btn-primary mt-auto">
                            Buy Now
                        </a>
                    @else
                        <p class="card-text text-success fw-bold">
                            <h5>Out of Stock</h5>
                        </p>
                    @endif
                    

                

                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
