<?php
$title = "Profile - PHP Media Organizer";
include base_path("app/views/partials/header.php");
include base_path("app/views/partials/topnav.php");
include base_path("app/views/partials/error_messages.php");

displayErrors($errors);
?>

  <main>
    <h1>Profiili Ülevaade</h1>
    <ul>
      <li>Kasutajanimi: <?php echo htmlspecialchars($user_data['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
      <li>E-post: <?php echo htmlspecialchars($user_data['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
      <li>
        <form action="/profile" method="POST">
            <label for="screen_name">Teistele nähtav nimi </label>
            <input type="text" id="screen_name" name="screen_name" value="<?php echo htmlspecialchars($user_data['screen_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            <button type="submit">Uuenda</button>
        </form>
      </li>
    </ul>



    </form>
  </main>

<?php include base_path("app/views/partials/footer.php"); ?>
