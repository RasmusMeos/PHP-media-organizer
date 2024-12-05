document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("delete-modal");
  const deleteForm = document.getElementById("delete-form");
  const cancelDeleteBtn = document.getElementById("cancel-delete");

  // adding click event to all delete icons (icons -> trash.svg)
  document.querySelectorAll(".delete-icon").forEach((deleteLink) => {
    deleteLink.addEventListener("click", (e) => {
      e.preventDefault(); // prevents from navigating to the router

      // getting the delete URL and image ID
      const deleteUrl = deleteLink.getAttribute("href");
      const imageId = deleteLink.getAttribute("media-id");

      // passing the values to the popup screen
      deleteForm.action = deleteUrl;
      deleteForm.querySelector("input[name='media-id']").value = imageId;

      // showing the modal
      modal.classList.add("show");
    });
  });

  // cancel button logic
  cancelDeleteBtn.addEventListener("click", () => {
    modal.classList.remove("show"); // hiding the modal
  });
});

