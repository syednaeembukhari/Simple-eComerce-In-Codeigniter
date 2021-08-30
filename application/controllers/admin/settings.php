<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class settings extends CI_Controller {
	var $data;
	function __construct()
	{
		parent::__construct();
		$this->data['msg']='';
		is_admin_user();
		$this->data['productid']=0;
		$this->load->model('products_model');
		$this->load->model('main_model');
		$this->lang->load('front', ADMINLANG);
	}
	public function index()
	{
		$this->data['countries']=$this->main_model->get_countries();
		$this->load->view('admin/settings/settings',$this->data);
	}
	
	function cities()
	{
		$this->data['country']=$this->main_model->get_country_byiso3(get_store_settings('COUNTRYISO3'));
		$this->data['country_cities']=$this->main_model->get_country_cities($this->data['country']->countryid);
		$this->data['timezone']=$this->main_model->get_country_timezone($this->data['country']->countryid);
		$this->load->view('admin/settings/settings-cities',$this->data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */