<?php
session_start();
$page_title = "Register - Gallery Mockers";
require_once 'includes/config.php';

/** @var mysqli $conn */

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, 2)");
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Account created! You can now <a href='login.php'>Login here</a>.";
        } else {
            $error = "Username or Email already exists.";
        }
        mysqli_stmt_close($stmt);
    }
}

include 'includes/header.php';
?>

<div class="container my-5" style="max-width: 450px;">
    <div class="card shadow-sm p-4">
        <h3 class="card-title text-center mb-3">Create Account</h3>
        <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Register</button>
        </form>
        <div class="mt-3 text-center">
            <small>Already registered? <a href="login.php">Login here</a></small>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>