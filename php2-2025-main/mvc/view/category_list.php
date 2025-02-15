<h1>Tạo danh mục</h1>
<a href="/categories/create" class="btn btn-primary mb-3">Thêm Danh mục</a>
<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $categories): ?>
        <tr>
            <td><?= $categories['category_id'] ?></td>
            <td><?= $categories['name'] ?></td>
            <td>
                <a href="/categories/<?= $categories['category_id'] ?>" class="btn btn-info btn-sm">Xem</a>
                <a href="/categories/edit/<?= $categories['category_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                <a href="/categories/delete/<?= $categories['category_id'] ?>" onclick="return confirm('Bạn muốn xoá danh mục này?')" class="btn btn-danger btn-sm">Xoá</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>