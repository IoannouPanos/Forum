<?php
$host = "localhost";
$dbname = "forum_db";
$username = "root";
$password = ""; // Αν χρησιμοποιείς XAMPP, αφήνεις κενό

// Δημιουργία σύνδεσης με MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

// Ορισμός character set σε utf8 για σωστή υποστήριξη ελληνικών χαρακτήρων
$conn->set_charset("utf8");

?>
