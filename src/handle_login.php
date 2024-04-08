<?php
session_start();
include ('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password']; 

    $stmt = $conn->prepare("SELECT username, password FROM user_login WHERE username = ? and password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $user;
        $stmt->close();
        $conn->close();
        header("Location: fuel-quote-form.php");
        exit();
    } else {
        header("Location: index.php?error=invalid_credentials");
        exit();
    }
}
?>
