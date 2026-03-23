@extends('layouts.main')

@section('title', 'Your Basket')

@section('content')

<link rel="stylesheet" href="{{ asset('css/checkoutstyle.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  /* ── Basket-specific overrides ── */
  .basket-page-grid {
    display: grid;
    grid-template-columns: 1.6fr 1fr;
    gap: 30px;
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
  }

  .basket-header {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--text-main);
  }

  /* Cart rows */
  .cart-row {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 18px 0;
    border-bottom: 1px solid var(--glass-border);
  }

  .cart-row:last-child { border-bottom: none; }

  .cart-row-img {
    width: 78px;
    height: 78px;
    object-fit: contain;
    border-radius: 8px;
    background: rgba(255,255,255,0.04);
    flex-shrink: 0;
    border: 1px solid var(--glass-border);
    padding: 4px;
  }

  .cart-row-info {
    flex: 1;
    min-width: 0;
  }

  .cart-row-name {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .cart-row-price {
    font-size: 0.85rem;
    color: var(--text-sub);
  }

  /* Qty stepper */
  .qty-stepper {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .qty-stepper button {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 1px solid var(--glass-border);
    background: var(--glass-bg);
    color: var(--text-main);
    cursor: pointer;
    font-size: 1rem;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
  }

  .qty-stepper button:hover { background: rgba(74,144,226,0.2); }

  .qty-display {
    min-width: 28px;
    text-align: center;
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--text-main);
  }

  /* Line total */
  .cart-row-total {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-main);
    white-space: nowrap;
    min-width: 68px;
    text-align: right;
  }

  /* Remove button */
  .btn-remove {
    background: none;
    border: none;
    color: #ff5c5c;
    cursor: pointer;
    font-size: 1rem;
    padding: 6px;
    border-radius: 6px;
    transition: background 0.2s;
  }

  .btn-remove:hover { background: rgba(255,92,92,0.12); }

  /* Summary card */
  .basket-summary-card {
    position: sticky;
    top: 80px;
    height: fit-content;
  }

  .summary-title {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--text-main);
  }

  .summary-line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 0.95rem;
    color: var(--text-sub);
  }

  .summary-line.grand {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-main);
    margin-top: 18px;
    padding-top: 18px;
    border-top: 1px solid var(--glass-border);
  }

  .btn-checkout {
    width: 100% !important;
    padding: 10px !important;
    margin-top: 22px !important;
    background: var(--btn-grad) !important;
    border: none !important;
    border-radius: 8px !important;
    color: white !important;
    font-size: 0.9rem !important;
    font-weight: 600 !important;
    line-height: 1.5 !important;
    box-sizing: border-box !important;
    cursor: pointer !important;
    text-align: center !important;
    text-decoration: none !important;
    display: block !important;
    transition: opacity 0.2s, transform 0.2s;
  }

  .btn-checkout:hover { opacity: 0.88; transform: translateY(-1px); }

  .btn-clear {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background: none;
    border: 1px solid var(--glass-border);
    border-radius: 8px;
    color: var(--text-sub);
    font-size: 0.9rem;
    cursor: pointer;
    transition: border-color 0.2s, color 0.2s;
    text-decoration: none;
    display: block;
    text-align: center;
  }

  .btn-clear:hover { border-color: #ff5c5c; color: #ff5c5c; }

  .basket-empty {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-sub);
  }

  .basket-empty i {
    font-size: 3rem;
    margin-bottom: 16px;
    opacity: 0.4;
  }

  .basket-empty p { font-size: 1rem; margin-bottom: 20px; }

  .btn-browse {
    display: inline-block;
    padding: 12px 28px;
    background: var(--btn-grad);
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: opacity 0.2s;
  }

  .btn-browse:hover { opacity: 0.85; }

  @media (max-width: 768px) {
    .basket-page-grid { grid-template-columns: 1fr; }
    .basket-summary-card { position: static; }
  }
</style>

@php
  $netTotal = 0;
  foreach ($items as $item) {
      $netTotal += $item->line_total;
  }
  $vat = $netTotal * 0.20;
  $grand = $netTotal + $vat;
@endphp

<div class="basket-page-grid">

  {{-- Left: Cart Items --}}
  <div>
    <h2 class="basket-header">
      <i class="fa-solid fa-cart-shopping" style="margin-right:10px; opacity:0.7;"></i>
      Your Basket
    </h2>

    <div class="card">

      @if($items->isEmpty())
        <div class="basket-empty">
          <i class="fa-solid fa-box-open"></i>
          <p>Your basket is empty.</p>
          <a href="{{ route('products.list') }}" class="btn-browse">Browse Products</a>
        </div>

      @else
        @foreach($items as $item)
          @php $product = $item->product; @endphp

          <div class="cart-row" data-item-id="{{ $item->id }}">

            {{-- Image --}}
            <img src="{{ $product->image_url }}"
                 alt="{{ $product->name }}"
                 class="cart-row-img"
                 onerror="this.style.opacity='0'">

            {{-- Info --}}
            <div class="cart-row-info">
              <div class="cart-row-name">{{ $product->name }}</div>
              <div class="cart-row-price">£{{ number_format($product->price, 2) }} each</div>

              {{-- Qty stepper --}}
              <div class="qty-stepper" style="margin-top:10px;">
                <button type="button" class="qty-minus" data-id="{{ $item->id }}">−</button>
                <span class="qty-display" id="qty-{{ $item->id }}">{{ $item->quantity }}</span>
                <button type="button" class="qty-plus" data-id="{{ $item->id }}" data-price="{{ $product->price }}">+</button>
              </div>
            </div>

            {{-- Line total --}}
            <div class="cart-row-total" id="line-{{ $item->id }}">
              £{{ number_format($item->line_total, 2) }}
            </div>

            {{-- Remove --}}
            <form action="{{ route('basket.remove', $item->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-remove" title="Remove">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </form>

          </div>
        @endforeach
      @endif

    </div>
  </div>

  {{-- Right: Summary --}}
  @if(!$items->isEmpty())
  <div class="basket-summary-card">
    <div class="card">
      <p class="summary-title">Order Summary</p>

      <div class="summary-line">
        <span>Subtotal</span>
        <span id="summary-net">£{{ number_format($netTotal, 2) }}</span>
      </div>
      <div class="summary-line">
        <span>VAT (20%)</span>
        <span id="summary-vat">£{{ number_format($vat, 2) }}</span>
      </div>
      <div class="summary-line grand">
        <span>Total</span>
        <span id="summary-grand">£{{ number_format($grand, 2) }}</span>
      </div>

      <a href="{{ route('checkout') }}" class="btn-checkout">
        Proceed to Checkout &nbsp;<i class="fa-solid fa-arrow-right"></i>
      </a>

      <form action="{{ route('basket.clear') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-clear">Clear Basket</button>
      </form>
    </div>
  </div>
  @endif

</div>

<script>
const CSRF = '{{ csrf_token() }}';

function updateQty(id, newQty) {
  return fetch(`/basket/update/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
    body: JSON.stringify({ quantity: newQty })
  }).then(r => r.json());
}

// Plus/minus buttons
document.querySelectorAll('.qty-plus, .qty-minus').forEach(btn => {
  btn.addEventListener('click', function () {
    const id = this.dataset.id;
    const display = document.getElementById(`qty-${id}`);
    let qty = parseInt(display.textContent);

    if (this.classList.contains('qty-plus')) qty += 1;
    else if (qty > 1) qty -= 1;

    display.textContent = qty;

    updateQty(id, qty).then(data => {
      if (data.success) location.reload();
    });
  });
});
</script>

@endsection