<?php
session_start();
include "db.php";

// Αν δεν υπάρχει ID thread, επιστροφή στην αρχική σελίδα
if (!isset($_GET["id"])) {
    header("Location: 1index.php");
    exit;
}

$thread_id = intval($_GET["id"]);

// Φέρνουμε το thread
$query = "SELECT threads.title, users.username 
          FROM threads 
          JOIN users ON threads.user_id = users.id 
          WHERE threads.id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $thread_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$thread = mysqli_fetch_assoc($result);

// Αν το thread δεν υπάρχει, επιστροφή στην αρχική
if (!$thread) {
    header("Location: index.php");
    exit;
}

// Αν υποβλήθηκε νέο post
if (isset($_POST["reply"])) {
    if (!isset($_SESSION["user_id"])) {
        echo "<script>alert('Πρέπει να συνδεθείτε για να απαντήσετε!');</script>";
    } else {
        $user_id = $_SESSION["user_id"];
        $content = trim($_POST["content"]);

        if (!empty($content)) {
            $query = "INSERT INTO posts (thread_id, user_id, content) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "iis", $thread_id, $user_id, $content);
            mysqli_stmt_execute($stmt);
            header("Location: thread.php?id=" . $thread_id);
            exit;
        } else {
            echo "<script>alert('Το περιεχόμενο δεν μπορεί να είναι κενό!');</script>";
        }
    }
}

// Φέρνουμε όλα τα posts του thread
$query = "SELECT posts.content, posts.created_at, users.username 
          FROM posts 
          JOIN users ON posts.user_id = users.id 
          WHERE posts.thread_id = ? 
          ORDER BY posts.created_at ASC";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $thread_id);
mysqli_stmt_execute($stmt);
$posts = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($thread["title"]); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo htmlspecialchars($thread["title"]); ?></h2>
        <p><strong>Δημιουργήθηκε από:</strong> <?php echo htmlspecialchars($thread["username"]); ?></p>
        <hr>

        <h4>Απαντήσεις:</h4>
        <?php while ($post = mysqli_fetch_assoc($posts)): ?>
            <div class="border p-3 mb-3">
                <p><strong><?php echo htmlspecialchars($post["username"]); ?></strong> - <?php echo $post["created_at"]; ?></p>
                <p><?php echo nl2br(htmlspecialchars($post["content"])); ?></p>
            </div>
        <?php endwhile; ?>

        <?php if (isset($_SESSION["user_id"])): ?>
            <h4>Απάντηση:</h4>
            <form action="thread.php?id=<?php echo $thread_id; ?>" method="POST">
                <div class="mb-3">
                    <textarea name="content" class="form-control" required></textarea>
                </div>
                <button type="submit" name="reply" class="btn btn-primary">Αποστολή</button>
            </form>
        <?php else: ?>
            <p><a href="login.php">Συνδεθείτε</a> για να απαντήσετε.</p>
        <?php endif; ?>

        <a href="index.php" class="btn btn-secondary mt-3">Πίσω</a>
    </div>
</body>
</html>
