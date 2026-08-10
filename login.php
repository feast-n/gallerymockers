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
            // Verify password hash
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

<div class="container my-5" style="max-width: 450px;">
    <div class="card shadow-sm p-4">
        <h3 class="card-title text-center mb-3">Login</h3>
        <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Login</button>
        </form>
        <div class="mt-3 text-center">
            <small>Don't have an account? <a href="register.php">Register here</a></small>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>