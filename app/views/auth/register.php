<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <form method="POST" class="p-4 border rounded shadow" style="width: 300px;">
        <h2 class="mb-4 text-center">Registracija</h2>
        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Korisničko ime" required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Lozinka" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Registruj se</button>
        <p class="mt-3 text-center"><a href="login.php">Već imate nalog? Ulogujte se</a></p>
    </form>
</body>

</html>