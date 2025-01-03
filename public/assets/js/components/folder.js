document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".toggle-description-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const description = btn.closest(".folder-card").querySelector(".folder-description");
      description.classList.toggle("hidden");
      btn.innerHTML = description.classList.contains("hidden") ? "&#9660" : "&#9650";
    });
  });
});
