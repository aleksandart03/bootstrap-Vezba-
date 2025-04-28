<?php

require_once __DIR__ . '/../models/Cart.php';
require_once __DIR__ . '/../models/CartProduct.php';


class CartController
{
    public function addToCart()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            echo "<script>
    alert('Morate biti ulogovani da biste dodali proizvod u korpu.');
    window.location.href = 'login.php';
</script>";
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $cartModel = new Cart();

        $cartId = $cartModel->getCartIdByUser($userId);

        if (!$cartId) {
            $cartId = $cartModel->createCart($userId);
        }

        $cartProductModel = new CartProduct();
        if ($cartProductModel->exists($cartId, $productId)) {
            $cartProductModel->updateQuantity($cartId, $productId, $quantity);
        } else {

            $cartProductModel->addProductToCart($cartId, $productId, $quantity);
        }

        header('Location: index.php');
        exit();
    }

    public function showCart()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit();
        }

        $userId = $_SESSION['user']['id'];

        $cartModel = new Cart();
        $cartId = $cartModel->getCartIdByUser($userId);

        if (!$cartId) {
            echo "Nemate nijednu aktivnu korpu.";
            return;
        }

        $productsInCart = $cartModel->getCartProducts($cartId);

        $totalPrice = 0;
        foreach ($productsInCart as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }

        require_once __DIR__ . '/../views/cart/index.php';
    }
}
