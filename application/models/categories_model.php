<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class categories_model extends CI_Model {
	
	function add_category($catname)
	{
		$this->db->select('*');
		$this->db->from(CATEGORIES);
		$this->db->where('catname', $catname);
		$query = $this->db->get();
		if( $query->num_rows()<=0)
		{
			$config = array(
						'id'	=> 'catid',
						'table' => CATEGORIES,
						'field' => 'catslug',
						'title' => 'catname',
						'replacement' => 'dash' // Either dash or underscore
					);
			$this->load->library('slug', $config);
			$data = array(
				'catname' => $catname,
			);
			//print_r($data);
			$slug=$this->slug->create_uri($data);
			$data['catslug'] = $slug;
			$this->db->insert(CATEGORIES, $data);
			return $this->db->insert_id();
		}
		else
		return 0;
			
	}
	
	
	function get_category_byid($catid)
	{
		$this->db->select('*');
		$this->db->from(CATEGORIES);
		$this->db->where('catid', $catid);
		return $query = $this->db->get();
	}
	function get_category_byslug($catslug)
	{
		$this->db->select('*');
		$this->db->from(CATEGORIES);
		$this->db->where('catslug', $catslug);
		return $query = $this->db->get();
	}
	function get_categories($status=1)
	{
		$this->db->select('*');
		$this->db->from(CATEGORIES);
		$this->db->where('status', $status);
		return $query = $this->db->get();
	}
	function delete_category($catid)
	{
		$this->db->delete(CATEGORIES, array('catid' => $catid)); 
		$this->db->delete(CATEGORY_PRODUCTS, array('catid' => $catid)); 
	}
	
	function update_category($catid,$catname)
	{
		$data = array(
               'catname' => $catname
            );

		$this->db->where('catid', $catid);
		$this->db->update(CATEGORIES, $data); 
	}
	
	function get_product_categories($productid)
	{
		$this->db->select(CATEGORY_PRODUCTS.'.*, '.CATEGORIES.'.catname, '.CATEGORIES.'.catslug, '.CATEGORIES.'.parentcatid');
		$this->db->from(CATEGORY_PRODUCTS);
		$this->db->join(CATEGORIES, CATEGORY_PRODUCTS.'.catid = '.CATEGORIES.'.catid');
		$this->db->where(CATEGORY_PRODUCTS.'.productid', $productid);
		$query = $this->db->get();
		return $query;
	}
	function get_product_categories_ids($productid)
	{
		
		$query = $this->get_product_categories($productid);
		
		if($query->num_rows()>0)
		{
			$a=array();
			foreach($query->result() as $row)
			$a[]=$row->catid;
			return $a;
		}
		return NULL;
		
	}
	
}