<?php
require_once 'db.php';

function get_threads() {
    global $conn;
    $threads = [];
    $result = $conn->query("SELECT threads.*, users.username FROM threads JOIN users ON threads.user_id = users.id ORDER BY created_at DESC");
    while ($row = $result->fetch_assoc()) {
        $threads[] = $row;
    }
    return $threads;
}

function create_thread($user_id, $title, $content) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);
    $stmt->execute();
    $stmt->close();
}

function delete_thread($thread_id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM threads WHERE id = ?");
    $stmt->bind_param("i", $thread_id);
    $stmt->execute();
    $stmt->close();
}
?>