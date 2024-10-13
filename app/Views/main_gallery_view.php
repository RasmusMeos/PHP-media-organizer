<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - PHP Image Organizer</title>
  <link rel="stylesheet" href="/css/homepage.css">
  <link rel="stylesheet" href="/css/image_gallery.css">
</head>
<body>
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

<main>
  <?php if (!$is_logged_in): ?>
    <h1>Welcome to PHP Image Organizer</h1>
    <h3>Organize your images with ease!</h3>
    <p><a href="signup.php">Get started by signing up</a></p>
  <?php else: ?>
    <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>!</h1>
    <p>Your latest images will be displayed here:</p>

    <!-- looping through and displaying images -->
    <?php if (!empty($images)): ?>
      <?php foreach ($images as $image): ?>
        <?php include '../app/Views/image_display_view.php'; ?>
      <?php endforeach; ?>
    <?php else: ?>
      <p>You haven't uploaded any images yet.</p>
    <?php endif; ?>
  <?php endif; ?>
</main>
</body>
</html>
