<?php
	include("dbconnect.php");
	
		$card_id=2;
		$sql="select * from tblCard where card_id like $card_id";
		$q=mysql_query($sql) or die(mysql_error());
		$r = mysql_fetch_assoc($q);
		$imageData=$r['image'];
		header("content-type:image/png?card_id");
		echo $imageData;	
	
?>
	
