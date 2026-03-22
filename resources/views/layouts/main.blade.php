<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CoreComponents')</title>

    <link rel="stylesheet" href="/css/samistyles.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="/js/script.js"></script>
</head>

<body>

    {{-- Navbar --}}
    @include('layouts.partials.navbar')

    @php
        $hasDatabaseWarning = isset($databaseWarning) && filled($databaseWarning);
        $statusMessage = $hasDatabaseWarning ? $databaseWarning : (session('warning') ?? session('error'));
        $statusClass = $hasDatabaseWarning || session('warning') ? '#8b5e00' : '#8f1d1d';
        $statusBorder = $hasDatabaseWarning || session('warning') ? '#f0b429' : '#f87171';
    @endphp

    @if(session('success'))
        <div style="max-width: 1100px; margin: 18px auto 0; padding: 12px 16px; border-radius: 10px; border: 1px solid #10b981; background: rgba(16, 185, 129, 0.12); color: #d1fae5;">
            {{ session('success') }}
        </div>
    @endif

    @if($statusMessage)
        <div style="max-width: 1100px; margin: 18px auto 0; padding: 12px 16px; border-radius: 10px; border: 1px solid {{ $statusBorder }}; background: rgba(248, 113, 113, 0.12); color: {{ $statusClass }};">
            {{ $statusMessage }}
        </div>
    @endif

    {{-- Page content --}}
    <main>
        @yield('content')
    </main>
    {{-- Footer --}}
    @include('layouts.partials.footer')

<script>
    // Function to switch themes
    function toggleTheme() {
        const htmlElement = document.documentElement; // This is the <html> tag
        const currentTheme = htmlElement.getAttribute('data-theme');
        
        // If it's light, make it dark. If it's dark, make it light.
        const newTheme = (currentTheme === 'light') ? 'dark' : 'light';
        
        htmlElement.setAttribute('data-theme', newTheme);
        
        // Save the choice so it persists on other pages
        localStorage.setItem('theme', newTheme);
    }

    // Function to apply the saved theme immediately when a new page loads
    (function initTheme() {
        const savedTheme = localStorage.getItem('theme') || 'dark'; // Default to dark
        document.documentElement.setAttribute('data-theme', savedTheme);
    })();
</script>
</body>
</html>
