<?php
require_once 'config/db.php';

$email = 'admin@store.com';
$newPassword = 'admin123';
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    $stmt = $conn->prepare("UPDATE users SET password = ?, role = 'admin' WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);

    if ($stmt->execute()) {
        echo "Admin password reset successful.<br>";
        echo "Email: admin@store.com<br>";
        echo "Password: admin123";
    } else {
        echo "Failed to reset admin password.";
    }
} else {
    $insert = $conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'admin')");
    $name = 'Administrator';
    $insert->bind_param("sss", $name, $email, $hashedPassword);

    if ($insert->execute()) {
        echo "Admin account created successfully.<br>";
        echo "Email: admin@store.com<br>";
        echo "Password: admin123";
    } else {
        echo "Failed to create admin account.";
    }
}
?>