<?php
require_once 'includes/config.php';
$page_title  = "Vision & Mission - Gallery Mockers";
$active_page = "vm";
include 'includes/header.php';
?>

  <main class="container py-5 min-vh-100">
    <div class="row mb-5 text-center reveal">
        <div class="col-12">
            <h1 class="fw-bold display-4 text-dark">Vision & Mission</h1>
            <p class="lead text-dark">What drives our artistic endeavors everyday.</p>
        </div>
    </div>

    <div class="row g-4 g-lg-5 align-items-stretch">
      <div class="col-md-6 reveal">
        <div class="p-4 p-md-5 border border-dark rounded bg-white h-100 shadow-sm text-center">
          <i class="fa-solid fa-eye fa-3x text-dark mb-4"></i>
          <h2 class="fw-bold mb-4 text-dark">Our Vision</h2>
          <p class="fs-5 text-dark">"To be the world's most engaging and thought-provoking platform for contemporary art, breaking down the barriers of elitism in fine art through the universal language of humor and satire."</p>
        </div>
      </div>
      <div class="col-md-6 reveal">
        <div class="p-4 p-md-5 border border-dark rounded bg-white h-100 shadow-sm" style="border-width: 2px !important;">
          <div class="text-center"><i class="fa-solid fa-bullseye fa-3x text-dark mb-4"></i></div>
          <h2 class="text-center fw-bold mb-4 text-dark">Our Mission</h2>
          <ul class="list-group list-group-flush fs-5">
            <li class="list-group-item bg-transparent border-bottom-0 pb-3 text-dark px-0"><i class="fa-solid fa-check text-dark me-2"></i> <strong>Empower Artists:</strong> Provide a lucrative space for digital and traditional artists who specialize in parodic works.</li>
            <li class="list-group-item bg-transparent border-bottom-0 pb-3 text-dark px-0"><i class="fa-solid fa-check text-dark me-2"></i> <strong>Accessible Art:</strong> Ensure our artworks and exhibitions are approachable, avoiding pretentious jargon.</li>
            <li class="list-group-item bg-transparent border-bottom-0 text-dark px-0"><i class="fa-solid fa-check text-dark me-2"></i> <strong>Cultural Commentary:</strong> Use art as a mirror to reflect and critique modern societal norms playfully.</li>
          </ul>
        </div>
      </div>
    </div>
  </main>

<?php include 'includes/footer.php'; ?>