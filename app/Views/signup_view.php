<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - PHP Image Organizer</title>
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
  <h1>Kasutaja loomine</h1>

  <!-- Kuva veasõnumid -->
  <?php
  function checkSignupErrors()
  {
    if (isset($_SESSION['errors_signup']) && !empty($_SESSION['errors_signup'])) {
      echo "<br>";
      foreach ($_SESSION['errors_signup'] as $error) {
        echo '<p class="form-error" style="color: red;">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
      }
      // Clear session variable
      unset($_SESSION['errors_signup']);
    }
  }

  checkSignupErrors();
  ?>

  <form action="/signup.php" method="POST">
    <label for="username">Kasutajanimi:</label>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="password">Parool:</label>
    <input type="password" id="password" name="password">

    <button type="submit">Loo kasutaja</button>
  </form>
</main>
</body>
</html>
