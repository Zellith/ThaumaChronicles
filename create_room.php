<head>
	<title>ThaumaChronicles|Create Room</title>
	<link rel="stylesheet" type="text/css" href="css/create_room.css">
</head>
<?php
	if(isset($_GET['msg']))
	{
		echo "<script type=text/javascript>"."alert('".$_GET['msg']."')</script>";
	}
	include 'check_login.php';
	include 'dbconnect.php';
	$sql = "select * from tblplayer where player_id='".$_SESSION['p_id']."'";
	$q = mysql_query($sql) or die(mysql_error());
	while($r=mysql_fetch_assoc($q))
	{
		echo $r['name']."</br>";
		echo $r['username']."</br>";
	}
?>
<body id="background">
	<section id="wrap">
		<form method="post" action="create_room_confirm.php">
			Room Name: <input type="text" name="rn">
			<input type="submit" name="submit" value="Create">
		</form>
	</section>
</body>