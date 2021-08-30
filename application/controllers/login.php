<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->lang->load('front', LANG);
	}
	public function index()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email',  $this->lang->line('email'), 'trim|required|valid_email');	
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');	
		
		
		if ($this->form_validation->run() == FALSE) 
		{
				$this->data['msg'] = validation_errors();
				
		}
		else
		{
			
			$msg='';
			$userdata=$this->auth_model->userlogin($this->input->post('email'),md5($this->input->post('password')));
			if($userdata->num_rows()>0)
			{
				$row=$userdata->row();
				$newdata = array(
								   'loginid'  	=> $row->userid,
								   'email'     	=> $row->email,
								   'usertype'	=>$row->usertype,
								   'loggedin' 	=> TRUE,
               					);

					$this->session->set_userdata($newdata);
					if($row->usertype=='admin')
					redirect('admin/dashboard');
					else
					redirect('users/dashboard');
				
			}
			else
			{
				$msg=$this->lang->line('invalidlogin');
			}
			$this->data['msg'] = $msg;	
			
		}
		//print_r($this->session->all_userdata()) ;
		$this->load->view(active_theme().'/login/login',$this->data);
		
	}
	
	public function forgetpassword()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email',  $this->lang->line('email'), 'trim|required|valid_email');	
		if ($this->form_validation->run() == FALSE) 
		{
				$this->data['msg'] = validation_errors();
				
		}
		else
		{
			
			$msg='';
			$userdata=$this->auth_model->getuser_byemail($this->input->post('email'));
			if($userdata->num_rows()>0)
			{
				$row=$userdata->row();
				
				$psswordkey=md5($this->input->post('email').date('Ymdhis'));
				$this->auth_model->addpassword_resetkey($row->userid,$psswordkey);
				
				$to=$this->input->post('email');
				$subject="Password Reset Request";
				$reseturl=site_url('login/resetpassword/'.$psswordkey);
				$message='
				<p>Click the link blow to reset your password</p>
				<p><a href="'.$reseturl.'" style="font-size:24px">'.$reseturl.'</a></p>
				<p>if link did not work , just copy the url and past into your browser url bar</p>
				
				';
					
					
					
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					
					// More headers
					$headers .= 'From: <'.get_store_settings('COMMON_EMAIL').'>' . "\r\n";
					//$headers .= 'Cc: myboss@example.com' . "\r\n";
					mail($to,$subject,$message,$headers);
					
				//$msg=$message;
				$_SESSION['forgetpassword_message']=$this->lang->line('forgetpassword_message');
				redirect('login/forgetpassword');
				
			}
			else
			{
				$msg=$this->lang->line('emailnotfound');
			}
			$this->data['msg'] = $msg;	
			
		}
		$this->load->view(active_theme().'/login/forgetpassword',$this->data);
		unset($_SESSION['forgetpassword_message']);
	}
	
	function resetpassword($resetkey='')
	{
		if($resetkey=='')
		{
			redirect('login');
			die();
		}
		$checkey=$this->auth_model->check_resetkey($resetkey);
		if($checkey<=0)
		{
			redirect('login');
			die();
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password',  $this->lang->line('password'), 'trim|required');	
		$this->form_validation->set_rules('password2',  $this->lang->line('password2'), 'trim|required|matches[password]');	
		
		
		if ($this->form_validation->run() == FALSE) 
		{
				$this->data['msg'] = validation_errors();
		}
		else
		{
			
			$this->auth_model->resetpassword($this->input->post('password'),$resetkey);
			$_SESSION['resetpassword_message']=$this->lang->line('passwordchanged');
			redirect('login');
			die();
		}
		$this->load->view(active_theme().'/login/resetpasswword',$this->data);
	}
	function customer_login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email',  'Your Email', 'trim|required|valid_email');	
		$this->form_validation->set_rules('password',  'Password', 'trim|required');	
		
		
		if ($this->form_validation->run() == FALSE) 
		{
			$this->data['status']="ERROR";
			$this->data['msg'] = validation_errors();
				
		}
		else
		{
			
			$msg='';
			$userdata=$this->auth_model->userlogin($this->input->post('email'),md5($this->input->post('password')));
			if($userdata->num_rows()>0)
			{
				$row=$userdata->row();
				$newdata = array(
								   'loginid'  	=> $row->userid,
								   'email'     	=> $row->email,
								   'usertype'	=>$row->usertype,
								   'loggedin' 	=> TRUE,
               					);

				$this->session->set_userdata($newdata);
				$msg="You are sucessfully Logedin";
				$this->data['status']="OK";
			}
			else
			{
				$this->data['status']="ERROR";
				$msg='Invalid Login Information';
			}
			$this->data['msg'] = $msg;	
		
		}
		//print_r($this->session->all_userdata()) ;
		echo json_encode($this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */