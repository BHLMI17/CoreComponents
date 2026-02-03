<header class="top-bar">
    <img src="/images/CoreComponentsLogo.png" alt="CoreComponents Logo" class="logo-img" />

    <div class="search-wrapper">
        <form id="search-form" class="search-bar" action="{{ route('products.list') }}" method="GET">
            <input id="search-input" name="q" type="text" placeholder="Search..." />
            <button type="submit">🔍</button>
        </form>
    </div>

    <div class="icon-group">
        <a href="{{ route('basket.index') }}" id="btn-cart" class="icon">🛒</a>

        {{-- Logged-in users --}}
        @auth
            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                {{-- Admins go to admin dashboard --}}
                <a href="{{ route('admin.dashboard') }}" id="btn-account" class="icon">👤</a>
            @else
                {{-- Normal users go to user dashboard --}}
                <a href="{{ route('dashboard') }}" id="btn-account" class="icon">👤</a>
            @endif
        @endauth

        {{-- Guests --}}
        @guest
            {{-- Normal login --}}
            <a href="{{ route('login') }}" id="btn-account" class="icon">👤</a>

            {{-- Admin login --}}
            <a href="{{ route('admin.login') }}" id="btn-admin" class="icon">🛡️</a>
        @endguest
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