<?php
require_once "model/CategoryModel.php";
require_once "view/helpers.php";

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new categoryModel();
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategory();
        //compact: gom bien dien thanh array
        renderView("view/category_list.php", compact('categories'), "categories List");
    }

    public function show($id) {
        $categories = $this->categoryModel->getCategoryById($id);
        renderView("view/category_detail.php", compact('categories'), "categories Detail");
    }
    public function create() {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $_SESSION['message'] = "<p class='alert alert-success '>Tạo Danh mục Thành công <i class='fa-solid fa-check'></i></p>";
            $this->categoryModel->createCategory($name);
            header("Location: /categories");
        } else {
            renderView("view/category_create.php", [], "Create category");
        }
    }
    public function edit($category_id){
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $_SESSION['message'] = "<p class='alert alert-success '>Sửa Danh mục Thành công <i class='fa-solid fa-check'></i></p>";
            $this->categoryModel->updateCategory($category_id, $name);
            header("Location: /categories");
        } else {
            $categories = $this->categoryModel->getCategoryById($category_id);
            renderView("view/category_edit.php", compact('categories'), "Edit categories");
        }
    }
    public function delete($category_id) {
        $message = '';
        $_SESSION['message'] = "<p class='alert alert-success '>Xóa Danh mục Thành công <i class='fa-solid fa-check'></i></p>";
        $this->categoryModel->deleteCategory($category_id);
        header("Location: /categories");
        exit;
    }
}