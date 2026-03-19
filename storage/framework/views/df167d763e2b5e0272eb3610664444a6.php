<?php $__env->startSection('title', 'CoreComponents'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="/css/samistyles.css">

<main>

    <section id="welcome-hero">
        <div class="hero-content">
            <h1>Welcome to CoreComponents!</h1>
            <h5>
                Your ultimate destination for high-performance PC parts and upgrades.
                We provide everything you need to power your build.
            </h5>
            <img class="main-thumbnail" src="/images/main-thumbnail.png" alt="Main Thumbnail">
            <div class="hero-actions">
                <a href="<?php echo e(route('products.list')); ?>" class="hero-button">Our Stock</a>
            </div>
        </div>
    </section>

    
    <section id="category-grid-section">
        <div class="category-header">
            <h1>Shop by Category</h1>
            <h5>
                find the perfect component for your build
            </h5>
        </div>

        <div class="cat-row-top">
            <a href="<?php echo e(route('products.list', ['type' => 'cpu'])); ?>" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-microchip"></i></div>
                <span>CPU</span>
            </a>
            <a href="<?php echo e(route('products.list', ['type' => 'gpu'])); ?>" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-memory"></i></div>
                <span>GPU</span>
            </a>
            <a href="<?php echo e(route('products.list', ['type' => 'monitor'])); ?>" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-desktop"></i></div>
                <span>Monitor</span>
            </a>
        </div>

        <div class="cat-row-bottom">
            <a href="<?php echo e(route('products.list', ['type' => 'mouse'])); ?>" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-computer-mouse"></i></div>
                <span>Mouse</span>
            </a>
            <a href="<?php echo e(route('products.list', ['type' => 'keyboard'])); ?>" class="cat-card">
                <div class="cat-icon"><i class="fa-solid fa-keyboard"></i></div>
                <span>Keyboard</span>
            </a>
        </div>
    </section>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($featuredProducts) && $featuredProducts->count() > 0): ?>
        <section id="featured-products" class="featured-section">
            <h2 class="featured-title">Featured Products</h2>

            <div class="featured-carousel-wrapper">
                <button class="carousel-btn prev" type="button" onclick="scrollFeatured(-1)">
                    &#10094;
                </button>

                <div class="featured-carousel" id="featuredCarousel">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="landing-product-card featured-card">
                            <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" class="landing-product-img" />

                            <h4 class="landing-product-title"><?php echo e($product->name); ?></h4>
                            <p class="landing-product-price">£<?php echo e(number_format($product->price, 2)); ?></p>

                            <a href="<?php echo e(route('products.show', $product->id)); ?>" class="landing-button">
                                View <?php echo e($product->type); ?>

                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <button class="carousel-btn next" type="button" onclick="scrollFeatured(1)">
                    &#10095;
                </button>
            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

   
        

    <footer id="footer">
        <br><br>
    </footer>

</main>

<script>
    function scrollFeatured(direction) {
        const carousel = document.getElementById('featuredCarousel');
        const card = carousel.querySelector('.featured-card');

        if (!card) return;

        const carouselStyles = window.getComputedStyle(carousel);
        const gap = parseInt(carouselStyles.columnGap || carouselStyles.gap || 0);
        const cardWidth = card.offsetWidth;

        const scrollAmount = (cardWidth + gap) * 3;

        carousel.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }

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

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Projects\CoreComponents\resources\views/pages/Landing.blade.php ENDPATH**/ ?>