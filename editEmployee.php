<?php
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
    exit();
} 

require_once 'core/dbConfig.php';
require_once 'core/models.php';
$employee_id = $_GET['employee_id'];
$employee = getEmployeeByID($pdo, $employee_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Employee</h2>
    <form action="core/handleForms.php?employee_id=<?= $employee_id ?>" method="post">
        <label>First Name:</label>
        <input type="text" name="firstName" value="<?= $employee['first_name'] ?>" required><br>
        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?= $employee['last_name'] ?>" required><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?= $employee['email'] ?>" required><br>
        <button type="submit" name="editEmployeeBtn">Update Employee</button>
    </form>

    <br>
    <a href="index.php">Return to Employee Dashboard</a>
</body>
</html>
