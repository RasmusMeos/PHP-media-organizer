<div class="image-wrapper">
  <div class="image-title">
    <!-- Display mode -->
    <span class="image-name" media-id="<?php echo $image['media_id']; ?>">
        <?php echo htmlspecialchars($image['media_name'], ENT_QUOTES, 'UTF-8'); ?>
    </span>
    <!-- Edit mode -->
    <input type="text" class="image-name-input editing" media-id="<?php echo $image['media_id']; ?>"
           value="<?php echo htmlspecialchars($image['media_name'], ENT_QUOTES, 'UTF-8'); ?>">

    <button type="button" class="edit-icon" media-id="<?php echo $image['media_id']; ?>">
      <img src="/assets/icons/pencil.png" alt="Rename">
    </button>
  </div>

  <div class="image-container">
    <img src="/uploads/images/<?php echo htmlspecialchars(basename($image['file_name']), ENT_QUOTES, 'UTF-8'); ?>"
         alt="<?php echo htmlspecialchars($image['media_name'], ENT_QUOTES, 'UTF-8'); ?>"
         class="image-thumbnail" media-id="<?php echo $image['media_id']; ?>">
    <button type="button" class="fullscreen-icon" media-id="<?php echo $image['media_id']; ?>">
      <img src="/assets/icons/fullscreen.png" alt="View Fullscreen">
    </button>
  </div>

  <div class="image-actions">
    <?php $isFavourite = in_array($image['media_id'], $favourites); ?>
    <button type="button" class="favourite-icon <?php echo $isFavourite ? 'favourited' : ''; ?>" media-id="<?php echo $image['media_id']; ?>">
      <img src="/assets/icons/<?php echo $isFavourite ? 'star-filled.svg' : 'star.svg'; ?>" alt="<?php echo $isFavourite ? 'Unfavourite' : 'Favourite'; ?>">
    <button type="button" class="delete-icon" media-id="<?php echo $image['media_id']; ?>">
      <img src="/assets/icons/trash.png" alt="Delete">
    </button>
  </div>
</div>
