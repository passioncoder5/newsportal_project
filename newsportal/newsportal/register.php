<!-- register.php -->

<html>
<head>
	<title>Register page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#ADD8E6">
	<?php
		include('header.php');
	?>
	<div class="main">
		<form action="" method='POST'>
			<!-- Remove User Id field -->
			<label class="side">Firstname:</label>
			<input type="text" name="firstname" class="input" size="70" required><br>
			<br>
			<label class="side">Lastname:</label>
			<input type="text" name="lastname" class="input" size="70" required><br>
			<br>
			<!-- Change Username label to Email -->
			<label class="side">Email:</label>&emsp;&emsp;&emsp;
			<input type="email" name="email" class="input" size="70" required><br>
			<br>
			<label class="side">Password:</label>
			<input type="password" name="password" class="input" size="70" required><br>
			<br>
			<button type="submit" name="register" id="register" class="button">Register</button>
			<h3 style="color:blue;">Already a user?<a href="index.php" style="color:blue"> Login</a></h3>
		</form>	
	</div>

<?php 
	require_once "database.php";

	if(isset($_POST["register"])){
		$conn = mysqli_connect($servername, $username, $password, $database);
		
		if(!$conn){
			die("Couldn't connect to MySQL: " . mysqli_connect_error());
		}

		$firstname = ucfirst(strtolower(strip_tags($_POST['firstname'])));
		$lastname = ucfirst(strtolower(strip_tags($_POST['lastname'])));
		$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : '';
		$password = $_POST['password'];

		if(empty($email) || empty($password)){
			echo "<p class='danger'>Please provide a valid email and password</p>";
		} else {
			// Use prepared statement to prevent SQL injection
			$query = "SELECT * FROM user WHERE email=?";
			$stmt = mysqli_prepare($conn, $query);
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);

			if(mysqli_stmt_num_rows($stmt) > 0){
				echo "<p class='danger'>Email already exists</p>";
			} else {
				// Use prepared statement to insert data with password hashing
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
				$query = "INSERT INTO user (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
				$stmt = mysqli_prepare($conn, $query);
				mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $hashedPassword);

				if(mysqli_stmt_execute($stmt)){
					echo "<p class='success'>You have registered successfully. You may login now</p>";
				} else {
					echo "<p class='danger'>Insert failed</p>";
				}
			}

			// Close the prepared statement and the connection
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
?>
	
</body>
</html>
