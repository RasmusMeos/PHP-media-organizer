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
    <a href="javascript:void(0)" class="favorite-icon">
      <img src="/assets/icons/star.svg" alt="Favorite">
    </a>
    <button type="button" class="delete-icon" media-id="<?php echo $image['media_id']; ?>">
      <img src="/assets/icons/trash.svg" alt="Delete">
    </button>
  </div>
</div>
