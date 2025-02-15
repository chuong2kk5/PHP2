<?php
require_once "model/ColorModel.php";
require_once "view/helpers.php";

class ColorController {
    private $colorModel;

    public function __construct() {
        $this->colorModel = new colorModel();
    }

    public function index() {
        $colors = $this->colorModel->getAll();
        //compact: gom bien dien thanh array
        renderView("view/color/list.php", compact('colors'), "colors List");
    }

    public function show($color_id) {
        $color = $this->colorModel->getBycolor_Id($color_id);
        renderView("view/color/detail.php", compact('color'), "color Detail");
    }
    public function create() {
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $color_name = $_POST['color_name'];
            $_SESSION['message'] = "<p class='alert alert-success '>Tạo màu thành công <i class='fa-solid fa-check'></i></p>";
            $this->colorModel->create($color_name);
            header("Location: /colors");
        } else {
            renderView("view/color/create.php", ['color'], "Create color");
        }
    }
    public function edit($color_id){
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $color_name = $_POST['color_name'];
            $_SESSION['message'] = "<p class='alert alert-success '>Sửa màu thành công <i class='fa-solid fa-check'></i></p>";
            $this->colorModel->update($color_id, $color_name);
            header("Location: /colors");
        } else {
            $color = $this->colorModel->getById($color_id);
            renderView("view/color/edit.php", compact('color'), "Edit color");
        }
    }
    public function delete($color_id) {
        $message = "";
        $_SESSION['message'] = "<p class='alert alert-success '>Xoá màu thành công <i class='fa-solid fa-check'></i></p>";
        $this->colorModel->delete($color_id);
        header("Location: /colors");
        exit;
    }
}