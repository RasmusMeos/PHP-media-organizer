<?php
$title = "Home - PHP Media Organizer";
include base_path("App/views/partials/header.php");
include base_path("App/views/partials/topnav.php");

?>

<div class="page-message">
  <?php if (!isset($_SESSION['user_id'])): ?>
    <h1>Welcome to PHP Media Organizer</h1>
    <h3>Organize your images with ease!</h3>
    <p><a href="/signup">Get started by signing up</a></p>
  <?php else: ?>
    <?php if (!$has_content && $result): ?>
      <h1><?php echo "Welcome back, " . htmlspecialchars($_SESSION['screen_name'] ?? $_SESSION['username'] , ENT_QUOTES, 'UTF-8') . "!"; ?></h1>
      <p><?php echo "You have not uploaded any images yet:"; ?></p>
    <?php endif; ?>
    <?php if ($result && $has_content): ?>
      <h1><?php echo $currentPage === 1 ? "Welcome back, " . htmlspecialchars($_SESSION['screen_name'] ?? $_SESSION['username'] , ENT_QUOTES, 'UTF-8') . "!": ""; ?></h1>
      <p><?php echo !empty($images) && $currentPage === 1 ? "Your latest images will be displayed here:" : ""; ?></p>
      <p><?php echo empty($images) ? "You have not uploaded any images yet:" : ""; ?></p>
    <?php endif; ?>
  <?php endif; ?>

  <?php if ($has_content): ?>
  <?php include base_path("App/views/partials/search.php"); ?>
</div>
<div class="filter-button-container">
  <button id="open-filter">Filter Media</button>
</div>
<?php include base_path("App/views/modals/filter.php"); ?>
<?php endif; ?>


<main>
    <!-- looping through and displaying images -->
    <?php if (!empty($images) && $result): ?>
      <?php foreach ($images as $image): ?>
        <?php include base_path("App/views/partials/image_card.php"); ?>
      <?php endforeach; ?>
  <?php endif; ?>

    <?php if($has_content && !$result && isset($_SESSION['user_id'])): ?>
    <?php include base_path("App/views/system/empty_result.php"); ?>
    <?php endif; ?>
</main>
  <?php if (isset($_SESSION['user_id']) && $result): ?>
  <?php include base_path("App/views/partials/pagination.php"); ?>
  <?php include base_path("App/views/modals/delete_image.php"); ?>
  <?php endif; ?>


<?php include base_path("App/views/partials/footer.php"); ?>
