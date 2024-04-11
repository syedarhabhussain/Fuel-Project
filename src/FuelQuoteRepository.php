<?php
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