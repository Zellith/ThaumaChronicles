<link rel="stylesheet" type="text/css" href="css/join_room.css">
<script type="text/javascript "src="js/angular.js"></script>
<?php
	include 'check_login.php';
	include 'dbconnect.php';
	
	if(isset($_GET['msg']))
	{
		echo "<script type=text/javascript>"."alert('".$_GET['msg']."')</script>";
	}

	$p_id = $_SESSION['p_id'];
	$sql = "select * from tblroom where player_2 = $p_id";
	$q = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($q)==0)
	{
		$sql = "select * from tblroom where player_2 = 0";
		$q = mysql_query($sql) or die(mysql_error());
		while($r=mysql_fetch_assoc($q))
		{
			?>
			<a href="join_room_confirm.php?room_id=<?php echo $r['room_id'];?>"><div id="room">
				<section class="name"><?php echo $r['room_name']."</br>"?></section>
			</div></a>			
			<?php
		}
	}
?>
<button>Refresh</button><br/><br/>