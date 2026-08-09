<?php
session_start();
require_once 'includes/config.php';
$page_title  = "Cart - Gallery Mockers";
$active_page = "cart";

// Hapus Item
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    unset($_SESSION['cart'][$_GET['id']]);
    header("Location: cart.php");
    exit();
}

include 'includes/header.php';
?>

<main class="container py-5 min-vh-100">
  <div class="row mb-4 reveal">
    <div class="col-12 text-center text-md-start">
      <h1 class="fw-bold display-5 mb-2">Shopping Cart</h1>
      <p class="text-muted">Review your selected artworks before proceeding to checkout.</p>
    </div>
  </div>

  <?php if (empty($_SESSION['cart'])): ?>
    <div class="row justify-content-center py-5 reveal">
      <div class="col-md-6 text-center">
        <div class="p-5 bg-white border rounded-4 shadow-sm">
          <i class="fa-solid fa-cart-flatbed fa-4x text-muted mb-4 opacity-50"></i>
          <h3 class="fw-bold mb-3">Your cart is empty</h3>
          <p class="text-muted mb-4">Looks like you haven't added any parodic masterpieces to your collection yet.</p>
          <a href="gallery.php" class="btn btn-dark btn-lg px-4 rounded-pill fw-bold fs-6">
            <i class="fa-solid fa-arrow-left me-2"></i>Explore Collection
          </a>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="row g-4 reveal">
      <!-- Tabel Keranjang -->
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="table-responsive">
            <table class="table align-middle mb-0 custom-cart-table">
              <thead class="bg-dark text-white">
                <tr>
                  <th class="py-3 px-4">Product</th>
                  <th class="py-3 px-3 text-center">Price</th>
                  <th class="py-3 px-3 text-center">Qty</th>
                  <th class="py-3 px-3 text-end">Subtotal</th>
                  <th class="py-3 px-4 text-center">Action</th>
                </tr>
              </thead>
              <tbody class="border-top-0">
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                  <td class="py-3 px-4">
                    <div class="d-flex align-items-center gap-3">
                      <img src="<?php echo htmlspecialchars($item['img']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="rounded-3 cart-item-img">
                      <div>
                        <h6 class="fw-bold mb-1 text-dark"><?php echo htmlspecialchars($item['name']); ?></h6>
                        <small class="text-muted">Original Print</small>
                      </div>
                    </div>
                  </td>
                  <td class="py-3 px-3 text-center fw-medium">$<?php echo number_format($item['price'], 2); ?></td>
                  <td class="py-3 px-3 text-center">
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fs-6 fw-bold"><?php echo $item['quantity']; ?></span>
                  </td>
                  <td class="py-3 px-3 text-end fw-bold text-dark">$<?php echo number_format($subtotal, 2); ?></td>
                  <td class="py-3 px-4 text-center">
                    <a href="cart.php?action=remove&id=<?php echo $id; ?>" class="btn btn-outline-danger btn-sm rounded-circle p-2" title="Remove Item">
                      <i class="fa-solid fa-trash-can fa-fw"></i>
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="mt-4 text-start">
          <a href="gallery.php" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
            <i class="fa-solid fa-arrow-left me-2"></i>Continue Shopping
          </a>
        </div>
      </div>

      <!-- Ringkasan Belanja (Summary) -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
          <h4 class="fw-bold mb-4">Order Summary</h4>
          
          <div class="d-flex justify-content-between mb-2 text-muted">
            <span>Subtotal</span>
            <span class="fw-semibold text-dark">$<?php echo number_format($total, 2); ?></span>
          </div>
          <div class="d-flex justify-content-between mb-3 text-muted">
            <span>Estimated Shipping</span>
            <span class="text-success fw-semibold">Free</span>
          </div>
          
          <hr class="my-3">
          
          <div class="d-flex justify-content-between mb-4">
            <span class="fs-5 fw-bold">Total</span>
            <span class="fs-4 fw-bold text-dark">$<?php echo number_format($total, 2); ?></span>
          </div>

          <a href="checkout.php" class="btn btn-dark w-100 py-3 rounded-pill fw-bold text-uppercase fs-6 shadow-sm transition-all">
            Proceed to Checkout <i class="fa-solid fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>
    </div>
  <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>