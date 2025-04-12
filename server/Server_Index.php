<?php
session_start();
require_once 'functions/functions_index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($content)) {
        create_thread($user_id, $title, $content);
    }
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_thread_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $delete_thread_id = intval($_POST['delete_thread_id']);
    delete_thread($delete_thread_id);
    header("Location: index.php");
    exit();
}

$threads = get_threads();
?>