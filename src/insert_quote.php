<?php
global $conn;
@session_start();
require_once('db.php');
if (!isset($conn)) {
  $connector = new DatabaseConnector();
  $conn = $connector->connect();
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["username"]))
{
    $gallons = $_POST['gallonsRequested'];
    $address = $_POST['deliveryAddress'];
    $delivery_date = $_POST['deliveryDate'];
    $price = floatval(preg_replace("/[^0-9.]/", "", $_POST['suggestedPrice']));
    $total = floatval(preg_replace("/[^0-9.]/", "", $_POST['totalAmountDue']));
    $user = $_SESSION["username"];

    $sql = "INSERT INTO fuel_quote_history (username, gallons, address, delivery_date, price, total) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissdd", $user, $gallons, $address, $delivery_date, $price, $total);

    if ($stmt->execute()) {
        if (!headers_sent()) {
            header("Location: history.php");
            exit();
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
