<?php
global $conn;
@session_start(); 
require_once('db.php');
if (!isset($conn)) {
  $connector = new DatabaseConnector();
  $conn = $connector->connect();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    $fullName = $_POST['fullName'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode'];
    $user = $_SESSION['username']; 

    
    $sql = "INSERT INTO user_info (username, full_name, address1, address2, city, state, zip_code) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE full_name = ?, address1 = ?, address2 = ?, city = ?, state = ?, zip_code = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssisssssi", $user, $fullName, $address1, $address2, $city, $state, $zipCode, $fullName, $address1, $address2, $city, $state, $zipCode);

    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: fuel-quote-form.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    $conn->close();
    header("Location: profile.php?error=not_logged_in");
    exit();
}
?>
