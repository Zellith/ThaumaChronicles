<?php
	include 'dbconnect.php';
	$username = $_POST['un'];
	if(strlen($username)>=3 && strlen($username)<=25) 
	{
		$name = $_POST['name'];	
		$password = $_POST['pw'];

		$sql = "insert into tblplayer(name, username, password) values('$name', '$username', '$password')";
		$q = mysql_query($sql) or die(mysql_error());
		$msg = "Registered Successfully";

		header("location: index.php?msg=$msg");
	}
	elseif(strlen($username)<3)
	{
		$msg = "Name is too short!";
		header("location: register.php?msg=$msg");
	}
	else
	{
		$msg = "Name is too long!";
		header("location: register.php?msg=$msg");
	}
?>