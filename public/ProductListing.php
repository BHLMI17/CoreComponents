<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product List</title>
  <link rel="stylesheet" href="css/seanstyles.css" />
  <script src="js/seanscript.js"></script>
</head>
<body>
  <!-- Top Navigation -->
  <header class="top-bar">
      <!-- Download the removed bg and cropped png i sent if logo is cooked -->
    <img src="images/logo.png" alt="CoreComponents Logo" class="logo-img" />

    <!--separates the search bar from the rest of the top navs objects to align it properly-->
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

  <section class="filter-bar">
  <!-- Category Dropdown -->
  <div class="filter-group">
    <label for="category">Category:</label>
    <select id="category" name="category">
      <option value="">All</option>
      <option value="mouse">Mice</option>
      <option value="keyboard">Keyboards</option>
      <option value="monitor">Monitors</option>
      <option value="accessories">Accessories</option>
    </select>
  </div>

  <!-- Price Range -->
  <div class="filter-group">
    <label for="price">Price Range:</label>
    <input type="range" id="price" name="price" min="0" max="400" step="10" />
    <span id="price-value">£0 - £400</span>
  </div>

  <!-- Compatibility Checkbox -->
  <div class="filter-group">
    <label>Compatibility:</label>
    <div class="checkboxes">
      <label><input type="checkbox" name="compatibility" value="windows" /> Windows</label>
      <label><input type="checkbox" name="compatibility" value="mac" /> Mac</label>
      <label><input type="checkbox" name="compatibility" value="linux" /> Linux</label>
    </div>
  </div>

  <!-- Apply Button -->
  <button class="apply-filter">Apply Filters</button>
  </section>
  <script src="seanscript.js"></script>

  <!-- products here, div class copy n pastable-->
  <main class="product-listing">
  <div class="product-card">
    <img src="images/Razer Basilisk V3 X HyperSpeed.png" alt="Razer Basilisk V3 X HyperSpeed" class="product-img" />
    <h3 class="product-title">Razer Basilisk V3 X HyperSpeed</h3>
    <p class="product-price">£34.99</p>
    <button class="add-to-cart" >Add to Cart</button>

    
  </div>

  <div class="product-card">
    <img src="images/Razer DeathAdder V4 Pro.png" alt="Razer DeathAdder V4 Pro" class="product-img" />
    <h3 class="product-title">Razer DeathAdder V4 Pro</h3>
    <p class="product-price">£139.99</p>
    <button class="add-to-cart">Add to Cart</button>
  </div>

   <div class="product-card">
    <img src="images/AMD Ryzensets 7 5800X.png" alt="AMD Ryzensets 7 5800X " class="product-img2"/>
    <h3 class="product-title">AMD Ryzensets 7 5800X </h3>
    <p class="product-price">£139.99</p>
    <button class="add-to-cart">Add to Cart</button>
  </div>

   <div class="product-card">
    <img src="images/Intel Core i7 13700F.png" alt="Intel Core i7 13700F" class="product-img2" />
    <h3 class="product-title">Intel Core i7 13700F</h3>
    <p class="product-price">£299.99</p>
    <button class="add-to-cart">Add to Cart</button>
  </div>

   <div class="product-card">
    <img src="images/Logitech G413 TKL SE Mechanical Gaming Keyboard.png" alt="Logitech G413 TKL SE Mechanical Gaming Keyboard" class="product-img2" />
    <h3 class="product-title">Logitech G413 TKL SE Mechanical Gaming Keyboard</h3>
    <p class="product-price">£34.99</p>
    <button class="add-to-cart">Add to Cart</button>
  </div>

   <div class="product-card">
    <img src="images/ASUS ROG Azoth 75% Wireless DIY Custom Gaming Keyboard.png" alt="ASUS ROG Azoth 75% Wireless DIY Custom Gaming Keyboard" class="product-img2" />
    <h3 class="product-title">ASUS ROG Azoth 75% Wireless DIY Custom Gaming Keyboard</h3>
    <p class="product-price">£149.99</p>
    <button class="add-to-cart">Add to Cart</button>
  </div>

   <div class="product-card">
    <img src="images/MSI GeForce RTX 5060 8G SHADOW 2X OC Graphics Card.png" alt="MSI GeForce RTX 5060 8G SHADOW 2X OC Graphics Card" class="product-img2" />
    <h3 class="product-title">MSI GeForce RTX 5060 8G SHADOW 2X OC Graphics Card</h3>
    <p class="product-price">£249.99</p>
    <button class="add-to-cart">Add to Cart</button>
  </div>

   <div class="product-card">
    <img src="images/Powercolor Radeon RX 9060 XT HellHound OC 16GB GDDR6 Graphics Card.png" alt="Powercolor Radeon RX 9060 XT HellHound OC 16GB GDDR6 Graphics Card" class="product-img2" />
    <h3 class="product-title">Powercolor Radeon RX 9060 XT HellHound OC 16GB GDDR6 Graphics Card</h3>
    <p class="product-price">£259.99</p>
    <button class="add-to-cart">Add to Cart</button>
  </div>

   <div class="product-card">
    <img src="images/PHILIPS 24E1N1100A.png" alt="PHILIPS 24E1N1100A" class="product-img2" />
    <h3 class="product-title">PHILIPS 24E1N1100A</h3>
    <p class="product-price">£54.99</p>
    <button class="add-to-cart">Add to Cart</button>
  </div>

  <div class="product-card">
    <img src="images/KOORUI G2411P 24 Inch Gaming Monitor.png" alt="KOORUI G2411P 24 Inch Gaming Monitor" class="product-img2" />
    <h3 class="product-title">KOORUI G2411P 24 Inch Gaming Monitor</h3>
    <p class="product-price">£149.99</p>
    <button class="add-to-cart">Add to Cart</button>
  </div>
</main>
<!-- your products list, cards, grid, etc. -->
    <div class="product-listing">
        <!-- product cards here -->
    </div>

    <!-- Add the script here -->
    <script src="search_logic.js"></script>
</body>

</html>
