<div class="image-wrapper">
  <div class="image-title">
    <span class="image-name"><?php echo htmlspecialchars($image['image_name'], ENT_QUOTES, 'UTF-8'); ?></span>
    <a href="edit_image.php?id=<?php echo $image['image_id']; ?>" class="edit-icon">
      <img src="/icons/pencil.png" alt="Edit">
    </a>
  </div>

  <div class="image-container">
    <img src="/serve_image.php?file=<?php echo htmlspecialchars(basename($image['file_path']), ENT_QUOTES, 'UTF-8'); ?>"
         alt="<?php echo htmlspecialchars($image['image_name'], ENT_QUOTES, 'UTF-8'); ?>"
         class="image-thumbnail">
  </div>

  <div class="image-actions">
    <a href="favorite_image.php?id=<?php echo $image['image_id']; ?>" class="favorite-icon">
      <img src="/icons/<?php echo $image['favourite'] ? 'star-filled.png' : 'star.png'; ?>" alt="Favorite">
    </a>
    <a href="delete_image.php?id=<?php echo $image['image_id']; ?>" class="delete-icon">
      <img src="/icons/trash.png" alt="Delete">
    </a>
  </div>
</div>
