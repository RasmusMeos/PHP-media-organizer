document.addEventListener("DOMContentLoaded", () => {

  document.querySelectorAll(".rename-folder").forEach((renameButton) => {
    renameButton.addEventListener("click", () => {
      const folderId = renameButton.getAttribute("folder-id");
      const titleContainer = renameButton.closest(".folder-title");
      titleContainer.classList.add("editing"); // editing mode ON
      const nameInput = titleContainer.querySelector(`.folder-name-input[folder-id="${folderId}"]`);
      nameInput.focus(); // autofocus on the input field
      nameInput.select(); //everything selected
    });
});

  // rename folder submission logic
  document.querySelectorAll(".folder-name-input").forEach((nameInput) => {
    nameInput.addEventListener("blur", () => submitNameChange(nameInput));
    nameInput.addEventListener("keydown", (event) => {
      if (event.key === "Enter") {
        event.preventDefault();
        submitNameChange(nameInput);
      }
    });
  });

  function submitNameChange(nameInput) {
    const folderId = nameInput.getAttribute("folder-id");
    const newName = nameInput.value.trim();
    const titleContainer = nameInput.closest(".folder-title");
    const nameSpan = titleContainer.querySelector(`.folder-name[folder-id="${folderId}"]`);
    const currentName = nameSpan.textContent.trim();

    if (!newName) {
      alert("Folder name cannot be empty.");
      nameInput.value = currentName;
      titleContainer.classList.remove("editing");
      return;
    }

    if (newName === currentName) {
      titleContainer.classList.remove("editing");
      return;
    }

    fetch(`/rename-folder`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ folder_id: folderId, folder_name: newName }),
    })
      .then((response) => {
        if (!response.ok) {
          return response.json().then((data) => {
            throw new Error(data.error || "Failed to rename the folder.");
          });
        }
        return response.json();
      })
      .then((data) => {
        nameSpan.textContent = newName; // new folder name displayed in the UI
        titleContainer.classList.remove("editing"); // editing mode OFF
      })
      .catch((error) => {
        console.error("Error renaming media:", error);
        alert(error.message);
      });
  }


});
