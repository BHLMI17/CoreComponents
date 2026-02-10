@extends('layouts.main')

@section('title', 'About Us')

@section('content')
{{-- Reusing your product overview styles for consistency --}}
<link rel="stylesheet" href="{{ asset('css/productoverview.css') }}">
<link rel="stylesheet" href="/css/nazeerstyles.css">

<main class="hero">
  <div class="hero-overlay">
    
    {{-- 1. SUCCESS NOTIFICATION --}}
    @if(session('success'))
        <div class="success-toast card" style="max-width: 800px; margin: 0 auto 20px auto;">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- 2. ABOUT TEXT SECTION --}}
    <section class="about-section">
      <h1>About Us</h1>
      <p class="about-text">
        CoreComponents was founded in 2025 by a group of seven students wanting to change the way people buy PC components.
        Ensuring affordability for those from deprived backgrounds and ensuring everyone had a chance to play games and enjoy PCs.
        Founder Bilal Hussain won the 2025 Nobel Peace Prize due to the impact we’ve had in the gaming world.
        Going beyond the vision we had when we were founded. Thus changing lives forever.
      </p>
    </section>

    {{-- 3. VALUES SECTION --}}
    <section class="values-section">
      <h2>We have three values</h2>
      <div class="values-grid">
        <article class="value-card">
          <h3>“Quality”</h3>
          <p>We believe in providing the best products for our customers</p>
        </article>
        <article class="value-card">
          <h3>“Affordability”</h3>
          <p>We ensure anyone can afford our products regardless of their background</p>
        </article>
        <article class="value-card">
          <h3>“Support”</h3>
          <p>We are here to help our customers anytime</p>
        </article>
      </div>
    </section>

    {{-- 4. TOP 5 PRODUCT REVIEWS --}}
    <section class="reviews-wrapper-card" style="margin-top: 40px; text-align: left;">
      <h2 style="margin-bottom: 20px;"><i class="fa-solid fa-trophy" style="color: #FFD700;"></i> Top Product Reviews</h2>
      <div class="reviews-right-list">
        @foreach($topProductReviews as $review)
          <div class="individual-review-box">
            <div class="review-user-icon">{{ substr($review->user_name, 0, 1) }}</div>
            <div class="review-body">
              <strong>{{ $review->user_name }}</strong> on <em>{{ $review->product->name }}</em>
              <div class="stars-row-yellow-sm">
                @for ($i = 1; $i <= 5; $i++)
                  <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                @endfor
              </div>
              <h4>{{ $review->title }}</h4>
              <p>{{ $review->comment }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    {{-- 5. WEBSITE REVIEWS SECTION --}}
    <section class="reviews-wrapper-card" style="margin-top: 40px; text-align: left;">
      <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <h2>What People Say About Us</h2>
        <button class="btn-gradient-add" style="width: auto; padding: 0 25px;" onclick="showWebsiteReviewModal()">
            <i class="fa-solid fa-pen-to-square"></i> Rate Our Website
        </button>
      </div>
      
      <div class="reviews-right-list" style="margin-top: 30px;">
        @forelse($websiteReviews as $wReview)
          <div class="individual-review-box">
             <div class="review-user-icon" style="background: var(--btn-grad); color: white;">{{ substr($wReview->user_name, 0, 1) }}</div>
             <div class="review-body">
                <strong>{{ $wReview->user_name }}</strong>
                <div class="stars-row-yellow-sm">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa-{{ $i <= $wReview->rating ? 'solid' : 'regular' }} fa-star"></i>
                    @endfor
                </div>
                <p style="opacity: 0.9;">{{ $wReview->comment }}</p>
                <small style="opacity: 0.5;">{{ $wReview->created_at->diffForHumans() }}</small>
             </div>
          </div>
        @empty
          <p style="text-align: center; opacity: 0.5; padding: 40px;">No website reviews yet. Be the first to tell us what you think!</p>
        @endforelse
      </div>
    </section>

  </div>
</main>

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
@endsection