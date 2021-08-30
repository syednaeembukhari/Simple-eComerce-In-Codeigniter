<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class products extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('products_model');
		$this->lang->load('front', LANG);
		//echo $this->lang->line('frm_fullname');die;
	}
	public function index()
	{
		$this->load->view(active_theme().'/home/home');
	}
	
	public function detail($productsku='',$product_slug='')
	{
		//print_r($productsku); die;
		if($productsku=='')
		redirect('/');
		$this->data['product']=$this->products_model->get_product_bysku($productsku);
		if($this->data['product']->num_rows()<=0)
		redirect('pageerror');
		$this->data['productid']=$this->data['product']->row()->productid;
		
		$countryiso3= $this->main_model->get_country_byiso3(get_store_settings('COUNTRYISO3'))->countryid;
		$this->data['cities']=$this->main_model->get_country_cities($countryiso3)->result();
		
		$this->load->view(active_theme().'/products/product',$this->data);
	}
	
	function addtocart($productid=0)
	{
		//sleep(3);
		//$this->session->set_userdata($newdata);
		$this->session->unset_userdata('order_error');
		$cartid=$this->session->userdata('cart_id');
		if( $cartid=='' || $cartid==0)
		$this->session->set_userdata(array('cart_id'=>date('Y-m-d-H:i:s-').rand(1001,9999)));
		
		//pre_print($this->session->all_userdata());
		$data['msg']='';
		$data['status']='error';
		if($productid==0)
		{
			$data['msg']='Could not added to cart';
			$data['status']='error';
		}
		else
		{
			$this->data['product']=$this->products_model->get_product_byid($productid);
			if($this->data['product']->num_rows()<=0)
			{
				$data['msg']='Product not found';
				$data['status']='error';
			}
			else if($this->data['product']->row()->instock<=0)
			{
				$data['msg']='Product is out of stock';
				$data['status']='error';
			}
			else
			{
				$this->products_model->cart_add_product_temp($productid);
				$data['msg']='Successfully added to your cart';
				$data['status']='success';
			}
		}
		$data['itemcount']=count_temp_cart_items();
		echo json_encode($data);
	}
	
	function updatecart()
	{
		$qtydata=$this->input->post('qtydata');
		foreach($qtydata as $a)
		{
			$this->products_model->cart_update_qty($this->session->userdata('cart_id'),$a['name'],$a['value']);
		}
		
	}
	
	function cartitem_removed_confirmed($tempid=0)
	{
		if(isset($_POST['is_ajax']))
		{
			$this->products_model->cart_itemdelete($tempid);
		}
		die();
	}
	
	function cartitem_remove($tempid=0)
	{
		$this->data['tempid']=$tempid;
		$this->load->view(active_theme().'/customers/cart/item_remove_dialog',$this->data);
	}
	
	public function category($category_slug='')
	{
		if($category_slug=='')
		redirect('/');
		
		$this->data['cat_product']=$this->products_model->get_product_bycategory($category_slug);
		//if($this->data['product']->num_rows()<=0)
		//redirect('pageerror');
		$this->load->view(active_theme().'/categories/categories',$this->data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */