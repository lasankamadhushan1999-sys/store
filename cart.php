<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<?php
if (isset($_GET['remove'])) {
    $removeId = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$removeId])) {
        unset($_SESSION['cart'][$removeId]);
    }
    redirect('cart.php');
}
?>

<div class="container section">
    <h1 class="section-title">Shopping Cart</h1>

    <div class="table-box glass">
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty.</p><br>
            <a href="products.php" class="btn">Browse Products</a>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><?= esc($item['title']); ?></td>
                            <td>LKR <?= number_format($item['price'], 2); ?></td>
                            <td><?= (int)$item['qty']; ?></td>
                            <td>LKR <?= number_format($item['price'] * $item['qty'], 2); ?></td>
                            <td>
                                <a class="btn-danger" href="cart.php?remove=<?= (int)$item['id']; ?>">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="3">Total</th>
                        <th colspan="2">LKR <?= number_format(cartTotal(), 2); ?></th>
                    </tr>
                </tbody>
            </table>
            <br>
            <a href="checkout.php" class="btn">Proceed to Checkout</a>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>