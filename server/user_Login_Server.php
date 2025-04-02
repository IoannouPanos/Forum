<?php

require ('../functions/databaseFunctions.php');
require ('../functions/genericFunctions.php');
require ('../functions/userFunctions.php');

startsession();


// if (isset($_POST["login"])) {
//     $email = $_POST["email"];
//     $password = $_POST["password"];

//     $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
//     $stmt->execute([$email]);
//     $user = $stmt->fetch();

//     if ($user && password_verify($password, $user["password"])) {
//         $_SESSION["user_id"] = $user["id"];
//         $_SESSION["username"] = $user["username"];
//         $_SESSION["role"] = $user["role"];
//         header("Location: index.php");
//         exit;
//     } else {
//         echo "<script>alert('Λάθος στοιχεία σύνδεσης');</script>";
//     }
// }
// ?>
