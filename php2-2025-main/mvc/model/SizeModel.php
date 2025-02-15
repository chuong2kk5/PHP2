<?php
require_once "Database.php";

class sizeModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM sizes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($size_id) {
        $query = "SELECT * FROM sizes WHERE size_id = :size_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':size_id', $size_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($size_name) {
        $query = "INSERT INTO sizes (size_name) VALUES (:size_name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':size_name', $size_name);
        return $stmt->execute();
    }
    public function update($size_id, $size_name) {
        $query = "UPDATE sizes SET size_name = :size_name WHERE size_id = :size_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':size_id', $size_id);
        $stmt->bindParam(':size_name', $size_name);
        return $stmt->execute();
    }
    public function delete($size_id) {
        $query = "DELETE FROM sizes WHERE size_id = :size_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':size_id', $size_id);
        return $stmt->execute();
    }

    
}
?>