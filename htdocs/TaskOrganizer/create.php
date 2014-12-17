<?php
	session_start();
	if(!isset($_SESSION['name'])){
		header("Location:login.php");
		//$redirect = "onload=\"window.location.assign('login.php');\"";
	}
	if(isset($_REQUEST['create'])){
		$dbLink = mysqli_connect("localhost","root","","pml");
		$user = $_SESSION['uid'];
		$name = $_REQUEST['name'];
		$body = $_REQUEST['body'];
		$time_created = date("Y-m-d H:i:s");
		$sql = "insert into task (user,name,body,time_created) values ('$user',\"$name\",\"$body\",\"$time_created\");";
		$sql = mysqli_query($dbLink,$sql);
		if($sql){
			header("Location:list.php?ref=create_1");
			//$redirect = "onload=\"window.location.assign('list.php?ref=create_1');\"";
		} else {
			$notif = "<h2>Connection Error.</h2>";
		}
	} else {
		$notif = "<h2>Create New Task</h2>";
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
			<form method="post" data-ajax="false" action="create.php">
				<label for="name">Task Name</label>
				<input data-clear-btn="true" name="name" id="text-3" value="" type="text">
				<label for="body">Task Detail:</label>
				<textarea name="body" id="textarea-1"></textarea>
				<input data-theme="b" name="create" value="Create" type="submit">
			</form>
		</div>
	</body>
</html>