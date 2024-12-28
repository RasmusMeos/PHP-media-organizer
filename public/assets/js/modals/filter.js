document.addEventListener("DOMContentLoaded", () => {
  const filterModal = document.querySelector(".filter-modal-overlay");
  const applyFilterBtn = document.getElementById("apply-filter");
  const cancelFilterBtn = document.getElementById("cancel-filter");

  // opening and closing the filter modal
  document.getElementById("open-filter").addEventListener("click", () => {
    filterModal.style.display = "flex";
  });
  cancelFilterBtn.addEventListener("click", () => {
    filterModal.style.display = "none";
  });

  filterModal.addEventListener("click", (e) => {
    if(e.target === filterModal)
    filterModal.style.display = "none";
  });


  applyFilterBtn.addEventListener("click", () => {
    const order = document.getElementById("order").value;
    const type = document.getElementById("type").value;

    // building a query string
    const urlParams = new URLSearchParams(window.location.search);
    if (order !== "desc") urlParams.set("order", order);
    else urlParams.delete("order"); // Remove if default

    if (type !== "all") urlParams.set("type", type);
    else urlParams.delete("type"); // Remove if default

    window.location.href = `/?${urlParams.toString()}`; // Redirect with new params
  });
});
