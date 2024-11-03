<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log In</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
	<h1>Login here</h1>
	<form action="core/handleForms.php" method="post">
        <label>Username</label> <br>
        <input type="text" name="username"> <br> <br>
        <label>Password</label> <br>
        <input type="password" name="password"> <br> <br>
        <button type="submit" value="Log in" id="loginBtn" name="loginBtn">Log in</button>
	</form>

    <form action="register.php">    
        <button type="submit">Register</button>
    </form>



</body>
</html>