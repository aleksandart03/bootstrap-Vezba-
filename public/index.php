<?php

session_start();

require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/CartController.php';


$action = $_GET['action'] ?? 'index';

$controller = new ProductController();


switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'add_to_cart':
        $cartController = new CartController();
        $cartController->addToCart();
        break;
}
