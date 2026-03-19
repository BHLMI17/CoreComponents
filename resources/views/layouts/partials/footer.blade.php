{{-- resources/views/layouts/partials/footer.blade.php --}}
<footer class="main-footer">
    <div class="footer-container">
        <!-- Logo Column -->
        <div class="footer-column">
            <img src="/images/CoreComponentsLogo.png" alt="CoreComponents Logo" class="footer-logo">
        </div>

        <!-- Quick Links -->
        <div class="footer-column">
            <h3>Quick links</h3>
            <ul>
                <li><a href="{{ route('landing') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('products.list') }}">Browse</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <!-- Useful Links -->
        <div class="footer-column">
            <h3>Useful Links</h3>
            <ul>
                <li><a href="{{ route('products.list', ['type' => 'cpu']) }}">CPUs & Processors</a></li>
                <li><a href="{{ route('products.list', ['type' => 'gpu']) }}">Graphics Cards</a></li>
                <li><a href="{{ route('products.list', ['type' => 'monitor']) }}">Gaming Monitors</a></li>
                <li><a href="{{ route('products.list', ['type' => 'keyboard']) }}">Mechanical Keyboards</a></li>
            </ul>
        </div>

        <!-- Company Info -->
        <div class="footer-column">
            <h3>Company</h3>
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fa-solid fa-location-dot"></i>
                    </span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <a href="mailto:sales@corecomponents.com">sales@corecomponents.com</a>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-phone"></i>
                    0121 543 8707</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="footer-bottom">
    <div class="footer-bottom-content">
        Copyright 2025 &copy; CoreComponents Ltd. All Rights Reserved. 
        <a href="#">Website Design</a> by CoreComponents Team. 
        <span class="footer-separator">|</span>
        <a href="#">Terms of Service</a> 
        <span class="footer-separator">|</span>
        <a href="#">Privacy Policy</a>
    </div>
</div>
