<?php
session_start();
require_once 'dbConfig.php';
require_once 'models.php';
require_once 'validate.php';

if (isset($_POST['insertEmployeeBtn'])) {
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $added_by = $_SESSION['username'];
    $last_updated_by = $_SESSION['username'];

    insertEmployee($pdo, $username, $firstName, $lastName, $email, $added_by, $last_updated_by);
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['insertSaleBtn'])) {
    $product = $_POST['product'];
    $amount = $_POST['amount'];
    $employee_id = $_GET['employee_id'];

    insertSale($pdo, $product, $amount, $employee_id);
    header("Location: ../viewSales.php?employee_id=$employee_id");
    exit;
}

if (isset($_POST['editEmployeeBtn'])) {
    $employee_id = $_GET['employee_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $last_updated_by = $_SESSION['username'];

    editEmployee($pdo, $employee_id, $firstName, $lastName, $email, $last_updated_by);
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['editSaleBtn'])) {
    $sale_id = $_GET['sale_id'];
    $product = $_POST['product'];
    $amount = $_POST['amount'];
    $employee_id = $_GET['employee_id'];

    editSale($pdo, $sale_id, $product, $amount);
    header("Location: ../viewSales.php?employee_id=$employee_id");
    exit;
}

if (isset($_POST['deleteEmployeeBtn'])) {
    $employee_id = $_GET['employee_id'];

    deleteEmployee($pdo, $employee_id);
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['deleteSaleBtn'])) {
    $sale_id = $_GET['sale_id'];
    $employee_id = $_GET['employee_id'];

    deleteSale($pdo, $sale_id);
    header("Location: ../viewSales.php?employee_id=$employee_id");
    exit;
}

//for log in and register

if (isset($_POST['loginBtn'])) {
	$username = sanitizeInput($_POST['username']);
	$password = sanitizeInput($_POST['password']);

	if(empty($username) && empty($password)) {
		echo "<script>
		alert('Input fields are empty!');
		window.location.href='../index.php'
		</script>";
	} 
	else {

		if(login($pdo, $username, $password)) {
			header('Location: ../index.php');
		}

		else {
			echo "<script>
			alert('Incorrect username or password!');
			window.location.href='../index.php'
			</script>";
		}
	}
	
}


if (isset($_POST['regBtn'])) {
	$username = sanitizeInput($_POST['username']);
    $first_name = sanitizeInput($_POST['first_name']);
    $last_name = sanitizeInput($_POST['last_name']);
	$passwordInput = $_POST['password'];

	if(empty($username) || empty($passwordInput)) {
		echo '<script> 
		alert("The input field is empty!");
		window.location.href = "register.php";
		</script>';
	}
	
	else {

        if(validatePassword($passwordInput)) {

            $password = password_hash($passwordInput, PASSWORD_DEFAULT);

            if(addUser($pdo, $username, $first_name, $last_name, $password)) {
                header('Location: ../index.php');
            }

            else {
                header('Location: ../register.php');
            }
        }
        else{
            echo '<script> 
            alert("The password should be more than 8 characters and should contain both uppercase, lowercase, and numbers");
            window.location.href = "../register.php";
            </script>';
        }



	}
}


?>
