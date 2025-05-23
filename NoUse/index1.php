<?php
session_start();
require_once 'db.php'; // περιέχει την σύνδεση με τη βάση μέσω mysqli

// Έλεγχος για υποβολή νέου thread
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $content);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: forum.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_thread_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $delete_thread_id = intval($_POST['delete_thread_id']);
    $stmt = $conn->prepare("DELETE FROM threads WHERE id = ?");
    $stmt->bind_param("i", $delete_thread_id);
    $stmt->execute();
    $stmt->close();
    header("Location: 2index.php");
    exit();
}

// Φόρτωση threads
$threads = [];
$result = $conn->query("SELECT threads.*, users.username FROM threads JOIN users ON threads.user_id = users.id ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    $threads[] = $row;
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Forum Αρχική</title>
    <link rel="stylesheet" href="css/styleIndex.css">
</head>
<body>
    <header>
        <h1>Καλώς ήρθατε στο Forum</h1>
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

    <main>
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="create-thread-link">
            <a href="create_thread.php" class="btn big">✍️ Δημιουργία νέας ανάρτησης</a>
        </div>
        <br>

<!-- μετάβαση στο create_user.php ορατό μόνο για admin -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <div class="admin-actions">
                <a href="create_user.php" class="btn btn-success">Δημιουργία Νέου Χρήστη</a>
            </div>
        <?php endif; ?>

<?php else: ?>
    <p>Για να δημιουργήσεις ανάρτηση, πρέπει να έχεις λογαριασμό</p>
    <p>
        Αν έχεις λογαριασμό μπορείς να συνδεθείς
        <a href="login.php" class="btn">Σύνδεση</a>
    </p>
    <p>
        Για να δημιουργήσεις λογαριασμό
        <a href="register.php" class="btn">Εγγραφή</a>
    </p>
<?php endif; ?>   

        <section class="threads">
            <h2>Αναρτήσεις</h2>
            <?php if (empty($threads)): ?>
                <p>Δεν υπάρχουν αναρτήσεις ακόμα.</p>
            <?php else: ?>
                <?php foreach ($threads as $thread): ?>
                    <article class="thread">
                        <h3>
                            <a href="thread.php?id=<?= $thread['id'] ?>">
                                <?= htmlspecialchars($thread['title']) ?>
                            </a>
                        </h3>
                        <p class="textrow"><?= nl2br(htmlspecialchars($thread['content'])) ?></p>
                        <div class="meta">Αναρτήθηκε από <?= htmlspecialchars($thread['username']) ?> στις <?= $thread['created_at'] ?></div>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?><br>
                            <!-- Κουμπί διαγραφής -->
                            <form action="delete_thread.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $thread['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Διαγραφή</button>
                            </form>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
