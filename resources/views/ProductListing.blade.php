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
    @foreach ($products as $product)
        <div class="product-card">
            <img 
                src="{{ $product->image_url }}" 
                alt="{{ $product->name }}" 
                class="{{ $product->type === 'mouse' || $product->type === 'keyboard' ? 'product-img' : 'product-img2' }}"
            />

            <h3 class="product-title">{{ $product->name }}</h3>

            <p class="product-price">£{{ number_format($product->price, 2) }}</p>

            <button class="add-to-cart">Add to Cart</button>
        </div>
    @endforeach
</main>
<!-- your products list, cards, grid, etc. -->
    <div class="product-listing">
        <!-- product cards here -->
    </div>

    <!-- Add the script here -->
    <script src="search_logic.js"></script>
</body>

</html>
