<?php 

require ('./functions/databaseFunctions.php');
connectToDatabase();
// startsession();




?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εγγραφή</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Εγγραφή</h2>
        <form action="server/userRegisterServer.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Όνομα Χρήστη</label>
                <input type="text" name="username" class="form-control" placeholder="Όνομα Χρήστη" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Passord" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder ="Email" requaired>
            </div>
            <!-- <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="text" name="role" class="form-control" placeholder ="Role">
            </div> -->
            <button type="submit" name="register" class="btn btn-primary">Εγγραφή</button>
        </form>
    </div>
</body>
</html>
