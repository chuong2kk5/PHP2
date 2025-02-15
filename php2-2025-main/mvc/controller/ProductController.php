<?php
require_once "model/ProductModel.php";
require_once "model/ProductVariantsModel.php";
require_once "view/helpers.php";

class ProductController {
    private $productModel;
    private $productVariantsModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->productVariantsModel = new ProductVariantModel();
    }
    public function home() {
        $products = $this->productModel->getAllProducts(); 
        renderView("view/home.php", compact('products'), "Home");
    }
    
    public function index() {
        $products = $this->productModel->getAllProducts();
        
        //compact: gom bien dien thanh array
        renderView("view/product_list.php", compact('products'), "Product List");
    }

    public function show($id) {
        $product = $this->productModel->getProductById($id); 
        $product_variants = $this->productVariantsModel->getVariantByProductId($id);
        echo "<pre>";
        // var_dump($product_variants);
        echo "</pre>";
        renderView("view/product_detail.php", compact('product_variants', 'product'), "Product Detail");
    }

    public function create() {
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $category_id = $_POST['category_id'];
            $image = null;
    
            if (isset($_FILES['image'])) {
                $uploadDir = "image/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                    echo "Lỗi: Có vấn đề khi tải ảnh lên.";
                    return;
                }
    
                if ($_FILES['image']['size'] == 0) {
                    echo "Bạn chưa chọn hình ảnh";
                    return;
                }
    
                if (!is_writable($uploadDir)) {
                    echo "Lỗi: Không thể ghi vào thư mục ảnh.";
                    return;
                }
    
                $fileName = basename($_FILES['image']['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
    
                if (in_array($fileType, $allowedTypes)) {
                    if (!file_exists($targetFilePath)) {
                        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                            echo "Lỗi: Không thể di chuyển file.";
                            return;
                        }
                    } else {
                        echo "Lưu ý: Ảnh đã tồn tại, sử dụng ảnh cũ.";
                    }
                    $image = $targetFilePath;
                } else {
                    echo "Lỗi: Chỉ chấp nhận các định dạng JPG, PNG, GIF, WebP.";
                    return;
                }
            } else {
                echo "Ảnh tải lên bị lỗi.";
                return;
            }
    
            if (!file_exists($targetFilePath)) {
                echo "Lỗi: File ảnh không tồn tại sau khi tải lên.";
                return;
            }
    
            if ($image) {
                // Luu san pham
                $_SESSION['message'] = "<p class='alert alert-success '>Tạo Sản phẩm thành công <i class='fa-solid fa-check'></i></p>";
                $this->productModel->createProduct($name, $description, $price, $image, $quantity, $category_id);
                header("Location: /products");
                exit;
            } else {
                echo "Lỗi: Không thể lưu sản phẩm.";
            }

        } else {
            $productModel = new ProductModel();
            $categories = $productModel->getAllCategories(); 
            renderView("view/product_create.php", ['categories' => $categories], "Create Product");
        }
    }
    

    public function edit($product_id) { 
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form và chống XSS
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $price = floatval($_POST['price']);
            $category_id = intval($_POST['category_id']);
            $quantity = intval($_POST['quantity']);
    
            // Lấy thông tin sản phẩm hiện tại
            $product = $this->productModel->getProductById($product_id);
            $image = $product['image']; // Giữ ảnh cũ nếu không có ảnh mới
    
            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = "image/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                $fileName = time() . "_" . basename($_FILES['image']['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
    
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                        // Xóa ảnh cũ nếu có
                        if (!empty($product['image']) && file_exists($product['image'])) {
                            unlink($product['image']);
                        }
                        $image = $targetFilePath;
                    } else {
                        echo "Lỗi: Không thể tải ảnh lên.";
                        return;
                    }
                } else {
                    echo "Lỗi: Chỉ chấp nhận JPG, PNG, GIF, WebP.";
                    return;
                }
            }
    
            // Cập nhật sản phẩm
            if ($this->productModel->updateProduct($product_id, $name, $description, $price, $image, $quantity, $category_id)) {
                $_SESSION['message'] = "<p class='alert alert-success'>Cập nhật sản phẩm thành công <i class='fa-solid fa-check'></i></p>";
                header("Location: /products");
                exit;
            } else {
                echo "Lỗi: Không thể cập nhật sản phẩm.";
            }
        } else {
            $product = $this->productModel->getProductById($product_id);
            $categories = $this->productModel->getAllCategories();
            renderView("view/product_edit.php", compact('product', 'categories'), "Edit Product");
        }
    }

    public function delete($product_id) {
        $message = "";
        $_SESSION['message'] = "<p class='alert alert-success'>Xóa sản phẩm thành công <i class='fa-solid fa-check'></i></p>";
        $this->productModel->deleteProduct($product_id);
        header("Location: /products");
        exit;
    }
}