<?php
session_start();
include ('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password']; 

    $stmt = $conn->prepare("SELECT username FROM user_login WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {    
        $stmt->close();
        $conn->close();
        header("Location: register.php?error=username_not_available");
        exit();
    }
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO user_login (username, password) VALUES (?, ?)");
    
    $stmt->bind_param("ss", $user, $pass);
    if ($stmt->execute()) {
        $_SESSION['username'] = $user;
        $stmt->close();
        $conn->close();
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
        $stmt->close();
        $conn->close();
    }
}
?>
