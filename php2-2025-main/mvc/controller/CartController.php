<?php
require_once "model/CategoryModel.php";
require_once "view/helpers.php";
require_once "model/CartModel.php";

class CartController {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new CartModel();
    }

    public function index() {
        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();
        $carts = $this->cartModel->getCart($user_id, $session_id);
        
        renderView("view/cart/list.php", compact('carts'), "Cart List");
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            // exit;
    
            $user_id = $_SESSION['user']['id'] ?? null;
            $cart_session = session_id();
            $sku = $_POST['sku'] ?? null;
            $image = $_POST['image'] ?? null;
            $name = $_POST['name'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;
            $price = $_POST['price'] ?? 0;
    
            if (!$sku || !$name || !$image || $quantity <= 0 || $price < 0) {
                $_SESSION['error'] = "Dữ liệu sản phẩm không hợp lệ!";
                header("Location: /cart");
                exit;
            }
    
            $result = $this->cartModel->addToCart($cart_session, $user_id, $sku, $name, $image, $quantity, $price);
    
            if ($result) {
                $_SESSION['message'] = "Sản phẩm đã được thêm vào giỏ hàng!";
            } else {
                $_SESSION['error'] = "Lỗi khi thêm sản phẩm vào giỏ hàng!";
            }
    
            header("Location: /cart");
            exit;
        } else {
            renderView("view/cart_create.php", [], "Thêm sản phẩm vào giỏ hàng");
        }
    }
    

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
            $quantity = intval($_POST['quantity']);
            if ($quantity > 0) {
                $user_id = $_SESSION['user']['id'] ?? null;
                $cart_session = session_id();
                $this->cartModel->updateCartItem($cart_session, $user_id, $id, $quantity);
                $_SESSION['message'] = "Cập nhật thành công số lượng sản phẩm!";
            } else {
                $_SESSION['error'] = "Invalid quantity!";
            }
        }
        header("Location: /cart");
        exit;
    }

    public function delete($id) {
        $user_id = $_SESSION['user']['id'] ?? null;
        $cart_session = session_id();
        $this->cartModel->removeCartItem($cart_session, $user_id, $id);
        $_SESSION['message'] = "Item removed from cart!";
        header("Location: /cart");
        exit;
    }
}
?>
