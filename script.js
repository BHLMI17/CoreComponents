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

  document.getElementById("search-form")?.addEventListener("submit", e => {
    e.preventDefault();
    console.log("Search:", document.getElementById("search-input").value);
  });
});
