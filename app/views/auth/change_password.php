<?php
$title = "Change Password - PHP Media Organizer";
include base_path("app/views/partials/header.php");
include base_path("app/views/partials/topnav.php");
include base_path("app/views/partials/error_messages.php");

displayErrors($errors);
?>

<main>
  <h1>Parooli muutmine</h1>



  <form action="/change-password" method="POST">

    <label for="old_pwd">Kehtiv parool:</label>
    <input type="password" id="old_pwd" name="old_pwd">

    <label for="pwd">Uus parool:</label>
    <input type="password" id="pwd" name="pwd">

    <label for="pwd_confirm">Kinnita uus parool:</label>
    <input type="password" id="pwd_confirm" name="pwd_confirm">

    <button type="submit">Vaheta parool</button>
  </form>
</main>

<?php include base_path("app/views/partials/footer.php"); ?>
