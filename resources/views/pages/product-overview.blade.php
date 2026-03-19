@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/productoverview.css') }}">

{{-- Success Toast Notification --}}
@if(session('success'))
    <div class="success-toast card">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="product-container">
    
    {{-- HERO SECTION --}}
    <div class="product-hero-card">
        <div class="product-image-area">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        </div>

        <div class="product-info-area">
            <span class="category-label">{{ ucfirst($product->type) }}</span>
            <h1>{{ $product->name }}</h1>
            
            <div class="stock-status">
                <span class="{{ $product->stock > 0 ? 'in-stock-pill' : 'out-stock-pill' }}">
                    @if($product->stock > 0)
                        <i class="fa-solid fa-check"></i> In Stock
                    @else
                        <i class="fa-solid fa-xmark"></i> Out of Stock
                    @endif
                </span>
            </div>

            <div class="price-display">£{{ number_format($product->price, 2) }}</div>

            <p class="product-description">{{ $product->description }}</p>
{{-- ACTION AREA --}}
<div class="action-row" style="display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
    
    {{-- Top Row: Quantity and Bottleneck --}}
    <div style="display: flex; gap: 10px; align-items: center;"> {{-- Changed stretch to center --}}
        
        {{-- Quantity Box: Now restricted in width --}}
        <div class="quantity-input-box" style="margin: 0; width: 140px; flex-shrink: 0;"> {{-- Set a fixed width --}}
            <button type="button" onclick="changeQty(-1)">-</button>
            <input type="text" id="qty" value="1" readonly style="width: 40px; text-align: center;">
            <button type="button" onclick="changeQty(1)">+</button>
        </div>

        {{-- Bottleneck Button (Only shows for CPU/GPU) --}}
        @if($product->type === 'cpu' || $product->type === 'gpu')
            <a href="{{ route('bottleneck.index') }}" class="btn-bottleneck-glass" style="flex: 1;">
                <i class="fa-solid fa-microchip"></i> Bottleneck Check
            </a>
        @endif
    </div>

                {{-- Bottom Row: Add to Basket --}}
                <form action="{{ route('basket.add') }}" method="POST" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn-gradient-add" style="
                        width: 100%;
                        padding: 16px;
                        font-size: 1.1rem;
                        font-weight: 700;
                        border-radius: 10px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 12px;
                        box-shadow: 0 4px 15px rgba(0, 255, 136, 0.2);
                    ">
                        <i class="fa-solid fa-cart-shopping"></i> Add to Basket
                    </button>
                </form>
            </div> {{-- End Action Row --}}
        </div> {{-- End Product Info Area --}}
    </div> {{-- End Product Hero Card (Crucial this closes here) --}}

    {{-- REVIEWS SECTION (Now sits safely below the grid) --}}
    <div class="reviews-wrapper-card">
        <h2>Customer Reviews</h2>
        <div class="reviews-split-layout">
            <div class="reviews-left-stats">
                <div class="large-number">{{ number_format($product->reviews->avg('rating') ?: 0, 1) }}</div>
                <div class="stars-row-yellow">
                    @php $avg = $product->reviews->avg('rating') ?: 0; @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa-{{ $i <= round($avg) ? 'solid' : 'regular' }} fa-star"></i>
                    @endfor
                </div>
                <p>Based on {{ $product->reviews->count() }} reviews</p>

                <div class="rating-bar-stack">
                    @for ($i = 5; $i >= 1; $i--)
                        @php 
                            $count = $product->reviews->where('rating', $i)->count();
                            $percent = $product->reviews->count() > 0 ? ($count / $product->reviews->count()) * 100 : 0;
                        @endphp
                        <div class="rating-line">
                            <span>{{ $i }} ★</span>
                            <div class="bar-bg"><div class="bar-fill" style="width: {{ $percent }}%"></div></div>
                            <span>{{ round($percent) }}%</span>
                        </div>
                    @endfor
                </div>

                <button class="btn-write-review-grad" onclick="showReviewModal()">Write a Review</button>
            </div>

            <div class="reviews-right-list">
                @forelse($product->reviews as $review)
                    <div class="individual-review-box">
                        <div class="review-user-icon">{{ substr($review->user_name, 0, 1) }}</div>
                        <div class="review-body">
                            <strong>{{ $review->user_name }}</strong>
                            <div class="stars-row-yellow-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </div>
                            <span class="review-date">{{ $review->created_at->format('M d, Y') }}</span>
                            <h4>{{ $review->title }}</h4>
                            <p>{{ $review->comment }}</p>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; opacity: 0.5; padding: 20px;">No reviews yet. Be the first!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- REVIEW MODAL --}}
<div id="review-modal" class="modal-overlay">
    <div class="modal-content card">
        <h3>Submit Your Review</h3>
        <form action="{{ route('reviews.store', $product->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Your Name</label>
                <input type="text" name="user_name" required placeholder="e.g. Harry">
            </div>
            
            <div class="form-group">
                <label>Rating</label>
                <select name="rating" required>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>

            <div class="form-group">
                <label>Review Title</label>
                <input type="text" name="title" required placeholder="e.g. Amazing Performance">
            </div>

            <div class="form-group">
                <label>Review Details</label>
                <textarea name="comment" required placeholder="Tell us about your experience..." rows="4"></textarea>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn-submit-review">Submit Review</button>
                <button type="button" class="btn-cancel-review" onclick="closeReviewModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    // --- 1. THEME INITIALIZATION ---
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

    // --- 2. MODAL LOGIC ---
    function showReviewModal() {
        document.getElementById('review-modal').classList.add('show');
    }

    function closeReviewModal() {
        document.getElementById('review-modal').classList.remove('show');
    }

    // --- 3. QUANTITY LOGIC ---
    function changeQty(n) {
        let q = document.getElementById('qty');
        let v = parseInt(q.value) + n;
        if(v > 0 && v <= 10) {
            q.value = v;
        }
    }
</script>
@endsection