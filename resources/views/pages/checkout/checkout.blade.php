<?php
// checkout.php
session_start();

// Mock data to simulate a cart
$cart_items = [
    [
        'name' => 'NVIDIA GeForce RTX 4080',
        'price' => 1199.99,
        'image' => 'https://via.placeholder.com/50' 
    ],
    [
        'name' => 'Intel Core i9-13900K',
        'price' => 589.99,
        'image' => 'https://via.placeholder.com/50'
    ],
    [
        'name' => 'Corsair Vengeance 32GB DDR5',
        'price' => 149.99,
        'image' => 'https://via.placeholder.com/50'
    ]
];

$subtotal = array_sum(array_column($cart_items, 'price'));
$tax = $subtotal * 0.08;
$total = $subtotal + $tax;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - CoreComponents</title>
    
    <link rel="stylesheet" href="/css/checkoutstyle.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="navbar">
        <div class="nav-top-row">
            <a href="#" class="logo">
                <img src="corecomponents.png" alt="CoreComponents">
            </a>
            
            <div class="search-container">
                <input type="text" placeholder="Search...">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>

            <div class="nav-icons">
                <button class="theme-btn" onclick="toggleTheme()" title="Switch Theme">
                    <i class="fas fa-adjust"></i>
                </button>
                
                <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="#"><i class="fa-solid fa-user"></i></a>
            </div>
        </div>
        
        <div class="nav-links-row">
            <a href="#">Home</a>
            <a href="#">Browse</a>
            <a href="#">Compatibility</a>
            <a href="#">About Us</a>
            <a href="#">Orders/Returns</a>
        </div>
    </nav>
    <div class="container">
        
        <div class="checkout-form">
            <h2>Checkout</h2>
            
            <form action="process_order.php" method="POST" id="checkoutForm" novalidate>
                <div class="card form-section">
                    <h3>Contact Information</h3>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" placeholder="e.g. user@example.com" required>
                    </div>
                </div>

                <div class="card form-section">
                    <h3>Shipping Address</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="John" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" placeholder="Doe" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" placeholder="123 Tech Lane" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" placeholder="Birmingham" required>
                        </div>
                        <div class="form-group">
                            <label>Post Code</label>
                            <input type="text" placeholder="B1 1AA" required>
                        </div>
                    </div>
                </div>

                <div class="card form-section">
                    <h3>Payment Details</h3>
                    
                    <div class="payment-methods-grid">
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="card" checked onclick="togglePayment('card')">
                            <div class="payment-box">
                                <i class="fa-regular fa-credit-card"></i>
                                <span>Card</span>
                            </div>
                        </label>
                        
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="paypal" onclick="togglePayment('paypal')">
                            <div class="payment-box">
                                <i class="fa-brands fa-paypal"></i>
                                <span>PayPal</span>
                            </div>
                        </label>
                        
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="googlepay" onclick="togglePayment('googlepay')">
                            <div class="payment-box">
                                <i class="fa-brands fa-google-pay"></i>
                                <span>Google Pay</span>
                            </div>
                        </label>
                    </div>

                    <div id="card-fields" class="payment-dynamic-content">
                        <div class="form-group">
                            <label>Card Number</label>
                            <input type="text" placeholder="0000 0000 0000 0000">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <input type="text" placeholder="MM/YY">
                            </div>
                            <div class="form-group">
                                <label>CVC</label>
                                <input type="text" placeholder="123">
                            </div>
                        </div>
                    </div>

                    <div id="paypal-fields" class="payment-dynamic-content hidden">
                        <button type="button" class="btn-alt-payment btn-paypal">
                            <i class="fa-brands fa-paypal"></i> Pay with PayPal
                        </button>
                    </div>

                    <div id="googlepay-fields" class="payment-dynamic-content hidden">
                        <button type="button" class="btn-alt-payment btn-gpay">
                            <i class="fa-brands fa-google-pay"></i> Pay with Google Pay
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <div class="order-summary">
            <h2>Order Summary</h2>
            <div class="card">
                
                <?php foreach($cart_items as $item): ?>
                <div class="cart-item">
                    <div class="item-info">
                        <div class="item-img" style="background-image: url('<?php echo $item['image']; ?>');"></div>
                        <div class="item-details">
                            <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                            <p>Qty: 1</p>
                        </div>
                    </div>
                    <div class="item-price">
                        £<?php echo number_format($item['price'], 2); ?>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="summary-totals">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>£<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (8%)</span>
                        <span>£<?php echo number_format($tax, 2); ?></span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>£<?php echo number_format($total, 2); ?></span>
                    </div>
                </div>

                <button class="btn-checkout" onclick="showPrototypeModal()">Complete Order</button>
            </div>
        </div>

    </div>

    <div id="prototype-modal" class="modal-overlay">
        <div class="modal-content card">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem; color: #ffc439; margin-bottom: 20px;"></i>
            <h3 style="color: var(--text-main);">Prototype Version</h3>
            <p style="color: var(--text-sub); margin-bottom: 20px;">
                This is a demonstration of the CoreComponents checkout flow. No actual payment will be processed.
            </p>
            <button class="btn-checkout modal-btn" onclick="closePrototypeModal()">Return</button>
        </div>
    </div>

    <script>
        // --- 1. THEME SWITCHING ---
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) {
            document.documentElement.setAttribute('data-theme', currentTheme);
        }

        function toggleTheme() {
            const html = document.documentElement;
            const current = html.getAttribute('data-theme');
            
            if (current === 'light') {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        }

        // --- 2. PAYMENT METHOD TOGGLE ---
        function togglePayment(method) {
            const cardFields = document.getElementById('card-fields');
            const paypalFields = document.getElementById('paypal-fields');
            const googleFields = document.getElementById('googlepay-fields');

            cardFields.classList.add('hidden');
            paypalFields.classList.add('hidden');
            googleFields.classList.add('hidden');

            if (method === 'card') {
                cardFields.classList.remove('hidden');
            } else if (method === 'paypal') {
                paypalFields.classList.remove('hidden');
            } else if (method === 'googlepay') {
                googleFields.classList.remove('hidden');
            }
        }

        // --- 3. PROTOTYPE MODAL CONTROL (NEW) ---
        function showPrototypeModal() {
            // Prevent default form submission via simple logic here
            // In a real scenario, you'd check form validity first:
            // if(document.getElementById('checkoutForm').checkValidity()) ...
            
            document.getElementById('prototype-modal').classList.add('show');
        }

        function closePrototypeModal() {
            document.getElementById('prototype-modal').classList.remove('show');
        }

        // --- 4. CUSTOM ERROR MESSAGES ---
        const inputs = document.querySelectorAll('input');

        inputs.forEach(input => {
            const tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            if(input.parentElement) {
                input.parentElement.appendChild(tooltip);
            }

            input.addEventListener('invalid', (e) => {
                e.preventDefault(); 
                tooltip.textContent = input.validationMessage; 
                tooltip.classList.add('active');
            });

            input.addEventListener('input', () => {
                tooltip.classList.remove('active');
            });
        });
    </script>

</body>
</html>