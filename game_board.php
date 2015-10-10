<?php
        include 'check_login.php';
        include 'TC_functs.php';
?>
<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
<link rel="stylesheet" type="text/css" href="css/gameboardv2.css">
<head><title>ThaumaChronicles | Game</title></head>
<body id="background">
        <div>
                <form method="post" action="card_rand.php">
                        <input class="draw" type="submit" value="Draw">
                </form>
        </div>
        <?php
                        connectDB();
                        $room_id = getRoomID();
                        #-- Stores the rec_id of the records in tblboard onto an array $rec_id[] --#
                        $sql = "select * from tblboard where room_id=$room_id";
                        $q = mysql_query($sql) or die(mysql_error());
                        $i = 0;
                        while ($r = mysql_fetch_assoc($q))
                        {
                                $rec_id[$i] = $r['rec_id'];
                                $i++;
                        }
                        #-- Stores the rec_id of the records in tblplayer_card onto an array $p_rec_id[] --#
                        $sql = "select * from tblplayer_card where room_id=$room_id";
                        $q = mysql_query($sql);
                        $i = 0;
                        while ($r = mysql_fetch_assoc($q))
                        {
                                $p_rec_id[$i] = $r['rec_id'];
                                $i++;
                        }
                        closeConn();
                #-- stores the value of the room_id into a variables to be use in the board selection(display) of the cards --#
                $i = 1;
                connectDB();
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
                closeConn();
        ?>
                <?php
                        connectDB();
                        #--checks current amount of cards in player hand if equal to 5 hides draw button--#
                        checkCurrent_Amnt_PCards();
                        $i = 1;
                        while (isset($p_card[$i]))
                                {
                                        $index = $p_card[$i];
                                        $i++;
                                        echo "<div class=\"player\"><div id=\"card\"><a href=\"game_board.php?card_id=$index\"><img src=\"$img_card[$index]\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\"></a></div></div>";    
                                }
                        closeConn();
                ?>
 
<div id="board">
        <div id= "m1">
                <a href="game_board.php?field_id=001"><div class="field">
                <?php
                        connectDB();
                        
                        #--checks if there is a value in card_id if true stores it into a session called card_id--#
                        if(isset($_GET['card_id']))
                        {
                                $_SESSION['card_id'] = $_GET['card_id'];
                        }
                        #-- checks if there is a value in field_id if true executes the condition statement --#
                        if(isset($_GET['field_id']))
                        {
                                        if($_GET['field_id'] == '001')
                                        {
                                                if (isset($_SESSION['card_id']))
                                                {
                                                        $_SESSION['card_id_001'] = $_SESSION['card_id'];
                                                        $sql = "select * from tblcard where card_id = ".$_SESSION['card_id_001'];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        $img_card = $r['image'];
                                                        $card_id = $_SESSION['card_id_001'];
                                                        $player_id = $_SESSION['p_id'];
                                                        $sql = "insert into tblboard(field1, room_id, card_id, player_id) values('$img_card', '$room_id', '$card_id', '$player_id')";
                                                        $q = mysql_query($sql);
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        $room_id = getRoomID();
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field4']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field4 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field1 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($east1 > $west2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                              	$i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field2']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field2 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field1 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($south1 > $north2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }                                                      
                                                            }

                                                        }
                                            }
                                        }
                                        else
                                        {
                                                $i = 0;
                                                while (isset($rec_id[$i]))
                                                {
                                                        $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        if ($r['field1']!="NONE")
                                                        {
                                                                $img_card = $r['field1'];
                                                                echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                break;
                                                        }
                                                        $i++;
                                                }      
                                        }
                                }
                                else
                                {
                                        $i = 0;
                                        while (isset($rec_id[$i]))
                                        {
                                                $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                $q = mysql_query($sql);
                                                $r = mysql_fetch_assoc($q);
                                                if ($r['field1']!="NONE")
                                                {
                                                        $img_card = $r['field1'];
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        break;
                                                }
                                                $i++;
                                        }
                                }
                                closeConn();
                        ?>
                </div></a>
 
                <a href="game_board.php?field_id=002"><div class="field">
                <?php
                        connectDB();
                        #--checks if there is a value in card_id if true stores it into a session called card_id--#
                        if(isset($_GET['card_id']))
                        {
                                $_SESSION['card_id'] = $_GET['card_id'];
                        }
                        #-- checks if there is a value in field_id if true executes the condition statement --#
                        if(isset($_GET['field_id']))
                        {
                                        if($_GET['field_id'] == '002')
                                        {
                                                if (isset($_SESSION['card_id']))
                                                {
                                                        $_SESSION['card_id_002'] = $_SESSION['card_id'];
                                                        $sql = "select * from tblcard where card_id = ".$_SESSION['card_id_002'];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        $img_card = $r['image'];
                                                        $card_id = $_SESSION['card_id_002'];
                                                        $player_id = $_SESSION['p_id'];
                                                        $sql = "insert into tblboard(field2, room_id, card_id, player_id) values('$img_card', '$room_id', '$card_id', '$player_id')";
                                                        $q = mysql_query($sql);
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        $room_id = getRoomID();
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field1']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field1 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field2 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($north1 > $south2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }    
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field5']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field5 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field2 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($south1 > $north2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field3']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field3 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field2 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($south1 > $north2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }

                                                }
                                        }
                                        else
                                        {
                                                $i = 0;
                                                while (isset($rec_id[$i]))
                                                {
                                                        $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        if ($r['field2']!="NONE")
                                                        {
                                                                $img_card = $r['field2'];
                                                                echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                break;
                                                        }
                                                        $i++;
                                                }      
                                        }
                                }
                                else
                                {
                                        $i = 0;
                                        while (isset($rec_id[$i]))
                                        {
                                                $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                $q = mysql_query($sql);
                                                $r = mysql_fetch_assoc($q);
                                                if ($r['field2']!="NONE")
                                                {
                                                        $img_card = $r['field2'];
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        break;
                                                }
                                                $i++;
                                        }
                                }
                                closeConn();
                        ?>
                </div></a>
                <a href="game_board.php?field_id=003"><div class="field">
                <?php
                        connectDB();
                        #--checks if there is a value in card_id if true stores it into a session called card_id--#
                        if(isset($_GET['card_id']))
                        {
                                $_SESSION['card_id'] = $_GET['card_id'];
                        }
                        #-- checks if there is a value in field_id if true executes the condition statement --#
                        if(isset($_GET['field_id']))
                        {
                                        if($_GET['field_id'] == '003')
                                        {
                                                if (isset($_SESSION['card_id']))
                                                {
                                                        $_SESSION['card_id_003'] = $_SESSION['card_id'];
                                                        $sql = "select * from tblcard where card_id = ".$_SESSION['card_id_003'];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        $img_card = $r['image'];
                                                        $card_id = $_SESSION['card_id_003'];
                                                        $player_id = $_SESSION['p_id'];
                                                        $sql = "insert into tblboard(field3, room_id, card_id, player_id) values('$img_card', '$room_id', '$card_id', '$player_id')";
                                                        $q = mysql_query($sql);
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        $room_id = getRoomID();
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field2']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field2 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field3 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($north1 > $south2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field6']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field6 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field3 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($east1 > $west2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                       }
                                                    }
                                        }

                                        else
                                        {
                                                $i = 0;
                                                while (isset($rec_id[$i]))
                                                {
                                                        $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        if ($r['field3']!="NONE")
                                                        {
                                                                $img_card = $r['field3'];
                                                                echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                break;
                                                        }
                                                        $i++;
                                                }      
                                        }
                                }
                                else
                                {
                                        $i = 0;
                                        while (isset($rec_id[$i]))
                                        {
                                                $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                $q = mysql_query($sql);
                                                $r = mysql_fetch_assoc($q);
                                                if ($r['field3']!="NONE")
                                                {
                                                        $img_card = $r['field3'];
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        break;
                                                }
                                                $i++;
                                        }
                                }
                                closeConn();
                        ?>
                </div></a> <!-- end of div for current row-->
        </div>
                <div id= "m2">
                        <a href="game_board.php?field_id=004"><div class="field">
                        <?php
                        connectDB(); #-- opens a TCP port to the database --#
                        #--checks if there is a value in card_id if true stores it into a session called card_id--#
                        if(isset($_GET['card_id']))
                        {
                                $_SESSION['card_id'] = $_GET['card_id'];
                        }
                        #-- checks if there is a value in field_id if true executes the condition statement --#
                        if(isset($_GET['field_id']))
                        {
                                        if($_GET['field_id'] == '004')
                                        {
                                                if (isset($_SESSION['card_id']))
                                                {
                                                        $_SESSION['card_id_004'] = $_SESSION['card_id'];
                                                        $sql = "select * from tblcard where card_id = ".$_SESSION['card_id_004'];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        $img_card = $r['image'];
                                                        $card_id = $_SESSION['card_id_004'];
                                                        $player_id = $_SESSION['p_id'];
                                                        $sql = "insert into tblboard(field4, room_id, card_id, player_id) values('$img_card', '$room_id', '$card_id', '$player_id')";
                                                        $q = mysql_query($sql);
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        $room_id = getRoomID();
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field1']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field1 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field4 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($west1 > $east2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field5']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field5 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field4 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($south1 > $north2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field7']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field7 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field4 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($west1 > $east2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }   
                                                }
                                        }
                                           
                                        else
                                        {
                                                $i = 0;
                                                while (isset($rec_id[$i]))
                                                {
                                                        $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        if ($r['field4']!="NONE")
                                                        {
                                                                $img_card = $r['field4'];
                                                                echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                break;
                                                        }
                                                        $i++;
                                                }      
                                        }
                                }
                                else
                                {
                                        $i = 0;
                                        while (isset($rec_id[$i]))
                                        {
                                                $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                $q = mysql_query($sql);
                                                $r = mysql_fetch_assoc($q);
                                                if ($r['field4']!="NONE")
                                                {
                                                        $img_card = $r['field4'];
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        break;
                                                }
                                                $i++;
                                        }
                                }
                                closeConn(); #-- closes TCP Ports connected to the database --#
                        ?>
                        </div></a> <!-- end of div for current row-->
 
                        <a href="game_board.php?field_id=005"><div class="field">
                                <?php
                                connectDB(); #-- opens a TCP port to the database --#
                                #--checks if there is a value in card_id if true stores it into a session called card_id--#
                                if(isset($_GET['card_id']))
                                {
                                        $_SESSION['card_id'] = $_GET['card_id'];
                                }
                                #-- checks if there is a value in field_id if true executes the condition statement --#
                                if(isset($_GET['field_id']))
                                {
                                                if($_GET['field_id'] == '005')
                                                {
                                                    if (isset($_SESSION['card_id']))
                                                    {
                                                        $_SESSION['card_id_005'] = $_SESSION['card_id'];
                                                        $sql = "select * from tblcard where card_id = ".$_SESSION['card_id_005'];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        $img_card = $r['image'];
                                                        $card_id = $_SESSION['card_id_005'];
                                                        $player_id = $_SESSION['p_id'];
                                                        $sql = "insert into tblboard(field5, room_id, card_id, player_id) values('$img_card', '$room_id', '$card_id', '$player_id')";
                                                        $q = mysql_query($sql);
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        $room_id = getRoomID();
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field2']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field2 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field5 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($west1 > $east2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                    }
                                                                }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field4']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field4 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field5 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($north1 > $south2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                    }
                                                                }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field6']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field6 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field5 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($south1 > $north2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                    }
                                                                }
                                                        }  
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field8']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field8 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field5 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($east1 > $west2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }

                                                }
                                            }
                                            else
                                                {
                                                        $i = 0;
                                                        while (isset($rec_id[$i]))
                                                        {
                                                                $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                if ($r['field5']!="NONE")
                                                                {
                                                                        $img_card = $r['field5'];
                                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                        break;
                                                                }
                                                                $i++;
                                                        }      
                                                }
                                        }
                                        else
                                        {
                                                $i = 0;
                                                while (isset($rec_id[$i]))
                                                {
                                                        $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        if ($r['field5']!="NONE")
                                                        {
                                                                $img_card = $r['field5'];
                                                                echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                break;
                                                        }
                                                        $i++;
                                                }
                                        }
                                        closeConn(); #-- closes TCP Ports connected to the database --#
                                ?>
                        </div></a> <!-- end of div for current row-->
 
 
                        <a href="game_board.php?field_id=006"><div class="field">
                                <?php
                                connectDB(); #-- opens a TCP port to the database --#
                                #--checks if there is a value in card_id if true stores it into a session called card_id--#
                                if(isset($_GET['card_id']))
                                {
                                        $_SESSION['card_id'] = $_GET['card_id'];
                                }
                                #-- checks if there is a value in field_id if true executes the condition statement --#
                                if(isset($_GET['field_id']))
                                {
                                                if($_GET['field_id'] == '006')
                                                {
                                                        if (isset($_SESSION['card_id']))
                                                        {
                                                            $_SESSION['card_id_006'] = $_SESSION['card_id'];
                                                            $sql = "select * from tblcard where card_id = ".$_SESSION['card_id_006'];
                                                            $q = mysql_query($sql);
                                                            $r = mysql_fetch_assoc($q);
                                                            $img_card = $r['image'];
                                                            $card_id = $_SESSION['card_id_006'];
                                                            $player_id = $_SESSION['p_id'];
                                                            $sql = "insert into tblboard(field6, room_id, card_id, player_id) values('$img_card', '$room_id', '$card_id', '$player_id')";
                                                            $q = mysql_query($sql);
                                                            echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                            $room_id = getRoomID();
                                                            $sql = "select * from tblboard where room_id = $room_id";
                                                            $q1 = mysql_query($sql);
                                                            while($r1 = mysql_fetch_assoc($q1))
                                                            {
                                                                if($r1['field3']!="NONE")
                                                                {
                                                                $sql = "select * from tblboard where field3 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field6 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($west1 > $east2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                    }
                                                                }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field5']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field5 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field6 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($north1 > $south2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                    }
                                                                }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field9']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field9 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field6 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($west1 > $east2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }

                                                }
                                        }
                                                
                                                else
                                                {
                                                        $i = 0;
                                                        while (isset($rec_id[$i]))
                                                        {
                                                                $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                if ($r['field6']!="NONE")
                                                                {
                                                                        $img_card = $r['field6'];
                                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                        break;
                                                                }
                                                                $i++;
                                                        }      
                                                }
                                        }
                                        else
                                        {
                                                $i = 0;
                                                while (isset($rec_id[$i]))
                                                {
                                                        $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        if ($r['field6']!="NONE")
                                                        {
                                                                $img_card = $r['field6'];
                                                                echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                break;
                                                        }
                                                        $i++;
                                                }
                                        }
                                        closeConn(); #-- closes TCP Ports connected to the database --#
                                ?>
                        </div></a> <!-- end of div for current row-->
                </div>
 
                <div id = "m3">
                        <a href="game_board.php?field_id=007"><div class="field">
                                <?php
                                connectDB(); #-- opens a TCP port to the database --#
                                #--checks if there is a value in card_id if true stores it into a session called card_id--#
                                if(isset($_GET['card_id']))
                                {
                                        $_SESSION['card_id'] = $_GET['card_id'];
                                }
                                #-- checks if there is a value in field_id if true executes the condition statement --#
                                if(isset($_GET['field_id']))
                                {
                                                if($_GET['field_id'] == '007')
                                                {
                                                        if (isset($_SESSION['card_id']))
                                                        {
                                                            $_SESSION['card_id_007'] = $_SESSION['card_id'];
                                                            $sql = "select * from tblcard where card_id = ".$_SESSION['card_id_007'];
                                                            $q = mysql_query($sql);
                                                            $r = mysql_fetch_assoc($q);
                                                            $img_card = $r['image'];
                                                            $card_id = $_SESSION['card_id_007'];
                                                            $player_id = $_SESSION['p_id'];
                                                            $sql = "insert into tblboard(field7, room_id, card_id, player_id) values('$img_card', '$room_id', '$card_id', '$player_id')";
                                                            $q = mysql_query($sql);
                                                            echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                            $room_id = getRoomID();
                                                            $sql = "select * from tblboard where room_id = $room_id";
                                                            $q1 = mysql_query($sql);
                                                            while($r1 = mysql_fetch_assoc($q1))
                                                            {
                                                                if($r1['field4']!="NONE")
                                                                {
                                                                    $sql = "select * from tblboard where field4 != \"NONE\"";
                                                                    $q = mysql_query($sql);
                                                                    $r = mysql_fetch_assoc($q);
                                                                    $card2 = $r['card_id'];
                                                                    if ($r['player_id']!=$_SESSION['p_id'])
                                                                    {
                                                                        $sql = "select * from tblboard where field7 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($west1 > $east2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                    }
                                                                }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field8']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field8 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field7 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($south1 > $north2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }
 
                                                       
                                                }
                                        }                                                        
                                                
                                                else
                                                {
                                                        $i = 0;
                                                        while (isset($rec_id[$i]))
                                                        {
                                                                $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                if ($r['field7']!="NONE")
                                                                {
                                                                        $img_card = $r['field7'];
                                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                        break;
                                                                }
                                                                $i++;
                                                        }      
                                                }
                                        }
                                        else
                                        {
                                                $i = 0;
                                                while (isset($rec_id[$i]))
                                                {
                                                        $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        if ($r['field7']!="NONE")
                                                        {
                                                                $img_card = $r['field7'];
                                                                echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                break;
                                                        }
                                                        $i++;
                                                }
                                        }
                                        closeConn(); #-- closes TCP Ports connected to the database --#
                                ?>
                        </div></a> <!-- end of div for current row-->
 
                        <a href="game_board.php?field_id=008"><div class="field">
                                <?php
                                connectDB(); #-- opens a TCP port to the database --#
                                #--checks if there is a value in card_id if true stores it into a session called card_id--#
                                if(isset($_GET['card_id']))
                                {
                                        $_SESSION['card_id'] = $_GET['card_id'];
                                }
                                #-- checks if there is a value in field_id if true executes the condition statement --#
                                if(isset($_GET['field_id']))
                                {
                                        if($_GET['field_id'] == '008')
                                        {
                                                if (isset($_SESSION['card_id']))
                                                {
                                                    $_SESSION['card_id_008'] = $_SESSION['card_id'];
                                                    $sql = "select * from tblcard where card_id = ".$_SESSION['card_id_008'];
                                                    $q = mysql_query($sql);
                                                    $r = mysql_fetch_assoc($q);
                                                    $img_card = $r['image'];
                                                    $card_id = $_SESSION['card_id_008'];
                                                    $player_id = $_SESSION['p_id'];
                                                    $sql = "insert into tblboard(field8, room_id, card_id, player_id) values('$img_card', '$room_id', '$card_id', '$player_id')";
                                                    $q = mysql_query($sql);
                                                    echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                    $room_id = getRoomID();
                                                    $sql = "select * from tblboard where room_id = $room_id";
                                                    $q1 = mysql_query($sql);
                                                    while($r1 = mysql_fetch_assoc($q1))
                                                    {
                                                        if($r1['field7']!="NONE")
                                                        {
                                                                $sql = "select * from tblboard where field7 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field8 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($north1 > $south2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                    }
                                                        
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                        if($r1['field5']!="NONE")                                                       
                                                        {
                                                                $sql = "select * from tblboard where field5 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field8 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($west1 > $east2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field9']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field9 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field8 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($south1 > $north2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {       $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                    }

                                                }
                                        }
                                        else
                                        {
                                                $i = 0;
                                                while (isset($rec_id[$i]))
                                                {
                                                        $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        if ($r['field8']!="NONE")
                                                        {
                                                                $img_card = $r['field8'];
                                                                echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                break;
                                                        }
                                                        $i++;
                                                }      
                                        }
                                }
                                else
                                {
                                        $i = 0;
                                        while (isset($rec_id[$i]))
                                        {
                                                $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                $q = mysql_query($sql);
                                                $r = mysql_fetch_assoc($q);
                                                if ($r['field8']!="NONE")
                                                {
                                                        $img_card = $r['field8'];
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        break;
                                                }
                                                $i++;
                                        }
                                }
                                closeConn(); #-- closes TCP Ports connected to the database --#
                        ?>
                        </div></a> <!-- end of div for current row-->
                       
                        <a href="game_board.php?field_id=009"><div class="field">
                                <?php
                                connectDB(); #-- opens a TCP port to the database --#
                                #--checks if there is a value in card_id if true stores it into a session called card_id--#
                                if(isset($_GET['card_id']))
                                {
                                        $_SESSION['card_id'] = $_GET['card_id'];
                                }
                                #-- checks if there is a value in field_id if true executes the condition statement --#
                                if(isset($_GET['field_id']))
                                {
                                        if($_GET['field_id'] == '009')
                                        {
                                                if (isset($_SESSION['card_id']))
                                                {
                                                        $_SESSION['card_id_009'] = $_SESSION['card_id'];
                                                        $sql = "select * from tblcard where card_id = ".$_SESSION['card_id_009'];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);
                                                        $img_card = $r['image'];
                                                        $card_id = $_SESSION['card_id_009'];
                                                        $player_id = $_SESSION['p_id'];
                                                        $sql = "insert into tblboard(field9, room_id, card_id, player_id) values('$img_card', '$room_id', '$card_id', '$player_id')";
                                                        $q = mysql_query($sql);
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        $room_id = getRoomID();
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field8']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field8 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field9 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($north1 > $south2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                        }
                                                        $sql = "select * from tblboard where room_id = $room_id";
                                                        $q1 = mysql_query($sql);
                                                        while($r1 = mysql_fetch_assoc($q1))
                                                        {
                                                            if($r1['field6']!="NONE")
                                                            {
                                                                $sql = "select * from tblboard where field6 != \"NONE\"";
                                                                $q = mysql_query($sql);
                                                                $r = mysql_fetch_assoc($q);
                                                                $card2 = $r['card_id'];
                                                                if ($r['player_id']!=$_SESSION['p_id'])
                                                                {
                                                                        $sql = "select * from tblboard where field9 != \"NONE\"";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $card1 = $r['card_id'];
                                                                        $sql = "select * from tblcard where card_id = $card1";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north1 = $r['north'];
                                                                        $south1 = $r['south'];
                                                                        $west1 = $r['west'];
                                                                        $east1 = $r['east'];
                                                                        $sql = "select * from tblcard where card_id = $card2";
                                                                        $q = mysql_query($sql);
                                                                        $r = mysql_fetch_assoc($q);
                                                                        $north2 = $r['north'];
                                                                        $south2 = $r['south'];
                                                                        $west2 = $r['west'];
                                                                        $east2 = $r['east'];
                                                                        if($west1 > $east2)
                                                                        {
                                                                                $i = 0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card2";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                                $i=0;
                                                                                while (isset($p_rec_id[$i]))
                                                                                {
                                                                                        $sql = "update tblplayer_card set used = \"DEAD\" where rec_id = ".$p_rec_id[$i]." and card_id = $card1";
                                                                                        $q = mysql_query($sql);
                                                                                        $i++;
                                                                                }
                                                                        }
                                                                }
                                                            }
                                                       }
                                                    }
                                        }

                                        else
                                        {
                                                $i = 0;
                                                while (isset($rec_id[$i]))
                                                {
                                                        $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_assoc($q);    
                                                        if ($r['field9']!="NONE")
                                                        {
                                                                $img_card = $r['field9'];
                                                                echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                                break;
                                                        }
                                                        $i++;
                                                }      
                                        }
                                }
                                else
                                {
                                        $i = 0;
                                        while (isset($rec_id[$i]))
                                        {
                                                $sql = "select * from tblboard where rec_id = ".$rec_id[$i];
                                                $q = mysql_query($sql);
                                                $r = mysql_fetch_assoc($q);
                                                if ($r['field9']!="NONE")
                                                {
                                                        $img_card = $r['field9'];
                                                        echo "<img src=\"$img_card\" class=\"card\" title=\"North: $north[$index]\n South: $south[$index]\n West: $west[$index]\n East: $east[$index]\">";
                                                        break;
                                                }
                                                $i++;
                                        }
                                }
                                closeConn(); #-- closes TCP Ports connected to the database --#

                               
                        ?>
                        </div></a> <!-- end of div for current row-->
                        <?php
                         connectDB();
                                	$sql = "select * from tblplayer_card where used = \"DEAD\"";
                                	$q = mysql_query($sql);
                                	while($r = mysql_fetch_assoc($q))
             						{
                                		$delete_card = $r['card_id'];
                                		$sql = "delete from tblboard where card_id = $delete_card";
                                        $q1 = mysql_query($sql);
	                                }
                                	 
                                    #-- Win condition if board fills up --#
                                    $sql = "select * from tblboard where player_id = ".$_SESSION['p_id'];
                                    $q = mysql_query($sql);
                                    $player1_count = mysql_num_rows($q);

                                    $sql = "select * from tblboard where player_id != ".$_SESSION['p_id'];
                                    $q = mysql_query($sql);
                                    $player2_count = mysql_num_rows($q);

                                    if(($player1_count + $player2_count) == 9)
                                    {
                                        if($player1_count < 5)
                                        {
                                            echo 'You Lose!';
                                        }
                                        else
                                            echo 'You Win!';
        
                                    }
                                    #-- Win condition if board fills up --#

                                    #-- Win condition if players use all the cards--#
                                    $sql = "select * from tblplayer_card where used = \"DEAD\" or \"ON BOARD\"";
                                    $q = mysql_query($sql);
                                    $card_count = mysql_num_rows($q);

                                    if($card_count == 50)
                                    {
                                        if($player1_count > $player2_count)
                                        {
                                            echo 'You Win!';
                                        }
                                        if($player1_count == $player2_count)
                                        {
                                            echo 'draw'; 
                                        }
                                        else
                                        {
                                            echo 'You Lose!';
                                        }
                                    }
                                    #-- Wind codition if players use all the cards--#
                         closeConn();
                         ?>
                </div>
        </div>
</body>
