<h1>Create Product</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>
    <div class="md-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="text" class="form-control" id="quantity" name="quantity">
    </div>
    <br>
    <div class="md-3">
        <label for="category_id" class="form-label">Category</label>
        <select name="category_id" id="category_id">
            <?php foreach($categories as $category): ?>
                <option value="<?= $category['category_id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-success">Create</button>
</form>