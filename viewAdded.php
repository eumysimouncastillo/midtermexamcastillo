<?php
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
    exit();
} 

require_once 'core/dbConfig.php';
require_once 'core/models.php';
$username = $_SESSION['username'];
$admin_id = $_GET['admin_id'];
$employees = getAllAdded($pdo, $admin_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Sales</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Created by admin <?php echo $username ?></h1>
    <table border="1">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Created By</th>
                <th>Last Updated By</th>
                <th>Last Updated</th>
            </tr>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= $employee['employee_id'] ?></td>
                    <td><?= $employee['username'] ?></td>
                    <td><?= $employee['first_name'] ?></td>
                    <td><?= $employee['last_name'] ?></td>
                    <td><?= $employee['email'] ?></td>
                    <td><?= $employee['added_by'] ?></td>
                    <td><?= $employee['last_updated_by'] ?></td>
                    <td><?= $employee['last_updated'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    

    <br>
    <a href="index.php">Return to admin Dashboard</a>
</body>
</html>
