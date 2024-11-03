<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>
    <h1>Register Admin Here</h1>
    <form action="core/handleForms.php" method="POST">
        <label>Username</label> <br>
        <input type="text" name="username" required> <br> <br>

        <label>First Name</label> <br>
        <input type="text" name="first_name" required> <br> <br>

        <label>Last Name</label> <br>
        <input type="text" name="last_name" required> <br> <br>

        <label>Password</label> <br>
        <input type="password" name="password" required> <br> <br>

        <button type="submit" value="Register" id="submitBtn" name="regBtn">Register</button>
    </form>

    <form action="login.php">    
        <button type="submit">Back to Log in page</button>
    </form>

</body>
</html>
