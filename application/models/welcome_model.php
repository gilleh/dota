<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
			$this->load->database();
        }
        
        function getMatches()
        {
            return $this->db->get('dota_matches');
        }
    }
	
?>