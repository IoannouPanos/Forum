<?php
session_start();
include "db.php";

// Αν ο χρήστης δεν είναι συνδεδεμένος, τον στέλνουμε στη σελίδα login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Αν υποβλήθηκε η φόρμα
if (isset($_POST["create"])) {
    $user_id = $_SESSION["user_id"];
    $title = trim($_POST["title"]);
    $content = trim($_POST["content"]);

    if (empty($title) || empty($content)) {
        echo "<script>alert('Ο τίτλος και το περιεχόμενο είναι υποχρεωτικά!');</script>";
    } else {
        $query = "INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $title, $content);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Η συζήτηση δημιουργήθηκε!'); window.location='pppindex.php';</script>";
        } else {
            echo "<script>alert('Σφάλμα κατά τη δημιουργία.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Νέα Aνάρτηση</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Ενσωμάτωση TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            height: 300,
            menubar: false,
            plugins: 'lists link image code',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | code'
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>Δημιουργία Νέας Ανάρτησης</h2>
        <form action="create_thread.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Τίτλος </label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Περιεχόμενο</label>
                <textarea id="content" name="content" class="form-control" required></textarea>
            </div>
            <button type="submit" name="create" class="btn btn-success">Δημιουργία</button>
            <a href="index.php" class="btn btn-secondary">Ακύρωση</a>
        </form>
    </div>
</body>
</html>
