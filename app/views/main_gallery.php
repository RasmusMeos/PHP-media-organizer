<?php
$title = "Home - PHP Media Organizer";
include base_path() . "/app/views/partials/header.php";
include base_path() . "/app/views/partials/topnav.php";

?>

<main>
  <?php if (!$is_logged_in): ?>
    <h1>Welcome to PHP Media Organizer</h1>
    <h3>Organize your images with ease!</h3>
    <p><a href="signup.php">Get started by signing up</a></p>
  <?php else: ?>
    <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>!</h1>
    <p>Your latest images will be displayed here:</p>

    <!-- looping through and displaying images -->
    <?php if (!empty($images)): ?>
      <?php foreach ($images as $image): ?>
        <?php include '../app/views/partials/image_display.php'; ?>
      <?php endforeach; ?>
    <?php else: ?>
      <p>You haven't uploaded any images yet.</p>
    <?php endif; ?>
  <?php endif; ?>
</main>

<?php include base_path() . "/app/views/partials/footer.php"; ?>

