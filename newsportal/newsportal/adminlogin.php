<!-- adminlogin.php -->

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php
        include('header.php');
    ?>
</head>
<body bgcolor="#ADD8E6">
    <div class="main">
        <form action="adminlogin.php" method='POST'>
            <label class="side">Admin Email:</label>&emsp;&emsp;&emsp;
            <input type="email" name="loginemail" class="input" size="70" required><br>
            <br>
            <label class="side">Admin Password:</label>
            <input type="password" name="loginpassword" class="input" size="70" required><br>
            <br>
            <input type="submit" name="Submit" id="submit" value="login" class="button"/>
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
            $loginpassword = sha1($_POST['loginpassword']); // Convert entered password to SHA-1

            // Use prepared statement to prevent SQL injection
            $query = "SELECT aemail, apassword FROM admin WHERE aemail=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $loginemail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) > 0){
                // Fetch the results
                mysqli_stmt_bind_result($stmt, $email, $hashed_password);
                mysqli_stmt_fetch($stmt);

                // Verify hashed password
                if($loginpassword == $hashed_password){
                    $_SESSION['aemail'] = $email;

                    echo '<script>alert("Successfully login")</script>';
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("location: adminhome.php");
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
