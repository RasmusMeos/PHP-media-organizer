<?php
$title = "Upload - PHP Media Organizer";
include base_path('App/views/partials/header.php');
include base_path('App/views/partials/topnav.php');
include base_path("App/views/partials/error_messages.php");

displayErrors($errors);
?>

<main>
  <h1>Upload Image</h1>

  <form action="/upload" method="POST" enctype="multipart/form-data">
    <label for="image">Vali pilt, mida üles laadida:</label>
    <input type="file" id="image" name="image" accept="image/*" >
    <button type="submit">Upload</button>
  </form>
</main>

<?php include base_path('App/views/partials/footer.php'); ?>

