<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	
	public function index()
	{	
        $this->load->model('update_model');
		$this->load->helper('xml');
		echo 'Updating latest matches...<br/>';
		$url = "https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/v001/?key=C2F12A9910099D2B914436795669B1F1&format=XML";
		$file = file_get_contents($url);
		$matches = new SimpleXMLElement($file);
		
		xml_convert($matches);
		$match = $matches->matches->match;
		for ($i=0;$i<count($match);$i++){
			
			if (count($match[$i]->players->player) != 10)
			{
				for ($x=count($match[$i]->players->player);$x<10;$x++)
				{
					$match[$i]->players->player[$x]->account_id = "";
					$match[$i]->players->player[$x]->player_slot = "";
					$match[$i]->players->player[$x]->hero_id = "";
				}
			}
			$data = array(
			   'match_id' => $match[$i]->match_id,
			   'match_seq_num' => $match[$i]->match_seq_num,
			   'start_time' => $match[$i]->start_time,
			   'lobby_type' => $match[$i]->lobby_type,
			   
			   'player1' => $match[$i]->players->player[0]->account_id.'|'.$match[$i]->players->player[0]->player_slot.'|'.$match[$i]->players->player[0]->hero_id,
			   'player2' => $match[$i]->players->player[1]->account_id.'|'.$match[$i]->players->player[1]->player_slot.'|'.$match[$i]->players->player[1]->hero_id,
			   'player3' => $match[$i]->players->player[2]->account_id.'|'.$match[$i]->players->player[2]->player_slot.'|'.$match[$i]->players->player[2]->hero_id,
			   'player4' => $match[$i]->players->player[3]->account_id.'|'.$match[$i]->players->player[3]->player_slot.'|'.$match[$i]->players->player[3]->hero_id,
			   'player5' => $match[$i]->players->player[4]->account_id.'|'.$match[$i]->players->player[4]->player_slot.'|'.$match[$i]->players->player[4]->hero_id,
			   'player6' => $match[$i]->players->player[5]->account_id.'|'.$match[$i]->players->player[5]->player_slot.'|'.$match[$i]->players->player[5]->hero_id,
			   'player7' => $match[$i]->players->player[6]->account_id.'|'.$match[$i]->players->player[6]->player_slot.'|'.$match[$i]->players->player[6]->hero_id,
			   'player8' => $match[$i]->players->player[7]->account_id.'|'.$match[$i]->players->player[7]->player_slot.'|'.$match[$i]->players->player[7]->hero_id,
			   'player9' => $match[$i]->players->player[8]->account_id.'|'.$match[$i]->players->player[8]->player_slot.'|'.$match[$i]->players->player[8]->hero_id,
			   'player10' => $match[$i]->players->player[9]->account_id.'|'.$match[$i]->players->player[9]->player_slot.'|'.$match[$i]->players->player[9]->hero_id,
			); 
			
			$this->update_model->updateMatches($data);
		} 
		echo 'Successfully updated matches...';
		// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
	}
}