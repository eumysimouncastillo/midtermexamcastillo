<?php
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
    exit();
} 

require_once 'core/dbConfig.php';
require_once 'core/models.php';
$admins = getAllAdmins($pdo);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Info</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admins Table</h1>
    
    <table border="1">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?= $admin['admin_id'] ?></td>
                    <td><?= $admin['username'] ?></td>
                    <td><?= $admin['first_name'] ?></td>
                    <td><?= $admin['last_name'] ?></td>
                    <td><?= $admin['created_at'] ?></td>
                    <td>
                        <a href="viewAdded.php?admin_id=<?= $admin['admin_id'] ?>">View Added Employees</a>
                    </td>
                </tr>
                
            <?php endforeach; ?>
        </table>
    
    <form action="index.php" method="POST">
        <button type="submit">Home</button>
    </form>
</body>
</html>



