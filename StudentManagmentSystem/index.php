<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'includes/header.php';
?>

<div class="welcome-container">
    <h1>Hello 👋 PHP LOVERS, Welcome to your administration platform</h1>

    <div class="welcome-content">
        <div class="cta-buttons">
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="/views/auth/login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
