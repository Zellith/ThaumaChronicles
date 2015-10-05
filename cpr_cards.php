<?php
	include 'check_login.php';
	include 'dbconnect.php';

	$card_id=$_GET['card_id'];
	$sql = "select * from tblcard where card_id = $card_id";
	$q = mysql_query($sql);
	$r = mysql_fetch_assoc($q);
	$north = $r['north'];
	$east = $r['east'];
	$west = $r['west'];
	$south = $r['south'];

	if () {
	}
?>