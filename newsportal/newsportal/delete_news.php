<?php 
	require_once "database.php";
	include('admin_check.php');
	session_start();
	$conn = mysqli_connect($servername,$username,$password,$database);
	if(!$conn){
		die("Unable to connect to mysql".mysqli_connect_error());
	}
	$sql = "delete from news where newsid='$_GET[newsid]'";
	$run_sql = mysqli_query($conn,$sql);
	if($run_sql){
		echo "<script> alert('Deleted record successfully') </script>";
		header("Location: view_news.php");
	}
	else{
		echo "<script> alert('failed to delete') </script>"; 
	}
?>
<!-- Add this hidden input field -->
<input type="hidden" id="aemail" value="<?php echo $_SESSION['aemail']; ?>">
<script type="text/javascript" src="admincheck_session.js"></script>

<script type="text/javascript">
		function preventBack(){ window.history.forward();}
		setTimeout("preventBack()",0);
		window.onunload = function () {null};
	</script>