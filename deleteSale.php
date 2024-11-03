<?php
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
    exit();
} 

require_once 'core/dbConfig.php';
require_once 'core/models.php';
$sale_id = $_GET['sale_id'];
$employee_id = $_GET['employee_id'];

deleteSale($pdo, $sale_id);
header("Location: viewSales.php?employee_id=$employee_id");
exit;
?>
