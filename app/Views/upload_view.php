<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Image - PHP Image Organizer</title>
  <link rel="stylesheet" href="/css/homepage.css">
</head>
<body>
<header>
  <nav>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/upload.php">Upload Image</a></li>
      <li><a href="/logout.php">Logout</a></li>
    </ul>
  </nav>
</header>

<main>
  <h1>Upload Image</h1>

  <?php
  function checkUploadErrors()
  {
    if (isset($_SESSION['errors_upload']) && !empty($_SESSION['errors_upload'])) {
      echo "<br>";
      foreach ($_SESSION['errors_upload'] as $error) {
        echo '<p class="form-error" style="color: red;">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
      }
      unset($_SESSION['errors_upload']);
    }
  }

  checkUploadErrors();
  ?>

  <form action="/upload.php" method="POST" enctype="multipart/form-data">
    <label for="image">Vali pilt, mida üles laadida:</label>
    <input type="file" id="image" name="image" accept="image/*" >
    <button type="submit">Upload</button>
  </form>
</main>
</body>
</html>

