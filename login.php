<?php
session_start();
$page_title = "Login - Gallery Mockers";
require_once 'includes/config.php';

/** @var mysqli $conn */

if (isset($_SESSION['user_id'])) {
    header("Location: " . ($_SESSION['role_name'] === 'Admin' ? "dashboard.php" : "index.php"));
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        $query = "SELECT u.id, u.username, u.password, r.role_name 
                  FROM users u 
                  JOIN roles r ON u.role_id = r.id 
                  WHERE u.username = ?";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['username']  = $user['username'];
                $_SESSION['role_name'] = $user['role_name'];

                header("Location: " . ($user['role_name'] === 'Admin' ? "dashboard.php" : "index.php"));
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User not found.";
        }
        mysqli_stmt_close($stmt);
    }
}

include 'includes/header.php';
?>

<div class="container my-5 min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card dashboard-card p-4 p-md-5 w-100" style="max-width: 420px;">
        <div class="text-center mb-4">
            <div class="bg-light d-inline-flex p-3 rounded-circle mb-2">
                <i class="fa-solid fa-lock fs-2 text-dark"></i>
            </div>
            <h3 class="fw-bold">Welcome Back</h3>
            <p class="text-muted small">Enter your details to log into your account</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger py-2 small rounded-3 border-0 shadow-sm mb-3">
                <i class="fa-solid fa-circle-exclamation me-1"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label small fw-semibold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa-regular fa-user text-muted"></i></span>
                    <input type="text" name="username" class="form-control bg-light border-start-0" placeholder="Username" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-key text-muted"></i></span>
                    <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="btn btn-custom-dark w-100 py-2">
                <i class="fa-solid fa-right-to-bracket me-2"></i> Log In
            </button>
        </form>
        <div class="mt-4 text-center">
            <small class="text-muted">Don't have an account? <a href="register.php" class="text-dark fw-bold text-decoration-none">Register here</a></small>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>