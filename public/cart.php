
<?php

require_once __DIR__ . "/../app/controllers/CartController.php";

$cartController = new CartController();
$cartController->showCart();
