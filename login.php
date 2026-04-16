<?php
include 'includes/header.php';
include 'includes/navbar.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            redirect('admin/dashboard.php');
        } else {
            redirect('index.php');
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<div class="container center-box">
    <div class="form-box glass">
        <h1 class="section-title">Login</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= esc($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <br>
        <p class="small-text">Demo admin login: admin@store.com / admin123</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>