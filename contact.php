<?php
require_once 'includes/config.php';

/** @var mysqli $conn */

$page_title  = "Contact Us - Gallery Mockers";
$active_page = "contact";

$success_message = false;
$error_message   = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $subject    = trim($_POST['subject']);
    $message    = trim($_POST['message']);

    if (!empty($first_name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Logika simpan data ke database
        $stmt = mysqli_prepare($conn, "INSERT INTO messages (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $email, $subject, $message);

        if (mysqli_stmt_execute($stmt)) {
            $success_message = true;
        } else {
            $error_message = "Gagal mengirim pesan. Silakan coba lagi.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Harap isi semua kolom yang diwajibkan.";
    }
}

include 'includes/header.php';
?>

  <main class="container py-5 min-vh-100">
    <div class="row mb-5 text-center reveal">
        <div class="col-12">
            <h1 class="fw-bold display-4">Get In Touch</h1>
            <p class="lead text-muted">Have a question, feedback, or a cease-and-desist letter from a traditional art critic? We'd love to hear from you.</p>
        </div>
    </div>

    <div class="row g-4 g-lg-5">
      <div class="col-lg-5 col-md-12 reveal">
        <div class="p-4 p-md-5 border rounded shadow-sm bg-white h-100">
            <h3 class="fw-bold mb-4">Contact Information</h3>
            <p class="text-muted mb-4">Feel free to reach out to our permanent studio hub. We are always looking for new artists, gallery opportunities, and collaborations.</p>
            <ul class="list-unstyled mb-5 fs-5">
                <li class="mb-4 d-flex align-items-center"><i class="fa-solid fa-location-dot fa-fw me-3 fs-4 text-dark"></i> Jakarta, Indonesia</li>
                <li class="mb-4 d-flex align-items-center"><i class="fa-solid fa-phone fa-fw me-3 fs-4 text-dark"></i> +62 21 5555 1234</li>
                <li class="mb-4 d-flex align-items-center"><i class="fa-solid fa-envelope fa-fw me-3 fs-4 text-dark"></i> hello@gallerymockers.com</li>
            </ul>
            <h5 class="fw-bold mb-3">Connect With Us</h5>
            <div class="d-flex gap-3">
                <a href="#" class="text-dark fs-3 transition-all"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="text-dark fs-3 transition-all"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#" class="text-dark fs-3 transition-all"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
      </div>

      <div class="col-lg-7 col-md-12 reveal">
        <form action="contact.php" method="POST" class="p-4 p-md-5 border rounded shadow-sm bg-white h-100">
            <h3 class="fw-bold mb-4">Send us a Message</h3>
            
            <?php if ($success_message): ?>
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <i class="fa-solid fa-circle-check me-2"></i>Pesan Anda berhasil dikirim dan tersimpan! Kami akan segera menghubungi Anda kembali.
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <i class="fa-solid fa-circle-exclamation me-2"></i><?= htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="firstName" class="form-label fw-bold">First Name</label>
                    <input type="text" name="first_name" class="form-control bg-light border-0 py-2" id="firstName" placeholder="John" required>
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <label for="lastName" class="form-label fw-bold">Last Name</label>
                    <input type="text" name="last_name" class="form-control bg-light border-0 py-2" id="lastName" placeholder="Doe" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email Address</label>
                <input type="email" name="email" class="form-control bg-light border-0 py-2" id="email" placeholder="name@example.com" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label fw-bold">Subject</label>
                <input type="text" name="subject" class="form-control bg-light border-0 py-2" id="subject" placeholder="What is this regarding?" required>
            </div>
            <div class="mb-4">
                <label for="message" class="form-label fw-bold">Message</label>
                <textarea name="message" class="form-control bg-light border-0 py-2" id="message" rows="5" placeholder="Write your thoughts here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-dark w-100 py-3 fw-bold transition-all">Send Message</button>
        </form>
      </div>
    </div>
  </main>

<?php include 'includes/footer.php'; ?>