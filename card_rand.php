<?php
	//checks if player is logged in
	include ("check_login.php");
	//include the content of dbconnect.php
	include("dbconnect.php");  //session = roomid
	$sql = "select * from tblcard";
	$q = mysql_query($sql) or die(mysql_error());

	$player_id = $_SESSION['p_id'];
	$room_id = $_SESSION['room_id'];

	$i = 0;
	while ($r = mysql_fetch_assoc($q)) 
		{
			$p_card[$i] = $r['card_id'];
			$i++;
		}
	$index = rand(0, $i-1);
	$sql_check_card_amount = "select * from tblplayer_card where player_id = ".$_SESSION['p_id'];
	$q_check = mysql_query($sql_check_card_amount);
	if(mysql_num_rows($q_check)<5) #-- checks if current hand of the player is 5 or less.--#
	{
		$sql = "select * from tblplayer_card where card_id = ".$p_card[$index];
		$q = mysql_query($sql);
		#-- checks if the card picked by the RNG is already in hand --#
		if(mysql_num_rows($q)==0)
		{
			$card_id = $p_card[$index];
			$sql = "insert into tblplayer_card(room_id,player_id,card_id) values ('$room_id','$player_id','$card_id')";
			$q = mysql_query($sql) or die(mysql_error());
			header('location: game_board.php');
		}
		$sql = "select * from tblplayer_card where player_id = ".$player_id;
		$q = mysql_query($sql) or die(mysql_error());
		#-- checks if the current cards in hand is less than 5 if true draw again --#
		if(mysql_num_rows($q)<5)
		{
			header('location: card_rand.php');
		}
		#-- if the above condition is false go back to game board --#
		else
		{
			header('location: game_board.php');
		}
	}
	else #-- go back to game board if cards in hand is 5 --#
	{
		header('location: game_board.php');
	}
?>