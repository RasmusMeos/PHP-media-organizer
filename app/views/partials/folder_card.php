<div class="folder-wrapper">

  <div class="folder-header">
    <div class="folder-title">
      <!-- Display mode -->
      <span class="folder-name" folder-id="<?php echo $folder['folder_id']; ?>">
        <?php echo htmlspecialchars($folder['folder_name'], ENT_QUOTES, 'UTF-8'); ?>
      </span>
      <!-- Edit mode -->
      <input type="text" class="folder-name-input editing" folder-id="<?php echo $folder['folder_id']; ?>"
             value="<?php echo htmlspecialchars($folder['folder_name'], ENT_QUOTES, 'UTF-8'); ?>">

      <button type="button" class="rename-folder" folder-id="<?php echo $folder['folder_id']; ?>">
          <img src="/assets/icons/pencil.svg" alt="Rename">
        </button>
    </div>
      <div class="description-toggle">
        <button type="button" class="toggle-description-btn">&#9660</button>
      </div>
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
