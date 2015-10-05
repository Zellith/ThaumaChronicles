<?php
	include 'check_login.php';
	include 'dbconnect.php';
	include 'TC_functs.php';
?>
<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
<link rel="stylesheet" type="text/css" href="css/gameboard.css">
<body id="background">
	<div>
		<form method="post" action="card_rand.php">
			<input class="draw" type="submit" value="Draw">
		</form>
	</div>
	<?php
		$i = 1;
		$sql = "select * from tblplayer_card where player_id =".$_SESSION['p_id'];
		$q = mysql_query($sql);
		while ($r = mysql_fetch_assoc($q))
		{
			$p_card[$i] = $r['card_id'];
			$i++;
		}
		$i = 1;
		$sql = "select * from tblcard";
		$q = mysql_query($sql);
		while ($r = mysql_fetch_assoc($q)) 
		{
			$north[$i] = $r['north'];
			$south[$i] = $r['south'];
			$west[$i] = $r['west'];
			$east[$i] = $r['east'];
			$img_card[$i] = $r['image'];
			$i++;
		}
	?>
		<?php
			#--checks current amount of cards in player hand if equal to 5 hides draw button--#
			checkCurrent_Amnt_PCards(); 
			$i = 1;
			while (isset($p_card[$i])) 
				{
					$index = $p_card[$i];
					$i++;
					echo "<div class=\"player\"><div id=\"card\"><a href=\"game_board.php?card_id=$index\"><img src=\"$img_card[$index]\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\"></a></div></div>";	
				}
		?>
		

	<div id="board">
		<div id= "m1">
			<a href="game_board.php?field_id=001"><div class="field">
			<?php
				#--checks if there is a value in card_id if true stores it into a session called card_id--#
				if(isset($_GET['card_id']))
				{
					$_SESSION['card_id'] = $_GET['card_id'];
				}
				if(isset($_GET['field_id']))
				{
					if($_GET['field_id'] == 001)
					{
						$_SESSION['field_001'] = 001;
						if (isset($_SESSION['card_id']) && isset($_SESSION['field_001']))
						{
							$_SESSION['card_id_001'] = $_SESSION['card_id'];
							$sql = "select * from tblcard where card_id = ".$_SESSION['card_id_001'];
							$q = mysql_query($sql);
							$r = mysql_fetch_assoc($q);
							$img_card = $r['image'];
							echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
						}
					}
				else
				{
					if(isset($_SESSION['card_id_001']))
					{
						$sql = "select * from tblcard where card_id = ".$_SESSION['card_id_001'];
						$q = mysql_query($sql);
						$r = mysql_fetch_assoc($q);
						$img_card = $r['image'];
						echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
					}
				}
					
				}
				else
				{
					if (isset($_SESSION['card_id_001']))
					{
						$sql = "select * from tblcard where card_id = ".$_SESSION['card_id_001'];
						$q = mysql_query($sql);
						$r = mysql_fetch_assoc($q);
						$img_card = $r['image'];
						echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
					}
				}
			?>
		</div></a>

			<a href="game_board.php?field_id=002"><div class="field">
			<?php
				if(isset($_GET['card_id']))
				{
					$_SESSION['card_id'] = $_GET['card_id'];
				}
				if(isset($_GET['field_id']))
				{
					if($_GET['field_id'] == 002)
					{
						$_SESSION['field_002'] = 002;
						if (isset($_SESSION['card_id']) && isset($_SESSION['field_002']))
						{
							$_SESSION['card_id_002'] = $_SESSION['card_id'];
							$sql = "select * from tblcard where card_id = ".$_SESSION['card_id_002'];
							$q = mysql_query($sql);
							$r = mysql_fetch_assoc($q);
							$img_card = $r['image'];
							echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
						}
					
						
					}
					else
					{
						if(isset($_SESSION['card_id_002']))
						{
							$sql = "select * from tblcard where card_id = ".$_SESSION['card_id_002'];
							$q = mysql_query($sql);
							$r = mysql_fetch_assoc($q);
							$img_card = $r['image'];
							echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
						}
					}
					
				}
				else
				{
					if (isset($_SESSION['card_id_002']))
					{
						$sql = "select * from tblcard where card_id = ".$_SESSION['card_id_002'];
						$q = mysql_query($sql);
						$r = mysql_fetch_assoc($q);
						$img_card = $r['image'];
						echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
					}
				}
			?>
		</div></a>

			<a href="game_board.php?field_id=003"><div class="field">
			<?php
				if(isset($_GET['card_id']))
				{
					$_SESSION['card_id'] = $_GET['card_id'];
				}
				if(isset($_GET['field_id']))
				{
					if($_GET['field_id'] == 003)
					{
						$_SESSION['field_003'] = 003;
						if (isset($_SESSION['card_id']) && isset($_SESSION['field_003']))
						{
							$_SESSION['card_id_003'] = $_SESSION['card_id'];
							$sql = "select * from tblcard where card_id = ".$_SESSION['card_id_003'];
							$q = mysql_query($sql);
							$r = mysql_fetch_assoc($q);
							$img_card = $r['image'];
							echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
						}
					}
					else
					{
						if (isset($_SESSION['card_id_003']))
						{
							$sql = "select * from tblcard where card_id = ".$_SESSION['card_id_003'];
							$q = mysql_query($sql);
							$r = mysql_fetch_assoc($q);
							$img_card = $r['image'];
							echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
						}
					}	
				}
				else
				{
					if (isset($_SESSION['card_id_003']))
					{
						$sql = "select * from tblcard where card_id = ".$_SESSION['card_id_003'];
						$q = mysql_query($sql);
						$r = mysql_fetch_assoc($q);
						$img_card = $r['image'];
						echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
					}
				}
			?>
		</div></a> 
		</div>
		<div id= "m2">
			<a href="game_board.php?field_id=004"><div class ="field">
			<?php
				if(isset($_GET['card_id']))
				{
					$_SESSION['card_id'] = $_GET['card_id'];
				}

				if(isset($_SESSION['card_id']))
				{
					$index = $_SESSION['card_id'];
				}
				if(isset($_GET['field_id']))
				{
					$north = $north[$index];
					$south = $south[$index];
					$east = $east[$index];
					$west = $west[$index];
					$field_id = $_GET['field_id'];
					checkPlayer_Input($field_id, 004, $north, $south, $east, $west);
				}
			?>
			</div></a>
			<a href="game_board.php?field_id=005"><div class ="field">
			<?php
				if(isset($_GET['card_id']))
				{
					$_SESSION['card_id'] = $_GET['card_id'];
				}
				if(isset($_SESSION['card_id']))
				{
					$index = $_SESSION['card_id'];
				}
				$i=0;
				$sql = "select * from tblcard";
				$q = mysql_query($sql);
				while ($r = mysql_fetch_assoc($q)) 
				{
					$north[$i] = $r['north'];
					$south[$i] = $r['south'];
					$west[$i] = $r['west'];
					$east[$i] = $r['east'];
					$img_card[$i] = $r['image'];
					$i++;
				}
				if(isset($_GET['field_id']))
				{
					$north = $north[$index];
					$south = $south[$index];
					$east = $east[$index];
					$west = $west[$index];
					$field_id = $_GET['field_id'];
					checkPlayer_Input($field_id, 005, $north, $south, $east, $west);
				}
			?>
			</div></a>
			<a href="game_board.php?field_id=006"><div class ="field">
			<?php
				if(isset($_GET['card_id']))
				{
					$_SESSION['card_id'] = $_GET['card_id'];
				}

				if(isset($_SESSION['card_id']))
				{
					$index = $_SESSION['card_id'];
				}
				$i=0;
				$sql = "select * from tblcard";
				$q = mysql_query($sql);
				while ($r = mysql_fetch_assoc($q)) 
				{
					$north[$i] = $r['north'];
					$south[$i] = $r['south'];
					$west[$i] = $r['west'];
					$east[$i] = $r['east'];
					$img_card[$i] = $r['image'];
					$i++;
				}
				if(isset($_GET['field_id']))
				{
					$north = $north[$index];
					$south = $south[$index];
					$east = $east[$index];
					$west = $west[$index];
					$field_id = $_GET['field_id'];
					checkPlayer_Input($field_id, 006, $north, $south, $east, $west);
				}
				// else
				// 	showCard(006, $north, $south, $east, $west);
			?>
			</div></a>
		</div>
		<div id = "m3">
			<div class ="field"></div>
			<div class ="field"></div>
			<div class ="field"></div>
		</div> 
	</div>
</body>
