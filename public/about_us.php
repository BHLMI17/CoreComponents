<?php
// CoreComponents | About Us - PHP version
// You can add backend logic here later (e.g., handling search, cart, account, etc.)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us</title>
  <link rel="stylesheet" href="nazeerstyles.css">
  <script src="js/script.js"></script>
</head>
<body>


<!-- Header -->
 <!-- Top Navigation -->
 <header class="top-bar">
    <!-- Download the removed bg and cropped png i sent if logo is cooked -->
  <img src="images/CoreComponentsLogo.png" alt="CoreComponents Logo" class="logo-img" />

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
    <li><a href="#">Orders/Returns</a></li>
  </ul>
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
