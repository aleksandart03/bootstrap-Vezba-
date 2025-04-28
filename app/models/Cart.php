
<?php

require_once __DIR__ . '/../../config/database.php';

class Cart
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getCartIdByUser($userId)
    {
        $stmt = $this->db->prepare("SELECT id FROM cart WHERE user_id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['id'] ?? null;
    }

    public function createCart($userId)
    {
        $stmt = $this->db->prepare("INSERT INTO cart (user_id, created_at) VALUES (?, NOW())");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $this->db->insert_id;
    }
    public function getCartProducts($cartId)
    {
        $stmt = $this->db->prepare("SELECT p.id, p.name, p.price, cp.quantity
                                    FROM cart_product cp
                                    JOIN products p ON cp.product_id = p.id
                                    WHERE cp.cart_id = ?");
        $stmt->bind_param('i', $cartId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
