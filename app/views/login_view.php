<?php
$title = "Login - PHP Media Organizer";
require_once '../app/core/pathHelper.php';
include base_path() . "/app/views/partials/header.php";
include base_path() . "/app/views/partials/topnav.php";
include base_path() . "/app/views/partials/error_messages.php";

checkLoginErrors();
?>

<main>
  <h1>Login</h1>

  <form action="/login.php" method="POST">
    <label for="username">Kasutajanimi:</label>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="password">Parool:</label>
    <input type="password" id="password" name="password">

    <button type="submit">Login</button>
  </form>
</main>

<?php include base_path() . "/app/views/partials/footer.php"; ?>
