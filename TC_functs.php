<?php
	include 'dbconnect.php';
	function checkCurrent_Amnt_PCards()
	{
		$sql = "select * from tblplayer_card where player_id = ".$_SESSION['p_id'];
		$q = mysql_query($sql);
		if (mysql_num_rows($q)==5)
		{
			?>
			<script type="text/javascript">
			$(document).ready(function(){
				$(".draw").hide();
			});
			</script>
			<?php
		}
	}
	function checkPlayer_Input($field_id, $fparam, $north=" ", $south=" ", $east=" ", $west=" ")
	{
		if(isset($field_id))
			{
				if($field_id == $fparam)
				{
					$_SESSION['\'field_'.$fparam.'\''] = $fparam;
					if (isset($_SESSION['card_id']) && isset($_SESSION['\'field_'.$fparam.'\'']))
					{
						$_SESSION['\'card_id_'.$fparam.'\''] = $_SESSION['card_id'];
						$sql = "select * from tblcard where card_id = ".$_SESSION['\'card_id_'.$fparam.'\''];
						$q = mysql_query($sql);
						$r = mysql_fetch_assoc($q);
						$img_card = $r['image'];
						echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north\n South: $south\n West: $west\n East: $east\">";
					}
				}
				else
				{
					if(isset($_SESSION['\'card_id_'.$fparam.'\'']))
					{
						$sql = "select * from tblcard where card_id = ".$_SESSION['\'card_id_'.$fparam.'\''];
						$q = mysql_query($sql);
						$r = mysql_fetch_assoc($q);
						$img_card = $r['image'];
						echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north\n South: $south\n West: $west\n East: $east\">";
					}
				}		
			}
			else
			{
				if (isset($_SESSION['\'card_id_'.$fparam.'\'']))
				{
					$sql = "select * from tblcard where card_id = ".$_SESSION['\'card_id_'.$fparam.'\''];
					$q = mysql_query($sql);
					$r = mysql_fetch_assoc($q);
					$img_card = $r['image'];
					echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north\n South: $south\n West: $west\n East: $east\">";
				}
			}
	}
	function showCard($fparam, $north, $south, $east, $west)
	{
		$sql = "select * from tblcard where card_id = ".$_SESSION['\'card_id_'.$fparam.'\''];
						$q = mysql_query($sql);
						$r = mysql_fetch_assoc($q);
						$img_card = $r['image'];
						echo "<img src=\"".$img_card."\" class=\"card\" title=\"North: $north\n South: $south\n West: $west\n East: $east\">";
	}
?>