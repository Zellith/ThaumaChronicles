<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/login.css">
<head>
	<title>Login Page | Thauma Chronicles</title>
</head>

<?php
	if(isset($_GET['msg']))
		echo "<script type=text/javascript>"."alert('".$_GET['msg']."')</script>";
?>

<body>
		<div class="logo">
			<img src="images/LOGO_THAUMCHRONICLES.png">
		</div>
		<section class="wrap">
		<form name="form" method="Post" action="login_confirm.php">
			<ul class="input-style">
				<li>
					Username: <input type="text" name="un" placeholder="Username" class="style 2">
				</li>
				<li>
					Password: <input type="password" name="pw" placeholder="Password" class="focus">
				</li>
			</ul>
		<input type="submit" name="submit" value="login">
		</form>
	</section>
</body>
</html>