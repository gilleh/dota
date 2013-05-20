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
		$heroname = str_replace("_", " ", $heroname);
		//echo '<div class="herorow"><span class="heroname">'.ucfirst($heroname).'</span><img src="'.$imgsrc.'"></div>';
		$heroa[(int)$heroes->heroes->hero[$i]->id][0] = ucwords($heroname);
		$heroa[(int)$heroes->heroes->hero[$i]->id][1] = $imgsrc;
	}
}

$totalm = count($matches->matches->match);
$matchtype = array();
$matchtype[6] = "Not set";
$matchtype[5] = "Team Match";
$matchtype[4] = "Co-op with Bots";
$matchtype[3] = "Tutorial";
$matchtype[2] = "Tournament";
$matchtype[1] = "Practice";
$matchtype[0] = "Public Matchmaking";
$matchtype[-1] = "Invalid";

for($i=0;$i<$totalm;$i++)
{
	$match = $matches->matches->match;
	echo '<div class="matchbox">';
	echo "<div>Match Id: ".$match[$i]->match_id.' <a href="match/'.$match[$i]->match_id.'">View Match</a></div>';
	echo "Match type: ".$matchtype[(int)$match[$i]->lobby_type].'<br>';
	echo "Dire<br>";
	for ($x=0;$x<count($match[$i]->players->player);$x++)
	{
		if ($match[$i]->players->player[$x]->player_slot >= 0 && $match[$i]->players->player[$x]->player_slot < 5)
		{
			echo '<div class="herobox">'.$heroa[(int)$match[$i]->players->player[$x]->hero_id][0].'<br><img src="'.$heroa[(int)$match[$i]->players->player[$x]->hero_id][1].'"/></div>';
		}
	}
	echo "<br>Radiant<br>";
	for ($x=0;$x<count($match[$i]->players->player);$x++)
	{
		if ($match[$i]->players->player[$x]->player_slot > 5)
		{
			echo '<div class="herobox">'.$heroa[(int)$match[$i]->players->player[$x]->hero_id][0].'<br><img src="'.$heroa[(int)$match[$i]->players->player[$x]->hero_id][1].'"/></div>';
		}
	}
	echo '</div>';
	echo '<br>';
	echo '<br>';
}

?>
</div>
</body>
</html>
