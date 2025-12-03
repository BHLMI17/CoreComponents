<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Contact Us
    </title>
    <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="images/CCfavicon.png" type="image/x-icon">
    <script src="JavaScript/script.js"></script>
</head>

<link rel = "stylesheet" type="text/css"  href="css/samistyles.css" />
<head>
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
    <li><a href="#">Home</a></li>
    <li><a href="#">Browse</a></li>
    <li><a href="#">Compatibility</a></li>
    <li><a href="#">About Us</a></li>
    <li><a href="#">Orders/Returns</a></li>
  </ul>
</nav>   
    </header>

      <main>
        <section id = "contact-thumbnail">
        <img class = "contact-thumbnail" src="images/contact-thumbnail.png" alt="Contact Thumbnail">
        </section>


        <!-- Main Form -->
        
            <form id="signup-form" action ="https://formspree.io/f/xkgljdwk" method="POST"> 
              <div id="form-container">
          
                  <h3 id = "form-title">Fill out the form below:</h3>
                  <br>
                  <p class = "form-subtext"> Name</p>
                  <input class = "field-design" type="text" name="name" placeholder="Name" required />
          
                  <br><br><br>
          
                  <p class = "form-subtext"> Email</p>
                  <input class = "field-design" type="text" name="email" placeholder="Email" required />
          
                  <br><br><br>

                  <p class = "form-subtext"> Message</p>
                  <textarea class="message-design" name="message" placeholder="Message" rows="3" cols="50" required></textarea>
                  <br><br><br>

                    <input id = "submit-button" type="submit" value="Submit" />
              </div>
          </form>

      <!-- Send Email Directly -->

      <!--     <section id="contact-info">
            <h4>Alternatively send us an email:</h4>
          
            <a href="mailto:corecomponents@gmail.com">corecomponents@gmail.com</a>
  
            <br><br><br>
          </section> -->



       <footer id="footer">
          <br>
          <br>
      </footer>
      </main>
  </body>
</html>