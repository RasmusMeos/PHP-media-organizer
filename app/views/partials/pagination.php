<?php if ($totalPages > 1): ?>
  <div class="pagination">
    <p>Viewing page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></p>
    <div class="pagination-buttons">
      <!-- "Previous" button -->
      <a href="<?php echo $currentPage > 1 ? $baseEndpoint . '?page=' . ($currentPage - 1) : '#'; ?>"
         class="pagination-btn <?php echo $currentPage === 1 ? 'disabled' : ''; ?>">
        Previous
      </a>

      <!-- First page button (always '1') -->
      <a href="<?php echo $baseEndpoint; ?>?page=1"
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
        <a href="<?php echo $baseEndpoint; ?>?page=<?php echo $i; ?>"
           class="pagination-btn <?php echo $i === $currentPage ? 'active' : ''; ?>">
          <?php echo $i; ?>
        </a>
      <?php endfor; ?>

      <!-- Three dots for skipped pages (after current page range) -->
      <?php if ($currentPage < $totalPages - 2): ?>
        <span class="pagination-ellipsis">...</span>
      <?php endif; ?>

      <!-- Last page button (always equal to $totalPages) -->
      <a href="<?php echo $baseEndpoint; ?>?page=<?php echo $totalPages; ?>"
         class="pagination-btn <?php echo $currentPage === $totalPages ? 'active' : ''; ?>">
        <?php echo $totalPages; ?>
      </a>

      <!-- "Next" button -->
      <a href="<?php echo $currentPage < $totalPages ? $baseEndpoint . '?page=' . ($currentPage + 1) : '#'; ?>"
         class="pagination-btn <?php echo $currentPage === $totalPages ? 'disabled' : ''; ?>">
        Next
      </a>
    </div>
  </div>
<?php endif; ?>
