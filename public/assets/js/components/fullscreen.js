document.addEventListener("DOMContentLoaded", () => {
  // Fullscreen component
  const fullscreenOverlay = document.createElement("div");
  fullscreenOverlay.className = "fullscreen-overlay";
  fullscreenOverlay.innerHTML = `
         <div class="fullscreen-image-container">
            <img src="" alt="Fullscreen View" class="fullscreen-image">
            <button class="exit-fullscreen-icon">
                <img src="/assets/icons/fullscreen-exit.png" alt="Exit Fullscreen">
            </button>
        </div>
    `;
  document.body.appendChild(fullscreenOverlay);

  const overlayImage = fullscreenOverlay.querySelector(".fullscreen-image");
  const exitButton = fullscreenOverlay.querySelector(".exit-fullscreen-icon");

  // actions on fullscreen icon click
  document.querySelectorAll(".fullscreen-icon").forEach((fullscreenButton) => {
    fullscreenButton.addEventListener("click", () => {
      const mediaId = fullscreenButton.getAttribute("media-id");
      const imageElement = document.querySelector(`.image-thumbnail[media-id="${mediaId}"]`);
      const imageUrl = imageElement.getAttribute("src");

      overlayImage.src = imageUrl;
      fullscreenOverlay.classList.add("show");

    });
  });

  // exit fullscreen functionality
  exitButton.addEventListener("click", () => {
    fullscreenOverlay.classList.remove("show");
    overlayImage.src = "";
  });

  // exits fullscreen when clicking outside the image
  fullscreenOverlay.addEventListener("click", (event) => {
    if (event.target === fullscreenOverlay) {
      fullscreenOverlay.classList.remove("show");
      overlayImage.src = "";
    }
  });
});
