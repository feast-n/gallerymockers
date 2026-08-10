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

include 'includes/header.php';
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Management Dashboard</h2>
        <span class="badge bg-dark fs-6">Welcome, <?= htmlspecialchars($_SESSION['username']); ?></span>
    </div>

    <?php if ($msg): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($msg); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs mb-4" id="adminTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active fw-bold" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button">Products Management</button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-bold" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button">History Management</button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabContent">
        <!-- PRODUCTS TAB -->
        <div class="tab-pane fade show active" id="products" role="tabpanel">
            <div class="card p-4 mb-4 shadow-sm">
                <h5 class="card-title mb-3">Add New Product</h5>
                <form method="POST" action="">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control" placeholder="Product Name" required>
                        </div>
                        <div class="col-md-4">
                            <input type="number" step="0.01" name="price" class="form-control" placeholder="Price ($)" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="img" class="form-control" placeholder="Image Path (e.g. assets/2.jpg)" required>
                        </div>
                        <div class="col-12">
                            <textarea name="description" class="form-control" placeholder="Description" rows="2" required></textarea>
                        </div>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-dark mt-3">Add Product</button>
                </form>
            </div>

            <div class="card p-4 shadow-sm">
                <h5 class="card-title mb-3">Product Catalog</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($products)): ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><img src="<?= htmlspecialchars($row['img']); ?>" width="50" height="50" class="rounded object-fit-cover"></td>
                                    <td><?= htmlspecialchars($row['name']); ?></td>
                                    <td>$<?= number_format($row['price'], 2); ?></td>
                                    <td><?= htmlspecialchars($row['description']); ?></td>
                                    <td>
                                        <a href="dashboard.php?delete_product=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</a>
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
            <div class="card p-4 mb-4 shadow-sm">
                <h5 class="card-title mb-3">Add New History Event</h5>
                <form method="POST" action="">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="year" class="form-control" placeholder="Year (e.g. 2026)" required>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="title" class="form-control" placeholder="Event Title" required>
                        </div>
                        <div class="col-12">
                            <textarea name="description" class="form-control" placeholder="Event Description" rows="2" required></textarea>
                        </div>
                    </div>
                    <button type="submit" name="add_history" class="btn btn-dark mt-3">Add History Event</button>
                </form>
            </div>

            <div class="card p-4 shadow-sm">
                <h5 class="card-title mb-3">History Timeline</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
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
                                    <td><?= $row['id']; ?></td>
                                    <td><span class="badge bg-secondary"><?= htmlspecialchars($row['year']); ?></span></td>
                                    <td><?= htmlspecialchars($row['title']); ?></td>
                                    <td><?= htmlspecialchars($row['description']); ?></td>
                                    <td>
                                        <a href="dashboard.php?delete_history=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this history event?')">Delete</a>
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