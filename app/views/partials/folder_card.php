<div class="folder-card" data-folder-id="<?php echo $folder['folder_id']; ?>">
  <div class="folder-header">
    <h3 class="folder-name">
      <?php echo htmlspecialchars($folder['folder_name'], ENT_QUOTES, 'UTF-8'); ?>
      <button type="button" id="rename-folder-btn">
        <img src="/assets/icons/pencil.svg" alt="Rename">
      </button>
    </h3>
    <button type="button" class="toggle-description-btn">&#9660</button>
  </div>
  <div class="folder-description hidden">
    <div class="folder-description-container">
      <p><?php echo htmlspecialchars($folder['folder_description'], ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
  </div>
  <div class="folder-actions">
    <button type="button" class="add-media-btn">
      <img src="/assets/icons/plus.png" alt="Add Media">
    </button>
    <button type="button" class="delete-folder-btn">
      <img src="/assets/icons/trash.svg" alt="Delete Folder">
    </button>
  </div>
</div>
