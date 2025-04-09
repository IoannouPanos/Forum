<?php
session_start();
include "db.php";

// Έλεγχος αν ο χρήστης είναι συνδεδεμένος
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Φόρτωση των στοιχείων του χρήστη από τη βάση
$query = "SELECT username, email FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Αν πατήθηκε το κουμπί ενημέρωσης
if (isset($_POST["update"])) {
    $new_username = trim($_POST["username"]);
    $new_email = trim($_POST["email"]);
    $new_password = $_POST["password"] ? password_hash($_POST["password"], PASSWORD_DEFAULT) : null;

    // Έλεγχος αν το username ή το email υπάρχει ήδη σε άλλον χρήστη
    $check_query = "SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, "ssi", $new_username, $new_email, $user_id);
    mysqli_stmt_execute($stmt);
    $check_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Το username ή το email χρησιμοποιείται ήδη από άλλον χρήστη.');</script>";
    } else {
        // Ενημέρωση στη βάση δεδομένων
        if ($new_password) {
            $update_query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($stmt, "sssi", $new_username, $new_email, $new_password, $user_id);
        } else {
            $update_query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($stmt, "ssi", $new_username, $new_email, $user_id);
        }

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION["username"] = $new_username; // Ενημέρωση session
            echo "<script>alert('Τα στοιχεία ενημερώθηκαν επιτυχώς!'); window.location='profile.php';</script>";
        } else {
            echo "<script>alert('Σφάλμα κατά την ενημέρωση.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επεξεργασία Προφίλ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Επεξεργασία Προφίλ</h2>
        <form action="edit_profile.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Όνομα Χρήστη</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Νέος Κωδικός (προαιρετικά)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" name="update" class="btn btn-success">Αποθήκευση</button>
            <a href="profile.php" class="btn btn-secondary">Ακύρωση</a>
        </form>
    </div>
</body>
</html>
