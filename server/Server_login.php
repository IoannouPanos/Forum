<?php 
session_start();
require "db.php"; 

// Function για τη διαχείριση της σύνδεσης
function handleLogin($email, $password, $conn) {
    $stmt = $conn->prepare("SELECT id, username, role, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Plain-text σύγκριση (όπως ζητήθηκε)
        if ($password === $user["password"]) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            header("Location: index.php");
            exit;
        } else {
            return "Λάθος στοιχεία σύνδεσης";
        }
    } else {
        return "Λάθος στοιχεία σύνδεσης";
    }

    $stmt->close();
}

// Έλεγχος αν υποβλήθηκε η φόρμα
if (isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $error = handleLogin($email, $password, $conn);
    if ($error) {
        echo "<script>alert('$error');</script>";
    }
}

$conn->close();
?>