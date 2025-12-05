@extends('layouts.main')

@section('title', 'Checkout')

@section('content')
<main class="checkout-page">

    <section id="checkout-items">
        <h2>Your Basket</h2>
        <!-- Items will be injected here by JavaScript -->
    </section>

    <aside class="checkout-summary">
        <h2>Summary</h2>
        <p id="subtotal">Subtotal: £0.00</p>
        <p id="shipping">Shipping: £2.99</p>
        <p id="total"><strong>Total: £2.99</strong></p>

        <button class="checkout-btn">Proceed to Payment</button>
        <button class="clear-cart">Clear Cart</button>
    </aside>

</main>

{{-- Checkout JS --}}
<script src="/js/checkout.js"></script>
@endsection