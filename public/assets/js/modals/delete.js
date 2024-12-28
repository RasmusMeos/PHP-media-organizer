document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("delete-modal");
  const cancelDeleteBtn = document.getElementById("cancel-delete");
  let deleteBtnClicked = null;

  // adding click event to all delete buttons
  document.querySelectorAll(".delete-icon").forEach((deleteBtn) => {
    deleteBtn.addEventListener("click", (e) => {
      deleteBtnClicked = deleteBtn;
      modal.classList.add("show"); // show the modal
    });
  });

  document.querySelector(".confirm-btn").addEventListener("click", () => {
    if (!deleteBtnClicked) return; // button has to be clicked first

    const mediaId = deleteBtnClicked.getAttribute("media-id");

    // sending DELETE request via AJAX
    fetch(`/delete-image?id=${mediaId}`, {
      method: "DELETE",
    })
      .then((response) => {
        if (!response.ok) {
          return response.json().then((data) => {
            throw new Error(data.error || "Unknown error occurred.");
          });
        }
        return response.json(); //parsing the JSON response
      })
      .then((data) => {
        // SUCCESS: removing the image element from the DOM
        deleteBtnClicked.closest(".image-wrapper").remove();
        modal.classList.remove("show"); // closing the modal
        //alert(data.message || "Image deleted successfully.");
      })
      .catch((error) => {
        // error handling
        console.error("Error deleting image:", error);
        alert(error.message || "Failed to delete the image. Please try again.");
      });
  });

  // closing the pop-up logic
  cancelDeleteBtn.addEventListener("click", () => {
    modal.classList.remove("show");
  });

  modal.addEventListener("click", (e) => {
    if(e.target === modal)
      modal.classList.remove("show");
  });

});

