<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends CI_Controller {
	var $data;
	function __construct()
	{
		parent::__construct();
		$this->data['msg']='';
		$this->lang->load('front', ADMINLANG);
	}
	public function index()
	{
		die();
	}
	
	function update_settings()
	{
		//sleep(3);
		if(isset($_POST['is_ajax']))
		{
			$this->main_model->update_store_settings($_POST['name'],$_POST['values']);
			echo json_encode(array('message' => 'Settings Updated Successfully','result'=>'success'));
		}else
			echo json_encode(array('message' => 'You dont have permissions','result'=>'error'));
			 
	}
	function deleteimg($productid=0,$imageno=1)
	{
		$this->load->model('products_model');
		$this->products_model->delete_product_image($productid,$this->input->post('deleteimg'));
		echo json_encode(array('message' => 'Image Successfuly deleted','result'=>'success'));
	}
	
	
	function upload_image($productid=0,$imgno=1)
	{
		
		$imgno=$imgno<=0?1:$imgno;
		$data['error']='no';
		$data['msg']='';
		$data['fileurl']='';
		$data['imgno']=$imgno;
		
		$this->data['productid']=$productid;
		if($this->data['productid']>0)
		{
			$config['upload_path'] = './'.PRODUCT_UPLOAD_PATH.'/';
			$config['allowed_types'] = 'png|jpg';
			$config['max_size']	= '10000';
			
	
			$this->load->library('upload', $config);
	
			if ( ! $this->upload->do_upload('FileInput'))
			{
				$data['error']='yes';
				$data['msg']=$this->upload->display_errors();
				$data['fileurl']='';
			}
			else
			{
				$upload_data = $this->upload->data();
				$filepath=$upload_data['file_name'];
				//$filename=$upload_data['orig_name'];
				//$attachdate=date('Y-m-d H:i:s');
				
				// resize -image 
				
				$this->load->helper('thumb');
				$thumb = PhpThumbFactory::create('./'.PRODUCT_UPLOAD_PATH.'/'.$filepath);  
				//$thumb->resize(800, 600)->save($targetPath.$new_fileName.$extension);
				//$thumb->adaptiveResize(400, 400)->save($targetPath.$new_fileName.'4x4'.$extension);
				$thumb->adaptiveResize(1200, 1200)->save('./'.PRODUCT_UPLOAD_PATH.'/1200x1200-'.$filepath);
				$thumb->adaptiveResize(600, 600)->save('./'.PRODUCT_UPLOAD_PATH.'/600x600-'.$filepath);
				$thumb->adaptiveResize(400, 400)->save('./'.PRODUCT_UPLOAD_PATH.'/'.$filepath);
				
				
				$this->load->model('products_model');
				$this->products_model->save_product_image($this->data['productid'],$filepath,$imgno);
				$data['error']='no';
				$data['msg']='Image uploaded successfully';
				$data['fileurl']=base_url().PRODUCT_UPLOAD_PATH.'/'.$filepath;
				
			}
			
		}
		else
		{
			$data['error']='yes';
			$data['msg']='Error while uploading your file';
			$data['fileurl']='';
		}
		echo json_encode($data);
	}
	
	function banner_upload()
	{
		
		$data['error']='no';
		$data['msg']='';
		$data['fileurl']='';
		$config['upload_path'] = './'.MEDIA_UPLOAD_PATH.'/banners/';
		$config['allowed_types'] = 'png|jpg';
		$config['max_size']	= '10000';
		

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('FileInput'))
		{
			$data['error']='yes';
			$data['msg']=$this->upload->display_errors();
			$data['fileurl']='';
		}
		else
		{
			$upload_data = $this->upload->data();
			$filepath=$upload_data['file_name'];
			//$filename=$upload_data['orig_name'];
			//$attachdate=date('Y-m-d H:i:s');
			$current_banner=get_store_settings('BANNER_IMG');
			if($current_banner!='')
			{
				@unlink('./'.MEDIA_UPLOAD_PATH.'/banners/'.$current_banner);
			}
			$this->main_model->update_store_settings('BANNER_IMG',$filepath);
			
			$data['error']='no';
			$data['msg']='Banner successfully Uploaded';
			$data['fileurl']=base_url().MEDIA_UPLOAD_PATH.'/banners/'.$filepath;
			
		}
		echo json_encode($data);
	}
	
	function logo_upload()
	{
		
		$data['error']='no';
		$data['msg']='';
		$data['fileurl']='';
		$config['upload_path'] = './'.MEDIA_UPLOAD_PATH.'/common/';
		$config['allowed_types'] = 'png|jpg';
		$config['max_size']	= '10000';
		

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('FileInput'))
		{
			$data['error']='yes';
			$data['msg']=$this->upload->display_errors();
			$data['fileurl']='';
		}
		else
		{
			$upload_data = $this->upload->data();
			$filepath=$upload_data['file_name'];
			
			$current_banner=get_store_settings('LOGO_IMG');
			if($current_banner!='')
			{
				@unlink('./'.MEDIA_UPLOAD_PATH.'/common/'.$current_banner);
			}
			$this->main_model->update_store_settings('LOGO_IMG',$filepath);
			
			$data['error']='no';
			$data['msg']='Banner successfully Uploaded';
			$data['fileurl']=base_url().MEDIA_UPLOAD_PATH.'/common/'.$filepath;
		}
		echo json_encode($data);
	}
	
	function free_shipping_change()
	{
		$this->load->view('admin/common_ajax/free_shipping_change',$this->data);
	}
	function call_help_change()
	{
		$this->load->view('admin/common_ajax/call_help_change',$this->data);
	}
	
	
	function add_category()
	{
		//print_r($_POST);
		$response=array(
			'msg'=>''
		);
		if(isset($_POST['is_ajax']))
		{
			if($_POST['catname']!='')
			{
				$this->load->model('categories_model');
				$catid=$this->categories_model->add_category($_POST['catname']);
				if($catid>0)
				{
					$res=$this->categories_model->get_category_byid($catid);
					if($res->num_rows()>0)
					{
						$cat=$res->row();
						$response['msg']='added';
						$response['catli']=$this->load->view( 'admin/categories/category_li' , array('cat'=>$cat),true);
					}
					else
					$response['msg']			='Error:Try Later';
				}
				else
				$response['msg']			='Already Exists';
			}
			else
			$response['msg']			='Category name required';
			
			echo json_encode($response);
		}
		die();
	}
	
	
	function ship_order()
	{
		if(isset($_POST['is_ajax']))
		{
			if(isset($_POST['orderid']))
			{
				$this->load->model('orders_model');
				$this->orders_model->update_shipping_order($_POST['orderid'],$_POST['shippinglabel']);
				echo $_POST['orderid'];
			}
			die();
		}
		die();
	}
	
	function cancel_order()
	{
		if(isset($_POST['is_ajax']))
		{
			if(isset($_POST['orderid']))
			{
				$this->load->model('orders_model');
				$this->orders_model->update_order_status($_POST['orderid'],'4');
				echo $_POST['orderid'];
			}
			die();
		}
		die();
	}
	
	function delete_product()
	{
		if(isset($_POST['is_ajax']))
		{
			if(isset($_POST['productid']))
			{
				$this->load->model('products_model');
				$this->products_model->delete_product($_POST['productid']);
			}
			die();
		}
		die();
		
	}
	function updatecity()
	{
		if(isset($_POST['is_ajax']))
		{
			if(isset($_POST['id']))
			{
				 
				$this->main_model->update_city($_POST['id'],$_POST['countryid'],$_POST['name'],$_POST['arabicname'],'',$_POST['shippingcharges']);
				echo json_encode(array('message' => 'City  Successfully Updated','result'=>'success'));
			}else
				echo json_encode(array('message' => 'You dont have permissions','result'=>'error'));
			 
		}else
		echo json_encode(array('message' => 'You dont have permissions','result'=>'error'));
		 
		
	}
	function delcity()
	{
		if(isset($_POST['is_ajax']))
		{
			if(isset($_POST['id']))
			{
				 
				$this->main_model->delete_city($_POST['id']);
				echo json_encode(array('message' => 'City  Successfully Deleted','result'=>'success'));
			}else
				echo json_encode(array('message' => 'You dont have permissions','result'=>'error'));
			 
		}else
		echo json_encode(array('message' => 'You dont have permissions','result'=>'error'));
		 
		
	}
	function addcity()
	{
		//sleep(3);
		if(isset($_POST['is_ajax']))
		{
			$countryid=$this->input->post('countryid');
			$name=$this->input->post('name');
			$arabicname=$this->input->post('arabicname');
			$timezone=$this->input->post('timezone');
			$shippingcharges=$this->input->post('shippingcharges');
			$check=$this->main_model->add_city($countryid,$name,$arabicname,$timezone, $shippingcharges);
			if($check==0)
				echo json_encode(array('message' => 'City already exists','result'=>'error'));	
			else
				echo json_encode(array('message' => 'City  Successfully Added','result'=>'success'));
		}else
			echo json_encode(array('message' => 'You dont have permissions','result'=>'error'));
			 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */