<?php
$title = "Albums - PHP Media Organizer";
include base_path("app/views/partials/header.php");
include base_path("app/views/partials/topnav.php");
include base_path("app/views/partials/error_messages.php");

?>

<div class="page-message">
  <h1>Albums</h1>
  <p>Manage your albums here.</p>
</div>

<div class="folders-container">
  <div class="create-folder">
    <h2>Create a New Album</h2>
    <form action="/create-folder" method="POST" id="create-folder-form">
      <label for="folder-name">Album Name:</label>
      <input type="text" id="folder-name" name="folder_name" >
      <label for="folder-description">Description:</label>
      <input type="text" id="folder-description" name="folder_desc" placeholder="add a short description"
      value="<?php echo htmlspecialchars($folder_desc, ENT_QUOTES, 'UTF-8'); ?>">
      <button type="submit">Create Album</button>
    </form>
    <?php displayErrors($errors); ?>
    <?php if (!empty($success)): ?>
      <div class="success-message"> <!-- styling in albums.css -->
        <?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="folder-list">
    <h2>Your Albums</h2>
      <?php if (!empty($folders)): ?>
        <?php foreach ($folders as $folder): ?>
            <?php include base_path('app/views/partials/folder_card.php'); ?>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No albums found. Create one to get started!</p>
      <?php endif; ?>
  </div>

<?php include base_path("app/views/modals/dropdown_items.php"); ?>
<?php include base_path("app/views/partials/footer.php"); ?>
