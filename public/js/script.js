document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("[data-route]").forEach(el => {
    el.addEventListener("click", e => {
      e.preventDefault();
      console.log("Navigate:", el.dataset.route);
    });
  });

  document.getElementById("btn-cart")?.addEventListener("click", () => {
    console.log("Open cart");
  });

  document.getElementById("btn-account")?.addEventListener("click", () => {
    console.log("Open account");
  });

  // ========== SEARCH SUGGESTIONS LOGIC ==========
  const searchInput = document.getElementById("search-input");
  const suggestionsContainer = document.getElementById("search-suggestions");
  let searchTimeout;

  if (searchInput && suggestionsContainer) {
    searchInput.addEventListener("input", (e) => {
      clearTimeout(searchTimeout);
      const query = e.target.value.trim();

      if (query.length < 2) {
        suggestionsContainer.innerHTML = "";
        suggestionsContainer.classList.add("hidden");
        return;
      }

      // Debounce request by 300ms
      searchTimeout = setTimeout(() => {
        fetch(`/api/search-suggestions?query=${encodeURIComponent(query)}`)
          .then((res) => res.json())
          .then((data) => {
            suggestionsContainer.innerHTML = "";

            if (data.length > 0) {
              data.forEach((product) => {
                const item = document.createElement("a");
                item.href = `/product/${product.id}`;
                item.className = "suggestion-item";

                // Fallback image if missing
                const imgUrl = product.image_url || '/images/default-product.png';

                item.innerHTML = `
                  <div class="suggestion-img-wrap">
                    <img src="${imgUrl}" alt="${product.name}" class="suggestion-img">
                  </div>
                  <div class="suggestion-info">
                    <span class="suggestion-name">${product.name}</span>
                    <span class="suggestion-price">£${product.price}</span>
                  </div>
                `;
                suggestionsContainer.appendChild(item);
              });
              suggestionsContainer.classList.remove("hidden");
            } else {
              suggestionsContainer.innerHTML = `<div class="suggestion-no-results">No products found for "${query}"</div>`;
              suggestionsContainer.classList.remove("hidden");
            }
          })
          .catch((err) => console.error("Error fetching suggestions:", err));
      }, 300);
    });

    // Close suggestions when clicking outside
    document.addEventListener("click", (e) => {
      if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
        suggestionsContainer.classList.add("hidden");
      }
    });
  }

  // ========== AUTO-HIDE SUCCESS TOASTS ==========
  const successToast = document.querySelector(".success-toast");
  if (successToast) {
    setTimeout(() => {
      successToast.style.transition = "opacity 0.5s ease, transform 0.5s ease";
      successToast.style.opacity = "0";
      successToast.style.transform = "translateY(-10px)";
      setTimeout(() => {
        successToast.remove();
      }, 500); // Remove from DOM after fade out
    }, 3000); // 3 seconds delay
  }
});

