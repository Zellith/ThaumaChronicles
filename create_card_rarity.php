<?php
	if(isset($_GET['msg']))
		echo $_GET['msg'];
?>
<form method="post" action="create_card_stats.php">	
	Rarity
	<select name="formRarity">
			<option value="">Select...</option>
			<option value="1">1*</option>
			<option value="2">2*</option>
			<option value="3">3*</option>
			<option value="4">4*</option>
			<option value="5">5*</option>
		</select>
	<input type = "submit" name = "submit" value = "Continue">
</form>

<img src="show_card.php">