<?php

require_once __DIR__ . '/../app/models/ProductModel.php';

if (isset($_GET['query'])) {
    $search = trim($_GET['query']);

    $product = new ProductModel();
    $results = $product->searchListsProducts($search);

    if (empty($results)) {
        echo '<div class="suggestion-item" style="padding: 8px;">Nema proizvoda koji odgovaraju vašem upitu.</div>';
    } else {
        foreach ($results as $row) {
            echo '<div class="suggestion-item" style="padding: 8px; cursor: pointer;" data-product-id="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</div>';
        }
    }
} else {
    echo 'Nema rezultata.';
}
