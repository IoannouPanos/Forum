<?php 
require_once 'server/Server_login.php'; 
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Σύνδεση</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleIndex.css">
</head>
<header>
    <h1>Καλώς ήρθατε στο Forum</h1>
</header>
<body>
<div class="container mt-5">
    <h2>Σύνδεση</h2>
    <form action="login.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Κωδικός</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Σύνδεση</button>
    </form>
</div>
</body>
</html>