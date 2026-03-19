<?php $__env->startSection('title', 'About Us'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/productoverview.css')); ?>">
<link rel="stylesheet" href="/css/nazeerstyles.css">

<main class="about-hero-bg">
    <div class="about-content-container">
        
        
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

        
        <section class="about-glass-card">
            <div class="category-header">
                <h1>Top Rated Products</h1>
                <h5>The highest-rated gear by our community</h5>
            </div>
            <div class="top-rated-grid">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $topRatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="top-product-card">
                    <div class="rating-badge">
                        <i class="fa-solid fa-star"></i> <?php echo e(number_format($product->reviews_avg_rating, 1)); ?>

                    </div>
                    <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>">
                    <h4><?php echo e($product->name); ?></h4>
                    <p class="price-text">£<?php echo e(number_format($product->price, 2)); ?></p>
                    <a href="<?php echo e(route('products.show', $product->id)); ?>" class="hero-button small">View Gear</a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>

    </div>

<div class="reviews-wrapper-card" style="margin-top: 40px;">
    <h2>What People Say About Us</h2>
    
    <div class="reviews-split-layout">
        
        
        <div class="reviews-left-stats">
            <?php 
                $avgRating = $websiteReviews->avg('rating') ?: 0; 
                $totalReviews = $websiteReviews->count();
            ?>

            
            <div class="large-number"><?php echo e(number_format($avgRating, 1)); ?></div>
            
            <div class="stars-row-yellow">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?>
                    <i class="fa-<?php echo e($i <= round($avgRating) ? 'solid' : 'regular'); ?> fa-star"></i>
                <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <p>Based on <?php echo e($totalReviews); ?> website reviews</p>

            
            <div class="rating-bar-stack">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 5; $i >= 1; $i--): ?>
                    <?php 
                        $count = $websiteReviews->where('rating', $i)->count();
                        $percent = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                    ?>
                    <div class="rating-line">
                        <span><?php echo e($i); ?> ★</span>
                        <div class="bar-bg">
                            <div class="bar-fill" style="width: <?php echo e($percent); ?>%"></div>
                        </div>
                        <span><?php echo e(round($percent)); ?>%</span>
                    </div>
                <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <button class="btn-write-review-grad" onclick="showWebsiteReviewModal()">
                <i class="fa-solid fa-pen-to-square"></i> Rate Our Website
            </button>
        </div>

        
        <div class="reviews-right-list">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $websiteReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="individual-review-box">
                    <div class="review-user-icon" style="background: var(--btn-grad); color: white;">
                        <?php echo e(strtoupper(substr($wReview->user_name, 0, 1))); ?>

                    </div>
                    
                    <div class="review-body">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <strong><?php echo e($wReview->user_name); ?></strong>
                            <span class="review-date" style="opacity: 0.6; font-size: 0.85rem;">
                                <?php echo e($wReview->created_at->diffForHumans()); ?>

                            </span>
                        </div>

                        <div class="stars-row-yellow-sm">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="fa-<?php echo e($i <= $wReview->rating ? 'solid' : 'regular'); ?> fa-star"></i>
                            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <p style="margin-top: 10px;"><?php echo e($wReview->comment); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="text-align: center; opacity: 0.5; padding: 40px;">
                    <p>No website reviews yet. Be the first to tell us what you think!</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

    </div>
</div>
    
<div id="website-review-modal" class="modal-overlay">
    <div class="modal-content card">
        <h3>Rate Your Experience</h3>
        <p style="color: var(--text-sub); margin-bottom: 20px; font-size: 0.9rem;">Your feedback helps us make CoreComponents better for everyone.</p>
        
        <form action="<?php echo e(route('website-reviews.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Projects\CoreComponents\resources\views/pages/about_us.blade.php ENDPATH**/ ?>