<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "My App" ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">ShopOnline</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="/">Trang chủ</a></li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                <a class="nav-link" href="/products">Admin</a>
                            <?php endif; ?>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="/cart">Giỏ hàng</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <span class="nav-link">Chào, <?= htmlspecialchars($_SESSION['user']['name']); ?></span>
                            </li>
                            <li class="nav-item"><a href="/logout" class="btn btn-warning">Thoát</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a href="/login" class="btn btn-primary">Đăng nhập</a></li>
                            <li class="nav-item"><a href="/register" class="btn btn-success">Đăng ký</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main class="container my-4">
        <?php
        if (!isset($_SESSION['message'])) {
            $_SESSION['message'] = "";
        } else {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
        <?= $content ?>
    </main>
    <footer class="footer_bottom bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; <?= date("Y") ?> Shop Online</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>