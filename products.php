<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<?php $products = getAllProducts(); ?>

<div class="container section">
    <h1 class="section-title">All Products</h1>
    <p class="section-sub">Browse our available digital products and monthly offers.</p>

    <div class="grid-3">
        <?php foreach ($products as $product): ?>
            <div class="card glass">
                <?php
                    $img = !empty($product['image']) ? "uploads/product_images/" . $product['image'] : "https://via.placeholder.com/400x250";
                ?>
                <img src="<?= esc($img); ?>" class="card-img" alt="<?= esc($product['title']); ?>">
                <?php if (!empty($product['badge'])): ?>
                    <span class="badge"><?= esc($product['badge']); ?></span>
                <?php endif; ?>
                <h3><?= esc($product['title']); ?></h3>
                <p><?= esc($product['short_description']); ?></p>
                <div class="price-row">
                    <span class="price">LKR <?= number_format($product['price'], 2); ?></span>
                    <?php if (!empty($product['old_price'])): ?>
                        <span class="old-price">LKR <?= number_format($product['old_price'], 2); ?></span>
                    <?php endif; ?>
                </div>
                <div class="flex-between">
                    <span>⭐ <?= esc($product['rating']); ?></span>
                    <a href="product-details.php?slug=<?= urlencode($product['slug']); ?>" class="btn-small">View Product</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>