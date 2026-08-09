<?php
session_start();
require_once 'includes/config.php';
$page_title  = "Products - Gallery Mockers";
$active_page = "gallery";

// Ambil data produk langsung dari database
$products = [];
$query    = "SELECT * FROM products ORDER BY id ASC";
$result   = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[$row['id']] = [
            'id'    => $row['id'],
            'name'  => $row['name'],
            'price' => $row['price'],
            'img'   => $row['img'],
            'desc'  => $row['description']
        ];
    }
}

// Logika Tambah ke Keranjang
$added_item_name = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = (int)$_POST['product_id'];

    if (isset($products[$product_id])) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name'     => $products[$product_id]['name'],
                'price'    => $products[$product_id]['price'],
                'img'      => $products[$product_id]['img'],
                'quantity' => 1
            ];
        }

        $added_item_name = $products[$product_id]['name'];
    }
}

include 'includes/header.php';
?>

  <main class="container py-5 min-vh-100">
    
    <!-- Banner Notifikasi -->
    <?php if (!empty($added_item_name)): ?>
      <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center mb-4 shadow-sm" role="alert">
        <div>
          <i class="fa-solid fa-circle-check me-2"></i>
          <strong><?php echo htmlspecialchars($added_item_name); ?></strong> telah ditambahkan ke keranjang.
        </div>
        <div class="d-flex align-items-center gap-2">
          <a href="cart.php" class="btn btn-dark btn-sm fw-bold px-3">Proceed to Cart</a>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    <?php endif; ?>

    <div class="row mb-5 text-center reveal">
      <div class="col-12">
        <h1 class="fw-bold display-4">Our Collection</h1>
        <p class="lead text-muted">Bring home a piece of irony. Exclusive prints and canvases available now.</p>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($products as $item): ?>
        <div class="col reveal">
          <div class="card h-100 shadow-sm border-0">
            <img src="<?php echo htmlspecialchars($item['img']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>" style="height: 300px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title fw-bold"><?php echo htmlspecialchars($item['name']); ?></h5>
              <p class="card-text text-muted"><?php echo htmlspecialchars($item['desc']); ?></p>
              <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                <span class="fs-4 fw-bold text-dark">$<?php echo number_format($item['price'], 2); ?></span>
                <form method="POST" action="gallery.php" class="m-0">
                  <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                  <button type="submit" name="add_to_cart" class="btn btn-outline-dark">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

<?php include 'includes/footer.php'; ?>