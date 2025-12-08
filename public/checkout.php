<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CoreComponents Checkout Page</title>
  <link rel="stylesheet" href="nazeerstyles.css" />
</head>
<body>
  <!-- Top Navigation -->
  <header class="top-bar">
    <img src="logo.png" alt="CoreComponents Logo" class="logo-img" />

    <div class="search-wrapper">
      <form class="search-bar">
        <input type="text" placeholder="Search..." />
        <button type="submit">🔍</button>
      </form>
    </div>

    <div class="icon-group">
      <a href="#" class="icon">🛒</a>
      <a href="#" class="icon">👤</a>
    </div>
  </header>

  <!-- Lower Navigation -->
  <nav class="nav-bar">
    <ul class="nav-links">
    <li><a href="Landing.php">Home</a></li>
    <li><a href="ProductListing.php">Browse</a></li>
    <li><a href="Contact.php">Contact</a></li>
    <li><a href="about_us.php">About Us</a></li>
    <li><a href="checkout.php">Orders/Returns</a></li>
    </ul>
  </nav>

  <main class="checkout-page">
    <section id="checkout-items">
      <h2>Your Basket</h2>
      <!-- Items will be injected here by JavaScript -->
    </section>

    <aside class="checkout-summary">
      <h2>Summary</h2>
      <p id="subtotal">Subtotal: £0.00</p>
      <p id="shipping">Shipping: £2.99</p>
      <p id="total"><strong>Total: £2.99</strong></p>
      <button class="checkout-btn">Proceed to Payment</button>
      <button class="clear-cart">Clear Cart</button>
    </aside>
  </main>

  <script src="checkout.js"></script>
</body>
</html>