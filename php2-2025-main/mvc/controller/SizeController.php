<?php
require_once "model/SizeModel.php";
require_once "view/helpers.php";

class SizeController {
    private $sizeModel;

    public function __construct() {
        $this->sizeModel = new sizeModel();
    }

    public function index() {
        $sizes = $this->sizeModel->getAll();
        //compact: gom bien dien thanh array
        renderView("view/size/list.php", compact('sizes'), "size List");
    }

    public function show($id) {
        $size = $this->sizeModel->getById($id);
        renderView("view/size/detail.php", compact('size'), "size Detail");
    }
    public function create() {
       $mesage = "";
       $error = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $size_name = $_POST['size_name'];
            if (empty($size_name)) {
               
                $error['size_name'] = "size_name is required";
                renderView("view/size/create.php", compact('error'), "Create size");
            }else {
                $_SESSION['message'] = "<p class='alert alert-success '>Tạo size Thành công <i class='fa-solid fa-check'></i></p>";
                $this->sizeModel->create($size_name);
            header("Location: /sizes");
            }

        } else {
            renderView("view/size/create.php", compact('error'), "Create size");
            
        }
    }
    public function edit($size_id){
        $mesage = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $size_name = $_POST['size_name'];
            $_SESSION['message'] = "<p class='alert alert-success '>Sửa size Thành công <i class='fa-solid fa-check'></i></p>";
            $this->sizeModel->update($size_id, $size_name);
            header("Location: /sizes");
        } else {
            $sizes = $this->sizeModel->getById($size_id);
            renderView("view/size/edit.php", compact('sizes'), "Edit size");
        }
    }
    public function delete($size_id) {
        $mesage = "";
        $_SESSION['message'] = "<p class='alert alert-success '>Xóa size Thành công <i class='fa-solid fa-check'></i></p>";
        $this->sizeModel->delete($size_id);
        header("Location: /sizes");
        exit;
    }
}