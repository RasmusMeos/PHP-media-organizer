document.addEventListener("DOMContentLoaded", () => {
  const modalOverlay = document.querySelector(".edit-album-modal-overlay");
  const modal = modalOverlay.querySelector(".edit-album-modal");
  const cancelBtn = modal.querySelector(".cancel-btn");
  const saveBtn = modal.querySelector(".save-btn");

  document.querySelectorAll(".edit-folder-btn").forEach(button => {
    button.addEventListener("click", (e) => {
      const folderCard = e.target.closest(".folder-card");
      const folderId = folderCard.getAttribute("data-folder-id");
      const folderName = folderCard.querySelector(".folder-title a").textContent.trim();
      const folderDescElement = folderCard.querySelector(".description-full");
      const folderDesc = folderDescElement ? folderDescElement.textContent.trim() : "";

      // extract values
      document.getElementById("folder-id-input").value = folderId;
      document.getElementById("edit-folder-name").value = folderName;
      document.getElementById("edit-folder-description").value = folderDesc;

      // Show modal
      modalOverlay.classList.remove("hidden");
    });
  });


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
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        folder_id: folderId,
        folder_name: folderName,
        folder_desc: folderDescription || '',
      }),
    })
      .then(response => {
        if (!response.ok) {
          return response.json().then(data => {
            throw new Error(data.error || "Failed to save changes.");
          });
        }
        return response.json();
      })
      .then(() => {
        modalOverlay.classList.add("hidden"); // Hide modal

        // updating UI
        const folderCard = document.querySelector(`.folder-card[data-folder-id="${folderId}"]`);
        folderCard.querySelector(".folder-title a").textContent = folderName;

        const folderDescriptionContainer = folderCard.querySelector(".folder-description");
        folderDescriptionContainer.innerHTML = ''; // clearing existing content

        const maxLength = 50;

        if (folderDescription.length > maxLength) {
          // short description
          const shortDescription = document.createElement("span");
          shortDescription.className = "description-short";
          shortDescription.textContent = folderDescription.substring(0, maxLength) + "... ";

          // full description (hidden by default)
          const fullDescription = document.createElement("span");
          fullDescription.className = "description-full hidden";
          fullDescription.textContent = folderDescription;

          // toggling button
          const toggleButton = document.createElement("button");
          toggleButton.className = "toggle-description";
          toggleButton.textContent = "See more";
          toggleButton.addEventListener("click", () => toggleDescription(toggleButton));

          folderDescriptionContainer.appendChild(shortDescription);
          folderDescriptionContainer.appendChild(fullDescription);
          folderDescriptionContainer.appendChild(toggleButton);
        } else {
          const fullDescription = document.createElement("span");
          fullDescription.className = "description-full";
          fullDescription.textContent = folderDescription;
          folderDescriptionContainer.appendChild(fullDescription);
        }
      })
      .catch(error => {
        console.error("Error saving changes:", error);
        alert(error.message);
      });
  });

  // Closing modal actions
  cancelBtn.addEventListener("click", () => modalOverlay.classList.add("hidden"));
  window.addEventListener("click", (e) => {
    if (e.target === modalOverlay) {
      modalOverlay.classList.add("hidden");
    }
  });

  // toggling description visibility
  function toggleDescription(button) {
    const folderCard = button.closest(".folder-card");
    const shortDesc = folderCard.querySelector(".description-short");
    const fullDesc = folderCard.querySelector(".description-full");

    if (fullDesc.classList.contains("hidden")) {
      shortDesc.classList.add("hidden");
      fullDesc.classList.remove("hidden");
      button.textContent = "See less";
    } else {
      shortDesc.classList.remove("hidden");
      fullDesc.classList.add("hidden");
      button.textContent = "See more";
    }
  }
});
