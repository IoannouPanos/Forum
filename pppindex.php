<?php 
include "db.php";
session_start();

if (isset($_SESSION["user_id"])): ?>
    <a href="profile.php" class="btn btn-secondary">Προφίλ</a>
<?php endif; ?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Forum Συζητήσεων</h2>

        <?php if (isset($_SESSION["user_id"])): ?>
            <a href="create_thread.php" class="btn btn-primary mb-3">+ Νέα Συζήτηση</a>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Τίτλος</th>
                    <th>Δημιουργήθηκε από</th>
                    <th>Ημερομηνία</th>
                    <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1): ?>
                        <th>Ενέργειες</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT threads.id, threads.title, threads.created_at, users.username 
                          FROM threads 
                          JOIN users ON threads.user_id = users.id 
                          ORDER BY threads.created_at DESC";
                $result = mysqli_query($conn, $query);

                while ($thread = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><a href="thread.php?id=<?php echo $thread['id']; ?>"><?php echo htmlspecialchars($thread['title']); ?></a></td>
                        <td><?php echo htmlspecialchars($thread['username']); ?></td>
                        <td><?php echo $thread['created_at']; ?></td>
                        <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1): ?>
                            <td>
                                <a href="delete_thread.php?id=<?php echo $thread['id']; ?>" class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Είσαι σίγουρος ότι θέλεις να διαγράψεις αυτή τη συζήτηση;');">
                                    Διαγραφή
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
