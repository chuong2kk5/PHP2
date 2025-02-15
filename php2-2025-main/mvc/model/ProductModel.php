<?php
require_once "Database.php";

class ProductModel {
    private $conn;
    

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($product_id) {
        $query = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCategories(){
        $query = " SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduct($name, $description, $price, $image, $quantity, $category_id) {
        $query = "INSERT INTO products (name, description, price, image, quantity, category_id) 
                  VALUES (:name, :description, :price, :image, :quantity, :category_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':category_id', $category_id);
        return $stmt->execute();
    }

    public function updateProduct($product_id, $name, $description, $price, $image, $quantity, $category_id) {
        $query = "UPDATE products 
                  SET name = :name, description = :description, price = :price, image = :image, quantity = :quantity, category_id = :category_id 
                  WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':category_id', $category_id);
    
        return $stmt->execute();
    }

/*************  ✨ Codeium Command 🌟  *************/
    /**
     * Delete a product from database
     * @param int $product_id
     * @return bool
     */
    public function deleteProduct($product_id) {
        $query = "DELETE FROM products WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        return $stmt->execute();
    }
/******  e1f3fb1c-b433-4bad-85ad-019071d16fdb  *******/
}
?>