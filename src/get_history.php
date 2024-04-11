<?php
@session_start();
require_once ('db.php');
require_once ('FuelQuoteRepository.php');
$fuelQuotes = [];
if (isset($_SESSION['username'])) {
  $connector = new DatabaseConnector();
  $conn = $connector->connect();
  $repository = new FuelQuoteRepository($conn);
  $fuelQuotes = $repository->getFuelQuotesByUser($_SESSION['username']);
  if (empty($fuelQuotes)) {
    echo "0 results";
  }
  $conn->close();
}