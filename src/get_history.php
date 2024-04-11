<?php
@session_start();
global $conn;
$fuelQuotes = [];
if (isset($_SESSION['username'])) {
  require_once ('db.php');
  if (!isset($conn)) {
    $connector = new DatabaseConnector();
    $conn = $connector->connect();
  }
  $user = $_SESSION['username'];
  $stmt = $conn->prepare("SELECT delivery_date, gallons, address, delivery_date, price, total FROM fuel_quote_history where username = ?");
  $stmt->bind_param("s", $user);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $fuelQuotes[] = $row;
    }
  } else {
    echo "0 results";
  }
  $stmt->close();
  $conn->close();
}
?>