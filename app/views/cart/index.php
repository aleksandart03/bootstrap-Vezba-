<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korpa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <?php if (isset($productsInCart) && count($productsInCart) > 0): ?>
            <h2 class="mb-4 text-center text-primary">Vaša Korpa</h2>
            <table class="table table-hover table-bordered table-sm shadow-lg">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Proizvod</th>
                        <th>Cena</th>
                        <th>Količina</th>
                        <th>Ukupno</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productsInCart as $product): ?>
                        <tr>
                            <td class="align-middle"><?php echo htmlspecialchars($product['name']); ?></td>
                            <td class="align-middle"><?php echo number_format($product['price'], 2); ?> $</td>
                            <td class="align-middle"><?php echo $product['quantity']; ?></td>
                            <td class="align-middle"><?php echo number_format($product['price'] * $product['quantity'], 2); ?> RSD</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="checkout.php" class="btn btn-success btn-lg px-4 py-2 shadow-sm">Završi kupovinu</a>
                <a href="index.php" class="btn btn-outline-primary btn-lg px-4 py-2 shadow-sm">Nastavi kupovinu</a>
            </div>
            <div class="mt-4 text-right">
                <p class="h5 text-secondary">Ukupno: <?php echo number_format($totalPrice, 2); ?> RSD</p>
            </div>
        <?php else: ?>
            <div class="text-center mt-5">
                <h3 class="text-danger">Vaša korpa je prazna.</h3>
                <a href="index.php" class="btn btn-outline-primary mt-3">Nastavite sa kupovinom</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>