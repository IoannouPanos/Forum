<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $content);
        $stmt->execute();
        $stmt->close();
        header("Location: forum.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Δημιουργία Ανάρτησης</title>
    <link rel="stylesheet" href="css/styleCreate_Thread.css">
</head>

<header>
        <h1>Δημιουργήστε νέα ανάρτηση</h1>
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

<body class="create-thread-page">
    <div class="create-thread-container">
        <h1>📝 Δημιουργία Νέας Ανάρτησης</h1>
        <form method="post">
            <input type="text" name="title" placeholder="Τίτλος" required>
            <textarea name="content" placeholder="Περιεχόμενο..." required></textarea>
            <button type="submit">Ανάρτηση</button>
            <a href="forum.php" class="btn cancel">⬅ Επιστροφή</a>
        </form>
    </div>
</body>
</html>
