<?php
session_start();
include "db.php";

// Ελέγχουμε αν ο χρήστης είναι admin
if (!isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
    die("Δεν έχεις δικαίωμα να διαγράψεις αυτή τη συζήτηση.");
}

if (isset($_GET["id"])) {
    $thread_id = intval($_GET["id"]);

    // Διαγραφή του thread και όλων των posts του
    $delete_posts = "DELETE FROM posts WHERE thread_id = ?";
    $stmt = mysqli_prepare($conn, $delete_posts);
    mysqli_stmt_bind_param($stmt, "i", $thread_id);
    mysqli_stmt_execute($stmt);

    $delete_thread = "DELETE FROM threads WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_thread);
    mysqli_stmt_bind_param($stmt, "i", $thread_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Η συζήτηση διαγράφηκε!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Σφάλμα κατά τη διαγραφή.');</script>";
    }
} else {
    echo "<script>alert('Μη έγκυρο αίτημα.'); window.location='index.php';</script>";
}
?>
