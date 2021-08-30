<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main_model extends CI_Model {
	
	
	function get_store_settings($settingsname)
	{
		$this->db->select('*');
		$this->db->from(SETTINGS);
		$this->db->where('settingname', $settingsname); 
		$query = $this->db->get();
		//echo $this->db->last_query();
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
	function get_store_settings_value($settingsname)
	{
		$this->db->select('*');
		$this->db->from(SETTINGS);
		$this->db->where('settingname', $settingsname); 
		$query = $this->db->get();
		if($query->num_rows()>0)
		return $query->row()->settingvalue;
		return '';
	}
	function get_flate_shiping_charges($cart_id)
	{
		$this->load->model('products_model','PM');
		$cart_amount=$this->PM->cart_total_amount($cart_id);
		$flatrate=$this->get_store_settings_value('FLATE_RATE_SHIPING_PRICE');
		$freeover=$this->get_store_settings_value('FREE_SHIPPING_OVER');
		
		if($cart_amount < $freeover)
		{
			return $flatrate;
		}
		return 0;
	}
	
	
	function get_country_byid($countryid)
	{
		$this->db->select('*');
		$this->db->from(SETTINGS);
		$this->db->where('settingname', $settingsname); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	function get_countries()
	{
		$this->db->select('*');
		$this->db->from(COUNTRIES);
		$this->db->order_by('country'); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	function get_country_byiso3($countryiso3)
	{
		$this->db->select('*');
		$this->db->from(COUNTRIES);
		$this->db->where('iso3', $countryiso3); 
		$query = $this->db->get()->row();
		//echo $this->db->last_query();
		return $query;
	}
	function get_country_cities($countryid)
	{
		$this->db->select('*');
		$this->db->from(COUNTRY_STATES);
		$this->db->where('countryid', $countryid); 
		$this->db->order_by('name');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	function get_country_timezone($countryid)
	{
		$this->db->select(COUNTRY_STATES.'.timezone');
		$this->db->from(COUNTRY_STATES);
		$this->db->join(COUNTRIES ,  COUNTRIES.'.countryid='.COUNTRY_STATES.'.countryid');
		$this->db->where(COUNTRIES.'.countryid', $countryid); 
		$this->db->limit(1);
		$query = $this->db->get()->row()->timezone;
		//echo $this->db->last_query();
		return $query;
	}
	
	function get_city($cityid)
	{ 
		$this->db->where('id', $cityid);  
		$query = $this->db->get(COUNTRY_STATES)->row();
		return $query;
	}
	function delete_city($id)
	{ 
		$this->db->where('id', $id);  
		$query = $this->db->delete(COUNTRY_STATES);
		return $query;
	}
	function add_city($countryid,$name,$arabicname,$timezone='',$shippingcharges='0')
	{
		$this->db->select('*');
		$this->db->from(COUNTRY_STATES);
		$this->db->where('name', $name);
		$this->db->where('countryid', $countryid);
		$query = $this->db->get();
		if( $query->num_rows()>0)
		{
			return 0;
		}
		else
		{
			$data = array(
					'name' => $name,
					'countryid' => $countryid,
					'arabicname' =>$arabicname,
					'timezone'=>$timezone,
					'shippingcharges'=>$shippingcharges,
				);
				//print_r($data);
				$this->db->insert(COUNTRY_STATES, $data);
				//echo $this->db->last_query();
				return $this->db->insert_id();
		}
	}
	function update_city($id,$countryid,$name,$arabicname,$timezone='',$shippingcharges='0')
	{
		$this->db->select('*');
		$this->db->from(COUNTRY_STATES);
		$this->db->where('name', $name);
		$this->db->where('countryid', $countryid);
		$this->db->where('id !=', $id);
		$query = $this->db->get();
		if( $query->num_rows()>0)
		{
			return 0;
		}
		else
		{
			$data = array(
					'name' => $name,
					'arabicname' =>$arabicname, 
					'shippingcharges' =>$shippingcharges,
					//'timezone'=>$timezone
				);
				//print_r($data);
				$this->db->where('id', $id);
				$this->db->update(COUNTRY_STATES, $data);
				//echo $this->db->last_query();
			
				return 1;
		}
	}
	
	
	function add_customer($email,$password)
	{
		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('email', $email); 
		$query = $this->db->get();
		if( $query->num_rows()>0)
		{
			return $query->row()->userid;
		}
		else
		{
			$data = array(
					'email' => $email,
					'password' => $password,
					'usertype' =>'user'
				);
				//print_r($data);
				$this->db->insert(USERS, $data);
				return $this->db->insert_id();
		}
	}
}