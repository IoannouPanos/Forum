<?php
session_start();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Καλώς ήρθατε στο Forum</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="indexStyle.css">
</head>
<body>

<div class="container">
    <h1>Καλώς ήρθατε στο Forum!</h1>
    <p>Συνδεθείτε ή εγγραφείτε για να ξεκινήσετε.</p>

    <?php if (!isset($_SESSION["user_id"])): ?>
        <a href="login.php" class="btn btn-primary mb-3">Σύνδεση</a>
        <a href="register.php" class="btn btn-success">Εγγραφή</a>
    <?php else: ?>
        <a href="forum.php" class="btn btn-primary mb-3">Μετάβαση στο Forum</a>
        <a href="logout.php" class="btn btn-danger">Αποσύνδεση</a>
    <?php endif; ?>
</div>

</body>
</html>
