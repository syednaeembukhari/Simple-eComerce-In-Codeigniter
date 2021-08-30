<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class thankyou extends CI_Controller {
	var $data;
	function __construct()
	{
		parent::__construct();
		$this->load->model('products_model');
		$this->load->model('orders_model');
		$this->load->library('form_validation');
		$this->lang->load('front', LANG);
	}
	public function index()
	{
		
		$this->data['orderinfo']=$this->orders_model->get_order_byid($this->session->userdata('orderid'));
	
		$this->load->view(active_theme().'/thankyou',$this->data);
		//$this->session->unset_userdata('cartdata');
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */