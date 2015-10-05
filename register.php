<?php
	if(isset($_GET['msg']))
	{
		echo "<script type=text/javascript>"."alert('".$_GET['msg']."')</script>";
	}
?>
<form method="post" action="register_confirm.php">
	Name: <input type="text" name="name">
	Username: <input type="text" name="un">
	Password: <input type="text" name="pw">
	<input type="submit" name="submit" value="Confirm">
</form>