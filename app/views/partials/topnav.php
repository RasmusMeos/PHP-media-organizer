<header>
  <nav>
    <ul>
      <li><a href="/">Home</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="/favourites">Favourites</a> </li>
        <li><a href="/upload">Upload</a> </li>
        <li><a href="/profile">Profile</a></li>
        <li><a href="/change-password">Change Password</a></li>
        <li><a href="/logout">Logout</a></li>
      <?php else: ?>
        <li><a href="/signup">Sign Up</a></li>
        <li><a href="/login">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
