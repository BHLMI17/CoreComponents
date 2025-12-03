<?php
// CoreComponents | About Us - PHP version
// You can add backend logic here later (e.g., handling search, cart, account, etc.)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CoreComponents | About Us</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <header class="navbar">
    <div class="nav-left">
      <a href="#" class="logo" id="nav-logo" data-route="home">
        <img src="img/logo.png" alt="CoreComponents Logo" class="logo-icon" />
        <span class="logo-text">Core<span class="logo-accent">Components</span></span>
      </a>
    </div>

    <div class="nav-center">
      <form class="search-bar" id="search-form" method="GET" action="">
        <button type="submit" class="search-icon-btn">
          <img src="img/icon-search.png" alt="Search" class="icon-search"/>
        </button>
        <input type="text" name="q" id="search-input" placeholder="Search" aria-label="Search"/>
      </form>
    </div>

    <div class="nav-right">
      <button class="icon-button" id="btn-cart" data-action="open-cart">
        <img src="img/icon-cart.png" alt="Cart" class="icon-image"/>
      </button>

      <button class="icon-button" id="btn-account" data-action="open-account">
        <img src="img/icon-account.png" alt="Account" class="icon-image"/>
      </button>
    </div>
  </header>

  <nav class="main-menu">
    <a href="#" id="nav-home" data-route="home">Home</a>
    <a href="#" id="nav-browse" data-route="browse">Browse</a>
    <a href="#" id="nav-compatibility" data-route="compatibility">Compatibility</a>
    <a href="#" id="nav-pc-builder" data-route="pc-builder">PC Builder</a>
    <a href="#" id="nav-about" data-route="about" class="active">About Us</a>
    <a href="#" id="nav-contact" data-route="contact">Contact Us</a>
    <a href="#" id="nav-orders" data-route="orders-returns">Orders/Returns</a>
  </nav>

  <main class="hero">
    <div class="hero-overlay">
      <section class="about-section">
        <h1>About Us</h1>
        <p class="about-text">
          CoreComponents was founded in 2025 by a group of seven students wanting to change the way people buy PC components. 
          Ensuring affordability for those from deprived backgrounds and ensuring everyone had a chance to play games and enjoy PCs. 
          Founder Bilal Hussain won the 2025 Nobel Peace Prize due to the impact we’ve had in the gaming world. 
          Going beyond the vision we had when were founded. Thus changing lives forever.
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

  <script src="script.js"></script>
</body>
</html>
