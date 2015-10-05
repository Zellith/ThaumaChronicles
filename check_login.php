<?php
	session_start();
	if(!isset($_SESSION['p_id']))
	{
		$msg="Please Log In";
		header("location:login.php?msg=$msg");
	}
?>