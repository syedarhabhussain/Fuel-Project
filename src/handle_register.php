<?php
global $conn;
@session_start();
require_once('db.php');
if (!isset($conn)) {
  $connector = new DatabaseConnector();
  $conn = $connector->connect();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password']; 

    $stmt = $conn->prepare("SELECT username FROM user_login WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $stmt->close();
        $conn->close();
        if (!headers_sent()) {
            header("Location: register.php?error=username_not_available");
            exit();
        }
    }
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO user_login (username, password) VALUES (?, ?)");
    
    $stmt->bind_param("ss", $user, $pass);
    if ($stmt->execute()) {
        $_SESSION['username'] = $user;
        $stmt->close();
        $conn->close();
        if (!headers_sent()) {
            header("Location: profile.php");
            exit();
        }
    } else {
        echo "Error: " . $stmt->error;
        $stmt->close();
        $conn->close();
    }
}
?>
