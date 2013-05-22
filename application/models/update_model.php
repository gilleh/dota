<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
			$this->load->database();
        }
        function updateMatches($data)
        {
            $this->db->insert('dota_matches',$data);
        }
    }
	
?>