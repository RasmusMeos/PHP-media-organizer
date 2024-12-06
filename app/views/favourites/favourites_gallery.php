<?php
$title = "Favourites - PHP Media Organizer";
include base_path("app/views/partials/header.php");
include base_path("app/views/partials/topnav.php");

?>

  <main>
      <h1>Favourite media</h1>
      <p>Your favourited images will be displayed here:</p>

      <?php if (!empty($images)): ?>
        <?php foreach ($images as $image): ?>
          <?php include base_path("app/views/partials/image_card.php"); ?>
        <?php endforeach; ?>
      <?php else: ?>
        <p>You haven't favourited any images yet.</p>
      <?php endif; ?>
    <?php include base_path("app/views/modals/delete_image.php"); ?>
  </main>

<?php include base_path("app/views/partials/footer.php"); ?>

<?php
