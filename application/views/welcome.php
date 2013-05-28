<?php
//die('Access denied.');

?>
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
//echo '<pre>';
//print_r($matches);
//exit();

$totalm = count($matches);
$matchtype = array(
"-1" => "Invalid",
"0" => "Public Matchmaking",
"1" => "Practice",
"2" => "Tournament",
"3" => "Tutorial",
"4" => "Co-op with Bots",
"5" => "Team Match",
"6" => "Not set");
//var_dump($matches);
for($i=0;$i<$totalm;$i++)
{
	$match = $matches[$i];
	$valid_match = TRUE;
	for ($x=1;$x<=10;$x++)
	{
		${"player".$x} = explode("|", $match->{"player".$x});
		if (${"player".$x}[0] == "" || ${"player".$x}[1] == "" || ${"player".$x}[2] == ""){
			$valid_match = FALSE;
		}
	}

	if ($valid_match){
		echo '<div class="matchbox">';
		echo "<div>Match Id: ".$match->match_id.' <a href="match/'.$match->match_id.'">View Match</a></div>';
		echo "Match type: ".$matchtype[(int)$match->lobby_type].'<br>';
		echo "Dire<br>";	
		for ($x=1;$x<=5;$x++)
		{
			if (${"player".$x}[1] !== "" && ${"player".$x}[1] >= 0 && ${"player".$x}[1] < 5){
				echo '<div class="herobox">'.$heroes[(int)${"player".$x}[2]][0].'<br><img src="'.$heroes[(int)${"player".$x}[2]][1].'"/></div>';
			}
		}
		echo "<br>Radiant<br>";
		for ($x=5;$x<=10;$x++)
		{
			${"player".$x} = explode("|", $match->{"player".$x});
			if (${"player".$x}[1] !== "" && ${"player".$x}[1] > 5){
				echo '<div class="herobox">'.$heroes[(int)${"player".$x}[2]][0].'<br><img src="'.$heroes[(int)${"player".$x}[2]][1].'"/></div>';
			}
		}
		echo '</div>';
		echo '<br>';
		echo '<br>';
	}
}

?> </div> </body> </html>