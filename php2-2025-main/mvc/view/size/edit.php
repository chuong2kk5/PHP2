<h1>Edit Size</h1>
<form method="POST">
    <div class="mb-3">
        <label for="size_name" class="form-label">Name</label>
        <input type="text" class="form-control" id="size_name" name="size_name" value="<?= $sizes['size_name'] ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Edit</button>
</form>