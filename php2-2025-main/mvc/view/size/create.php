<h1>Create Size</h1>
<form method="POST">
    <div class="mb-3">
        <label for="size_name" class="form-label">Name</label>
        <input type="text" class="form-control" id="size_name" name="size_name">
        <span class="text-danger"><?= $error['size_name'] ?? "" ?></span>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
 
</form>
