<?php
	include("dbconnect.php");
	
	$rarity=$_POST['rarity'];
	$type=$_POST['type'];
	$name=$_POST['name'];
	$north=$_POST['north'];
	$east=$_POST['east'];
	$south=$_POST['south'];
	$west=$_POST['west'];
	$defence=$_POST['defence'];
	$image=mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
	
	$sql="insert into tblCard(rarity,type,name,north,east,south,west,defence,image) values('$rarity','$type','$name','$north','$east','$south','$west','$defence','$image')";
	$q=mysql_query($sql) or die(mysql_error());
	$msg="<h1>Added successfully!</h1><br>";
	
	header("location: create_card_rarity.php?msg=$msg");
?>
