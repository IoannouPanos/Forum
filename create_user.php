<?php
session_start();
require 'db.php';

// Έλεγχος αν ο χρήστης είναι admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim( $_POST['password']); 
    $role = $_POST['role'];

    if (!empty($username) && !empty($email) && !empty($password) && in_array($role, ['user', 'admin'])) {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $role);

        if ($stmt->execute()) {
            echo "<script>alert('Ο χρήστης δημιουργήθηκε επιτυχώς!');</script>";
        } else {
            echo "<script>alert('Σφάλμα κατά τη δημιουργία χρήστη.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Συμπληρώστε όλα τα πεδία σωστά.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Δημιουργία Χρήστη</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleCreate_Thread.css">
</head>
<header>
        <h1><a href="index.php">Forum</h1>
        <nav class="top-nav">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>👋 Καλωσήρθες, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php" class="btn">Αποσύνδεση</a>
            <?php else: ?>
                <a href="login.php" class="btn">Σύνδεση</a>
                <a href="register.php" class="btn">Εγγραφή</a>
            <?php endif; ?>
        </nav>
</header>
<body>
    <div class="container mt-5">
        <h2>Δημιουργία Νέου Χρήστη</h2>
        <form action="create_user.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Όνομα Χρήστη</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Κωδικός</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ρόλος</label>
                <select name="role" class="form-select" required>
                    <option value="user">Χρήστης</option>
                    <option value="admin">Διαχειριστής</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Δημιουργία</button>
            <a href="index.php" class="btn btn-secondary">Πίσω</a>
        </form>
    </div>
</body>
</html>