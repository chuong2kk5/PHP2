<?php
require_once "Database.php";
require_once "controller/ProductController.php";
require_once "controller/AuthController.php";
require_once "controller/CategoryController.php";
require_once "controller/ColorController.php";
require_once "controller/SizeController.php";
require_once "controller/ProductVariantController.php";
require_once "controller/CartController.php";

require_once "router/Router.php";
require_once "middleware.php";

$router = new Router();
$productController = new ProductController();
$authController = new AuthController();
$categoryController = new CategoryController();
$colorController = new ColorController();
$sizeController = new SizeController();
$productVariantController = new ProductVariantController();
$cartController = new CartController();

$router->addMiddleware('logRequest');

$router->addRoute("/", [$productController, "home"]);
$router->addRoute("/products", [$productController, "index"], ['isUser']); // Accessible to all logged-in users
$router->addRoute("/products/create", [$productController, "create"], ['isAdmin']); // Admin only
$router->addRoute("/products/{id}", [$productController, "show"], ['isUser']); // Accessible to all logged-in users
$router->addRoute("/products/edit/{id}", [$productController, "edit"], ['isAdmin']); // Admin only
$router->addRoute("/products/delete/{id}", [$productController, "delete"], ['isAdmin']); // Admin only
# routers variant products
$router->addRoute("/product-variants/create/{id}", [$productVariantController, "create"]);

// Accessible to all logged-in users
$router->addRoute("/login", [$authController, "login"]);
$router->addRoute("/logout", [$authController, "logout"]);
$router->addRoute("/register", [$authController, "register"]);
$router->addRoute("/categories", [$categoryController, "index"], ['isUser']); 
$router->addRoute("/categories/create", [$categoryController, "create"]);
$router->addRoute("/categories/edit/{id}", [$categoryController, "edit"],); 
$router->addRoute("/categories/delete/{id}", [$categoryController, "delete"], ); 

// colors

$router->addRoute("/colors", [$colorController, "index"]); 
$router->addRoute("/colors/create", [$colorController, "create"]);
$router->addRoute("/colors/{id}", [$colorController, "show"]); 
$router->addRoute("/colors/edit/{id}", [$colorController, "edit"],); 
$router->addRoute("/colors/delete/{id}", [$colorController, "delete"], );

// sizes
$router->addRoute("/sizes", [$sizeController, "index"]);
$router->addRoute("/sizes/create", [$sizeController, "create"]);
$router->addRoute("/sizes/{id}", [$sizeController, "show"]);
$router->addRoute("/sizes/edit/{id}", [$sizeController, "edit"]);
$router->addRoute("/sizes/delete/{id}", [$sizeController, "delete"]);

// carts
$router->addRoute("/cart", [$cartController, "index"]);
$router->addRoute("/cart/create", [$cartController, "create"]);
$router->addRoute("/cart/delete/{id}", [$cartController, "delete"]);
$router->addRoute("/cart/edit/{id}", [$cartController, "edit"]);


$router->dispatch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        #loading {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            top: 0;
            left: 0;
            z-index: 9999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #ddd;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div id="loading">
        <div class="spinner"></div>
    </div>
    <script>
    window.onload = function() {
        setTimeout(function() {
            document.getElementById("loading").style.display = "none";
        }, 100);  
    };
</script>


</body>

</html>