<?php
session_start();
$page_title = "Admin Dashboard - Gallery Mockers";
require_once 'includes/config.php';

/** @var mysqli $conn */

// Auth Guard: Restrict page to logged-in Admins only
if (!isset($_SESSION['user_id']) || $_SESSION['role_name'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$msg = '';

// --- 1. PRODUCT CONTROLLER ---
if (isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $img = trim($_POST['img']);
    $description = trim($_POST['description']);

    $stmt = mysqli_prepare($conn, "INSERT INTO products (name, price, img, description) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sdss", $name, $price, $img, $description);
    if (mysqli_stmt_execute($stmt)) $msg = "Product added successfully!";
    mysqli_stmt_close($stmt);
}

if (isset($_GET['delete_product'])) {
    $id = intval($_GET['delete_product']);
    $stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) $msg = "Product deleted successfully!";
    mysqli_stmt_close($stmt);
}

// --- 2. HISTORY CONTROLLER ---
if (isset($_POST['add_history'])) {
    $year = trim($_POST['year']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    $stmt = mysqli_prepare($conn, "INSERT INTO history (year, title, description) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $year, $title, $description);
    if (mysqli_stmt_execute($stmt)) $msg = "History event added successfully!";
    mysqli_stmt_close($stmt);
}

if (isset($_GET['delete_history'])) {
    $id = intval($_GET['delete_history']);
    $stmt = mysqli_prepare($conn, "DELETE FROM history WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) $msg = "History event deleted successfully!";
    mysqli_stmt_close($stmt);
}

// Fetch Records
$products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$history  = mysqli_query($conn, "SELECT * FROM history ORDER BY id DESC");

$total_products = mysqli_num_rows($products);
$total_history  = mysqli_num_rows($history);

include 'includes/header.php';
?>

<div class="container my-5 min-vh-100">
    <!-- Header Banner -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-3 border-bottom gap-3">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-sliders me-2"></i>Admin Dashboard</h2>
            <p class="text-muted mb-0">Control catalog items and brand history timeline</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-dark rounded-pill px-3 py-2 fs-6 fw-normal">
                <i class="fa-solid fa-user-shield me-1"></i> <?= htmlspecialchars($_SESSION['username']); ?> (Admin)
            </span>
            <a href="logout.php" class="btn btn-custom-danger btn-sm">
                <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="dashboard-stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small uppercase fw-bold">Total Products</span>
                    <h3 class="fw-bold mb-0 mt-1"><?= $total_products; ?> Items</h3>
                </div>
                <div class="bg-light p-3 rounded-circle text-dark">
                    <i class="fa-solid fa-boxes-stacked fs-3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dashboard-stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small uppercase fw-bold">History Events</span>
                    <h3 class="fw-bold mb-0 mt-1"><?= $total_history; ?> Events</h3>
                </div>
                <div class="bg-light p-3 rounded-circle text-dark">
                    <i class="fa-solid fa-timeline fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <?php if ($msg): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> <?= htmlspecialchars($msg); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Navigation Tabs -->
    <ul class="nav custom-admin-tabs mb-4" id="adminTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active fw-bold" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button">
                <i class="fa-solid fa-box-archive me-2"></i>Product Management
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-bold" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button">
                <i class="fa-solid fa-clock-rotate-left me-2"></i>History Management
            </button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabContent">
        <!-- PRODUCTS TAB -->
        <div class="tab-pane fade show active" id="products" role="tabpanel">
            <div class="card dashboard-card p-4 mb-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-plus-circle me-2"></i>Add New Product</h5>
                <form method="POST" action="">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Mona Lisa Canvas" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control" placeholder="120.00" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Image Asset Path</label>
                            <input type="text" name="img" class="form-control" placeholder="assets/2.jpg" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Description</label>
                            <textarea name="description" class="form-control" placeholder="Describe the item..." rows="2" required></textarea>
                        </div>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-custom-dark mt-3">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Product
                    </button>
                </form>
            </div>

            <div class="card dashboard-card p-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-list me-2"></i>Product Catalog</h5>
                <div class="table-responsive">
                    <table class="table custom-admin-table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Preview</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($products)): ?>
                                <tr>
                                    <td class="fw-bold"><?= $row['id']; ?></td>
                                    <td><img src="<?= htmlspecialchars($row['img']); ?>" width="48" height="48" class="rounded-3 object-fit-cover border"></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($row['name']); ?></td>
                                    <td class="text-success fw-bold">$<?= number_format($row['price'], 2); ?></td>
                                    <td class="text-muted small" style="max-width: 300px;"><?= htmlspecialchars($row['description']); ?></td>
                                    <td>
                                        <a href="dashboard.php?delete_product=<?= $row['id']; ?>" class="btn btn-custom-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="fa-solid fa-trash-can me-1"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- HISTORY TAB -->
        <div class="tab-pane fade" id="history" role="tabpanel">
            <div class="card dashboard-card p-4 mb-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-plus-circle me-2"></i>Add History Timeline Event</h5>
                <form method="POST" action="">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Year</label>
                            <input type="text" name="year" class="form-control" placeholder="e.g. 2026" required>
                        </div>
                        <div class="col-md-9">
                            <label class="form-label small fw-semibold">Event Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Description</label>
                            <textarea name="description" class="form-control" placeholder="Event details..." rows="2" required></textarea>
                        </div>
                    </div>
                    <button type="submit" name="add_history" class="btn btn-custom-dark mt-3">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Event
                    </button>
                </form>
            </div>

            <div class="card dashboard-card p-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-timeline me-2"></i>History Records</h5>
                <div class="table-responsive">
                    <table class="table custom-admin-table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Year</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($history)): ?>
                                <tr>
                                    <td class="fw-bold"><?= $row['id']; ?></td>
                                    <td><span class="badge bg-dark rounded-pill px-3 py-2"><?= htmlspecialchars($row['year']); ?></span></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($row['title']); ?></td>
                                    <td class="text-muted small" style="max-width: 350px;"><?= htmlspecialchars($row['description']); ?></td>
                                    <td>
                                        <a href="dashboard.php?delete_history=<?= $row['id']; ?>" class="btn btn-custom-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">
                                            <i class="fa-solid fa-trash-can me-1"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>