<?php

require_once __DIR__ . '/../models/ProductModel.php';


class ProductController
{

    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        $productsPerPage = 9;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) {
            $page = 1;
        }

        $offset = ($page - 1) * $productsPerPage;

        if (!empty($search)) {
            $totalProducts = $this->productModel->getTotalProductsBySearch($search);
            $products = $this->productModel->searchProducts($search, $productsPerPage, $offset);
        } else {
            $totalProducts = $this->productModel->getTotalProducts();
            $products = $this->productModel->getProductsWithLimit($productsPerPage, $offset);
        }

        $totalPages = ceil($totalProducts / $productsPerPage);

        require_once __DIR__ . '/../views/products/index.php';
    }
}
