<?php 

include "db.php"; 
session_start(); 

if (isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Προετοιμασία δήλωσης για ασφάλεια
    $stmt = $conn->prepare("SELECT id, username, role, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result(); // Παίρνουμε το αποτέλεσμα

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Φέρνουμε τα δεδομένα του χρήστη
        
        if (password_verify($password, $user["password"])) {
            // Αποθήκευση στοιχείων στη συνεδρία
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];
            
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Λάθος στοιχεία σύνδεσης');</script>";
        }
    } else {
        echo "<script>alert('Λάθος στοιχεία σύνδεσης');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Σύνδεση</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Σύνδεση</h2>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Κωδικός</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Σύνδεση</button>
        </form>
    </div>
</body>
</html>
