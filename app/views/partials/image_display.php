<div class="image-wrapper">
  <div class="image-title">
    <span class="image-name"><?php echo htmlspecialchars($image['media_name'], ENT_QUOTES, 'UTF-8'); ?></span>
    <a href="edit_image.php?id=<?php echo $image['media_id']; ?>" class="edit-icon">
      <img src="/assets/icons/pencil.svg" alt="Edit">
    </a>
  </div>

  <div class="image-container">
    <img src="/uploads/images/<?php echo htmlspecialchars(basename($image['file_name']), ENT_QUOTES, 'UTF-8'); ?>"
         alt="<?php echo htmlspecialchars($image['media_name'], ENT_QUOTES, 'UTF-8'); ?>"
         class="image-thumbnail">
  </div>

  <div class="image-actions">
    <a href="favorite_image.php?id=<?php echo $image['media_id']; ?>" class="favorite-icon">
      <img src="/assets/icons/star.svg" alt="Favorite">
    </a>
    <a href="delete_image.php?id=<?php echo $image['media_id']; ?>" class="delete-icon">
      <img src="/assets/icons/trash.svg" alt="Delete">
    </a>
  </div>
</div>
