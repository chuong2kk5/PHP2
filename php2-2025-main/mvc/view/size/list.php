<h1>Danh sách size</h1>
<a href="/sizes/create" class="btn btn-primary mb-3">Tạo size</a>
<?php if(isset($_SESSION['success'])) : ?>
    <div class="alert alert-success"></div>
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
        <?php foreach ($sizes as $size): ?>
        <tr>
            <td><?= $size['size_id'] ?></td>
            <td><?= $size['size_name'] ?></td>
            <td>
                <a href="/sizes/<?= $size['size_id'] ?>" class="btn btn-info btn-sm">Xem</a>
                <a href="/sizes/edit/<?= $size['size_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                <a href="/sizes/delete/<?= $size['size_id'] ?>" onclick="return confirm('Bạn muốn xoá size này?')" class="btn btn-danger btn-sm">Xoá</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>