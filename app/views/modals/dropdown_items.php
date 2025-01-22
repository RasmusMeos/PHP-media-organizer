<!-- Edit folder details -->
<div class="edit-album-modal-overlay hidden">
  <div class="edit-album-modal">
    <h2>Edit Album Details</h2>
    <form id="edit-album-form">
      <input type="hidden" id="folder-id-input">

      <label for="edit-folder-name">Album Name:</label>
      <input type="text" id="edit-folder-name" required>

      <label for="edit-folder-description">Description:</label>
      <input type="text" id="edit-folder-description" placeholder="Add a short description">

      <div class="edit-modal-actions">
        <button type="button" class="save-btn">Save Changes</button>
        <button type="button" class="cancel-btn">Cancel</button>
      </div>
    </form>
  </div>
</div>



