<div class="search-bar">
  <form id="search-form">
    <input type="text" id="search" name="search" placeholder="otsi nime järgi"
           value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <button type="submit">Otsi</button>
  </form>
</div>
<!-- styling in main_gallery.css -->


