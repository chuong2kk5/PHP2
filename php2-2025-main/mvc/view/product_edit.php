<h1>Edit Product</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= $product['description'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?= $product['price'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" id="image" name="image" >
        <?php if ($product['image']): ?>
        <p>Đường dẫn ảnh: </p>
        <img src="/<?php echo $product['image']; ?>" alt="Product Image" style="max-width: 200px;">
    <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="text" class="form-control" id="quantity" name="quantity" value="<?= $product['quantity'] ?>">
    </div>
    <div class="md-3">
        <label for="category_id" class="form-label">Category</label>
        <select name="category_id" id="category_id">
            <?php foreach($categories as $category): ?>
                <option value="<?= $category['category_id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>