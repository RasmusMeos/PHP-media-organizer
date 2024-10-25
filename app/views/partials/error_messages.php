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

?>
