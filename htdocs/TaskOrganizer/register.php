<?php
	session_start();
	if(isset($_SESSION['name'])){
		header("Location:list.php");
		//$redirect = "onload=\"window.location.assign('list.php');\"";
	}
	$dbLink = mysqli_connect("localhost","root","","pml");
	if(isset($_REQUEST['signup'])){
		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$rpassword = $_REQUEST['rpassword'];
		if($password!=$rpassword){
			//cek konfirmasi password
			$notif = "<h2>Confirmed password doesn't match.</h2>";
			if(isset($_REQUEST['ajax'])){echo "{\"regstate\":\"0\",\"error\":\"".$notif."\"}";}
		} else {
			//cek apakah email sudah terdaftar
			$sql = "select email from user where email = \"$email\";";
			$sql = mysqli_query($dbLink,$sql);
			if($sql){
				$sql = mysqli_num_rows($sql);
				if($sql>0){
					$notif = "<h2>Email already used.</h2>";
				} else {
					$sql = "insert into user (name,email,password) values (\"$name\",\"$email\",\"".md5($password)."\");";
					$sql = mysqli_query($dbLink,$sql);
					if($sql){
						//jika sukses registrasi user redirect ke login.php
						if(isset($_REQUEST['ajax'])){echo "{\"regstate\":\"1\",\"error\":\"\"}";}
						header("Location:login.php?ref=reg_1");
						//$redirect = "onload=\"window.location.assign('login.php?ref=reg_1');\"";
					}
				}
			}
		}
	} else {
		$notif = "<h2>Sign Up</h2>";
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
			<form method="post" data-ajax="false" action="register.php">
				<label for="text-3">Name</label>
				<input data-clear-btn="true" name="name" id="text-3" value="<?php if(isset($_REQUEST['signup'])){echo $name;}?>" type="text">
				<label for="email-2">Email</label>
				<input data-clear-btn="true" name="email" id="email-2" value="<?php if(isset($_REQUEST['signup'])){echo $email;}?>" type="email">
				<label for="password-1">Password</label>
				<input data-clear-btn="true" name="password" id="password-1" value="" autocomplete="off" type="password">
				<label for="password-2">Retype Password</label>
				<input data-clear-btn="true" name="rpassword" id="password-2" value="" autocomplete="off" type="password">
				<input data-theme="b" name="signup" value="Sign Up" type="submit">
			</form>
			<a data-theme="a" data-role="button" href="login.php" rel="external">Sign In</a>
		</div>
	</body>
</html>
