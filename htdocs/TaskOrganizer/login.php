<?php
	session_start();
	if(isset($_SESSION['name'])){
		header("Location:list.php");
		//$redirect = "onload=\"window.location.assign('list.php');\"";
	}
	$dbLink = mysqli_connect("localhost","root","","pml");
	if(isset($_REQUEST['ref'])){
		if($_REQUEST['ref']=='reg_1'){
			$notif = "<h2>Successfuly signed up, please login.</h2>";
		}
	} else {
		if(isset($_REQUEST['signin'])){
			$email = $_REQUEST['email'];
			$password = $_REQUEST['password'];
			$sql = "select * from user where email = \"$email\" and password = \"".md5($password)."\";";
			$sql = mysqli_query($dbLink,$sql);
			if($sql){
				$numRows = mysqli_num_rows($sql);
				if($numRows==1){
					$sql = mysqli_fetch_array($sql);
					$_SESSION['uid'] = $sql['id'];
					$_SESSION['name'] = $sql['name'];
					header("Location:list.php");
					//$redirect = "onload=\"window.location.assign('list.php');\"";
				} else {
					$notif = "<h2>Login Failed, Wrong Email / Password.</h2>";
				}
			} else {
				$notif = "<h2>Connection Error</h2>";
			}
		} else {
			$notif = "<h2>Sign In</h2>";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/jquery.js"></script>
		<script src="js/jquery.mobile-1.4.5.min.js"></script>
	</head>
	<body<?php if(isset($redirect)){echo " ".$redirect;}?>>
		<div id="form-container">
			<?php if(isset($notif)){echo $notif;}?>
			<form method="post" data-ajax="false" action="login.php">
				<label for="email-2">Email</label>
				<input data-clear-btn="true" name="email" id="email-2" value="" type="email">
				<label for="password-2">Password</label>
				<input data-clear-btn="true" name="password" id="password-2" value="" autocomplete="off" type="password">
				<input data-theme="b" name="signin" value="Sign In" type="submit">
			</form>
			<a data-theme="a" data-role="button" href="register.php" rel="external">Sign Up</a>
		</div>
	</body>
</html>
