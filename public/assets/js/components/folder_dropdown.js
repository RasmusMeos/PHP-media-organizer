document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".dropdown-btn").forEach((button) => {
    button.addEventListener("click", (e) => {
      const dropdownMenu = button.nextElementSibling;
      dropdownMenu.classList.toggle("hidden");
      e.stopPropagation(); // Prevent click from bubbling up
    });
  });

  // Close dropdown menu when clicking outside
  document.addEventListener("click", () => {
    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
      menu.classList.add("hidden");
    });
  });
});
