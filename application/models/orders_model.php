<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orders_model extends CI_Model {
	
	
	function generate_order_fromcart()
	{
		
		//INSERT INTO `tyler_secco`.`secco_orders` (`orderid`, `customerid`, `orderdate`, `orderstatus`, `billingfname`, `billinglname`, `billingaddress`, `billingaddress2`, `billingcity`, `billingstate`, `billingzip`, `billingcountry`, `billingphone`, `billingsame`, `shippingfname`, `shippinglname`, `shippingaddress`, `shippingaddress2`, `shippingcity`, `shippingstate`, `shippingzip`, `shippingcountry`, `shippingphone`, `cardname`, `cardno`, `cardmonth`, `cardyear`, `cardcvv`);
		$userdata=$this->session->userdata('cartdata');
		unset($userdata['signupemail']);
		unset($userdata['signuppass']);
		unset($userdata['signuppass2']);
		$userdata['customerid']=$this->session->userdata('loginid');
		$userdata['orderdate']= date('Y-m-d H:i:s');
		$userdata['orderstatus']='';
		if(!isset($userdata['shippingchareges']))
			$userdata['shippingchareges']=get_shiping_cost();		
		$userdata['carttotal']=get_cart_total_price();	
		$userdata['grandtotal']=$userdata['carttotal']+$userdata['shippingchareges'];	
		$userdata['orderstatus']=1;	
				//print_r($data);
		$this->db->insert(ORDERS, $userdata);
		$order_id= $this->db->insert_id();
		
		$cartitems=get_temp_cart_items();
		$this->session->set_userdata(array('orderid'=>$order_id));
		foreach($cartitems->result() as $cartrow)
		{
			$product=$this->products_model->get_product_byid($cartrow->productid);
			$productinfo=$product->row();
			$cartdata=array(
			'orderid'=>$order_id,
			'productid'=>$cartrow->productid,
			'quantity'=>$cartrow->qty,
			'pprice'=>$cartrow->price,
			'sprice'=>$productinfo->sprice,
			'dprice'=>$productinfo->dprice,
			'price'=>get_product_price($productinfo),
			);
			$this->db->insert(ORDERS_DETAIL, $cartdata);
		}
		
		$ses_id=$this->session->userdata('cart_id');
		$this->db->delete(SHOPING_CART, array('session_id' => $ses_id));
		
	}
	
	function get_order_byid($orderid)
	{
		
		$this->db->select('*');
		$this->db->from(ORDERS);
		$this->db->join(ORDERS_DETAIL, ORDERS_DETAIL.'.orderid ='.ORDERS.".orderid");
		$this->db->where(ORDERS.".orderid", $orderid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	
	function update_order_status($orderid, $orderstatus)
	{
		
		$this->db->set('orderstatus', $orderstatus);
		
		$this->db->where('orderid', $orderid); 
		$query = $this->db->update(ORDERS);
		
		
		//echo $this->db->last_query();
	
	}
	
	function get_orders_bystatus($orderstatus,$fromdate='',$todate='',$offset=0,$limit=0)
	{
		
		$this->db->select('*');
		$this->db->from(ORDERS);
		$this->db->join(ORDERS_DETAIL, ORDERS_DETAIL.'.orderid ='.ORDERS.".orderid");
		$this->db->where(ORDERS.".orderstatus", $orderstatus);
		$this->db->order_by(ORDERS.".orderid",'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	
	function get_pending_orders($offset=0,$limit=0,$fromdate='',$todate='')
	{
		
		$this->db->select('*');
		$this->db->from(ORDERS);
		$this->db->join(ORDERS_DETAIL, ORDERS_DETAIL.'.orderid ='.ORDERS.".orderid");
		$this->db->where(ORDERS.".orderstatus <=", '2');
		if($fromdate!='' && $todate!='')
		{
			$this->db->where(ORDERS.".orderdate BETWEEN '".$fromdate."' AND '".$todate."'");
		}
		$this->db->order_by(ORDERS.".orderid",'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	
	function get_completed_orders($offset=0,$limit=0,$fromdate='',$todate='')
	{
		
		$this->db->select('*');
		$this->db->from(ORDERS);
		$this->db->join(ORDERS_DETAIL, ORDERS_DETAIL.'.orderid ='.ORDERS.".orderid");
		$this->db->where(ORDERS.".orderstatus", '3');
		if($fromdate!='' && $todate!='')
		{
			$this->db->where(ORDERS.".orderdate BETWEEN '".$fromdate."' AND '".$todate."'");
		}
		$this->db->order_by(ORDERS.".orderid",'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	function get_order_products($orderid)
	{
		$this->db->select(PRODUCTS.'.*');
		$this->db->from(PRODUCTS);
		$this->db->join(ORDERS_DETAIL, ORDERS_DETAIL.'.productid='.PRODUCTS.'.productid');
		$this->db->where(ORDERS_DETAIL.'.orderid', $orderid);
		$this->db->order_by("productid", "desc"); 
		$query = $this->db->get()->result();
		return $query;
	}
	
	function update_shipping_order($orderid, $shippinglabel)
	{
		$this->db->set('orderstatus', '3');
		$this->db->set('shippinglabel', $shippinglabel);
		$this->db->set('shippingdate', date('Y-m-d H:i:s'));
		$this->db->where('orderid', $orderid); 
		$query = $this->db->update(ORDERS);
		
		
		//echo $this->db->last_query();
	
	}
	
}