<script src="js/angular.js"></script>

<?php
include 'dbconnect.php';
include 'check_login.php';
$_SESSION['room_id'] = $_GET['room_id'];
if(isset($_GET['msg']))
	{
		echo "<script type=text/javascript>"."alert('".$_GET['msg']."')</script>";
	}

$sql = "select * from tblroom where room_id = ".$_SESSION['room_id'];
$q = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_assoc($q);
	$pl1 = $r['player_1'];
	$pl2 = $r['player_2'];
	$room_name = $r['room_name'];
$sql = "select * from tblplayer where player_id=$pl1";
$q = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_assoc($q);
	$name1 = $r['username'];
$sql = "select * from tblplayer where player_id=$pl2";
$q = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_assoc($q);
	$name2 = $r['username'];
echo "<div ng-app=\"\" ng-init=\"player={player2:"."'".$name2."',player1:"."'".$name1."'"."}\">";
?>
<table border = "1">
<tr>
	<td>Room Name</td>
	<td>Player 1</td>
	<td>Player 2</td>
</tr>
<tr>
	<td><?php echo $room_name?></td>
	<td>{{player.player1}}</td>
	<td>{{player.player2}}</td>
</tr>
</table>
</div>
<form method="post" action="game_board.php">
	<input type="submit" value="Start">
</form>