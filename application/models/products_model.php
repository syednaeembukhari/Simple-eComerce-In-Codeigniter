<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class products_model extends CI_Model {
	
	
	function get_new_productid()
	{
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->where('sku', '');
		$this->db->order_by("productid", "asc"); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		if( $query->num_rows()>0)
		{
			return $query->row()->productid;
		}
		else
		{
			
			$data = array(
			   'sku' => ''
			);
			
			$this->db->insert(PRODUCTS, $data); 
			//echo $this->db->last_query();
			return $this->db->insert_id();
		}
	}
	function get_sku_check($sku,$productid=0)
	{
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->where('sku', $sku);
		if($productid>0)
		$this->db->where('productid !=', $productid);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->num_rows();
	}
	function get_product_images_array($productid,$getsample=true)
	{
		$sampleproduct='assets/images/sampleproduct.png';
		$array=array('img1'=>$sampleproduct,'img2'=>$sampleproduct,'img3'=>$sampleproduct,'img4'=>$sampleproduct);
		if($getsample==false)
		$array=array('img1'=>$sampleproduct,'img2'=>'','img3'=>'','img4'=>'');
		
		$this->db->select('*');
		$this->db->from(PRODUCT_IMAGES);
		$this->db->where("productid", $productid);
		$this->db->order_by("isdefault", 'asc'); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		if( $query->num_rows()>0)
		{
			$counter=0;
			foreach($query->result() as $row)
			{
				$counter++;
				$array['img'.$counter]=base_url().PRODUCT_UPLOAD_PATH.'/'.$row->image;
			}
			
		}
		
		return $array;
	}
	
	function save_product_image($productid,$filepath,$imgno)
	{
		$this->db->select('*');
		$this->db->from(PRODUCT_IMAGES);
		$this->db->where("productid", $productid);
		$this->db->where("isdefault", $imgno); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		if( $query->num_rows()>0)
		{
			$sql="UPDATE `".PRODUCT_IMAGES."` SET  `image`=?  WHERE `productid`=? AND `isdefault`=? ";
			$this->db->query($sql,array($filepath,$productid,$imgno));
			$row=$query->row();
			@unlink('./'.PRODUCT_UPLOAD_PATH.'/'.$row->image);
			@unlink('./'.PRODUCT_UPLOAD_PATH.'/600x600-'.$row->image);
			@unlink('./'.PRODUCT_UPLOAD_PATH.'/1200x1200-'.$row->image);
		}
		else
		{
			$sql="INSERT INTO `".PRODUCT_IMAGES."` ( `productid`, `image`, `isdefault`) 
				VALUES (?,?,?);";
			$this->db->query($sql,array($productid,$filepath,$imgno));
		}
	}
	function delete_product_image($productid=0,$imageno=1)
	{
		
		$this->db->where('productid',$productid);
		$this->db->where('isdefault',$imageno);
		$this->db->delete(PRODUCT_IMAGES);
		//echo $this->db->last_query();
		// rearrange images
		$this->db->where('productid',$productid);
		$images=$this->db->get(PRODUCT_IMAGES)->result();
		$i=0;
		foreach($images as $img)
		{
			$i++;
			$this->db->where('imageid',$img->imageid);
			$this->db->set('isdefault',$i);
			$this->db->update(PRODUCT_IMAGES);
		}
		
	}
	function update_product($productid,$sku,$title,$description,$pprice,$sprice,$dprice,$instock)
	{
		$product_info=$this->get_product($productid);
		if($product_info->num_rows()>0)
		{
			$p=$product_info->row();
			$pslug='';
			if($p->product_slug!='')
			$pslug=$p->product_slug;
			
			if($pslug=='')
			{
				$config = array(
								'id'	=> 'productid',
								'table' => PRODUCTS,
								'field' => 'product_slug',
								'title' => 'title',
								'replacement' => 'dash' // Either dash or underscore
							);
					$this->load->library('slug', $config);
					$data = array(
						'title' => $title,
					);
					//print_r($data);
				$pslug=$this->slug->create_uri($data);
			}
			
		$data = array(
               'sku' => $sku,
               'title' => $title,
			   'product_slug' => $pslug,
			   
               'description' => $description,
			   
			   'pprice' => $pprice,
               'sprice' => $pprice,
               'dprice' => $dprice,
			   
			   'instock' => $instock,
			   
            );

		$this->db->where('productid', $productid);
		$this->db->update(PRODUCTS, $data); 
		}
	}
	function update_product_categories($productid,$cat_array )
	{
		$this->db->delete(CATEGORY_PRODUCTS, array('productid' => $productid)); 
		if(is_array($cat_array))
		{
			foreach($cat_array as $cat)
			{
				$data = array(
					'productid' => $productid,
					'catid' => $cat['value']
				);
				//print_r($data);
				$this->db->insert(CATEGORY_PRODUCTS, $data);
			}
		}
		
	}
	
	function delete_product($productid)
	{
		$this->db->delete(CATEGORY_PRODUCTS, array('productid' => $productid)); 
		$this->db->delete(SHOPING_CART, array('productid' => $productid)); 
		//------------  check if product exists in order -----
		$this->db->select('*');
		$this->db->from(ORDERS_DETAIL);
		$this->db->where("productid", $productid);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			// only change the status  isdeleted=1
			$data = array(
               'isdeleted' => 1
			   );
			$this->db->where('productid', $productid);
			$this->db->update(PRODUCTS, $data); 
		}
		else
		{
			//-----------   delete complete data
			$this->db->delete(PRODUCTS, array('productid' => $productid)); 
			
			$this->db->select('*');
			$this->db->from(PRODUCT_IMAGES);
			$this->db->where("productid", $productid);
			$query_products = $this->db->get();
			foreach ($query_products->result() as $row)
			{
				@unlink('./'.PRODUCT_UPLOAD_PATH.'/'.$row->image);
				@unlink('./'.PRODUCT_UPLOAD_PATH.'/600x600-'.$row->image);
				@unlink('./'.PRODUCT_UPLOAD_PATH.'/1200x1200-'.$row->image);
			}
			$this->db->delete(PRODUCT_IMAGES, array('productid' => $productid)); 
		}
		
		
	}
	function get_products($offset,$limit)
	{
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->where('sku !=', '');
		$this->db->where('isdeleted', 0);
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		
		return $query;
	}
	function get_active_products($offset,$limit)
	{
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->where('sku !=', '');
		$this->db->where('isdeleted', 0);
		$this->db->where('status', 'Active');
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		
		return $query;
	}
	function get_product($productid,$isadd='')
	{
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->where("productid", $productid);
		$this->db->where("isdeleted", 0);
		$query = $this->db->get();
		if($isadd=='add')
		{
			if($query->num_rows()<=0)
			{
				$data = array(
				   'productid' => $productid ,
				   'sku' => ''
				);
				$this->db->insert(PRODUCTS, $data); 
				
				$this->db->select('*');
				$this->db->from(PRODUCTS);
				$this->db->where("productid", $productid);
				$query = $this->db->get();
			}
		}
		return $query;
	}
	
	function get_next_product($productid)
	{
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->where("productid >", $productid);
		$this->db->order_by("productid", "asc"); 
		$query = $this->db->get();
		return $query;
	}
	function get_pre_product($productid)
	{
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->where("productid <", $productid);
		$this->db->order_by("productid", "desc"); 
		$query = $this->db->get();
		return $query;
	}
	
	
	function get_product_bysku($sku)
	{
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->where("sku", $sku);
		$this->db->order_by("productid", "desc"); 
		$query = $this->db->get();
		return $query;
	}
	
	function get_product_byid($productid)
	{
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->where("productid", $productid);
		$this->db->order_by("productid", "desc"); 
		$query = $this->db->get();
		return $query;
	}
	
	
	function get_product_bycategory($category_slug)
	{
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from(PRODUCTS);
		$this->db->join(CATEGORY_PRODUCTS, CATEGORY_PRODUCTS.'.productid='.PRODUCTS.'.productid');
		$this->db->join(CATEGORIES, CATEGORIES.'.catid='.CATEGORY_PRODUCTS.'.catid');
		$this->db->where(CATEGORIES.'.catslug', $category_slug);
		$this->db->order_by(PRODUCTS.".productid", "desc"); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	
	
	
	//==================== add to cart functions
	
	function cart_add_product_temp($productid,$quantity=1)
	{
		$pro=$this->get_product_byid($productid);
		$ses_id=$this->session->userdata('cart_id');
		if($pro->num_rows()>0)
		{
			
			$product=$pro->row();
			
			$this->db->select('*');
			$this->db->from(SHOPING_CART);
			$this->db->where("productid", $productid);
			$this->db->where("session_id", $ses_id);
			$query = $this->db->get();
			if($query->num_rows()>0)		
			{
				$temrow= $query->row();
				$data = array(
							'qty'=> (int)$temrow->qty + 1,
							'add_date'=>date('Y-m-d H:i:s')
						);
				$this->db->where("temp_id", $temrow->temp_id);
				$this->db->update(SHOPING_CART, $data);
			}
			else
			{
				$data = array(
							'productid' => $product->productid,
							'sprice' => $product->sprice,
							'dprice' => $product->dprice,
							'price' => get_product_price($product) ,
							'session_id'=>$ses_id,
							'add_date'=>date('Y-m-d H:i:s'),
							'qty'=>$quantity
						);
				$this->db->insert(SHOPING_CART, $data);
			}
		}
		//pre_print($this->session->all_userdata());
	}
	
	function cart_temp_items($session_id)
	{
		$this->db->select('*');
		$this->db->from(SHOPING_CART);
		$this->db->where("session_id", $session_id);
		return $query = $this->db->get();
	}
	
	function cart_update_qty($session_id,$productid,$qty)
	{
		$data=array(
				
				'qty'=>$qty
				);
		$this->db->where("productid", $productid);
		$this->db->where("session_id", $session_id);
		$this->db->update(SHOPING_CART, $data); 
	}
	
	function cart_temp_items_count($session_id)
	{
		$this->db->select('sum(qty) as total');
		$this->db->from(SHOPING_CART);
		$this->db->where("session_id", $session_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		return $query->row()->total;
		
		return 0;
	}
	
	function cart_total_amount($session_id)
	{
		$this->db->select('sum(qty * price) as amount');
		$this->db->from(SHOPING_CART);
		$this->db->where("session_id", $session_id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows()>0)
		return $query->row()->amount;
		
		return 0;
	}
	
	function cart_itemdelete($cartid=0)
	{
		$this->db->delete(SHOPING_CART, array('temp_id' => $cartid));
	}
	

	
}