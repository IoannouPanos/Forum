<?php
session_start(); // 1. Έναρξη session
require_once 'functions/functions_index.php'; // 2. Συμπερίληψη του αρχείου functions_index.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) { // 3. Έλεγχος αν η μέθοδος είναι POST και αν ο χρήστης είναι συνδεδεμένος
    $title = trim($_POST['title']); // 4. Ανάκτηση και καθαρισμός του τίτλου
    $content = trim($_POST['content']); // 5. Ανάκτηση και καθαρισμός του περιεχομένου
    $user_id = $_SESSION['user_id']; // 6. Ανάκτηση του user_id από το session

    if (!empty($title) && !empty($content)) { // 7. Έλεγχος αν τα πεδία δεν είναι άδεια
        create_thread($user_id, $title, $content); // 8. Κλήση της συνάρτησης create_thread()
    }
    header("Location: index.php"); // 9. Ανακατεύθυνση στην index.php
    exit(); // 10. Τερματισμός εκτέλεσης του script
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_thread_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { // 11. Έλεγχος για διαγραφή thread από admin
    $delete_thread_id = intval($_POST['delete_thread_id']); // 12. Ανάκτηση και μετατροπή του thread_id σε integer
    delete_thread($delete_thread_id); // 13. Κλήση της συνάρτησης delete_thread()
    header("Location: index.php"); // 14. Ανακατεύθυνση στην index.php
    exit(); // 15. Τερματισμός εκτέλεσης του script
}

$threads = get_threads(); // 16. Ανάκτηση των threads από τη βάση δεδομένων
?>