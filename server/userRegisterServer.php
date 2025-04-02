

<?php
require ('../functions/databaseFunctions.php');
require ('../functions/genericFunctions.php');
require ('../functions/userFunctions.php');

startsession();

if (isset($_POST["register"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Ασφαλής κωδικοποίηση

    // Έλεγχος αν το email ή το username υπάρχει ήδη
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Το username ή το email χρησιμοποιείται ήδη.');</script>";
    } else {
        // Εισαγωγή στη βάση
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $password])) {
            echo "<script>alert('Η εγγραφή ολοκληρώθηκε!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Σφάλμα εγγραφής.');</script>";
        }
    }
}
?>