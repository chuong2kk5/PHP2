<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.btn {
    margin-right: 5px;
    padding: 8px 15px;
    border-radius: 5px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    text-align: center;
    padding: 10px;
    border: 1px solid #dee2e6;
}

.table thead {
    background-color: #343a40;
    color: white;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f2f2f2;
}

/* Hình ảnh sản phẩm */
.table img {
    display: block;
    margin: 0 auto;
    border-radius: 5px;
}

.table tbody tr:hover {
    background-color: #ddd;
}
.container {
    max-width: 90%;
    margin: auto;
}

</style>
<h1>Danh sách sản phẩm</h1>
<br>
<a href="/products/create" class="btn btn-primary mb-3">Tạo sản phẩm</a>
<a href="/categories" class="btn btn-primary mb-3">Danh mục</a>
                    <a href="/colors" class="btn btn-primary mb-3">Màu</a>
                    <a href="/sizes" class="btn btn-primary mb-3">Kích thước</a>
                    <a href="/product-variants/create/1" class="btn btn-primary mb-3">Thêm biến thể</a>
<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success'] ?>
    </div>
<?php endif; ?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <!-- <th>ID</th> -->
            <th>Tên</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Số lượng</th>
            <th>Danh mục ID</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <!-- <td><?= $product['product_id'] ?></td> -->
            <td><?= $product['name'] ?></td>
            <td><?= number_format($product['price'], 0, ',', '.') ?> đ</td>
            <td><img style="width: 50px; height: 50px;" src="<?= $product['image'] ?>" alt="hinh anh san pham"></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['category_id'] ?></td>
            <td><?= $product['description'] ?></td>
            <td>
                <a href="/products/<?= $product['product_id'] ?>" class="btn btn-info btn-sm">Xem</a>
                <a href="/products/edit/<?= $product['product_id'] ?>" class="btn btn-warning btn-sm" >Sửa</a>
                <a href="/products/delete/<?= $product['product_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn xoá sản phẩm này?')">Xoá</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>