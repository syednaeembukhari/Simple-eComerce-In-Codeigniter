<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		redirect('products');
		$this->lang->load('front', LANG);
	}
	public function index()
	{
		//$this->load->view('welcome_message');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */