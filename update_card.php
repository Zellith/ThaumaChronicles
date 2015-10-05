<?php
	include 'dbconnect.php';
	$card_id = $_GET['card_id'];
	$sql = "select * from tblcard where card_id = $card_id";
	$q = mysql_query($sql);
	$r = mysql_fetch_assoc($q);
?>
<form method="post" action="update_card_confirm.php?card_id=<?php echo $r['card_id']?>">
	<select name="type">
		<option value="<?php echo $r['type'];?>">
			<?php echo $r['type']?>
		</option>
		<option>Red</option>
		<option>Blue</option>
		<option>Green</option>
		<option>White</option>
		<option>Black</option>
	</select>
	Name: <input type="text" name="name" value="<?php echo $r['name'];?>">
	Image: <input type="text" name="image" value="<?php echo $r['image'];?>">
	<input type="submit" value="submit">
</form>