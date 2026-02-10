@extends('layouts.main')

@section('title', 'Checkout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/checkoutstyle.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="container">

    <div class="checkout-form">
        <h2>Checkout</h2>

        <form action="#" method="POST" id="checkoutForm" novalidate>
            <div class="card form-section">
                <h3>Contact Information</h3>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="e.g. user@example.com" required>
                </div>
            </div>

            <div class="card form-section">
                <h3>Shipping Address</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" placeholder="John" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" placeholder="Doe" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" placeholder="123 Tech Lane" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" placeholder="Birmingham" required>
                    </div>
                    <div class="form-group">
                        <label>Post Code</label>
                        <input type="text" placeholder="B1 1AA" required>
                    </div>
                </div>
            </div>

            <div class="card form-section">
                <h3>Payment Details</h3>

                <div class="payment-methods-grid">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="card" checked onclick="togglePayment('card')">
                        <div class="payment-box">
                            <i class="fa-regular fa-credit-card"></i>
                            <span>Card</span>
                        </div>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="paypal" onclick="togglePayment('paypal')">
                        <div class="payment-box">
                            <i class="fa-brands fa-paypal"></i>
                            <span>PayPal</span>
                        </div>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="googlepay" onclick="togglePayment('googlepay')">
                        <div class="payment-box">
                            <i class="fa-brands fa-google-pay"></i>
                            <span>Google Pay</span>
                        </div>
                    </label>
                </div>

                <div id="card-fields" class="payment-dynamic-content">
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="text" placeholder="MM/YY">
                        </div>
                        <div class="form-group">
                            <label>CVC</label>
                            <input type="text" placeholder="123">
                        </div>
                    </div>
                </div>

                <div id="paypal-fields" class="payment-dynamic-content hidden">
                    <button type="button" class="btn-alt-payment btn-paypal">
                        <i class="fa-brands fa-paypal"></i> Pay with PayPal
                    </button>
                </div>

                <div id="googlepay-fields" class="payment-dynamic-content hidden">
                    <button type="button" class="btn-alt-payment btn-gpay">
                        <i class="fa-brands fa-google-pay"></i> Pay with Google Pay
                    </button>
                </div>

            </div>
        </form>
    </div>

{{-- Order Summary --}}
<div class="order-summary">
    <h2>Order Summary</h2>
    <div class="card">

        @if($items->isEmpty())
            <p style="text-align:center; padding:1rem; opacity:0.7;">
                Your basket is empty.
            </p>
        @else
            @php 
                $netTotal = 0; 
            @endphp

            @foreach($items as $item)
                @php
                    $product = $item->product;
                    $lineTotal = $item->line_total;
                    $netTotal += $lineTotal;
                @endphp

                <div class="checkout-item">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="checkout-item-image">

                    <div class="checkout-item-details">
                        <h4>{{ $product->name }}</h4>
                        <p>Price: £{{ number_format($product->price, 2) }}</p>

                        {{-- Auto-update quantity --}}
                        <label>Quantity:</label>
                        <input 
                            type="number"
                            value="{{ $item->quantity }}"
                            min="1"
                            class="qty-input"
                            data-id="{{ $item->id }}"
                            style="width:60px;"
                        >

                        {{-- Remove Item --}}
                        <form action="{{ route('basket.remove', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-small btn-danger" 
                                style="background:none; border:none; color:#ff4d4d; cursor:pointer;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>

                        <p>Line Total: £{{ number_format($lineTotal, 2) }}</p>
                    </div>
                </div>
            @endforeach

            <hr>

            {{-- NET TOTAL --}}
            <div class="checkout-total">
                <strong>Net Total (before VAT):</strong>
                £{{ number_format($netTotal, 2) }}
            </div>

            {{-- VAT --}}
            <div class="checkout-total">
                <strong>VAT (20%):</strong>
                £{{ number_format($netTotal * 0.20, 2) }}
            </div>

            {{-- TOTAL WITH VAT --}}
            <div class="checkout-total">
                <strong>Total (after VAT):</strong>
                £{{ number_format($netTotal + ($netTotal * 0.20), 2) }}
            </div>

        @endif

    </div>
</div>
{{--  Prototype Model --}}
<div id="prototype-modal" class="modal-overlay">
    <div class="modal-content card">
        <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem; color: #ffc439; margin-bottom: 20px;"></i>
        <h3 style="color: var(--text-main);">Prototype Version</h3>
        <p style="color: var(--text-sub); margin-bottom: 20px;">
            This is a demonstration of the CoreComponents checkout flow. No actual payment will be processed.
        </p>
        <button class="btn-checkout modal-btn" onclick="closePrototypeModal()">Return</button>
    </div>
</div>

<script>
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) {
        document.documentElement.setAttribute('data-theme', currentTheme);
    }

    function toggleTheme() {
        const html = document.documentElement;
        const current = html.getAttribute('data-theme');

        if (current === 'light') {
            html.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        } else {
            html.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
    }

    function togglePayment(method) {
        const cardFields = document.getElementById('card-fields');
        const paypalFields = document.getElementById('paypal-fields');
        const googleFields = document.getElementById('googlepay-fields');

        cardFields.classList.add('hidden');
        paypalFields.classList.add('hidden');
        googleFields.classList.add('hidden');

        if (method === 'card') cardFields.classList.remove('hidden');
        if (method === 'paypal') paypalFields.classList.remove('hidden');
        if (method === 'googlepay') googleFields.classList.remove('hidden');
    }

    function showPrototypeModal() {
        document.getElementById('prototype-modal').classList.add('show');
    }

    function closePrototypeModal() {
        document.getElementById('prototype-modal').classList.remove('show');
    }

    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        const tooltip = document.createElement('div');
        tooltip.className = 'custom-tooltip';
        input.parentElement.appendChild(tooltip);

        input.addEventListener('invalid', e => {
            e.preventDefault();
            tooltip.textContent = input.validationMessage;
            tooltip.classList.add('active');
        });

        input.addEventListener('input', () => {
            tooltip.classList.remove('active');
        });
    });
</script>

@endsection

<script>
document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('change', function () {
        const id = this.dataset.id;
        const quantity = this.value;

        fetch(`/basket/update/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Refresh totals + line totals
            }
        });
    });
});
</script>