<!-- Kuva veasõnumid -->
<?php
function displayErrors(array $errors = [])
{
  if (!empty($errors)) {
    foreach ($errors as $error) {
      echo '<p class="form-error" style="color: red;">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
    }
  }
}

?>
