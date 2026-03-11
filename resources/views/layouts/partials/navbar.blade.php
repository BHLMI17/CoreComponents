<header class="top-bar">
    <img src="/images/CoreComponentsLogo.png" alt="CoreComponents Logo" class="logo-img" />

<div class="search-wrapper">
    <form id="search-form" class="search-bar" action="{{ route('search') }}" method="GET">
        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <input id="search-input" name="query" type="text" placeholder="Search for components..." />
    </form>
</div>



<div class="icon-group">
    {{-- Shopping Cart --}}
    <a href="{{ route('basket.index') }}" id="btn-cart" class="icon">
        <i class="fa-solid fa-cart-shopping"></i>
    </a>

    @auth
        {{-- Logged-in Account --}}
        <a href="{{ route(auth()->user()->role === 'admin' ? 'admin.dashboard' : 'dashboard') }}" id="btn-account" class="icon">
            <i class="fa-solid fa-user"></i>
        </a>
    @endauth

    @guest
        {{-- Guest Login --}}
        <a href="{{ route('login') }}" id="btn-account" class="icon">
            <i class="fa-regular fa-user"></i>
        </a>

        {{-- Admin Login --}}
        <a href="{{ route('admin.login') }}" id="btn-admin" class="icon">
            <i class="fa-solid fa-user-shield"></i>
        </a>
    @endguest

    {{-- Theme Toggle --}}
    <button id="theme-toggle" onclick="toggleTheme()" class="theme-toggle-icon">
        <i class="fa-solid fa-circle-half-stroke"></i>
    </button>
</div>
</header>

<nav class="nav-bar">
    <ul class="nav-links">
        <li><a href="{{ route('landing') }}">Home</a></li>
        <li><a href="{{ route('products.list') }}">Browse</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li><a href="{{ route('about') }}">About Us</a></li>
        <li><a href="{{ route('checkout') }}">Checkout</a></li>
    </ul>
</nav>