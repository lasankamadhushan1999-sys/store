<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<?php
if (!isset($_GET['slug'])) {
    redirect('products.php');
}

$product = getProductBySlug($_GET['slug']);
if (!$product) {
    redirect('products.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $product['id'];
    $title = $product['title'];
    $price = $product['price'];
    $image = $product['image'];
    $qty = 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += 1;
    } else {
        $_SESSION['cart'][$id] = [
            'id' => $id,
            'title' => $title,
            'price' => $price,
            'qty' => $qty,
            'image' => $image
        ];
    }

    $success = "Product added to cart successfully.";
}
?>

<div class="container section product-details-page">
    <div class="two-col product-top-section">
        <div class="card glass">
            <?php
                $img = !empty($product['image']) ? "uploads/product_images/" . $product['image'] : "https://via.placeholder.com/500x320";
            ?>
            <img src="<?= esc($img); ?>" class="card-img product-main-img" alt="<?= esc($product['title']); ?>">
        </div>

        <div class="form-box glass">
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= esc($success); ?></div>
            <?php endif; ?>

            <?php if (!empty($product['badge'])): ?>
                <span class="badge"><?= esc($product['badge']); ?></span>
            <?php endif; ?>

            <h1 class="section-title"><?= esc($product['title']); ?></h1>
            <p class="section-sub"><?= esc($product['short_description']); ?></p>

            <div class="price-row">
                <span class="price">LKR <?= number_format($product['price'], 2); ?></span>
                <?php if (!empty($product['old_price'])): ?>
                    <span class="old-price">LKR <?= number_format($product['old_price'], 2); ?></span>
                <?php endif; ?>
            </div>

            <p><strong>Category:</strong> <?= esc($product['category_name']); ?></p><br>
            <p><strong>Rating:</strong> ⭐ <?= esc($product['rating']); ?></p><br>
            <p><?= nl2br(esc($product['description'])); ?></p><br>

            <form method="POST">
                <button type="submit" class="btn">Add to Cart</button>
                <a href="checkout.php" class="btn-outline">Go to Checkout</a>
            </form>
        </div>
    </div>

    <?php if (!empty($product['further_details'])): ?>
        <div class="section product-further-section">
            <div class="info-box glass">
                <h2 class="section-title">Further Details</h2>
                <div class="product-further-text">
                    <?= nl2br(esc($product['further_details'])); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>