<?php
	include("dbconnect.php");
	
	$sql = "select * from tblcard where card_id=".$_GET['card_id'];
	$q = mysql_query($sql) or die(mysql_error());
	$r = mysql_fetch_assoc($q);
	
	
	//goto location: <src location>	
?>
	<a href="delete_card_confirm.php?card_id=<?php echo $r['card_id']; ?>">Yes</a>
	<a href="cards_admin.php">NO</a>