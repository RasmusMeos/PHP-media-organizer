document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("edit-album-modal");
  const closeModalBtn = modal.querySelector(".close-btn");
  const cancelBtn = modal.querySelector(".cancel-btn");
  const saveBtn = modal.querySelector(".save-btn");

  // Open edit details modal
  document.querySelectorAll(".edit-folder-btn").forEach(button => {
    button.addEventListener("click", (e) => {
      const folderCard = e.target.closest(".folder-card");
      const folderId = folderCard.getAttribute("data-folder-id");
      const folderName = folderCard.querySelector(".folder-title a").textContent.trim();
      const folderDesc = folderCard.querySelector(".folder-description").textContent.trim();

      // Populate modal fields
      document.getElementById("folder-id-input").value = folderId;
      document.getElementById("edit-folder-name").value = folderName;
      document.getElementById("edit-folder-description").value = folderDesc;

      modal.classList.remove("hidden");
    });
  });

  // Save changes via AJAX
  saveBtn.addEventListener("click", () => {
    const folderId = document.getElementById("folder-id-input").value.trim();
    const folderName = document.getElementById("edit-folder-name").value.trim();
    const folderDescription = document.getElementById("edit-folder-description").value.trim();

    if (!folderName) {
      alert("Album name is required.");
      return;
    }

    fetch("/edit-folder", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        folder_id: folderId,
        folder_name: folderName,
        folder_desc: folderDescription || null,
      }),
    })
      .then((response) => {
        if (!response.ok) {
          return response.json().then((data) => {
            throw new Error(data.error || "Failed to save changes.");
          });
        }
        return response.json();
      })
      .then(() => {
       // alert("Changes saved successfully.");
        modal.classList.add("hidden");
        // Updating the UI to reflect changes
        const folderCard = document.querySelector(`.folder-card[data-folder-id="${folderId}"]`);
        folderCard.querySelector(".folder-title a").textContent = folderName;
        folderCard.querySelector(".folder-description").textContent = folderDescription || "";
      })
      .catch((error) => {
        console.error("Error saving changes:", error);
        alert(error.message);
      });
  });

  // Closing modal
  closeModalBtn.addEventListener("click", () => modal.classList.add("hidden"));
  cancelBtn.addEventListener("click", () => modal.classList.add("hidden"));

  // Close modal on outside click
  window.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.classList.add("hidden");
    }
  });
});
