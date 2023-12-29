<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
	<?php
		include('header.php');
		include('admin_check.php');
	?>
	<div style="color:darkblue;margin:200px 200px 400px 400px;">
		<p><h1>If you have any queries ,contact me @...</h1></p>
		<p><h2>Email : aru510704@gmail.com</h2></p>
	</div>
</body>
</html>
