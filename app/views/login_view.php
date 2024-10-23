<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - PHP Image Organizer</title>
  <link rel="stylesheet" href="/css/homepage.css">
</head>
<body>
<header>
  <nav>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/signup.php">Sign Up</a></li>
      <li><a href="/login.php">Login</a></li>
    </ul>
  </nav>
</header>

<main>
  <h1>Login</h1>

  <!-- Display error messages -->
  <?php
  function checkLoginErrors()
  {
    if (isset($_SESSION['errors_login']) && !empty($_SESSION['errors_login'])) {
      echo "<br>";
      foreach ($_SESSION['errors_login'] as $error) {
        echo '<p class="form-error" style="color: red;">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
      }
      unset($_SESSION['errors_login']);
    }
  }

  checkLoginErrors();
  ?>

  <form action="/login.php" method="POST">
    <label for="username">Kasutajanimi:</label>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="password">Parool:</label>
    <input type="password" id="password" name="password">

    <button type="submit">Login</button>
  </form>
</main>
</body>
</html>
