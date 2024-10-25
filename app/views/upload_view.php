<?php
$title = "Upload - PHP Media Organizer";
require_once '../app/core/pathHelper.php';
include base_path() . "/app/views/partials/header.php";
include base_path() . "/app/views/partials/topnav.php";
include base_path() . "/app/views/partials/error_messages.php";

checkUploadErrors();
?>

<main>
  <h1>Upload Image</h1>

  <form action="/upload.php" method="POST" enctype="multipart/form-data">
    <label for="image">Vali pilt, mida üles laadida:</label>
    <input type="file" id="image" name="image" accept="image/*" >
    <button type="submit">Upload</button>
  </form>
</main>

<?php include base_path() . "/app/views/partials/footer.php"; ?>

