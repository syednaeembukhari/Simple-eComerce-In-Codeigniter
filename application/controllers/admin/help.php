<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class help extends CI_Controller {
	var $data;
	function __construct()
	{
		parent::__construct();
		$this->data['msg']='';
		is_admin_user();
		
		$this->load->helper('thumb');
		$this->load->model('products_model');
		$this->load->model('orders_model');
		$this->load->library('form_validation');
		$this->lang->load('front', ADMINLANG);
	}
	public function index()
	{
		$this->load->view('admin/under_construction',$this->data);
		
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */