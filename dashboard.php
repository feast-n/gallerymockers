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
$msg_type = 'success';

// Ensure upload directory exists
$upload_dir = 'assets/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// --- 1. PRODUCT CONTROLLER ---

// Add Product
if (isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $description = trim($_POST['description']);
    $imgPath = trim($_POST['img_path']);

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $fileName = time() . '_' . basename($_FILES['image_file']['name']);
        $targetFile = $upload_dir . $fileName;
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetFile)) {
            $imgPath = $targetFile;
        }
    }

    if (!empty($name) && !empty($imgPath)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO products (name, price, img, description) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sdss", $name, $price, $imgPath, $description);
        if (mysqli_stmt_execute($stmt)) {
            $msg = "Product added successfully!";
        } else {
            $msg = "Error adding product.";
            $msg_type = 'danger';
        }
        mysqli_stmt_close($stmt);
    }
}

// Edit Full Product
if (isset($_POST['update_product'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $description = trim($_POST['description']);
    $imgPath = trim($_POST['old_img']);

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $fileName = time() . '_' . basename($_FILES['image_file']['name']);
        $targetFile = $upload_dir . $fileName;
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetFile)) {
            $imgPath = $targetFile;
        }
    } elseif (!empty($_POST['img_path'])) {
        $imgPath = trim($_POST['img_path']);
    }

    $stmt = mysqli_prepare($conn, "UPDATE products SET name = ?, price = ?, img = ?, description = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sdssi", $name, $price, $imgPath, $description, $id);
    if (mysqli_stmt_execute($stmt)) {
        $msg = "Product updated successfully!";
    } else {
        $msg = "Error updating product.";
        $msg_type = 'danger';
    }
    mysqli_stmt_close($stmt);
}

// Dedicated Controller: Quick Update Image Only
if (isset($_POST['update_image_only'])) {
    $id = intval($_POST['id']);
    $imgPath = trim($_POST['old_img']);

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $fileName = time() . '_' . basename($_FILES['image_file']['name']);
        $targetFile = $upload_dir . $fileName;
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetFile)) {
            $imgPath = $targetFile;
        }
    } elseif (!empty($_POST['img_path'])) {
        $imgPath = trim($_POST['img_path']);
    }

    $stmt = mysqli_prepare($conn, "UPDATE products SET img = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $imgPath, $id);
    if (mysqli_stmt_execute($stmt)) {
        $msg = "Product image updated successfully!";
    } else {
        $msg = "Error updating image.";
        $msg_type = 'danger';
    }
    mysqli_stmt_close($stmt);
}

// Delete Product
if (isset($_GET['delete_product'])) {
    $id = intval($_GET['delete_product']);
    $stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $msg = "Product deleted successfully!";
    }
    mysqli_stmt_close($stmt);
}

// --- 2. HISTORY CONTROLLER ---

if (isset($_POST['add_history'])) {
    $year = trim($_POST['year']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    $stmt = mysqli_prepare($conn, "INSERT INTO history (year, title, description) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $year, $title, $description);
    if (mysqli_stmt_execute($stmt)) {
        $msg = "History event added successfully!";
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['update_history'])) {
    $id = intval($_POST['id']);
    $year = trim($_POST['year']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    $stmt = mysqli_prepare($conn, "UPDATE history SET year = ?, title = ?, description = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $year, $title, $description, $id);
    if (mysqli_stmt_execute($stmt)) {
        $msg = "History event updated successfully!";
    } else {
        $msg = "Error updating history event.";
        $msg_type = 'danger';
    }
    mysqli_stmt_close($stmt);
}

if (isset($_GET['delete_history'])) {
    $id = intval($_GET['delete_history']);
    $stmt = mysqli_prepare($conn, "DELETE FROM history WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $msg = "History event deleted successfully!";
    }
    mysqli_stmt_close($stmt);
}

// --- 3. MESSAGES CONTROLLER ---

if (isset($_GET['delete_message'])) {
    $id = intval($_GET['delete_message']);
    $stmt = mysqli_prepare($conn, "DELETE FROM messages WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $msg = "Message deleted successfully!";
    }
    mysqli_stmt_close($stmt);
}

// Fetch Records
$products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$history  = mysqli_query($conn, "SELECT * FROM history ORDER BY id DESC");
$messages = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC");

$total_products = mysqli_num_rows($products);
$total_history  = mysqli_num_rows($history);
$total_messages = mysqli_num_rows($messages);

include 'includes/header.php';
?>

<div class="container my-5 min-vh-100">
    <!-- Header Banner -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-3 border-bottom gap-3">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-sliders me-2"></i>Admin Dashboard</h2>
            <p class="text-muted mb-0">Control catalog items, brand history timeline, and view contact messages</p>
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
        <div class="col-md-4">
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
        <div class="col-md-4">
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
        <div class="col-md-4">
            <div class="dashboard-stat-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small uppercase fw-bold">Contact Messages</span>
                    <h3 class="fw-bold mb-0 mt-1"><?= $total_messages; ?> Messages</h3>
                </div>
                <div class="bg-light p-3 rounded-circle text-dark">
                    <i class="fa-solid fa-envelope fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <?php if ($msg): ?>
        <div class="alert alert-<?= $msg_type; ?> alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
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
        <li class="nav-item">
            <button class="nav-link fw-bold" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button">
                <i class="fa-solid fa-envelope-open-text me-2"></i>Contact Messages
                <?php if ($total_messages > 0): ?>
                    <span class="badge bg-danger rounded-pill ms-1"><?= $total_messages; ?></span>
                <?php endif; ?>
            </button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabContent">
        <!-- PRODUCTS TAB -->
        <div class="tab-pane fade show active" id="products" role="tabpanel">
            <div class="card dashboard-card p-4 mb-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-plus-circle me-2"></i>Add New Product</h5>
                <form method="POST" action="" enctype="multipart/form-data">
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
                            <label class="form-label small fw-semibold">Upload Image File</label>
                            <input type="file" name="image_file" class="form-control" accept="image/*">
                            <span class="text-muted x-small d-block mt-1">Or specify path below:</span>
                            <input type="text" name="img_path" class="form-control mt-1" placeholder="assets/2.jpg">
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $products_array = [];
                            while ($row = mysqli_fetch_assoc($products)): 
                                $products_array[] = $row;
                            ?>
                                <tr>
                                    <td class="fw-bold"><?= $row['id']; ?></td>
                                    <td>
                                        <div class="position-relative d-inline-block">
                                            <img src="<?= htmlspecialchars($row['img']); ?>" width="54" height="54" class="rounded-3 object-fit-cover border">
                                            <button class="btn btn-dark btn-sm rounded-circle position-absolute bottom-0 end-0 p-1 lh-1" 
                                                    style="transform: translate(20%, 20%);"
                                                    title="Edit Image" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editImageModal<?= $row['id']; ?>">
                                                <i class="fa-solid fa-camera fs-7"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="fw-semibold"><?= htmlspecialchars($row['name']); ?></td>
                                    <td class="text-success fw-bold">$<?= number_format($row['price'], 2); ?></td>
                                    <td class="text-muted small" style="max-width: 250px;"><?= htmlspecialchars($row['description']); ?></td>
                                    <td>
                                        <button class="btn btn-custom-outline-dark btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editProductModal<?= $row['id']; ?>">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Details
                                        </button>
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
                            <?php 
                            $history_array = [];
                            while ($row = mysqli_fetch_assoc($history)): 
                                $history_array[] = $row;
                            ?>
                                <tr>
                                    <td class="fw-bold"><?= $row['id']; ?></td>
                                    <td><span class="badge bg-dark rounded-pill px-3 py-2"><?= htmlspecialchars($row['year']); ?></span></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($row['title']); ?></td>
                                    <td class="text-muted small" style="max-width: 300px;"><?= htmlspecialchars($row['description']); ?></td>
                                    <td>
                                        <button class="btn btn-custom-outline-dark btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editHistoryModal<?= $row['id']; ?>">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                        </button>
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

        <!-- MESSAGES TAB -->
        <div class="tab-pane fade" id="messages" role="tabpanel">
            <div class="card dashboard-card p-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-inbox me-2"></i>Received Messages</h5>
                <div class="table-responsive">
                    <table class="table custom-admin-table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sender Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Submitted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $messages_array = [];
                            if ($total_messages > 0):
                                while ($row = mysqli_fetch_assoc($messages)): 
                                    $messages_array[] = $row;
                            ?>
                                    <tr>
                                        <td class="fw-bold"><?= $row['id']; ?></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                                        <td><a href="mailto:<?= htmlspecialchars($row['email']); ?>" class="text-decoration-none"><?= htmlspecialchars($row['email']); ?></a></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($row['subject']); ?></td>
                                        <td><span class="text-muted small"><?= date("d M Y H:i", strtotime($row['created_at'])); ?></span></td>
                                        <td>
                                            <button class="btn btn-custom-outline-dark btn-sm me-1" data-bs-toggle="modal" data-bs-target="#viewMessageModal<?= $row['id']; ?>">
                                                <i class="fa-solid fa-eye me-1"></i> View Message
                                            </button>
                                            <a href="dashboard.php?delete_message=<?= $row['id']; ?>" class="btn btn-custom-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?')">
                                                <i class="fa-solid fa-trash-can me-1"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No contact messages received yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODALS ================= -->

<!-- 1. IMAGE-ONLY EDIT MODALS -->
<?php foreach ($products_array as $item): ?>
<div class="modal fade" id="editImageModal<?= $item['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-image me-2"></i>Update Image - <?= htmlspecialchars($item['name']); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body p-4 text-center">
                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                    <input type="hidden" name="old_img" value="<?= htmlspecialchars($item['img']); ?>">

                    <div class="mb-3">
                        <label class="form-label d-block text-start small fw-semibold">Current Image Preview</label>
                        <img src="<?= htmlspecialchars($item['img']); ?>" class="img-thumbnail rounded shadow-sm" style="max-height: 200px; object-fit: contain;">
                    </div>

                    <div class="text-start mb-3">
                        <label class="form-label small fw-semibold">Upload New Image File</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                    </div>

                    <div class="text-start">
                        <label class="form-label small fw-semibold">Or Update Asset Path</label>
                        <input type="text" name="img_path" class="form-control" value="<?= htmlspecialchars($item['img']); ?>">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update_image_only" class="btn btn-custom-dark btn-sm rounded-pill px-4">Update Image</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- 2. FULL PRODUCT EDIT MODALS -->
<?php foreach ($products_array as $item): ?>
<div class="modal fade" id="editProductModal<?= $item['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Product #<?= $item['id']; ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                    <input type="hidden" name="old_img" value="<?= htmlspecialchars($item['img']); ?>">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Product Name</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($item['name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="<?= $item['price']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Replace Image File</label>
                            <input type="file" name="image_file" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Image Path</label>
                            <input type="text" name="img_path" class="form-control" value="<?= htmlspecialchars($item['img']); ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($item['description']); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update_product" class="btn btn-custom-dark btn-sm rounded-pill px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- 3. HISTORY EDIT MODALS -->
<?php foreach ($history_array as $event): ?>
<div class="modal fade" id="editHistoryModal<?= $event['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square me-2"></i>Edit History Event #<?= $event['id']; ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body p-4">
                    <input type="hidden" name="id" value="<?= $event['id']; ?>">
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Year</label>
                            <input type="text" name="year" class="form-control" value="<?= htmlspecialchars($event['year']); ?>" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small fw-semibold">Event Title</label>
                            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($event['title']); ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($event['description']); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update_history" class="btn btn-custom-dark btn-sm rounded-pill px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- 4. VIEW MESSAGE MODALS -->
<?php foreach ($messages_array as $msg_item): ?>
<div class="modal fade" id="viewMessageModal<?= $msg_item['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-envelope-open me-2"></i>Message Details #<?= $msg_item['id']; ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small text-muted mb-0">Sender Name</label>
                        <p class="fw-bold mb-0"><?= htmlspecialchars($msg_item['first_name'] . ' ' . $msg_item['last_name']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted mb-0">Sender Email</label>
                        <p class="fw-bold mb-0"><a href="mailto:<?= htmlspecialchars($msg_item['email']); ?>"><?= htmlspecialchars($msg_item['email']); ?></a></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted mb-0">Subject</label>
                        <p class="fw-bold mb-0"><?= htmlspecialchars($msg_item['subject']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted mb-0">Received At</label>
                        <p class="fw-bold mb-0"><?= date("d M Y H:i:s", strtotime($msg_item['created_at'])); ?></p>
                    </div>
                </div>
                <hr>
                <div>
                    <label class="form-label small text-muted mb-1">Message Content</label>
                    <div class="bg-light p-3 rounded border" style="white-space: pre-wrap; font-size: 0.95rem;"><?= htmlspecialchars($msg_item['message']); ?></div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Close</button>
                <a href="mailto:<?= htmlspecialchars($msg_item['email']); ?>?subject=Re: <?= urlencode($msg_item['subject']); ?>" class="btn btn-custom-dark btn-sm rounded-pill px-4">
                    <i class="fa-solid fa-paper-plane me-1"></i> Reply Email
                </a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?> 