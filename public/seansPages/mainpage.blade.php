<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreParts - Computer Components</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <a href="{{ route('home') }}">CoreParts</a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('products') }}">Products</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('cart') }}">Cart (0)</a></li>
        </ul>
    </nav>

    <main>
        @yield('content')  <!-- This is where page content goes -->
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>