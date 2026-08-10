<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($page_title)) $page_title = "Gallery Mockers";
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $page_title; ?></title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" type="image/x-icon" href="assets/icongallerymockers.png">
  <script src="https://kit.fontawesome.com/2e8c644617.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm py-2">
    <div class="container-fluid px-lg-4">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="assets/icongallerymockers.png" alt="Gallery Mockers Logo" width="42" height="42" class="d-inline-block">
            <span class="fw-bold text-dark">Gallery Mockers</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo ($current_page == 'vm.php' || $current_page == 'history.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">About Us</a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item <?php echo ($current_page == 'vm.php') ? 'active' : ''; ?>" href="vm.php">Vision & Mission</a></li>
                        <li><a class="dropdown-item <?php echo ($current_page == 'history.php') ? 'active' : ''; ?>" href="history.php">History</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'gallery.php') ? 'active' : ''; ?>" href="gallery.php">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'news.php') ? 'active' : ''; ?>" href="news.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact Us</a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (isset($_SESSION['role_name']) && $_SESSION['role_name'] === 'Admin'): ?>
                        <a href="dashboard.php" class="btn btn-custom-outline-dark btn-sm rounded-pill px-3">
                            <i class="fa-solid fa-gauge-high me-1"></i> Dashboard
                        </a>
                    <?php endif; ?>
                    <a href="logout.php" class="btn btn-custom-danger btn-sm rounded-pill px-3">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout (<?= htmlspecialchars($_SESSION['username']); ?>)
                    </a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-custom-outline-dark btn-sm rounded-pill px-3">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                    </a>
                    <a href="register.php" class="btn btn-custom-dark btn-sm rounded-pill px-3">
                        <i class="fa-solid fa-user-plus me-1"></i> Register
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>