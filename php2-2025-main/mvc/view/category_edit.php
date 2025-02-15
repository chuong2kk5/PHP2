<h1>Sửa danh mục</h1>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $categories['name'] ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Sửa</button>
</form>