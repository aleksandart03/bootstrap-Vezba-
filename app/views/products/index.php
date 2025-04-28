<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proizvodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../Bootstrap(autocomplete)/public/Style/mainstyle.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Proizvodi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Početna
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">1</a></li>
                            <li><a class="dropdown-item" href="#">2</a></li>
                            <li><a class="dropdown-item" href="#">3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">O nama</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center ms-auto">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="text-white me-3">
                            <i class="bi bi-person-fill"></i> <?php echo htmlspecialchars($_SESSION['user']['email']); ?>
                        </span>
                        <a href="/../Bootstrap(autocomplete)/public/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
                    <?php else: ?>
                        <a href="/../Bootstrap(autocomplete)/public/login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
                        <a href="/../Bootstrap(autocomplete)/public/register.php" class="btn btn-warning btn-sm">Register</a>
                    <?php endif; ?>


                    <a href="/../Bootstrap(autocomplete)/public/cart.php" class="text-white ms-3" title="Vaša korpa">
                        <i class="bi bi-cart-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>


    <div class="container mt-4">
        <form method="GET" action="">
            <div class="mb-4 d-flex justify-content-center">
                <input type="text" class="form-control search-box" name="search" id="search" placeholder="Pretraži proizvode..." autocomplete="off">
                <a href="?" class="btn btn-secondary ms-2">Resetuj</a>
            </div>
        </form>
    </div>



    <div class="container mt-5">
        <h1 class="mb-4 text-center">Lista Proizvoda</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4 d-flex justify-content-center">
                    <div class="card custom-card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="card-text"><strong>Cena: </strong><?php echo htmlspecialchars($product['price']); ?> €</p>

                            <form action="/bootstrap(autocomplete)/public/index.php?action=add_to_cart" method="POST" class="mt-auto">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>"> <!-- Popravljeno za duplikate -->
                                <div class="mb-2">
                                    <label for="quantity_<?= $product['id'] ?>" class="form-label">Količina:</label>
                                    <input type="number" id="quantity_<?= $product['id'] ?>" name="quantity" value="1" min="1" max="20" class="form-control" style="width: 80px;">
                                </div>
                                <button type="submit" class="btn btn-warning w-100 add-to-cart-btn">
                                    <i class="bi bi-cart-plus"></i> Dodaj u korpu
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php
    $searchQuery = isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '';
    ?>

    <div class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1 . $searchQuery; ?>" aria-label="Prethodna">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Prethodna</span>
                </a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i . $searchQuery; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1 . $searchQuery; ?>" aria-label="Sledeća">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Sledeća</span>
                </a>
            </li>
        </ul>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Proizvodi Inc. Sva prava zadržana.</p>
        <div class="social-icons">
            <a href="https://github.com" target="_blank" class="text-white me-3">
                <i class="bi bi-github" style="font-size: 24px;"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank" class="text-white me-3">
                <i class="bi bi-instagram" style="font-size: 24px;"></i>
            </a>
            <a href="https://twitter.com" target="_blank" class="text-white me-3">
                <i class="bi bi-twitter" style="font-size: 24px;"></i>
            </a>
            <a href="https://wa.me" target="_blank" class="text-white me-3">
                <i class="bi bi-whatsapp" style="font-size: 24px;"></i>
            </a>
            <a href="https://www.youtube.com" target="_blank" class="text-white me-3">
                <i class="bi bi-youtube" style="font-size: 24px;"></i>
            </a>
        </div>
    </footer>

    <script src="/../Bootstrap(autocomplete)/public/JS/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>