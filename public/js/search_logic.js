
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get('q');

    if (query) {
        const lowerCaseQuery = query.toLowerCase();
        const products = document.querySelectorAll('.product-card');
        let hasResults = false;

        products.forEach(product => {
            const title = product.querySelector('.product-title').textContent.toLowerCase();
            if (title.includes(lowerCaseQuery)) {
                product.style.display = 'block'; // Or whatever your default display is, usually block or flex
                hasResults = true;
            } else {
                product.style.display = 'none';
            }
        });

        // Show a message if no results found
        if (!hasResults) {
            const container = document.querySelector('.product-listing');
            if (container) {
                // Check if message already exists to avoid duplicates
                if (!document.querySelector('.no-results-msg')) {
                    const msg = document.createElement('div');
                    msg.className = 'no-results-msg';
                    msg.style.textAlign = 'center';
                    msg.style.width = '100%';
                    msg.style.padding = '2rem';
                    msg.style.gridColumn = '1 / -1'; // Span full width if grid
                    msg.innerHTML = `<h3>No results found for "${query}"</h3><p>Try checking your spelling or use different keywords.</p>`;
                    container.appendChild(msg);
                }
            }
        }
    }
});

