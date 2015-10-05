<?php
if(isset($_POST['submit']))
	{
		$rarity=$_POST['formRarity'];
		
		switch($rarity)
		{
			case "1":
				$min=50;
				$max=100;
				break;
			
			case "2":
				$min=100;
				$max=150;
				break;
			
			case "3":
				$min=150;
				$max=200;
				break;
			
			case "4":
				$min=200;
				$max=250;
				break;
			
			case "5":
				$min=250;
				$max=300;
				break;
		}
		?>Rarity: <?php echo $rarity ;?>
		</br>Min: <?php echo $min; ?>
		</br>Max: <?php echo $max; 
		
		$rarity=$rarity;
		$north=rand($min,$max);
		$east=rand($min,$max);
		$south=rand($min,$max);
		$west=rand($min,$max);
		$defence=($max*2);
		
	}
?>

<form method="post" action="create_card_confirm.php" enctype="multipart/form-data">
	Rarity <input type="text" name="rarity" value="<?php echo $rarity;?>"><br>
	Card Type <input type = "text" name = "type"><br>
	Card Name <input type = "text" name = "name"><br>
	Attack North <input type="text" name="north" value="<?php echo $north;?>"><br>
	Attack East <input type="text" name="east" value="<?php echo $east;?>"><br>
	Attack South <input type="text" name="south" value="<?php echo $south;?>"><br>
	Attack West <input type="text" name="west" value="<?php echo $west;?>"><br>
	Card Defense <input type="text" name="defence" value="<?php echo $defence;?>"><br>
	<input type="file" name="image">
	<input type = "submit" name = "submit" value = "Create Card">
</form>
