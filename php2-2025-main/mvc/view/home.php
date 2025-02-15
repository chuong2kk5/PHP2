<h1 class="text-center my-4 fw-bold">Danh sách sản phẩm</h1>
<div class="container">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card border-0 shadow-sm">
                    <img style="height: 300px; object-fit: cover;" src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="card-body text-center">
                        <h6 class="text-truncate fw-bold">
                            <a href="/products/<?= $product['product_id'] ?>"class="text-dark text-decoration-none">
                            <?= htmlspecialchars($product['name']) ?>
                            </a>
                        </h6>
                        <p class="text-danger fw-bold fs-5 mb-2">
                            <?= number_format($product['price'], 0, ',', '.') ?>đ
                        </p>
                        <a href="/products/<?= $product['product_id'] ?>" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                        </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
