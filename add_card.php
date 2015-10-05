<form method="post" action="add_card_confirm.php">
<table border="3", cellpadding="2" cellspacing="0" align="center" style="margin-top: 10%">
	<tr>
		<td>Type: <select name="type">
			<option value="Red">RED</option>
			<option value="Blue">BLUE</option>
			<option value="Green">Green</option>
			<option value="Black">BLACK</option>
			<option value="White">WHITE</option>
		</select></td>
	</tr>
	<tr>
		<td>Name: <input type="text" name="name"></td>
	</tr>
	<tr>
		<td>North: <input type="text" name="north"></td>
	</tr>	
	<tr>
		<td>South: <input type="text" name="south"></td>
	</tr>
	<tr>
		<td>East: <input type="text" name="east"></td>
	</tr>
	<tr>
		<td>West: <input type="text" name="west"></td>
	</tr>
	<tr>
		<td>Defence: <input type="text" name="defence"></td>
	</tr>
	<tr>
		<td>Rarity: <input type="text" name="rarity"></td>
	</tr>
	<tr>
		<td>Image: <input type="text" name="image"></td>
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="Save"></td>
	</tr>
</table>
</form>