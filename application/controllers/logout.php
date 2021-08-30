<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->lang->load('front', LANG);
	}
	public function index()
	{
		$newdata = array(
                   	'loginid'  	=>0,
				   	'email'     	=>'',
				   	'usertype'	=>'',
				   	'loggedin' 	=> FALSE,
				   	'cart_id'    =>'',
					'session_id' =>''
               );
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		
		redirect('login');
	}
	
}