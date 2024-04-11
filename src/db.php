<?php
class DatabaseConnector {
    private $conn = null;
    public function connect() {
        if ($this->conn === null) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fuel_quote";
            $this->conn = new mysqli($servername, $username, $password, $dbname);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
        return $this->conn;
    }

    public function setConnection($connection) {
        $this->conn = $connection;
    }
}