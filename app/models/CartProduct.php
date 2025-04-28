<?php

require_once __DIR__ . '/../../config/database.php';


class CartProduct
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function exists($cartId, $productId)
    {
        $stmt = $this->db->prepare("SELECT id FROM cart_product WHERE cart_id = ? AND product_id = ?");
        $stmt->bind_param('ii', $cartId, $productId);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function updateQuantity($cartId, $productId, $quantity)
    {
        $stmt = $this->db->prepare("UPDATE cart_product SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?");
        $stmt->bind_param('iii', $quantity, $cartId, $productId);
        $stmt->execute();
    }

    public function addProductToCart($cartId, $productId, $quantity)
    {
        $stmt = $this->db->prepare("INSERT INTO cart_product (cart_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param('iii', $cartId, $productId, $quantity);
        $stmt->execute();
    }
}
