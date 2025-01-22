<div class="folder-card" data-folder-id="<?php echo $folder['folder_id']; ?>">
  <!-- Icon Section -->
  <div class="folder-icon">
    <img src="/assets/icons/folder.png" alt="Folder">
  </div>

  <!-- Content Section -->
  <div class="folder-content">
    <h3 class="folder-title">
      <a href="/folders/<?php echo $folder['folder_id']; ?>">
        <?php echo htmlspecialchars($folder['folder_name'], ENT_QUOTES, 'UTF-8'); ?>
      </a>
    </h3>
    <div class="folder-description">
      <?php $maxLength = 50; //character limit ?>
      <?php if ($folder['folder_description'] !== null && strlen($folder['folder_description']) > $maxLength): ?>
      <span class="description-short">
        <?php echo htmlspecialchars(substr($folder['folder_description'], 0, $maxLength), ENT_QUOTES, 'UTF-8') . '...'; ?>
      </span>
      <span class="description-full hidden">
        <?php echo htmlspecialchars($folder['folder_description'], ENT_QUOTES, 'UTF-8'); ?>
      </span>
      <button class="toggle-description">See more</button>
      <?php else: ?>
        <span class="description-full">
        <?php echo $folder['folder_description'] !== null ? htmlspecialchars($folder['folder_description'], ENT_QUOTES, 'UTF-8') : ''; ?>
        </span>
      <?php endif; ?>
    </div>
  </div>

  <!-- Actions Section -->
  <div class="folder-actions">
    <button class="dropdown-btn">⋮</button>
    <?php include base_path("app/views/partials/folder_dropdown.php"); ?>
  </div>

</div>
