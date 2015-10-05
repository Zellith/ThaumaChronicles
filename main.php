<!--
	*Copyright 2015, All rights reserved, Not for commercial use
	*File: main.php
	*Project: 
	*Module: 
	*Description: This page handles the input and navigation of the player/s to access the several features of the game.
	*Notes: 
	*Revision History
	*Date: 9/11/2015 By:Zellith feat. Byron
	*Description: Added the Javascript code to apple hover animations to the main.php
-->
<link rel="stylesheet" type="text/css" href="css/main.css">
<?php
	include 'check_login.php';
	include 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Main Menu</title>
</head>
<body>
	<script>
		function hover(element) 
		{
			element.setAttribute('src', 'images/button_hover.png');
		}
		function unhover(element) 
		{
			element.setAttribute('src', 'images/button.png');
		}
	</script>
	<a href="create_room.php"><div class="wrap">
		<img id="button" src="images/button.png" onmouseover="hover(this);" onmouseout="unhover(this);">
		<p class="desc">CREATE ROOM</p>
	</div></a>
	<a href="join_room.php"><div class="wrap">
		<img src="images/button.png">
		<p class="desc">JOIN ROOM</p>
	</div></a>
	<a href="logout.php"><div class="wrap">
		<img src="images/button.png">
		<p class="desc">LOGOUT</p>
	</div></a>
</body>
</html>
