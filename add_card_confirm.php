<?php
	//include all values in the dbconnect.php
	include("dbconnect.php");
	$type = $_POST['type'];	
	$name = $_POST['name'];	
	$north = $_POST['north'];	
	$south = $_POST['south'];	
	$east = $_POST['east'];
	$west = $_POST['west'];
	$defence = $_POST['defence'];
	$rarity = $_POST['rarity'];
	$image = $_POST['image'];
	$sql = "insert into tblcard(type, name, north, south, east, west, defence, rarity, image) values('$type', '$name', '$north', '$south', '$east', '$west', '$defence', '$rarity', '$image')";
	$q = mysql_query($sql) or die(mysql_error());
	$msg = "Added Successfully";
	
	//goto location: <src location>
	header("location: cards_admin.php?msg=$msg");
?>