<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {
	var $data;
	function __construct()
	{
		parent::__construct();
		$this->data['msg']='';
		is_admin_user();
		$this->data['productid']=0;
		$this->load->model('products_model');
		$this->lang->load('front', ADMINLANG);
	}
	public function index()
	{
		$this->load->view('admin/dashboard',$this->data);
	}
	public function changepassword()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password',  'Password', 'trim|required');	
		$this->form_validation->set_rules('password2',  'Re-Enter Password', 'trim|required|matches[password]');	
		
		
		if ($this->form_validation->run() == FALSE) 
		{
				$this->data['msg'] = validation_errors();
		}
		else
		{
			$this->load->model('auth_model');
			$this->auth_model->changepassword($this->input->post('password'),$this->session->userdata('loginid'));
			$this->data['msg'] = 'Password has been changed';
		}
		$this->load->view('admin/changepassword',$this->data);
	}
	
	function upload_banner()
	{
		//echo  "i am here ";
		$this->load->view('admin/banner_uploader');
		
	}
	function upload_logo()
	{
		//echo  "i am here ";
		$this->load->view('admin/common_ajax/logo_uploader');
		
	}
	function products($offset=0,$limit=0)
	{
		if($offset==0)
		die();
		
		$this->data['offset']=$offset;
		$this->data['limit']=$limit;
		
		
		$this->data['products']=$this->products_model->get_products($this->data['offset'],$this->data['limit']);
		$this->load->view('admin/dashboard_products',$this->data);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */