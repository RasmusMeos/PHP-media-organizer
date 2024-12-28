<?php if ($totalPages > 1): ?>
  <?php
  $currentParams = $_GET; // existing query parameters

 //print_r($currentParams);

  function buildURLWithParams($baseEndpoint, $page, $params) {
    $params['page'] = $page; // Update the page parameter
    return $baseEndpoint . '?' . http_build_query($params);
  }
  ?>

  <div class="pagination">
    <p>Viewing page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></p>
    <div class="pagination-buttons">
      <!-- "Previous" button -->
      <a href="<?php echo $currentPage > 1 ? buildURLWithParams($baseEndpoint, $currentPage - 1, $currentParams) : '#'; ?>"         class="pagination-btn <?php echo $currentPage === 1 ? 'disabled' : ''; ?>">
        Previous
      </a>

      <!-- First page button (always '1') -->
      <a href="<?php echo buildURLWithParams($baseEndpoint, 1, $currentParams); ?>"
         class="pagination-btn <?php echo $currentPage === 1 ? 'active' : ''; ?>">1</a>

      <!-- Three dots for skipped pages (before current page range) -->
      <?php if ($currentPage > 3): ?>
        <span class="pagination-ellipsis">...</span>
      <?php endif; ?>

      <!-- Dynamic middle page buttons -->
      <?php
      $start = max(2, $currentPage - 1); // start from either the 2nd page or one before current
      $end = min($totalPages - 1, $currentPage + 1); // end at the second-to-last page or one after the current
      ?>
      <?php for ($i = $start; $i <= $end; $i++): ?>
        <a href="<?php echo buildURLWithParams($baseEndpoint, $i, $currentParams);?>"
           class="pagination-btn <?php echo $i === $currentPage ? 'active' : ''; ?>">
          <?php echo $i; ?>
        </a>
      <?php endfor; ?>

      <!-- Three dots for skipped pages (after current page range) -->
      <?php if ($currentPage < $totalPages - 2): ?>
        <span class="pagination-ellipsis">...</span>
      <?php endif; ?>

      <!-- Last page button (always equal to $totalPages) -->
      <a href="<?php echo buildURLWithParams($baseEndpoint, $totalPages, $currentParams); ?>"
         class="pagination-btn <?php echo $currentPage === $totalPages ? 'active' : ''; ?>">
        <?php echo $totalPages; ?>
      </a>

      <!-- "Next" button -->
      <a href="<?php echo $currentPage < $totalPages ? buildURLWithParams($baseEndpoint, $currentPage + 1, $currentParams) : '#'; ?>"
         class="pagination-btn <?php echo $currentPage === $totalPages ? 'disabled' : ''; ?>">
        Next
      </a>
    </div>
  </div>
<?php endif; ?>
