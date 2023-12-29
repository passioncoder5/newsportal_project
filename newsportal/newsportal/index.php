<!-- login.php -->

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php
        include('header.php');
       if(isset($_SESSION['email']) && isset($_SESSION['userid']))
        {header("location:userhome.php");}
        
    ?>
</head>
<body bgcolor="#ADD8E6">
    <div class="main">
        <form action="index.php" method='POST'>
            <label class="side">Email:</label>&emsp;&emsp;&emsp;
            <input type="email" name="loginemail" class="input" size="70" required><br>
            <br>
            <label class="side">Password:</label>
            <input type="password" name="loginpassword" class="input" size="70" required><br>
            <br>
            <input type="submit" name="Submit" id="submit" value="Login" class="button"/>
            <h3 style="color:blue;">Not a user?<a href="register.php" style="color:blue"> Register</a></h3><br/>
        </form>
    </div>

    <?php
        session_start();
        require_once "database.php";

        if(isset($_POST["Submit"])){
            $conn = mysqli_connect($servername, $username, $password, $database);

            if(!$conn){
                die("Couldn't connect to MySQL");
            }

            $loginemail = $_POST['loginemail'];
            $loginpassword = $_POST['loginpassword'];

            // Use prepared statement to prevent SQL injection
            $query = "SELECT userid, email, password FROM user WHERE email=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $loginemail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) > 0){
                // Fetch the results
                mysqli_stmt_bind_result($stmt, $userid, $email, $hashed_password);
                mysqli_stmt_fetch($stmt);

                // Verify hashed password
                if(password_verify($loginpassword, $hashed_password)){
                    $_SESSION['userid'] = $userid;
                    $_SESSION['email'] = $email;

                    echo '<script>alert("Successfully login")</script>';
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("location: userhome.php");
                    exit(); // Make sure to exit after header to prevent further execution
                } else {
                    echo "<h2 class='danger'>Invalid email or password</h2>";
                }
            } else {
                echo "<h2 class='danger'>Invalid email or password</h2>";
            }

            // Close the prepared statement and the connection
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    ?>
</body>
</html>
<?php
    include('footer.php');
?>
