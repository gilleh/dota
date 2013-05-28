<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hero_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
			$this->load->database();
        }
        function getHeroes()
        {
            $this->load->helper('xml');
            $url = "heroes.xml";
            $xml = file_get_contents($url);
            $heroes = new SimpleXMLElement($xml);

            xml_convert($heroes);

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
                    if ($heroname == "wisp"){
                        $heroname = "io";
                    }
                    $heroname = str_replace("_", " ", $heroname);
                    //echo '<div class="herorow"><span class="heroname">'.ucfirst($heroname).'</span><img src="'.$imgsrc.'"></div>';
                    $heroa[(int)$heroes->heroes->hero[$i]->id][0] = ucwords($heroname);
                    $heroa[(int)$heroes->heroes->hero[$i]->id][1] = $imgsrc;
                }
            }
            return $heroa;
        }
    }
	
?>