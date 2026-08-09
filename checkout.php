<?php
session_start();
require_once 'includes/config.php';
$page_title  = "Checkout - Gallery Mockers";
$active_page = "checkout";

if (empty($_SESSION['cart'])) {
    header("Location: gallery.php");
    exit();
}

$order_success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $address   = mysqli_real_escape_string($conn, $_POST['address']);

    // Kosongkan keranjang setelah pesanan diproses
    unset($_SESSION['cart']);
    $order_success = true;
}

include 'includes/header.php';
?>

<main class="container py-5 min-vh-100">
  <?php if ($order_success): ?>
      <div class="text-center py-5">
          <h1 class="display-4 text-success fw-bold">Thank You!</h1>
          <p class="lead">Pesanan Anda berhasil ditempatkan. Kami akan segera memproses pengiriman ke alamat Anda.</p>
          <a href="gallery.php" class="btn btn-dark mt-3">Kembali ke Galeri</a>
      </div>
  <?php else: ?>
      <h1 class="fw-bold mb-4">Checkout</h1>
      <div class="row g-5">
          <div class="col-md-7">
              <form method="POST" action="checkout.php" class="p-4 border rounded shadow-sm bg-white">
                  <h4 class="mb-3 fw-bold">Shipping Details</h4>
                  <div class="mb-3">
                      <label class="form-label fw-bold">Full Name</label>
                      <input type="text" name="full_name" class="form-control" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label fw-bold">Email Address</label>
                      <input type="email" name="email" class="form-control" required>
                  </div>
                  <div class="mb-4">
                      <label class="form-label fw-bold">Shipping Address</label>
                      <textarea name="address" class="form-control" rows="3" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-dark w-100 py-3 fw-bold">Place Order</button>
              </form>
          </div>

          <div class="col-md-5">
              <div class="p-4 border rounded shadow-sm bg-light">
                  <h4 class="fw-bold mb-3">Order Summary</h4>
                  <ul class="list-group list-group-flush mb-3">
                      <?php 
                      $total = 0;
                      foreach ($_SESSION['cart'] as $item): 
                          $subtotal = $item['price'] * $item['quantity'];
                          $total += $subtotal;
                      ?>
                      <li class="list-group-item bg-transparent d-flex justify-content-between">
                          <div>
                              <strong><?php echo $item['name']; ?></strong>
                              <small class="text-muted d-block">Qty: <?php echo $item['quantity']; ?></small>
                          </div>
                          <span>$<?php echo number_format($subtotal, 2); ?></span>
                      </li>
                      <?php endforeach; ?>
                  </ul>
                  <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-3">
                      <span>Total</span>
                      <span>$<?php echo number_format($total, 2); ?></span>
                  </div>
              </div>
          </div>
      </div>
  <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>