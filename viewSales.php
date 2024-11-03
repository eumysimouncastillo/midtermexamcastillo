<?php
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
    exit();
} 

require_once 'core/dbConfig.php';
require_once 'core/models.php';
$sales = getAllSales($pdo);
$employee_id = $_GET['employee_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Sales</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Add New Sale</h2>
    <form action="core/handleForms.php?employee_id=<?= $employee_id ?>" method="post">
        <label>Product:</label>
        <input type="text" name="product" required><br>
        <label>Amount:</label>
        <input type="number" step="0.01" name="amount" required><br>
        <button type="submit" name="insertSaleBtn">Add Sale</button>
    </form>
    <h1>Sales by Employee ID: <?= $employee_id ?></h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($sales as $sale): ?>
            <?php if ($sale['employee_id'] == $employee_id): ?>
                <tr>
                    <td><?= $sale['sale_id'] ?></td>
                    <td><?= $sale['product'] ?></td>
                    <td><?= $sale['amount'] ?></td>
                    <td>
                        <a href="editSale.php?sale_id=<?= $sale['sale_id'] ?>&employee_id=<?= $employee_id ?>">Edit</a> |
                        <a href="deleteSale.php?sale_id=<?= $sale['sale_id'] ?>&employee_id=<?= $employee_id ?>">Delete</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>

    

    <br>
    <a href="index.php">Return to Employee Dashboard</a>
</body>
</html>
