<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dota project</title>
</head>
<style>
body {
	background-color:#232425;
	color:#CCC;
	font-family:Verdana, Geneva, sans-serif;
}
.herorow {
	height:71px;
	padding:4px;
	text-align:right;
	margin-bottom:2px;
	
}
.heroname {
	top:-30px;
	position:relative;
	margin-right:10px;
}
img {
}
#container {
	width:1000px;
	margin-left:auto;
	margin-right:auto;
}
.herobox {
	height:150px;
	clear:none;
	display:inline-block;
	text-align:center;
}
.matchbox {
	background-color:#333;
	padding:10px;
	border:solid 2px #963;
	border-radius:4px;
}
</style>
<body>
<div id="container">
<?php

	$totalh = count($heroes->heroes->hero);
	$heroa = array();
	for($i=0;$i<$totalh;$i++)
	{
		$heroname = $heroes->heroes->hero[$i]->name;
		$heroname = substr($heroes->heroes->hero[$i]->name, 14);
		if ($heroname != "legion_commander" && $heroname != "abaddon")
		{		
			$imgsrc = "http://media.steampowered.com/apps/dota2/images/heroes/".$heroname."_hphover.png";
			if ($heroname == "magnataur"){
				$heroname = "magnus";
			} 
			if ($heroname == "obsidian_destroyer"){
				$heroname = "outworld_devourer";				
			}
			$heroname = str_replace("_", " ", $heroname);
			//echo '<div class="herorow"><span class="heroname">'.ucfirst($heroname).'</span><img src="'.$imgsrc.'"></div>';
			$heroa[(int)$heroes->heroes->hero[$i]->id][0] = ucwords($heroname);
			$heroa[(int)$heroes->heroes->hero[$i]->id][1] = $imgsrc;
		}
	}
	
	$matchtype = array();
	$matchtype[6] = "Not set";
	$matchtype[5] = "Team Match";
	$matchtype[4] = "Co-op with Bots";
	$matchtype[3] = "Tutorial";
	$matchtype[2] = "Tournament";
	$matchtype[1] = "Practice";
	$matchtype[0] = "Public Matchmaking";
	$matchtype[-1] = "Invalid";
	$gamemode[0] = "All Pick";
	$gamemode[1] = "Single Draft";
	$gamemode[2] = "All Random";
	$gamemode[3] = "Random Draft";
	$gamemode[4] = "Captain's Draft";
	$gamemode[5] = "Captain's Mode";
	$gamemode[6] = "Death Mode";
	$gamemode[7] = "Diretide";
	$gamemode[8] = "Reverse Captain's Mode";
	$gamemode[9] = "The Greeviling";
	$gamemode[10] = "Tutorial";
	$gamemode[11] = "Mid Only";
	$gamemode[12] = "Least Played";
	$gamemode[13] = "New Player Pool";

	echo '<div class="matchbox">';
	echo "<div>Match Id: ".$match_id.' <a href="../">Back</a></div>';
	echo "Match type: ".$matchtype[(int)$match->lobby_type].'<br>';
	echo "Dire<br>";
	for ($x=0;$x<count($match->players->player);$x++)
	{
		if ($match->players->player[$x]->player_slot >= 0 && $match->players->player[$x]->player_slot < 5)
		{
			echo '<div class="herobox">'.$heroa[(int)$match->players->player[$x]->hero_id][0].'<br><img src="'.$heroa[(int)$match->players->player[$x]->hero_id][1].'"/></div>';
		}
	}
	echo "<br>Radiant<br>";
	for ($x=0;$x<count($match->players->player);$x++)
	{
		if ($match->players->player[$x]->player_slot > 5)
		{
			echo '<div class="herobox">'.$heroa[(int)$match->players->player[$x]->hero_id][0].'<br><img src="'.$heroa[(int)$match->players->player[$x]->hero_id][1].'"/></div>';
		}
	}
	?>
    <ul>
    <li>Season:  <?php echo	$match->season;?></li>
 
    <?php
	if ($match->radiant_win == "true")
	{
		echo '<li>Radiant win</li>';
	} 
	else 
	{
		echo '<li>Dire win</li>';
	}
	?>
    
    <?php
	echo '<li>Duration: '.$match->duration.'</li>';
	echo '<li>Start date/time: '.date('d/m/Y h:i:s',(int)$match->start_time).'</li>';
	echo '<li>Match id: '.$match->match_id.'</li>';
	echo '<li>Match sequence number: '.$match->match_seq_num.'</li>';
	echo '<li>Tower status Radiant: '.decbin($match->tower_status_radiant).'</li>';
	echo '<li>Tower status Dire: '.decbin($match->tower_status_dire).'</li>';
	echo '<li>Barracks status Radiant: '.decbin($match->barracks_status_radiant).'</li>';
	echo '<li>Barracks status Dire: '.decbin($match->barracks_status_dire).'</li>';
	echo '<li>Cluster: '.$match->cluster.'</li>';
	$hours = "0".floor($match->first_blood_time / 3600);	
	$mins = floor(($match->first_blood_time - ($hours*3600)) / 60);
	if ($mins < 10){
		$mins = "0".$mins;
	}
	$secs = ($match->first_blood_time%60);
	echo '<li>First blood time: '.$hours.":".$mins.":".$secs.'</li>';
	echo '<li>Lobby type: '.$match->lobby_type.'</li>';
	echo '<li>Human players: '.$match->human_players.'</li>';
	echo '<li>League id: '.$match->leagueid.'</li>';
	echo '<li>Positive votes: '.$match->positive_votes.'</li>';
	echo '<li>Negative votes: '.$match->negative_votes.'</li>';
	echo '<li>Game mode: '.$gamemode[(int)$match->game_mode].'</li>';
	echo '</div>';


?>
</ul>
</div>
</body>
</html>