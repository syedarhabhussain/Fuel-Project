<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<header>
    <a href="./index.php" <?php if ($current_page == 'index.php') { echo 'class="active"'; } ?>>Home</a>
    <a href="./register.php" <?php if ($current_page == 'register.php') { echo 'class="active"'; } ?>>Register</a>
    <a href="./profile.php" <?php if ($current_page == 'profile.php') { echo 'class="active"'; } ?>>Profile</a>
    <a href="./fuel-quote-form.php" <?php if ($current_page == 'fuel-quote-form.php') { echo 'class="active"'; } ?>>Get Fuel Quote</a>
    <a href="./history.php" <?php if ($current_page == 'history.php') { echo 'class="active"'; } ?>>Quote History</a>
    <?php if(isset($_SESSION['username'])): ?>
        <a href="./logout.php">Logout</a>
    <?php endif; ?>
</header>
