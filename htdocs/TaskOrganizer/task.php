<?php
	session_start();
	if(!isset($_SESSION['name'])){
		header("Location:login.php");
		//$redirect = "onload=\"window.location.assign('login.php');\"";
	}
	$dbLink = mysqli_connect("localhost","root","","pml");
	if(isset($_REQUEST['markdone'])){
		$id = $_REQUEST['task_id'];
		$sql = "update task set marked_done = 'true' where id = '$id';";
		$sql = mysqli_query($dbLink,$sql);
		if($sql){
			header("Location:list.php?ref=task_1");
			//$redirect = "onload=\"window.location.assign('list.php?ref=task_1');\"";
		} else {
			$notif = "<h2>Connection Error.</h2>";
		}
	}
	if(isset($_REQUEST['id'])){
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
			<?php if(isset($notif)){echo $notif;} ?>
<?php
		$id = $_REQUEST['id'];
		$sql = "select * from task where id = '$id';";
		$sql = mysqli_query($dbLink,$sql);
		if(!$sql){
			$notif = "<h2>Connection Error.</h2>";
		} else {
			if(mysqli_num_rows($sql)<1){
				$notif = "<h2>Invalid Task Id</h2>";
			} else {
				$sql = mysqli_fetch_array($sql);
?>
			<div class="ui-corner-all custom-corners">
				<div class="ui-bar ui-bar-a">
					<h3><?php echo $sql['name'];?></h3>
				</div>
				<div class="ui-body ui-body-a">
					<p><?php echo $sql['body'];?></p>
				</div>
			</div>
			<form method="post" data-ajax="false" action="task.php">
				<input type="hidden" name="task_id" value="<?php echo $sql['id']; ?>">
				<input data-theme="b" name="markdone" value="Mark As Done" type="submit">
			</form>
<?php
			}
		}
	}
?>
			<a data-theme="a" data-role="button" href="list.php" rel="external">Task List</a>
		</div>
	</body>
</html>