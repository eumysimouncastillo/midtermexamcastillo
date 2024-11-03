<?php
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
    exit();
} 

require_once 'core/dbConfig.php';
require_once 'core/models.php';
$sale_id = $_GET['sale_id'];
$sale = getSaleByID($pdo, $sale_id);
$employee_id = $_GET['employee_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Sale</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Sale</h2>
    <form action="core/handleForms.php?sale_id=<?= $sale_id ?>&employee_id=<?= $employee_id ?>" method="post">
        <label>Product:</label>
        <input type="text" name="product" value="<?= $sale['product'] ?>" required><br>
        <label>Amount:</label>
        <input type="number" step="0.01" name="amount" value="<?= $sale['amount'] ?>" required><br>
        <button type="submit" name="editSaleBtn">Update Sale</button>
    </form>

    <br>
    <a href="viewSales.php?employee_id=<?= $employee_id ?>">Return to Sales</a>
</body>
</html>
