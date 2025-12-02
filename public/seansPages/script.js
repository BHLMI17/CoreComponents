// script.js
// price slider on plp
const priceSlider = document.getElementById('price');
const priceValue = document.getElementById('price-value');

priceSlider.addEventListener('input', () => {
  const max = priceSlider.max;
  const current = priceSlider.value;
  priceValue.textContent = `£0 - £${current}`;
});

// checkout.js - Handles checkout page functionality

// Sample cart data for my backend people, idk if ts neessary but yeah
let cartItems = [
  {
    id: 1,
    name: "Razer Basilisk V3 X HyperSpeed",
    price: 34.99,
    quantity: 1,
    image: "Razer Basilisk V3 X HyperSpeed.png"
  },
  {
    id: 2,
    name: "AMD Ryzen 7 5800X",
    price: 139.99,
    quantity: 2,
    image: "AMD Ryzensets 7 5800X.png"
  },
  {
    id: 3,
    name: "Logitech G413 TKL SE Mechanical Gaming Keyboard",
    price: 34.99,
    quantity: 1,
    image: "Logitech G413 TKL SE Mechanical Gaming Keyboard.png"
  }
];

// Initialize checkout page
function initCheckout() {
  renderCartItems();
  updateSummary();
}

// Render cart items
function renderCartItems() {
  const checkoutContainer = document.getElementById('checkout-items');
  
  // Clear existing content except the title
  const title = checkoutContainer.querySelector('h2');
  checkoutContainer.innerHTML = '';
  checkoutContainer.appendChild(title);
  
  if (cartItems.length === 0) {
    checkoutContainer.innerHTML += `
      <div class="empty-cart-message">
        <p>Your basket is empty</p>
        <p>Add some items from the product listing page!</p>
      </div>
    `;
    return;
  }
  
  // Create cart item cards
  cartItems.forEach(item => {
    const itemCard = document.createElement('div');
    itemCard.className = 'cart-item';
    itemCard.innerHTML = `
      <img src="${item.image}" alt="${item.name}" class="cart-item-img" onerror="this.src='https://via.placeholder.com/100x100/1e1e1e/00ffcc?text=No+Image'">
      <div class="cart-item-details">
        <h3 class="cart-item-title">${item.name}</h3>
        <p class="cart-item-price">£${item.price.toFixed(2)}</p>
        <div class="cart-item-actions">
          <div class="quantity-controls">
            <button class="quantity-btn" onclick="decreaseQuantity(${item.id})">-</button>
            <span class="quantity-display">${item.quantity}</span>
            <button class="quantity-btn" onclick="increaseQuantity(${item.id})">+</button>
          </div>
          <button class="remove-btn" onclick="removeItem(${item.id})">Remove</button>
        </div>
      </div>
    `;
    checkoutContainer.appendChild(itemCard);
  });
}

// Update summary calculations
function updateSummary() {
  const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  const shipping = cartItems.length > 0 ? 2.99 : 0;
  const total = subtotal + shipping;
  
  document.getElementById('subtotal').textContent = `Subtotal: £${subtotal.toFixed(2)}`;
  document.getElementById('shipping').textContent = `Shipping: £${shipping.toFixed(2)}`;
  document.getElementById('total').innerHTML = `<strong>Total: £${total.toFixed(2)}</strong>`;
}

// Increase item quantity
function increaseQuantity(itemId) {
  const item = cartItems.find(i => i.id === itemId);
  if (item) {
    item.quantity++;
    renderCartItems();
    updateSummary();
  }
}

// Decrease item quantity
function decreaseQuantity(itemId) {
  const item = cartItems.find(i => i.id === itemId);
  if (item && item.quantity > 1) {
    item.quantity--;
    renderCartItems();
    updateSummary();
  }
}

// Remove item from cart
function removeItem(itemId) {
  cartItems = cartItems.filter(i => i.id !== itemId);
  renderCartItems();
  updateSummary();
}

// Clear entire cart
document.addEventListener('DOMContentLoaded', () => {
  initCheckout();
  
  // Clear cart button
  const clearCartBtn = document.querySelector('.clear-cart');
  if (clearCartBtn) {
    clearCartBtn.addEventListener('click', () => {
      if (confirm('Are you sure you want to clear your basket?')) {
        cartItems = [];
        renderCartItems();
        updateSummary();
      }
    });
  }
  
  // Proceed to payment button
  const checkoutBtn = document.querySelector('.checkout-btn');
  if (checkoutBtn) {
    checkoutBtn.addEventListener('click', () => {
      if (cartItems.length === 0) {
        alert('Your basket is empty!');
      } else {
        alert('Proceeding to payment... (Demo only)');
      }
    });
  }
});