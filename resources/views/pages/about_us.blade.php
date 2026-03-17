@extends('layouts.main')

@section('title', 'About Us')

@section('content')
{{-- Reusing your product overview styles for consistency --}}
<link rel="stylesheet" href="{{ asset('css/productoverview.css') }}">
<link rel="stylesheet" href="/css/nazeerstyles.css">

<main class="about-hero-bg">
    <div class="about-content-container">
        
        {{-- Section 1: Our Story --}}
        <section class="about-glass-card">
            <div class="category-header">
                <h1>Our Story</h1>
                <h5>Changing the game since 2025</h5>
            </div>
            <p class="about-text">
                CoreComponents was founded in 2025 by a group of seven students wanting to change the way people buy PC components. 
                Ensuring affordability for those from deprived backgrounds and ensuring everyone had a chance to play games and enjoy PCs. 
                Founder Bilal Hussain won the 2025 Nobel Peace Prize due to the impact we’ve had in the gaming world. 
                Going beyond the vision we had when we were founded. Thus changing lives forever.
            </p>
        </section>

        {{-- Section 2: Values --}}
        <section class="about-glass-card">
            <div class="category-header">
                <h1>Our Values</h1>
                <h5>The pillars of CoreComponents</h5>
            </div>
            <div class="values-flex">
                <article class="value-mini-card">
                    <div class="value-icon"><i class="fa-solid fa-gem"></i></div>
                    <h3>Quality</h3>
                    <p>We provide the best products for our customers.</p>
                </article>
                <article class="value-mini-card">
                    <div class="value-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                    <h3>Affordability</h3>
                    <p>We ensure anyone can afford our products.</p>
                </article>
                <article class="value-mini-card">
                    <div class="value-icon"><i class="fa-solid fa-headset"></i></div>
                    <h3>Support</h3>
                    <p>We are here to help our customers anytime.</p>
                </article>
            </div>
        </section>

        {{-- Section 3: Top Rated Products --}}
        <section class="about-glass-card">
            <div class="category-header">
                <h1>Top Rated Products</h1>
                <h5>The highest-rated gear by our community</h5>
            </div>
            <div class="top-rated-grid">
                @foreach($topRatedProducts as $product)
                <div class="top-product-card">
                    <div class="rating-badge">
                        <i class="fa-solid fa-star"></i> {{ number_format($product->reviews_avg_rating, 1) }}
                    </div>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    <h4>{{ $product->name }}</h4>
                    <p class="price-text">£{{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="hero-button small">View Gear</a>
                </div>
                @endforeach
            </div>
        </section>

    </div>
{{-- 4. WEBSITE REVIEWS SECTION (NOW MATCHING GLASS STYLE) --}}
        <section class="about-glass-card" style="margin-top: 40px; text-align: left;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                <div class="category-header" style="text-align: left; margin: 0;">
                    <h1>What People Say About Us</h1>
                </div>
                <button class="hero-button small" style="width: 240px; padding: 25px;" onclick="showWebsiteReviewModal()">
                    <i class="fa-solid fa-pen-to-square"></i> Rate Our Website
                </button>
            </div>
            
            <div class="reviews-right-list" style="margin-top: 30px; display: flex; flex-direction: column; gap: 15px;">
                @forelse($websiteReviews as $wReview)
                    <div class="individual-review-box" style="display: flex; gap: 20px; background: rgba(255, 255, 255, 0.03); border: 1.5px solid rgba(255, 255, 255, 0.08); border-radius: 15px; padding: 20px;">
                        <div class="review-user-icon" style="background: var(--btn-grad); color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold;">
                            {{ strtoupper(substr($wReview->user_name, 0, 1)) }}
                        </div>
                        <div class="review-body" style="flex: 1;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <strong style="color: #fff;">{{ $wReview->user_name }}</strong>
                                <small style="opacity: 0.5; color: #fff;">{{ $wReview->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="stars-row-yellow-sm" style="color: #FFD700; margin: 5px 0;">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= $wReview->rating ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </div>
                            <p style="opacity: 0.9; color: #ccc; margin: 0; line-height: 1.5;">{{ $wReview->comment }}</p>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; opacity: 0.5; padding: 40px; color: #fff;">No website reviews yet. Be the first to tell us what you think!</p>
                @endforelse
            </div>
        </section>
    {{-- WEBSITE REVIEW MODAL --}}
<div id="website-review-modal" class="modal-overlay">
    <div class="modal-content card">
        <h3>Rate Your Experience</h3>
        <p style="color: var(--text-sub); margin-bottom: 20px; font-size: 0.9rem;">Your feedback helps us make CoreComponents better for everyone.</p>
        
        <form action="{{ route('website-reviews.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Your Name</label>
                <input type="text" name="user_name" required placeholder="e.g. Bilal">
            </div>
            
            <div class="form-group">
                <label>Rating</label>
                <select name="rating" required>
                    <option value="5">5 Stars - Excellent</option>
                    <option value="4">4 Stars - Very Good</option>
                    <option value="3">3 Stars - Good</option>
                    <option value="2">2 Stars - Fair</option>
                    <option value="1">1 Star - Poor</option>
                </select>
            </div>

            <div class="form-group">
                <label>Your Feedback</label>
                <textarea name="comment" required placeholder="How was your experience using our site?" rows="4"></textarea>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn-submit-review">Submit Feedback</button>
                <button type="button" class="btn-cancel-review" onclick="closeWebsiteReviewModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>


    </div> 
<script>
    // --- MODAL LOGIC ---
    function showWebsiteReviewModal() {
        document.getElementById('website-review-modal').classList.add('show');
    }

    function closeWebsiteReviewModal() {
        document.getElementById('website-review-modal').classList.remove('show');
    }

    // --- THEME PERSISTENCE ---
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) {
        document.documentElement.setAttribute('data-theme', currentTheme);
    }
</script>

</main>

@endsection