document.addEventListener("DOMContentLoaded", () => {
  // selecting all favourite buttons
  document.querySelectorAll(".favourite-icon").forEach((favouriteButton) => {
    favouriteButton.addEventListener("click", () => {
      const mediaId = favouriteButton.getAttribute("media-id");
      const isFavourited = favouriteButton.classList.contains("favourited"); // Check if currently favourited

      // request for toggling favourite status
      fetch(`/favourite-image`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          media_id: mediaId,
          action: isFavourited ? "unfavourite" : "favourite",
        }),
      })
        .then((response) => {
          if (!response.ok) {
            return response.json().then((data) => {
              throw new Error(data.error || "Failed to update favourite status.");
            });
          }
          return response.json();
        })
        .then((data) => {
          // updating UI elements based on status
          const imgElement = favouriteButton.querySelector("img");
          if (isFavourited) {
            favouriteButton.classList.remove("favourited");
            imgElement.src = "/assets/icons/star.svg";
            imgElement.alt = "Favourite";
          } else {
            favouriteButton.classList.add("favourited");
            imgElement.src = "/assets/icons/star-filled.svg";
            imgElement.alt = "Unfavourite";
          }
        })
        .catch((error) => {
          console.error("Error toggling favourite:", error);
          alert("Failed to toggle favourite status. Please try again.");
        });
    });
  });
});
