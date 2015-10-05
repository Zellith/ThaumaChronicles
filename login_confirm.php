<?php
	session_start();
	include("dbconnect.php");

	$sql = "select * from tblplayer where username='".$_POST['un']."' and password = '".$_POST['pw']."'";
	$q = mysql_query($sql);
	$r = mysql_fetch_assoc($q);
	if(mysql_num_rows($q)>0)
	{
		//$_SESSION['logged']=$_POST['un'];
		$_SESSION['p_id']=$r['player_id'];
		header("location:main.php");
	}
	else
	{
		$msg="Invalid Username and/or Password.";
		header("location:login.php?msg=$msg");

	}
?>