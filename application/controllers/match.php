<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Match extends CI_Controller {

	public function index($id = FALSE)
	{		
		if ($id){
			$this->load->helper('xml');
			$this->load->model('hero_model');

			//$url = "match_195937703.xml";
			$url ="https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/v001/?key=C2F12A9910099D2B914436795669B1F1&format=XML&match_id=".$id;
			$xml = file_get_contents($url);

			$data['heroes'] = $this->hero_model->getHeroes();
			$data['match'] = new SimpleXMLElement($xml);
			
			xml_convert($data['match']);
			$data['match_id'] = $id;
	        return $this->load->view('match', $data);
    	} else {
    		header('Location: http://localhost/dota/');
    	}
	}
}