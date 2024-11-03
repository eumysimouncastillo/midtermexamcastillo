<?php
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
    exit();
} 

require_once 'core/dbConfig.php';
require_once 'core/models.php';
$employees = getAllEmployees($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smartphone Shop Employee Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>SMARTPHONE SHOP EMPLOYEE MANAGEMENT SYSTEM</h1>
        <h1>Welcome! Admin <?php echo "{$_SESSION['username']}";?>!</h1>
        
        <div class="form-container">
            <h2>Add New Employee</h2>
            <form action="core/handleForms.php" method="post">
                <label>Username:</label>
                <input type="text" name="username" required><br>
                <label>First Name:</label>
                <input type="text" name="firstName" required><br>
                <label>Last Name:</label>
                <input type="text" name="lastName" required><br>
                <label>Email:</label>
                <input type="email" name="email" required><br>
                <button type="submit" name="insertEmployeeBtn">Add Employee</button>
            </form>
        </div>
    </div>
    <h2>List of Employees</h2>
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
                <th>Actions</th>
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
                    <td>
                        <a href="viewSales.php?employee_id=<?= $employee['employee_id'] ?>">View Sales</a> |
                        <a href="editEmployee.php?employee_id=<?= $employee['employee_id'] ?>">Edit</a> |
                        <a href="deleteEmployee.php?employee_id=<?= $employee['employee_id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <form action="admininfo.php" method="POST">
        <button type="submit">Admins</button>
    </form>

    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
    
</body>
</html>
