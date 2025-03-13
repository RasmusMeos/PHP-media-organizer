<div class="filter-modal-overlay">
  <div class="filter-modal">
    <h2>Filter Media</h2>
    <form id="filter-form">
      <!-- Ordering -->
      <label for="order">Order:</label>
      <select id="order" name="order">
        <option value="desc" >Newest First</option>
        <option value="asc">Oldest First</option>
      </select>

      <!-- Media Type -->
      <label for="type">Media Type:</label>
      <select id="type" name="type">
        <option value="all">All</option>
        <option value="image">Images</option>
        <option value="video">Videos</option>
      </select>

      <div class="filter-actions">
        <button type="button" id="apply-filter">Apply</button>
        <button type="button" id="cancel-filter">Cancel</button>
      </div>
    </form>
  </div>
</div>
