<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Update extends CI_Controller {
	
	public function index()
	{	
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	
		if ( ! $foo = $this->cache->get('foo'))
		{
			echo 'Saving to the cache!<br />';
			$url ="https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/v001/?key=C2F12A9910099D2B914436795669B1F1&format=XML&match_id=".$id;
			$foo = file_get_contents($url);
			//$foo = 'foobarbaz!';
			
			// Save into the cache for 5 minutes
			$this->cache->save('matches', $foo, 300);
		}
		
		echo $foo;
	}
}