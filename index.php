<?php 
require_once 'server/Server_Index.php'; 
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
                <span> Καλωσήρθες, <?= htmlspecialchars($_SESSION['username']) ?></span>
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
                        <p class="content"><?= nl2br(htmlspecialchars(mb_strimwidth($thread['content'], 0, 150, '...'))) ?></p>
                        <div class="meta">Αναρτήθηκε από <?= htmlspecialchars($thread['username']) ?> στις <?= $thread['created_at'] ?></div>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?><br>
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