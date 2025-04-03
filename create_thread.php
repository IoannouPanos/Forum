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

    if (empty($title)) {
        echo "<script>alert('Ο τίτλος δεν μπορεί να είναι κενός!');</script>";
    } else {
        $query = "INSERT INTO threads (user_id, title) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "is", $user_id, $title);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Η συζήτηση δημιουργήθηκε!'); window.location='index.php';</script>";
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
    <title>Νέα Συζήτηση</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Δημιουργία Νέας Συζήτησης</h2>
        <form action="create_thread.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Τίτλος Συζήτησης</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <button type="submit" name="create" class="btn btn-success">Δημιουργία</button>
            <a href="index.php" class="btn btn-secondary">Ακύρωση</a>
        </form>
    </div>
</body>
</html>
