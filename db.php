<?php
$host = "localhost";
$dbname = "forum_db";
$username = "root";
$password = ""; // Αν χρησιμοποιείς XAMPP, αφήνεις κενό

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Σφάλμα σύνδεσης: " . $e->getMessage());
}
?>
