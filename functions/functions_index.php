<?php
require_once 'db.php'; // 1. Συμπερίληψη του αρχείου db.php, το οποίο περιέχει τη σύνδεση στη βάση δεδομένων

function get_threads() { // 2. Ορισμός της συνάρτησης get_threads()
    global $conn; // 3. Χρήση της καθολικής μεταβλητής $conn (σύνδεση στη βάση δεδομένων)
    $threads = []; // 4. Δημιουργία ενός άδειου πίνακα $threads
    $result = $conn->query("SELECT threads.*, users.username FROM threads JOIN users ON threads.user_id = users.id ORDER BY created_at DESC"); // 5. Εκτέλεση SQL query για την ανάκτηση threads και username από users
    while ($row = $result->fetch_assoc()) { // 6. Επανάληψη στα αποτελέσματα της query
        $threads[] = $row; // 7. Προσθήκη κάθε γραμμής αποτελέσματος στον πίνακα $threads
    }
    return $threads; // 8. Επιστροφή του πίνακα $threads
}

function create_thread($user_id, $title, $content) { // 9. Ορισμός της συνάρτησης create_thread()
    global $conn; // 10. Χρήση της καθολικής μεταβλητής $conn
    $conn->query("INSERT INTO threads (user_id, title, content) VALUES ('$user_id', '$title', '$content')"); // 11. Εκτέλεση SQL query για την εισαγωγή νέου thread
}

function delete_thread($thread_id) { // 12. Ορισμός της συνάρτησης delete_thread()
    global $conn; // 13. Χρήση της καθολικής μεταβλητής $conn
    $conn->query("DELETE FROM threads WHERE id = $thread_id"); // 14. Εκτέλεση SQL query για τη διαγραφή thread
}
?>