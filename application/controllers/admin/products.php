<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class products extends CI_Controller {
	var $data;
	function __construct()
	{
		parent::__construct();
		$this->data['msg']='';
		is_admin_user();
		
		$this->load->helper('thumb');
		$this->load->model('products_model');
		$this->load->model('categories_model');
		$this->load->library('form_validation');
		$this->lang->load('front', ADMINLANG);
	}
	public function index()
	{
		$this->load->view('admin/products/products',$this->data);
	}
	function prep_product_id()
	{
		
		$this->data['productid']=get_new_productid();
		redirect('admin/products/addproducts/'.$this->data['productid']);
		die();
	}
	
	public function addproducts($productid=0)
	{
		$this->data['productid']=$productid;
		if($this->data['productid']<=0)
		{
				redirect('admin/products/prep_product_id');
				die();
		}
		$this->data['productsku']=date('ymdhis');
		 
		$this->data['productdata']=$this->products_model->get_product($this->data['productid'],'add');
		if($this->data['productdata']->num_rows()>0)
		{
			//echo "here";
			$productinfo=$this->data['productdata']->row();
			$this->data['productsku']=($productinfo->sku==''?$this->data['productsku']:$productinfo->sku);
			if($productinfo->isdeleted==1)
			redirect('admin/products/prep_product_id');
		}
		//$this->form_validation->set_rules('sku',  'Product SKU', 'trim|required|min_length[3]|max_length[15]|callback_product_sku_check');	
		$this->form_validation->set_rules('title',  	'Product Title', 'trim|required');
		$this->form_validation->set_rules('instock',	'Stock Inhand', 'trim|required|greater_than[-1]');
		$this->form_validation->set_rules('sprice',  	'Product Sale Price', 'trim|required');
		$this->form_validation->set_rules('detail',  	'Product Description', 'trim|required');
			
		
		if(isset($_POST['is_ajax']))
		if ($this->form_validation->run() == FALSE) 
		{
				$this->data['msg'] = validation_errors();
				echo json_encode( array('status'=>'error', 'msg'=>$this->data['msg']));
				die();
		}
		else
		{
			
			$this->products_model->update_product(
										$this->data['productid'],$this->input->post('sku'), $this->input->post('title'), 
										$this->input->post('detail'),$this->input->post('pprice'),$this->input->post('sprice'),
										$this->input->post('dprice'), $this->input->post('instock')
									);
			$this->products_model->update_product_categories($this->data['productid'],$this->input->post('categories'));
			echo json_encode( array('status'=>'added', 'msg'=>'Product data saved.'));
			die();
		}
		if(!isset($_POST['is_ajax']))
		$this->load->view('admin/products/add_product',$this->data);
	}
	public function product_sku_check($sku)
	{
		$chk=$this->products_model->get_sku_check($sku,$this->data['productid']);
		if ($chk>0)
		{
			$this->form_validation->set_message('product_sku_check', 'The %s field must be unique');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function add_image($productid=0,$imageno=1)
	{
		$this->data['productid']=$productid;
		$this->data['imageno']=$imageno;
		$this->load->view('admin/products/image_upload',$this->data);
	}
	
	
	
	function category_edit($catid)
	{
		
		$this->data['category']=$this->categories_model->get_category_byid($catid);
		$this->load->view( 'admin/categories/category_edit' , $this->data);
	}
	function deletecategory()
	{
		//sleep(3);
		$data['error']='yes';
		$data['msg']='';
		if(isset($_POST['is_ajax']))
		{
			$this->categories_model->delete_category($_POST['catid']);
			$data['error']='no';
			$data['msg']='Category Deleted';
			echo json_encode($data);
		}
		die();
	}
	function updatecategory()
	{
		//sleep(3);
		$data['error']='yes';
		$data['msg']='';
		if(isset($_POST['is_ajax']))
		{
			$this->categories_model->update_category($_POST['catid'],$_POST['catname']);
			$data['error']='no';
			$data['msg']='Category Updated';
			echo json_encode($data);
		}
		die();
	}
	function hide_product($productid=0)
	{
		$this->data['productid']=$productid;
		$this->db->set('status','Inactive') ;
		$this->db->where('productid',$productid);
		$this->db->update(PRODUCTS);
		$data['result']='success';
		$data['message']='Product hide from front area';
		echo json_encode($data);
	}
	
	function show_product($productid=0)
	{
		$this->data['productid']=$productid;
		$this->db->set('status','Active') ;
		$this->db->where('productid',$productid);
		$this->db->update(PRODUCTS);
		$data['result']='success';
		$data['message']='Product hide from front area';
		echo json_encode($data);
	}
	
	
	function del_product($productid=0)
	{
		$this->data['productid']=$productid;
		$this->load->view('admin/common_ajax/del_product',$this->data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */