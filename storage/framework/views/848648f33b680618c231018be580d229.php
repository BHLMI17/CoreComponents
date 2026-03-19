<header class="top-bar">
<a href="<?php echo e(route('landing')); ?>">
    <img src="/images/CoreComponentsLogo.png" alt="CoreComponents Logo" class="logo-img" />
</a>

<div class="search-wrapper">
    <form id="search-form" class="search-bar" action="<?php echo e(route('search')); ?>" method="GET">
        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <input id="search-input" name="query" type="text" placeholder="Search for components..." autocomplete="off" />
    </form>
    <!-- Search Suggestions Dropdown -->
    <div id="search-suggestions" class="search-suggestions-dropdown hidden"></div>
</div>


<div class="icon-group">
    
    <a href="<?php echo e(route('basket.index')); ?>" id="btn-cart" class="icon">
        <i class="fa-solid fa-cart-shopping"></i>
    </a>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
        
        <a href="<?php echo e(auth()->user()->canAccessPanel(app(\Filament\Panel::class)) ? '/admin-panel' : route('dashboard')); ?>" id="btn-account" class="icon">
            <i class="fa-solid fa-user"></i>
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
        
        <a href="<?php echo e(route('login')); ?>" id="btn-account" class="icon">
            <i class="fa-regular fa-user"></i>
        </a>

        
        <a href="/admin-panel/login" id="btn-admin" class="icon">
            <i class="fa-solid fa-user-shield"></i>
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <button id="theme-toggle" onclick="toggleTheme()" class="theme-toggle-icon">
        <i class="fa-solid fa-circle-half-stroke"></i>
    </button>
</div>
</header>


 <nav class="nav-bar">
    <ul class="nav-links">
        <li><a href="<?php echo e(route('landing')); ?>">Home</a></li>
        <li><a href="<?php echo e(route('products.list')); ?>">Browse</a></li>
        <li><a href="<?php echo e(route('contact')); ?>">Contact</a></li>
        <li><a href="<?php echo e(route('about')); ?>">About Us</a></li>
        <li><a href="<?php echo e(route('checkout')); ?>">Checkout</a></li>
        
        <li>
            <a href="<?php echo e(route('bottleneck.index')); ?>" 
               class="<?php echo e(request()->routeIs('bottleneck.*') ? 'active' : ''); ?>">
               Compare
            </a>
        </li>
    </ul>
</nav>
<?php /**PATH C:\Projects\CoreComponents\resources\views/layouts/partials/navbar.blade.php ENDPATH**/ ?>