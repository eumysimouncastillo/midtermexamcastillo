<?php

function getAllEmployees($pdo) {
    $stmt = $pdo->query('SELECT * FROM employees');
    return $stmt->fetchAll();
}

function getAllSales($pdo) {
    $stmt = $pdo->query('SELECT * FROM sales');
    return $stmt->fetchAll();
}

function getEmployeeByID($pdo, $employee_id) {
    $stmt = $pdo->prepare('SELECT * FROM employees WHERE employee_id = ?');
    $stmt->execute([$employee_id]);
    return $stmt->fetch();
}

function getSaleByID($pdo, $sale_id) {
    $stmt = $pdo->prepare('SELECT * FROM sales WHERE sale_id = ?');
    $stmt->execute([$sale_id]);
    return $stmt->fetch();
}

function insertEmployee($pdo, $username, $firstName, $lastName, $email, $added_by, $last_updated_by) {
    $stmt = $pdo->prepare('INSERT INTO employees (username, first_name, last_name, email, added_by, last_updated_by) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$username, $firstName, $lastName, $email, $added_by, $last_updated_by]);
}

function insertSale($pdo, $product, $amount, $employee_id) {
    $stmt = $pdo->prepare('INSERT INTO sales (product, amount, employee_id) VALUES (?, ?, ?)');
    $stmt->execute([$product, $amount, $employee_id]);
}

function editEmployee($pdo, $employee_id, $firstName, $lastName, $email, $last_updated_by) {
    $stmt = $pdo->prepare('UPDATE employees SET first_name = ?, last_name = ?, email = ?, last_updated_by = ? WHERE employee_id = ?');
    $stmt->execute([$firstName, $lastName, $email, $last_updated_by, $employee_id]);
}

function editSale($pdo, $sale_id, $product, $amount) {
    $stmt = $pdo->prepare('UPDATE sales SET product = ?, amount = ? WHERE sale_id = ?');
    $stmt->execute([$product, $amount, $sale_id]);
}

function deleteEmployee($pdo, $employee_id) {
    $stmt = $pdo->prepare('DELETE FROM employees WHERE employee_id = ?');
    $stmt->execute([$employee_id]);
}

function deleteSale($pdo, $sale_id) {
    $stmt = $pdo->prepare('DELETE FROM sales WHERE sale_id = ?');
    $stmt->execute([$sale_id]);
}

// for log in and register
 
function login($pdo, $username, $password) {
	$query = "SELECT * FROM admins WHERE username=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$username]);

	if($stmt->rowCount() == 1) {
		// returns associative array
		$row = $stmt->fetch();

		// store user info as a session variable
		$_SESSION['userInfo'] = $row;

		// get values from the session variable
		$uid = $row['user_id'];
		$uname = $row['username'];
		$passHash = $row['password'];

		// validate password 
		if(password_verify($password, $passHash)) {
			$_SESSION['user_id'] = $uid;
			$_SESSION['username'] = $uname;
			$_SESSION['userLoginStatus'] = 1;
			return true;
		}
		else {
			return false;
		}
	}
}


function addUser($pdo, $username, $first_name, $last_name, $password) {
	$sql = "SELECT * FROM admins WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]);

	if($stmt->rowCount()==0) {
		$sql = "INSERT INTO admins (username, first_name, last_name, password) VALUES (?,?,?,?)";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute([$username, $first_name, $last_name, $password]);
	}

}

// for admins
function getAllAdmins($pdo) {
    $stmt = $pdo->query('SELECT * FROM admins');
    return $stmt->fetchAll();
}

/*
function getAllAdded($pdo, $added_by) {
    $query = "SELECT * FROM employees WHERE added_by = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$added_by]);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['userInfo'] = $rows;

    return $rows;
}
*/
function getAllAdded($pdo, $admin_id) {
    $query = "SELECT * FROM employees WHERE added_by = (SELECT username FROM admins WHERE admin_id = ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$admin_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}







?>

