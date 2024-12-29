document.addEventListener("DOMContentLoaded", () => {
  const filterModal = document.querySelector(".filter-modal-overlay");
  const applyFilterBtn = document.getElementById("apply-filter");
  const cancelFilterBtn = document.getElementById("cancel-filter");

  const orderSelect = document.getElementById("order");
  const typeSelect = document.getElementById("type");

  // Helper function to select values based on the current URL
  const initializeFilters = () => {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has("order")) {
      const orderValue = urlParams.get("order");
      const orderOption = Array.from(orderSelect.options).find(option => option.value === orderValue);
      if (orderOption) orderOption.selected = true;
    }

    if (urlParams.has("type")) {
      const typeValue = urlParams.get("type");
      const typeOption = Array.from(typeSelect.options).find(option => option.value === typeValue);
      if (typeOption) typeOption.selected = true;
    }
  };

  initializeFilters();

  let currentOrderValue;
  let currentTypeValue;

  // opening the modal and assigning initial values
  document.getElementById("open-filter").addEventListener("click", () => {
    currentOrderValue = orderSelect.value;
    currentTypeValue = typeSelect.value;
    filterModal.style.display = "flex";
  });

  // Closing modal actions - values get reset to their previous state (if no filters applied)
  cancelFilterBtn.addEventListener("click", () => {
    orderSelect.value = currentOrderValue;
    typeSelect.value = currentTypeValue;
    filterModal.style.display = "none";
  });

  filterModal.addEventListener("click", (e) => {
    if (e.target === filterModal) {
      orderSelect.value = currentOrderValue;
      typeSelect.value = currentTypeValue;
      filterModal.style.display = "none";
    }
  });

  // applying filters and updating the URL
  applyFilterBtn.addEventListener("click", () => {
    const urlParams = new URLSearchParams(window.location.search);

    if (orderSelect.value !== "desc") {
      urlParams.set("order", orderSelect.value);
    } else {
      urlParams.delete("order"); // descending by default
    }

    if (typeSelect.value !== "all") {
      urlParams.set("type", typeSelect.value);
    } else {
      urlParams.delete("type"); // all media by default
    }
    if (urlParams.has("page")) urlParams.delete("page"); // ensuring first page after applying filters

    window.location.href = `/?${urlParams.toString()}`; // redirecting with new params
    console.log(window.location.href);
  });
});
