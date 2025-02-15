<div class="container mt-5">
    <h2 class="mb-4 text-center">🛒 Giỏ hàng của bạn</h2>

    <?php if (!empty($carts)) : ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>SKU</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                //  var_dump($_SESSION['user']['user_id']);
                    $totalPrice = 0;
                    foreach ($carts as $item) : 
                        $totalItem = $item['quantity'] * $item['price'];
                        $totalPrice += $totalItem;
                    ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="Product Image" class="img-fluid" style="width: 80px; height: 80px;"></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= htmlspecialchars($item['sku']) ?></td>
                            <td>
                                <form action="/cart/edit/<?= $item['id'] ?>" method="post" class="d-flex justify-content-center align-items-center">
                                    <input type="number" class="form-control w-50 text-center" name="quantity" value="<?= $item['quantity'] ?>" min="1">
                                    <button type="submit" class="btn btn-primary btn-sm ms-2">🔄</button>
                                </form>
                            </td>
                            <td><strong>$<?= number_format($item['price'], 2) ?></strong></td>
                            <td><strong>$<?= number_format($totalItem, 2) ?></strong></td>
                            <td>
                                <a href="/cart/delete/<?= $item['id'] ?>" class="btn btn-danger btn-sm">🗑 Xoá</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-warning">
                        <td colspan="5" class="text-end"><strong>Tổng tiền:</strong></td>
                        <td colspan="2"><strong>$<?= number_format($totalPrice, 2) ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="/cart/clear" class="btn btn-warning">🧹 Xoá giỏ hàng</a>
            <a href="/" class="btn btn-secondary">🛍 Tiếp tục mua sắm</a>
            <a href="/checkout" class="btn btn-success">💳 Thanh toán</a>
        </div>

    <?php else : ?>
        <div class="alert alert-info text-center">
            <h4>🛒 Giỏ hàng của bạn trống!</h4>
            <p>Hãy thêm sản phẩm vào giỏ để tiếp tục mua sắm.</p>
            <a href="/" class="btn btn-primary">🛍 Quay lại mua sắm</a>
        </div>
    <?php endif; ?>
</div>
