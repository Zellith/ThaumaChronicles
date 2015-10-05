<link rel="stylesheet" type="text/css" href="css/gameboard.css">
<?php
	include 'dbconnect.php';
	include 'check_login.php';

	$i = 0;
	$sql = "select * from tblplayer_card where player_id =".$_SESSION['p_id'];
	$q = mysql_query($sql);
	while ($r = mysql_fetch_assoc($q))
	{
		$p_card[$i] = $r['card_id'];
		echo $p_card[$i]."</br>";
		$i++;
	}
	$i = 0;
	$sql = "select * from tblcard";
	$q = mysql_query($sql);
	while ($r = mysql_fetch_assoc($q)) 
	{
		$img_card[$i] = $r['image'];
		$i++;
	}
?>
<div>
	<?php
	$i = 0;
	while (isset($p_card[$i])) {
		$index = $p_card[$i];
		echo "<a href=\"test.php?card=$index\"><img src=\"$img_card[$index]\" class=\"card\"></a>";
		$i++;
	}
	#echo "<img src=\""."../"."$img_card[$p_card[$i]]\";>"
	?>
</div>