<?php
global $conn;
global $repository;
@session_start();
require_once ('db.php');

class FuelQuoteRepository {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function getFuelQuotesByUser($username) {
        $fuelQuotes = [];
        $stmt = $this->conn->prepare("SELECT delivery_date, gallons, address, delivery_date, price, total FROM fuel_quote_history WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fuelQuotes[] = $row;
            }
        }
        $stmt->close();
        return $fuelQuotes;
    }
}

$fuelQuotes = [];
if (isset($_SESSION['username'])) {
  if(!isset($conn)){
    $connector = new DatabaseConnector();
    $conn = $connector->connect();
  }
  if(!isset($repository)){
    $repository = new FuelQuoteRepository($conn);
  }
  $fuelQuotes = $repository->getFuelQuotesByUser($_SESSION['username']);
  if (empty($fuelQuotes)) {
    echo "0 results";
  }
  $conn->close();
}