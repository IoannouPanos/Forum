<?php
require "db.php";

if (isset($_POST["register"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Ασφαλής κωδικοποίηση

    // Έλεγχος αν το email ή το username υπάρχει ήδη
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result(); // Χρειαζόμαστε αυτό για να χρησιμοποιήσουμε num_rows

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Το username ή το email χρησιμοποιείται ήδη.');</script>";
    } else {
        // Εισαγωγή στη βάση
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Η εγγραφή ολοκληρώθηκε!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Σφάλμα εγγραφής.');</script>";
        }
    }

    $stmt->close(); // Κλείσιμο του statement
}

$conn->close(); // Κλείσιμο της σύνδεσης
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εγγραφή</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Εγγραφή</h2>
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Όνομα Χρήστη</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Κωδικός</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary">Εγγραφή</button>
        </form>
    </div>
</body>
</html>
