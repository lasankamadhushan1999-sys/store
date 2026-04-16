<?php
include 'includes/header.php';
include 'includes/navbar.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $exists = $checkStmt->get_result()->fetch_assoc();

    if ($exists) {
        $error = "Email already exists.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'customer')");
        $stmt->bind_param("sss", $fullName, $email, $hashed);

        if ($stmt->execute()) {
            $success = "Registration successful. You can now login.";
        } else {
            $error = "Something went wrong.";
        }
    }
}
?>

<div class="container center-box">
    <div class="form-box glass">
        <h1 class="section-title">Create Account</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= esc($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= esc($success); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>