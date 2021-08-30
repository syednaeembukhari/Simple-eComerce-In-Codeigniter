<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customers extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('products_model');
		$this->load->library('form_validation');
		$this->lang->load('front', LANG);$this->lang->load('front', LANG);
	}
	public function index()
	{
		redirect('customers/cart');
	}
	
	function cart()
	{
		$this->data['cartitems']=get_temp_cart_items();
		$this->load->view(active_theme().'/customers/cart/cart', $this->data);
	}
	function cart_preview_page()
	{
		//pre_print($_POST);
		$this->data['cartitems']=get_temp_cart_items();
		if(isset($_POST['cartsubmitted']))
		{
			if(isset($_POST['signupemail']))
			{
				$this->form_validation->set_rules('signupemail',  	'Your Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('signuppass',  	'Password', 'trim|required');
				$this->form_validation->set_rules('signuppass2',  	'Confirm Password', 'trim|required|matches[signuppass]');	
			}
			
			$this->form_validation->set_rules('shippingfname',  	'Shipping First Name', 'trim|required');
			$this->form_validation->set_rules('shippinglname',  	'Shipping Last Name', 'trim|required');
			$this->form_validation->set_rules('shippingaddress',  	'Shipping Address', 'trim|required');	
			//$this->form_validation->set_rules('shippingaddress2',  'Shipping Address2', 'trim|required');	
			$this->form_validation->set_rules('shippingstate',  	'Shipping State', 'trim|required');	
			$this->form_validation->set_rules('shippingcity',  		'Shipping City', 'trim|required');	
			$this->form_validation->set_rules('shippingzip',  		'Shipping Zip', 'trim|required');	
			$this->form_validation->set_rules('shippingphone',  	'Shipping Phone', 'trim|required');	
			//$this->form_validation->set_rules('shippingstate',  	'Shipping State', 'trim|required');		
			
			$this->form_validation->set_rules('cardname',  			"Card holder's name", 'trim|required');	
			//$this->form_validation->set_rules('shippingaddress2',  'Shipping Address2', 'trim|required');	
			$this->form_validation->set_rules('cardno',  			'Card No', 'trim|required');	
			$this->form_validation->set_rules('cardmonth',  		'Card Expiry Month', 'trim|required');	
			$this->form_validation->set_rules('cardyear',  			'Card Expiry Year', 'trim|required');	
			$this->form_validation->set_rules('cardcvv',  			'Card CVV', 'trim|required');	
			
			if(!isset($_POST['billingsame']))
			{
				$this->form_validation->set_rules('billingfname',  		'Billing First Name', 'trim|required');
				$this->form_validation->set_rules('billinglname',  		'Billing Last Name', 'trim|required');
				$this->form_validation->set_rules('billingaddress',  	'Billing Address', 'trim|required');	
				//$this->form_validation->set_rules('billingaddress2',  'Billing Address2', 'trim|required');	
				$this->form_validation->set_rules('billingstate',  		'Billing State', 'trim|required');	
				$this->form_validation->set_rules('billingcity',  		'Billing City', 'trim|required');	
				$this->form_validation->set_rules('billingzip',  		'Billing Zip', 'trim|required');	
				$this->form_validation->set_rules('billingphone',  		'Billing Phone', 'trim|required');	
				//$this->form_validation->set_rules('billingstate',  		'Billing State', 'trim|required');
			}
			
			
			$sessiondata=array(
						
						'signupemail'			=>		$this->input->post('signupemail'),
						'signuppass'			=>		$this->input->post('signuppass'),
						'signuppass2'			=>		$this->input->post('signuppass2'),
						
						'shippingfname'			=>		$this->input->post('shippingfname'),
						'shippinglname'			=>		$this->input->post('shippinglname'),
						'shippingaddress'		=>		$this->input->post('shippingaddress'),
						'shippingaddress2'		=>		$this->input->post('shippingaddress2'),
						'shippingstate'			=>		$this->input->post('shippingstate'),
						'shippingcity'			=>		$this->input->post('shippingcity'),
						'shippingzip'			=>		$this->input->post('shippingzip'),
						'shippingphone'			=>		$this->input->post('shippingphone'),
				
						
						'cardname'				=>		$this->input->post('cardname'),
						'cardno'				=>		$this->input->post('cardno'),
						'cardmonth'				=>		$this->input->post('cardmonth'),
						'cardyear'				=>		$this->input->post('cardyear'),
						'cardcvv'				=>		$this->input->post('cardcvv'),
						
						
						'billingsame'			=>		$this->input->post('billingsame'),
						
						'billingfname'			=>		$this->input->post('billingfname'),
						'billinglname'			=>		$this->input->post('billinglname'),
						'billingaddress'		=>		$this->input->post('billingaddress'),
						'billingaddress2'		=>		$this->input->post('billingaddress2'),
						'billingstate'			=>		$this->input->post('billingstate'),
						'billingcity'			=>		$this->input->post('billingcity'),
						'billingzip'			=>		$this->input->post('billingzip'),
						'billingphone'			=>		$this->input->post('billingphone'),
			
			
			);
			
				$this->session->set_userdata(array('cartdata' => $sessiondata));
				//pre_print($this->session->userdata('cartdata'));
				if ($this->form_validation->run() == FALSE) 
				{
					 
						$this->data['msg'] = validation_errors();
						$this->session->set_userdata(array('order_error'=>validation_errors()));
						redirect('customers/cart');
						die();
				}
				else
				{
					
					$this->load->model('orders_model');
					if($this->session->userdata('loginid')<=0)
					{
						$data=$this->session->userdata('cartdata');
						
						$userid=$this->main_model->add_customer($data['signupemail'],$data['signuppass']);
						$newdata = array(
										   'loginid'  	=> $userid,
										   'email'     	=> $data['signupemail'],
										   'usertype'	=>'user',
										   'loggedin' 	=> TRUE,
										);
		
							$this->session->set_userdata($newdata);
					}
				
				//echo "here";
				require_once(APPPATH.'/third_party/stripe/Stripe.php');
				
				Stripe::setApiKey(get_store_settings('STRIP_SECRECT_KEY'));
				  $error = '';
				  $success = '';
				  try {
					if (!isset($_POST['stripeToken']))
					  throw new Exception("The Stripe Token was not generated correctly");
						Stripe_Charge::create(array("amount" =>round( (int)(get_shiping_cost()+get_cart_total_price())*100 ),
												"currency" => "usd",
												"card" => $_POST['stripeToken']));
					// $success = 'Your payment was successful.';
					
					$this->orders_model->generate_order_fromcart();
				
				
				  }
				  catch (Exception $e) {
					 $error = $e->getMessage();
					 $this->session->set_userdata(array('order_error'=>$error));
					 redirect('customers/cart');
					 die();
				  }
				redirect('customers/payment_check');
				
			}
			
		}
		else
		redirect('/');
		
	}
	
	function payment_check()
	{
		if($this->session->userdata('cartdata'))
		{
		//
			$this->load->model('orders_model');
			
			
			
			$this->data['orderinfo']=$this->orders_model->get_order_byid($this->session->userdata('orderid'));
			// send email to customer
			
			$to  = $this->session->userdata('email');
			
			// subject
			$subject = 'Order Confirmation email ';
			
			// message
			$message = $this->load->view(active_theme().'/customers/cart/order-email-template',$this->data,true);;
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			$headers .= 'To:<'.$to.'>' . "\r\n";
			$headers .= 'From: Staff <'.get_store_settings('STAFF_EMAIL').'>' . "\r\n";
			//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
			//$headers .= 'Bcc: '.get_store_settings('STAFF_EMAIL').'' . "\r\n";
			
			// Mail it
			@mail($to, $subject, $message, $headers);
						
			
			
			
			redirect('thankyou');
		}
		die();
	}
	
	
	function contactformsubmit($productid)
	{
		// for cartitem there must be a single order at the same time 
		//$this->session->unset_userdata('order_error');
		
		//$cartid=$this->session->userdata('cart_id');
		//if( $cartid=='' || $cartid==0)
		$this->session->set_userdata(array('cart_id'=>date('Y-m-d-H:i:s-').rand(1001,9999)));
		$quantity=$_POST['frm_quantity'];
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
			if($this->data['product']->num_rows()>0)
			{
			
				$this->products_model->cart_add_product_temp($productid,$quantity);
				$data['msg']='Successfully added to your cart';
				$data['status']='success';
			}
		}
		if($data['status']=='error')
		{
			redirect('/');
		}else{
			$shipingprice=get_store_settings('FLATE_RATE_SHIPING_PRICE');
			$cityid=$this->input->post('frm_city');
			$city;
			if($cityid>0)
			{
				// get city and its shipping price
				$city=$this->main_model->get_city($cityid);
				if($city->shippingcharges>0)
					$shipingprice=$city->shippingcharges;
			}
			else redirect('/');
			$sessiondata=array(
						
						'signupemail'			=>		'',
						'signuppass'			=>		'',
						'signuppass2'			=>		'',
						
						'shippingfname'			=>		$this->input->post('frm_fullname'),
						'shippinglname'			=>		'',
						'shippingaddress'		=>		$this->input->post('frm_address'),
						'shippingaddress2'		=>		'',
						'shippingstate'			=>		'',
						'shippingcity'			=>		(LANG=='arabic'?$city->arabicname:$city->name),//$this->input->post('frm_city'),
						'shippingzip'			=>		'',
						'shippingphone'			=>		$this->input->post('frm_phone'),
						'shippingcityid'		=>		$this->input->post('frm_city'),
						'shippingchareges'		=>		$shipingprice,
						
						'cardname'				=>		'',
						'cardno'				=>		'',
						'cardmonth'				=>		'',
						'cardyear'				=>		'',
						'cardcvv'				=>		'',
						
						
						'billingsame'			=>		'',
						
						'billingfname'			=>		'',
						'billinglname'			=>		'',
						'billingaddress'		=>		'',
						'billingaddress2'		=>		'',
						'billingstate'			=>		'',
						'billingcity'			=>		'',
						'billingzip'			=>		'',
						'billingphone'			=>		'',
			
			
			);
			
			$this->session->set_userdata(array('cartdata' => $sessiondata));
			
			$this->load->model('orders_model');
			$this->orders_model->generate_order_fromcart();
			// save form data in user cart
			
				redirect('customers/payment_check');
			
			
			
		}
		 
		//echo json_encode($data);
		
		//
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */