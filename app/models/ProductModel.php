<?php

require_once __DIR__ . '/../../config/database.php';


class ProductModel
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM products";
        $result = $this->db->query($query);

        $products = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        return $products;
    }

    public function searchProducts($search, $limit, $offset)
    {
        $search = $this->db->real_escape_string($search);
        $searchTerms = explode(' ', $search);

        $conditions = array_map(function ($term) {
            return "name LIKE '%$term%'";
        }, $searchTerms);

        $query = "SELECT * FROM products WHERE " . implode(' AND ', $conditions) . " LIMIT $limit OFFSET $offset";

        $result = $this->db->query($query);

        $products = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        return $products;
    }

    public function searchListsProducts($search)
    {
        $search = $this->db->real_escape_string($search);
        $searchTerms = explode(' ', $search);

        $conditions = array_map(function ($term) {
            return "name LIKE '%$term%'";
        }, $searchTerms);

        $query = "SELECT * FROM products WHERE " . implode(' AND ', $conditions) . " LIMIT 10";

        $result = $this->db->query($query);

        $products = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        return $products;
    }

    public function getProductsWithLimit($limit, $offset)
    {
        $query = "SELECT * FROM products LIMIT $limit OFFSET $offset";
        $result = $this->db->query($query);

        $products = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    public function getTotalProducts()
    {
        $query = "SELECT COUNT(*) AS total FROM products";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function getTotalProductsBySearch($search)
    {
        $search = $this->db->real_escape_string($search);
        $searchTerms = explode(' ', $search);

        $conditions = array_map(function ($term) {
            return "name LIKE '%$term%'";
        }, $searchTerms);

        $query = "SELECT COUNT(*) AS total FROM products WHERE " . implode(' AND ', $conditions);

        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
