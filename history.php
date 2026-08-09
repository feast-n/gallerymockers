<?php
require_once 'includes/config.php';
$page_title  = "History - Gallery Mockers";
$active_page = "history";

// Query data history dari database
$history_query  = "SELECT * FROM history ORDER BY id ASC";
$history_result = mysqli_query($conn, $history_query);

include 'includes/header.php';
?>

  <main class="container py-5 min-vh-100">
    <div class="row justify-content-center reveal">
      <div class="col-lg-8 text-center mb-5">
        <h1 class="fw-bold display-4">Our History</h1>
        <p class="lead text-muted">The journey of bringing humor back into the rigid world of fine art.</p>
      </div>
    </div>
    
    <!-- Filter Year Buttons -->
    <div class="row justify-content-center mb-5 reveal">
      <div class="col-lg-8 text-center">
        <div class="d-flex flex-wrap justify-content-center gap-2" role="group" aria-label="Year filter" id="yearFilterGroup">
          <button type="button" class="btn btn-outline-dark rounded active" data-filter="all">All</button>
          <button type="button" class="btn btn-outline-dark rounded" data-filter="2020">2020</button>
          <button type="button" class="btn btn-outline-dark rounded" data-filter="2021">2021</button>
          <button type="button" class="btn btn-outline-dark rounded" data-filter="2022">2022</button>
          <button type="button" class="btn btn-outline-dark rounded" data-filter="2023">2023</button>
          <button type="button" class="btn btn-outline-dark rounded" data-filter="2024">2024</button>
          <button type="button" class="btn btn-outline-dark rounded" data-filter="2025">2025</button>
          <button type="button" class="btn btn-outline-dark rounded" data-filter="2026">2026</button>
        </div>
      </div>
    </div>
    
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <?php if ($history_result && mysqli_num_rows($history_result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($history_result)): ?>
            <div class="card border-0 shadow-sm mb-4" data-year="<?php echo htmlspecialchars($row['year']); ?>">
              <div class="card-body p-4">
                <h4 class="fw-bold text-black"><?php echo htmlspecialchars($row['title']); ?></h4>
                <p class="mb-0 text-muted"><?php echo htmlspecialchars($row['description']); ?></p>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>

    <div class="row justify-content-center reveal mt-5">
      <div class="col-auto text-center">
        <a href="gallery.php" class="spike-button text-decoration-none link-dark" aria-label="Explore the Gallery">
          <span class="spike-text fw-bold">Enter The Gallery</span>
        </a>
      </div>
    </div>
  </main>

<?php include 'includes/footer.php'; ?>