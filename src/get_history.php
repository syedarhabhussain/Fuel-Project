<?php
global $conn;
global $repository;
@session_start();
require_once ('db.php');
require_once ('FuelQuoteRepository.php');
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