<?php
require_once "Database.php";

class colorModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM colors";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($color_id) {
        $query = "SELECT * FROM colors WHERE color_id = :color_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':color_id', $color_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($color_name) {
        $query = "INSERT INTO colors (color_name) VALUES (:color_name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':color_name', $color_name);
        return $stmt->execute();
    }
    public function update($color_id, $color_name) {
        $query = "UPDATE colors SET color_name = :color_name WHERE color_id = :color_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':color_id', $color_id);
        $stmt->bindParam(':color_name', $color_name);
        return $stmt->execute();
    }
    public function delete($color_id) {
        $query = "DELETE FROM colors WHERE color_id = :color_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':color_id', $color_id);
        return $stmt->execute();
    }

    
}
?>