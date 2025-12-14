<header class="top-bar">
    <img src="/images/CoreComponentsLogo.png" alt="CoreComponents Logo" class="logo-img" />

    <div class="search-wrapper">
        <form id="search-form" class="search-bar" action="{{ route('products.list') }}" method="GET">
          <input id="search-input" name="q" type="text" placeholder="Search..." />
          <button type="submit">🔍</button>
        </form>
    </div>

    <div class="icon-group">
        <a href="{{ route('checkout') }}" id="btn-cart" class="icon">🛒</a>
        @auth
            <a href="{{ route('register') }}" id="btn-account" class="icon">👤</a>
        @endauth

        @guest
            <a href="{{ route('login') }}" id="btn-account" class="icon">👤</a>
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