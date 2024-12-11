<?php
$title = "Favourites - PHP Media Organizer";
include base_path("app/views/partials/header.php");
include base_path("app/views/partials/topnav.php");

?>

  <div class="page-message">
      <h1><?php echo $currentPage === 1 ? "Favourite media" : ""; ?></h1>
      <p><?php echo !empty($images) && $currentPage === 1 ? "Your favourited images will be displayed here:" : ""; ?></p>
      <p><?php echo empty($images) ? "You haven't favourited any images yet." : ""; ?></p>

  </div>
  <main>
      <?php if (!empty($images)): ?>
        <?php foreach ($images as $image): ?>
          <?php include base_path("app/views/partials/image_card.php"); ?>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php include base_path("app/views/modals/delete_image.php"); ?>
  </main>

<?php include base_path("app/views/partials/pagination.php"); ?>
<?php include base_path("app/views/partials/footer.php"); ?>

<?php
