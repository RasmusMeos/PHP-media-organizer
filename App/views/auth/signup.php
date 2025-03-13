<?php
$title = "Signup - PHP Media Organizer";
include base_path("App/views/partials/header.php");
include base_path("App/views/partials/topnav.php");
include base_path("App/views/partials/error_messages.php");

displayErrors($errors);
?>

<div class="signup">
  <h1>Kasutaja loomine</h1>



  <form action="/signup" method="POST">
    <label for="username">Kasutajanimi:</label>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="password">Parool:</label>
    <input type="password" id="password" name="password">

    <button type="submit">Loo kasutaja</button>
  </form>
</div>

<?php include base_path("App/views/partials/footer.php"); ?>
