<h1>Sửa màu</h1>
<form method="POST">
    <div class="mb-3">
        <label for="color_name" class="form-label">Tên</label>
        <input type="text" class="form-control" id="color_name" name="color_name" value="<?= $color['color_name'] ?>" required>
    </div>
    <button type="submit" class="btn btn-warning">Sửa</button>
</form>