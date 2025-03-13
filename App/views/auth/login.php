<?php
$title = "Login - PHP Media Organizer";
include base_path("App/views/partials/header.php");
include base_path("App/views/partials/topnav.php");
include base_path("App/views/partials/error_messages.php");

displayErrors($errors);
?>

<div class="login">
  <h1>Login</h1>

  <form action="/login" method="POST">
    <label for="username">Kasutajanimi:</label>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="password">Parool:</label>
    <input type="password" id="password" name="password">

    <button type="submit">Login</button>
  </form>
</div>

<?php include base_path("App/views/partials/footer.php"); ?>
