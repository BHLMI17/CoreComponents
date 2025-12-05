@extends('layouts.main')

@section('title', 'About Us')

@section('content')
<main class="hero">
  <div class="hero-overlay">
    <section class="about-section">
      <h1>About Us</h1>
      <p class="about-text">
        CoreComponents was founded in 2025 by a group of seven students wanting to change the way people buy PC components.
        Ensuring affordability for those from deprived backgrounds and ensuring everyone had a chance to play games and enjoy PCs.
        Founder Bilal Hussain won the 2025 Nobel Peace Prize due to the impact we’ve had in the gaming world.
        Going beyond the vision we had when we were founded. Thus changing lives forever.
      </p>
    </section>

    <section class="values-section">
      <h2>We have three values</h2>

      <div class="values-grid">
        <article class="value-card">
          <h3>“Quality”</h3>
          <p>We believe in providing the best products for our customers</p>
        </article>

        <article class="value-card">
          <h3>“Affordability”</h3>
          <p>We ensure anyone can afford our products regardless of their background</p>
        </article>

        <article class="value-card">
          <h3>“Support”</h3>
          <p>We are here to help our customers anytime</p>
        </article>
      </div>
    </section>
  </div>
</main>
@endsection