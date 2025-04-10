<?php
function connectToDatabase(){
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database_name = 'forum_db';

    $conn = new mysqli($servername, $username, $password, $database_name);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function executeSqlQuery($sql) {
    $conn = connectToDatabase();
    $result = $conn->query($sql);
    if (!$result) {
        die("SQL Error: " . $conn->error);
    }
    $lastId = mysqli_insert_id($conn);

    $conn->close();
    
    return $lastId ? $lastId : $result;
    
}
function selectFromDb($sql){
    $conn = connectToDatabase();
    $result = $conn->query($sql);
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    $conn->close();
    return $data;
}
// function displayReplies($parent_post_id = NULL, $depth = 0) {
//     $sql = "SELECT users.user_name,posts.post_title,posts.created_at,posts.post_id
// FROM posts INNER JOIN users
// ON posts.user_id=users.user_id WHERE parent_post_id " . 
//            (is_null($parent_post_id) ? "IS NULL" : "= '{$parent_post_id}'") . " ORDER BY created_at ASC";
//     $posts = selectFromDb($sql);
//     // if(empty($posts)){
//     //     exit('There is no post created yet!');
//     // }
//     foreach ($posts as $post) {
//         // Λήψη πληροφοριών χρήστη
//         $user_sql = "SELECT user_name FROM users WHERE user_id = " . "'{$post['post_id']}'";
//         $user_data = selectFromDb($user_sql);
//         $username = $user_data[0]['user_name'] ?? 'Unknown';

//         // Εσοχή απαντήσεων
//         echo str_repeat("&nbsp;&nbsp;&nbsp;", $depth) . "<strong>{$post['post_title']}</strong> by $username <br>";

//         // Κουμπί απάντησης
//         echo str_repeat("&nbsp;&nbsp;&nbsp;", $depth) . 
//              "<button id='button-{$post['post_id']}' class='btn btn-primary' onclick='takeValues(this)' data-bs-toggle='modal' data-bs-target='#replyModal'>Reply</button><br>";

//         // Αναδρομική κλήση για υπο-απαντήσεις
//         displayReplies($post['post_id'], $depth + 1);
//     }
// }

?>