<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($view)
	{
		//$this->load->view('welcome_message');
		$this->load->helper('xml');
		$url = "https://api.steampowered.com/IEconDOTA2_570/GetHeroes/v0001/?key=C2F12A9910099D2B914436795669B1F1&format=XML";
		$xml = file_get_contents($url);
		$data['heroes'] = new SimpleXMLElement($xml);
		
		xml_convert($data['heroes']);
		
        return $this->load->view($view, $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */