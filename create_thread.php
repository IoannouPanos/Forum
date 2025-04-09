<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $content);
        $stmt->execute();
        $stmt->close();
        header("Location: forum.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Δημιουργία Ανάρτησης</title>
    <link rel="stylesheet" href="css/styleCreate_Thread.css">
</head>

<header>
        <h1>Δημιουργήστε νέα ανάρτηση</h1>
        <nav class="top-nav">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>👋 Καλωσήρθες, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php" class="btn">Αποσύνδεση</a>
            <?php else: ?>
                <a href="login.php" class="btn">Σύνδεση</a>
                <a href="register.php" class="btn">Εγγραφή</a>
            <?php endif; ?>
        </nav>
</header>

<body class="create-thread-page">
    <div class="create-thread-container">
        <h1>📝 Δημιουργία Νέας Ανάρτησης</h1>
        <form method="post">
            <input type="text" name="title" placeholder="Τίτλος" required>
            <textarea id="content" name="content" placeholder="Περιεχόμενο..." required></textarea>
            <button type="submit" onclick="alert('Button clicked!');">Ανάρτηση</button>
            <a href="forum.php" class="btn cancel">⬅ Επιστροφή</a>
        </form>
    </div>

    <script src="https://cdn.tiny.cloud/1/twr5mw7tdxjss1tctchgtrokgizwl0yzopliqdilnsnerke1/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
        console.log('Title:', document.querySelector('input[name="title"]').value);
        console.log('Content (before TinyMCE get):', document.querySelector('#content').value);

        // Προσθέστε αυτή τη γραμμή για να πάρετε το περιεχόμενο από τον TinyMCE
        console.log('Content (after TinyMCE get):', tinymce.get('content').getContent());
    });
        tinymce.init({
            selector: 'textarea',
            // plugins: [
            //     // Core editing features
            //     'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            //     // Your account includes a free trial of TinyMCE premium features
            //     // Try the most popular premium features until Apr 23, 2025:
            //     'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
            // ],
            // toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            // tinycomments_mode: 'embedded',
            // tinycomments_author: 'Author name',
            // mergetags_list: [
            //     { value: 'First.Name', title: 'First Name' },
            //     { value: 'Email', title: 'Email' },
            // ],
            // ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
        // tinymce.init({
        //     selector: '#content', // Επιλέγει το textarea με id="content"
        //     plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        //     toolbar_mode: 'floating',
        // });
    </script>
</body>
</html>
