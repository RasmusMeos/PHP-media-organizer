<header>
  <nav>
    <ul>
      <li><a href="/">Home</a></li>
      <?php if ($is_logged_in): ?>
        <li><a href="/upload.php">Upload</a> </li>
        <li><a href="/profile.php"><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li>
        <li><a href="/logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="/signup.php">Sign Up</a></li>
        <li><a href="/login.php">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
