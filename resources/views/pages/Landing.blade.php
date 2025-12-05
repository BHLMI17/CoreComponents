@extends('layouts.main')

@section('title', 'CoreComponents')

@section('content')

<link rel="stylesheet" href="/css/samistyles.css">

<main>

    <section id="main-thumbnail">
        <img class="main-thumbnail" src="/images/main-thumbnail.png" alt="Main Thumbnail">
    </section>

    <section id="welcome-text">
        <h1>Welcome to CoreComponents!</h1>
        <br><br>
        <h5>
            Your ultimate destination for high-performance PC parts and upgrades.
            We provide everything you need to power your build. Click below to explore our stock 👀👇
        </h5>
    </section>

    <section>
        <a id="welcome-button" href="{{ route('products.list') }}" class="button">Our Stock</a>
    </section>

    <footer id="footer">
        <br><br>
    </footer>

</main>

@endsection