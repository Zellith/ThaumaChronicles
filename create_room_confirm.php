<?php

	include 'check_login.php';
	include 'dbconnect.php';
	$rn = $_POST['rn'];
	if (strlen($rn)>=3 && strlen($rn)<=25) 
	{
		$sql = "select * from tblroom where room_name ='".$rn."'";
		$q = mysql_query($sql) or die(mysql_error());
		$r = mysql_fetch_assoc($q);
		$r_num = mysql_num_rows($q);
		$sql = "select * from tblroom where player_1 =".$_SESSION['p_id'];
		$q = mysql_query($sql);
		$p_num = mysql_num_rows($q);
		$p_id = $_SESSION['p_id'];
		if($r_num==0 && $p_num==0)
		{
			$sql = "insert into tblroom(room_name, player_1) values('$rn', '$p_id')";
			$q = mysql_query($sql);
			$sql = "select * from tblroom where room_name ='".$rn."'";
			$q = mysql_query($sql);
			$r = mysql_fetch_assoc($q);
			$room_id = $r['room_id'];
			header("location: room.php?room_id=$room_id");
		}
		elseif ($p_num>0) 
		{
			$sql = "select * from tblroom where player_1 ='".$_SESSION['p_id']."'";
			$q = mysql_query($sql);
			$r = mysql_fetch_assoc($q);
			$room_id = $r['room_id'];
			$msg = "You already created a room!";
			header("location: room.php?room_id=$room_id&msg=$msg");
		}
		else 
		{
			$msg = "Room Name already exists!";
			header("location: create_room.php?msg=$msg");
		}
	}
	elseif(strlen($rn)<3)
	{
		$msg = "Room name too short!";
		header("location: create_room.php?msg=$msg");
	}
	else
	{
		$msg = "Room name is too long!";
		header("location: create_room.php?msg=$msg");
	}
?>