@extends('layouts.frontend')

@section('content')

<h1>{{$product->name}}</h1>
<img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
<p class="card-text text-success fw-bold">
    ${{ number_format($product->price, 2) }}
</p>
<a href="{{ route('products.show', $product->id) }}" 
    class="btn btn-primary mt-auto">
    Buy Now
</a>
@endsection