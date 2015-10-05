<?php
	include 'dbconnect.php';
	$card_id = $_GET['card_id'];
	$name = $_POST['name'];
	$image = $_POST['image'];

	$sql = "update tblcard set name='$name',image='$image' where card_id='$card_id'";
	$q = mysql_query($sql) or die(mysql_error());

	header('location: cards_admin.php');
?>