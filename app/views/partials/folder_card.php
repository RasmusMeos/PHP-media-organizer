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
    <p class="folder-description">
      <?php
      $description = htmlspecialchars($folder['folder_description'], ENT_QUOTES, 'UTF-8');
      $maxLength = 100; // character limit
      if (strlen($description) > $maxLength) {
        echo substr($description, 0, $maxLength) . '...';
        ?>
        <button class="see-more">See more</button>
        <?php
      } else {
        echo $description;
      }
      ?>
    </p>
  </div>

  <!-- Actions Section -->
  <div class="folder-actions">
    <button class="dropdown-btn">⋮</button>
    <?php include base_path("app/views/partials/folder_dropdown.php"); ?>
  </div>

</div>
