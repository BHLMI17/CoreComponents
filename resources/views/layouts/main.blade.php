<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CoreComponents')</title>

    <link rel="stylesheet" href="/css/samistyles.css">
    <script src="/js/script.js"></script>
</head>

<body>

    {{-- Navbar --}}
    @include('layouts.partials.navbar')

    {{-- Page content --}}
    <main>
        @yield('content')
    </main>

</body>
</html>