<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = strip_tags(trim($_POST['content'])); // Αφαίρεση HTML tags
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("iss", $user_id, $title, $content);
            if ($stmt->execute()) {
                echo "<script>alert('Η ανάρτηση δημιουργήθηκε επιτυχώς!');</script>";
                header("Location: forum.php");
                exit();
            } else {
                echo "<script>alert('Σφάλμα κατά την εκτέλεση του ερωτήματος.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Σφάλμα κατά την προετοιμασία του ερωτήματος.');</script>";
        }
    } else {
        echo "<script>alert('Ο τίτλος και το περιεχόμενο δεν μπορούν να είναι κενά.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Δημιουργία Ανάρτησης</title>
    <!-- <link rel="stylesheet" href="css/styleCreate_Thread.css"> -->
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
        <form method="post" action="create_thread.php">
            <input type="text" name="title" placeholder="Τίτλος" required>
            <textarea id="content" name="content" placeholder="Περιεχόμενο..." required></textarea>
            <button type="submit">Ανάρτηση</button>
            <a href="forum.php" class="btn cancel">⬅ Επιστροφή</a>
        </form>
    </div>

    <script src="https://cdn.tiny.cloud/1/twr5mw7tdxjss1tctchgtrokgizwl0yzopliqdilnsnerke1/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            forced_root_block: false, // Απενεργοποίηση αυτόματης προσθήκης <p>
        });
    </script>
</body>
</html>
