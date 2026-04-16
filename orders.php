<?php
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/auth.php';

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container section">
    <h1 class="section-title">My Orders</h1>

    <div class="table-box glass">
        <table>
            <thead>
                <tr>
                    <th>Order No</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= esc($row['order_number']); ?></td>
                        <td>LKR <?= number_format($row['total_amount'], 2); ?></td>
                        <td><?= esc($row['payment_method']); ?></td>
                        <td><?= esc($row['status']); ?></td>
                        <td><?= esc($row['created_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>