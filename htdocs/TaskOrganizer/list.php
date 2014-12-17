<?php
	session_start();
	if(!isset($_SESSION['name'])){
		header("Location:login.php");
		//$redirect = "onload=\"window.location.assign('login.php');\"";
	}
	if(isset($_REQUEST['ref'])&&$_REQUEST['ref']=="create_1"){$notif = "<h2>Task created sucessfuly.</h2>";}
	if(isset($_REQUEST['ref'])&&$_REQUEST['ref']=="task_1"){$notif = "<h2>Task marked done.</h2>";}
	if(!isset($_REQUEST['descOrder'])||$_REQUEST['descOrder']=='true'){$listOrder="DESC";}
	if(isset($_REQUEST['descOrder'])&&$_REQUEST['descOrder']=='false'){$listOrder="ASC";}
	$dbLink = mysqli_connect("localhost","root","","pml");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/jquery.js"></script>
		<script src="js/jquery.mobile-1.4.5.min.js"></script>
		<script src="js/control.js"></script>
	</head>
	<body<?php if(isset($redirect)){echo " ".$redirect;}?>>
		<div id="form-container">
			<?php echo "<h2>Hi ".$_SESSION['name']."</h2>";?>
			<?php if(isset($notif)){echo $notif;}?>
			Order by newest tasks <input data-role="flipswitch" name="flip-checkbox-1" id="flip-checkbox-1" type="checkbox" <?php if($listOrder=="DESC"){echo "checked";}?> onchange="descOrder(isChecked(this));">
<?php
	$sql = "select * from task where user = \"".$_SESSION['uid']."\" AND marked_done = 'false' ORDER BY id $listOrder;";
	$sql = mysqli_query($dbLink,$sql);
	if($sql){
		if(mysqli_num_rows($sql)>0){
			echo "<ol data-role=\"listview\">";
			while($data=mysqli_fetch_array($sql)){
?>
				<li><a name="Lihat detail task" href="task.php?id=<?php echo $data['id'];?>" rel="external"><?php echo $data['name'];?></a></li>
<?php
			}
			echo "</ol>";
		} else {
			echo "<h2>You Don't Have Any Task.</h2>";
		}
	} else {
		echo "<h2>Connection Error</h2>";
	}
?>
			<a data-theme="b" data-role="button" href="create.php" rel="external">Create New Task</a>
			<a data-theme="a" data-role="button" href="logout.php" rel="external">Logout</a>
		</div>
	</body>
</html>