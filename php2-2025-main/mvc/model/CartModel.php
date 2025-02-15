<?php
require_once "Database.php";
class CartModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getCart($user_id, $session_id) {
        $condition = !empty($user_id) ? "user_id = :user_id" : "cart_session = :cart_session";
        $query = "SELECT * FROM carts WHERE $condition";
        $stmt = $this->conn->prepare($query);

        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':cart_session', $session_id, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $query = "SELECT * FROM carts";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToCart($cart_session, $user_id, $sku, $name, $image, $quantity, $price) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
echo "User ID: " . ($user_id ?? 'NULL'); // Debug kiểm tra giá trị

        $user_id = !empty($user_id) ? $user_id : null;
        $condition = $user_id ? "user_id = :user_id" : "cart_session = :cart_session";
    
        $query = "SELECT id FROM carts WHERE $condition AND sku = :sku";
        $stmt = $this->conn->prepare($query);
        
        if ($user_id) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
        }
    
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        $stmt->execute();
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($existingItem) {
            $query = "UPDATE carts SET quantity = quantity + :quantity WHERE $condition AND sku = :sku";
            $stmt = $this->conn->prepare($query);
        } else {
            $query = "INSERT INTO carts (cart_session, user_id, sku, name, image, quantity, price) 
                      VALUES (:cart_session, :user_id, :sku, :name, :image, :quantity, :price)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        }
    
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    
        if ($user_id === null) {
            $stmt->bindValue(':user_id', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        }
    
        return $stmt->execute();
    }
    

    public function updateCartItem($cart_session, $user_id, $id, $quantity) {
        if ($quantity <= 0) {
            return false;
        }

        $condition = (!empty($user_id)) ? "user_id = :user_id" : "cart_session = :cart_session";
        $query = "UPDATE carts SET quantity = :quantity WHERE $condition AND id = :id";
        $stmt = $this->conn->prepare($query);

        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function removeCartItem($cart_session, $user_id, $id) {
        if ($id <= 0) {
            return false;
        }

        $condition = (!empty($user_id)) ? "user_id = :user_id" : "cart_session = :cart_session";
        $query = "DELETE FROM carts WHERE $condition AND id = :id";
        $stmt = $this->conn->prepare($query);

        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function clearCart($cart_session, $user_id = null) {
        $condition = $user_id ? "user_id = :user_id" : "cart_session = :cart_session";
        $query = "DELETE FROM carts WHERE $condition";
        $stmt = $this->conn->prepare($query);

        if ($user_id) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }
}
?>
