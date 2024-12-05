<div id="delete-modal" class="modal-overlay">
  <div class="modal-content">
    <h2>Confirm Deletion</h2>
    <p>Are you sure you want to delete this image?</p>
    <div class="modal-actions">
      <form id="delete-form" method="POST" action="">
      <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="media-id" value="">
        <button type="submit" class="confirm-btn">Delete</button>
      </form>
      <button id="cancel-delete" class="cancel-btn">Cancel</button>
    </div>
  </div>
</div>

