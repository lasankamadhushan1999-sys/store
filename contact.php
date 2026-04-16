<?php
include 'includes/header.php';
include 'includes/navbar.php';

$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = "Your message has been received. We will contact you soon.";
}
?>

<div class="container section">
    <div class="two-col">
        <div class="form-box glass">
            <h1 class="section-title">Contact Us</h1>
            <p class="section-sub">Have a question? Send us a message.</p>

            <?php if ($success): ?>
                <div class="alert alert-success"><?= esc($success); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" required></textarea>
                </div>

                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>

        <div class="info-box glass">
            <h2 class="section-title">Support Details</h2>
            <p><strong>Email:</strong> support@store.com</p><br>
            <p><strong>WhatsApp:</strong> +94 77 000 0000</p><br>
            <p><strong>Facebook:</strong> Your Business Page</p><br>
            <p><strong>Hours:</strong> 9.00 AM - 10.00 PM</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>