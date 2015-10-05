<head>
	<title>Thauma Chronicles | Admin Cards</title>
</head>
<?php
	if(isset($_GET['msg']))
		echo "<script type=text/javascript>"."alert('".$_GET['msg']."')</script>";
?>

<form method="post" action="cards_admin.php">
<table border="3", cellpadding="2" cellspacing="0" align="center" style="margin-top: 10%">
	<tr>
	<td>
	Value: <input type="text" name="val">
	<input type="submit" name="submit" value="Search">
	</tr>
	</td>
</table>
</form>

<?php
	//checks if the variable 'msg' has a value if true echo the value.
	if(isset($_GET['msg']))
		echo $_GET['msg'];
	//include the content of dbconnect.php
	include("dbconnect.php");
	
	if(isset($_POST['submit']))
	{
		$val = $_POST['val'];
		$sql = "select * from tblcard where '%$val%' like name";
	}
	else
		$sql = "select * from tblcard";
	
	$q = mysql_query($sql) or die(mysql_error());
?>

<form method="post" action="add_card.php">
<table border="3", cellpadding="2" cellspacing="0" align="center">
	<tr>
		<td>Card ID</td>
		<td>Type</td>
		<td>Name</td>
		<td>North</td>
		<td>South</td>
		<td>East</td>
		<td>West</td>
		<td>Defence</td>
		<td>Rarity</td>
		<td>Image</td>
	</tr>
	<style type="text/css">
		table{
			font-size: 20pt;
			font-weight: bold;
		}
		img{
			height: 600px;
			width: 400px;
		}
	</style>
	<?php
		while($r=mysql_fetch_assoc($q))
		{
	?>
	<tr>
		<?php 
			$data = $r['image'];
		?>
		<td><?php echo $r['card_id'];?></td>
		<td><?php echo $r['type'];?></td>
		<td><?php echo $r['name'];?></td>
		<td><?php echo $r['north'];?></td>
		<td><?php echo $r['south'];?></td>
		<td><?php echo $r['east'];?></td>
		<td><?php echo $r['west'];?></td>
		<td><?php echo $r['defence']?></td>
		<td><?php echo $r['rarity'];?></td>
		<td id="card"><?php echo "<img src=\"$data\">"?></td>
		<td><a href="delete_card.php?card_id=<?php echo $r['card_id'];?>">Delete</a></td>
		<td><a href="update_card.php?card_id=<?php echo $r['card_id'];?>">Update</a></td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td colspan="7" align="center"><input type="submit" value="Add Card"></td>
	</tr>
</table>
</form>