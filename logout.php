<?php
	session_start();
	session_destroy();
	$msg = "you have been logged out.";
	header("location:index.php?msg=$msg");
?>