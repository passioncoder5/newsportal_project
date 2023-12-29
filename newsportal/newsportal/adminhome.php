<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<?php
		session_start();
		include('header.php');
		include('admin_check.php');
	?>
	<script type="text/javascript">
		function preventBack(){ window.history.forward();}
		setTimeout("preventBack()",0);
		window.onunload = function () {null};
	</script>
</head>
<body bgcolor="#ADD8E6">
	<!-- Add this hidden input field -->
<input type="hidden" id="aemail" value="<?php echo $_SESSION['aemail']; ?>">
<script type="text/javascript" src="admincheck_session.js"></script>

	<div class="floatright">
			<h2>Welcome <?php echo $_SESSION['ausername'];?></h2>


		<h2>Welcome to newsportal project</h2>
		<marquee><font color="orange">Special thanks to <b><font size="25px" color="black">Aravinda A Kumar</font></b> for guiding me throughout the journey cause self motivation is the best</font></marquee>
		<p>About Us</p>
		<p>NEWS is most essential these days.<br>Information about the ongoing events in the world is important to all of us.<br>We have developed this project keeping in mind the growing nature of technology</p>
		
	</div>
	<div>
		<?php 
			include('sidebar.php');
		?>
	</div>

</body>

</html>
<?php 
		include('footer.php');
?>