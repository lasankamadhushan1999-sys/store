<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<?php $products = getFeaturedProducts(6); ?>

<div class="container">
    <section class="hero">
        <div class="hero-box glass">
            <span class="badge">Premium Accounts Marketplace</span>
            <h1>Get Premium Accounts at the Best Price with Nexzio</h1>
            <p>
                Access tools like ChatGPT, Zoom, Grok and more at affordable monthly prices.
                Fast delivery, trusted service, and responsive support — everything you need in one place.
            </p>
            <div class="hero-actions">
                <a href="products.php" class="btn">Browse Accounts</a>
                <a href="contact.php" class="btn-outline">Contact Us</a>
            </div>
        </div>

        <div class="hero-metrics">
            <div class="metric glass">
                <h3>10+</h3>
                <p>Active Customers</p>
            </div>
            <div class="metric glass">
                <h3>Fast</h3>
                <p>Instant Delivery</p>
            </div>
            <div class="metric glass">
                <h3>24/7</h3>
                <p>Customer Support</p>
            </div>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Available Premium Accounts</h2>
        <p class="section-sub">
            Choose from a range of digital tools and premium subscriptions at affordable monthly prices.
        </p>

        <div class="grid-3">
            <?php foreach ($products as $product): ?>
                <div class="card glass">
                    <?php
                        $img = !empty($product['image'])
                            ? "uploads/product_images/" . $product['image']
                            : "https://via.placeholder.com/400x250";
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
    </section>

    <section class="section two-col">
        <div class="info-box glass">
            <h2 class="section-title">Why Choose Nexzio</h2>
            <p class="section-sub">
                We provide reliable and affordable access to premium digital services.
            </p>

            <p>✔ Affordable monthly pricing</p><br>
            <p>✔ Fast and secure delivery</p><br>
            <p>✔ Trusted by multiple users</p><br>
            <p>✔ Easy ordering process</p><br>
            <p>✔ Quick support via WhatsApp</p>
        </div>

        <div class="info-box glass">
            <h2 class="section-title">Start Using Premium Tools Today</h2>
            <p class="section-sub">
                Upgrade your productivity with premium access to the tools you need without paying full price.
            </p>
            <a href="products.php" class="btn">View Plans</a>
        </div>
    </section>

    <section class="section">
        <div class="info-box glass">
            <h2 class="section-title">Popular Services</h2>
            <p class="section-sub">
                Our most requested premium accounts and subscription services.
            </p>

            <p>✔ ChatGPT Plus Access</p><br>
            <p>✔ Zoom Pro Access</p><br>
            <p>✔ Grok Access</p><br>
            <p>✔ Other Digital Subscriptions</p>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>