<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <script src="../assets/js/script.js"></script>
    <title>Login</title>
</head>

<body class="common-body">
    <?php include 'header.php'; ?>
    <div class="login-container">
        <h2>Login</h2>
        <div id="error-message" class="error"></div>
        <?php
            if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
                echo '<script type="text/javascript">',
                    'document.addEventListener("DOMContentLoaded", function() {',
                    'var errorMessage = document.getElementById("error-message");',
                    'errorMessage.textContent = "Invalid username or password.";',
                    '});',
                    '</script>';
            }
        ?>
        <form id="loginForm" method="POST" action="handle_login.php" onsubmit="return validateLogin()">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <div class="form-group">
                <label>Don't have an account yet? <a href="register.php">Register</a></label>
            </div>
        </form>
    </div>
</body>
</html>