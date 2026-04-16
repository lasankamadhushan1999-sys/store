<?php
include 'includes/header.php';
include 'includes/navbar.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

if (empty($_SESSION['cart'])) {
    redirect('cart.php');
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $total = cartTotal();
    $orderNumber = generateOrderNumber();
    $paymentMethod = 'Manual Payment';
    $slipName = null;

    if (!empty($_FILES['payment_slip']['name'])) {
        $fileName = time() . '_' . basename($_FILES['payment_slip']['name']);
        $target = "uploads/payment_slips/" . $fileName;
        if (move_uploaded_file($_FILES['payment_slip']['tmp_name'], $target)) {
            $slipName = $fileName;
        }
    }

    $stmt = $conn->prepare("INSERT INTO orders (user_id, order_number, total_amount, payment_method, payment_slip, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("isdss", $userId, $orderNumber, $total, $paymentMethod, $slipName);
    $stmt->execute();
    $orderId = $stmt->insert_id;

    $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, price, qty) VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $item) {
        $itemStmt->bind_param("iidi", $orderId, $item['id'], $item['price'], $item['qty']);
        $itemStmt->execute();
    }

    unset($_SESSION['cart']);
    $message = "Order placed successfully. Your order number is " . $orderNumber;
}
?>

<div class="container section">
    <h1 class="section-title">Checkout</h1>

    <div class="two-col">
        <div class="table-box glass">
            <h2 class="section-title" style="font-size:22px;">Order Summary</h2>

            <?php if (!empty($message)): ?>
                <div class="alert alert-success"><?= esc($message); ?></div>
                <a href="orders.php" class="btn">View My Orders</a>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <tr>
                                <td><?= esc($item['title']); ?></td>
                                <td>LKR <?= number_format($item['price'], 2); ?></td>
                                <td><?= (int)$item['qty']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th colspan="2">Total</th>
                            <th>LKR <?= number_format(cartTotal(), 2); ?></th>
                        </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <?php if (empty($message)): ?>
        <div class="form-box glass">
            <h2 class="section-title" style="font-size:22px;">Payment Proof Upload</h2>
            <p class="section-sub">Complete payment manually and upload your slip.</p>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Payment Slip</label>
                    <input type="file" name="payment_slip" accept="image/*,.pdf">
                </div>
                <button type="submit" class="btn">Place Order</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>