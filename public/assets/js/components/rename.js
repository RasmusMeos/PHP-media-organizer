document.addEventListener("DOMContentLoaded", () => {
   // get all the edit buttons
  document.querySelectorAll(".edit-icon").forEach((editButton) => {
    editButton.addEventListener("click", () => {
      const mediaId = editButton.getAttribute("media-id");
      const titleContainer = editButton.closest(".image-title");
      titleContainer.classList.add("editing"); // editing mode ON
      const nameInput = titleContainer.querySelector(`.image-name-input[media-id="${mediaId}"]`);
      nameInput.focus(); // autofocus on the input field
      nameInput.select(); //everything selected
      // nameInput.setSelectionRange(nameInput.value.length, nameInput.value.length); // cursor placed to the end
    });
  });

  // name change submission logic
  document.querySelectorAll(".image-name-input").forEach((nameInput) => {
    nameInput.addEventListener("blur", () => submitNameChange(nameInput));
    nameInput.addEventListener("keydown", (event) => {
      if (event.key === "Enter") {
        event.preventDefault();
        submitNameChange(nameInput);
      }
    });
  });

  function submitNameChange(nameInput) {
    const mediaId = nameInput.getAttribute("media-id");
    const newName = nameInput.value.trim();
    const titleContainer = nameInput.closest(".image-title");
    const nameSpan = titleContainer.querySelector(`.image-name[media-id="${mediaId}"]`);
    const currentName = nameSpan.textContent.trim();

    if (!newName) {
      alert("Media name cannot be empty.");
      nameInput.value = currentName;
      titleContainer.classList.remove("editing");
      return;
    }

    if (newName === currentName) {
      titleContainer.classList.remove("editing");
      return;
    }

    fetch(`/rename-media`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ media_id: mediaId, media_name: newName }),
    })
      .then((response) => {
        if (!response.ok) {
          return response.json().then((data) => {
            throw new Error(data.error || "Failed to rename media.");
          });
        }
        return response.json();
      })
      .then((data) => {
        nameSpan.textContent = newName; // new name displayed in the UI
        titleContainer.classList.remove("editing"); // editing mode OFF
      })
      .catch((error) => {
        console.error("Error renaming media:", error);
        alert(error.message);
      });
  }
});
