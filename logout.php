<?php
session_start();
session_unset(); // Καθαρίζει τις μεταβλητές της συνεδρίας
session_destroy(); // Καταστρέφει τη συνεδρία
header("Location: login.php"); // Ανακατεύθυνση στο login
exit;
?>
