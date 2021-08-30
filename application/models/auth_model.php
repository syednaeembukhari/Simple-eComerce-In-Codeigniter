<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth_model extends CI_Model {
	
	
	function userlogin($email,$password)
	{
		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('email', $email); 
		$this->db->where('password', $password); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	function changepassword($password,$userid)
	{
		$this->db->set('password', md5($password));
		$this->db->where('userid', $userid); 
		$query = $this->db->update(USERS);
		return $query;
	}
	function addpassword_resetkey($userid,$key)
	{
		$this->db->set('resetpassword', $key);
		$this->db->where('userid', $userid); 
		$query = $this->db->update(USERS);
		return $query;
	}
	function check_resetkey($resetpassword)
	{
		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('resetpassword', $resetpassword);
		$query = $this->db->get();
		return $query->num_rows();
	}
	function resetpassword($password,$resetpassword)
	{
		$this->db->set('password', md5($password));
		$this->db->set('resetpassword', '');
		$this->db->where('resetpassword', $resetpassword);
		$query = $this->db->update(USERS);
		return $query;
	}
	function update_store_settings($settingsname,$settingvalue)
	{
		$this->db->set('settingname', $settingsname);
		$this->db->set('settingvalue', $settingvalue);
		
		$this->db->where('settingname', $settingsname); 
		$query = $this->db->update(SETTINGS);
		return $query;
	}
	
	function getuser_byemail($email)
	{
		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('email', $email); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	
	
}