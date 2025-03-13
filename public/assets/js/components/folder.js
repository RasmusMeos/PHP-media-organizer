document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".toggle-description").forEach((btn) => {
    btn.addEventListener("click", () => {
      const descriptionShort = btn.closest(".folder-description").querySelector(".description-short");
      const descriptionFull = btn.closest(".folder-description").querySelector(".description-full");

      // Toggle visibility
      descriptionShort.classList.toggle("hidden");
      descriptionFull.classList.toggle("hidden");

      // Update button text
      btn.textContent = descriptionFull.classList.contains("hidden") ? "See more" : "See less";
    });
  });
});
