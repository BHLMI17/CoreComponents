<header class="top-bar">
    <img src="/images/CoreComponentsLogo.png" alt="CoreComponents Logo" class="logo-img" />

    <div class="search-wrapper">
        <form id="search-form" class="search-bar">
            <input id="search-input" type="text" placeholder="Search..." />
            <button type="submit">🔍</button>
        </form>
    </div>

    <div class="icon-group">
        <a id="btn-cart" class="icon">🛒</a>
        <a id="btn-account" class="icon">👤</a>
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