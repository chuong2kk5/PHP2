<h1>Danh sách màu </h1>
<a href="colors/create" class="btn btn-primary mb-3">Tạo màu</a>
<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success'] ?>
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
        <?php foreach ($colors as $color): ?>
        <tr>
            <td><?= $color['color_id'] ?></td>
            <td><?= $color['color_name'] ?></td>
            <td>
                <a href="/colors/<?= $color['color_id'] ?>" class="btn btn-info btn-sm">Xem</a>
                <a href="/colors/edit/<?= $color['color_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                <a href="/colors/delete/<?= $color['color_id'] ?>" onclick="return confirm('Bạn muốn xoá màu này?')" class="btn btn-danger btn-sm">Xoá</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>