<?php
session_start();
include "db.php";

// Ελέγχουμε αν ο χρήστης είναι συνδεδεμένος
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$query = "SELECT username, email, created_at FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Προφίλ Χρήστη</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Προφίλ Χρήστη</h2>
        <table class="table">
            <tr>
                <th>Όνομα Χρήστη:</th>
                <td><?php echo htmlspecialchars($user["username"]); ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo htmlspecialchars($user["email"]); ?></td>
            </tr>
            <tr>
                <th>Ημερομηνία Εγγραφής:</th>
                <td><?php echo $user["created_at"]; ?></td>
            </tr>
        </table>
        <a href="index.php" class="btn btn-primary">Επιστροφή</a>
        <a href="profile_edit.php" class="btn btn-warning">Επεξεργασία Προφίλ</a>
    </div>
</body>
</html>
