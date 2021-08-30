<?php 
if(!function_exists('isrtl'))
{
	function isrtl()
	{
		return true;
		
	}
	
}

if(!function_exists('get_store_settings'))
{
	function get_store_settings($settingname)
	{
		$ci =& get_instance();
		//$ci->load->model('main_model');
		$settings=$ci->main_model->get_store_settings($settingname);
		if($settings->num_rows()>0)
		{
			
			return $settings->row()->settingvalue;
		}
		return NULL;
		
	}
	
}

if(!function_exists('get_store_currency'))
{
	function get_store_currency()
	{
		$ci =& get_instance();
		//$ci->load->model('main_model');
		$settings=$ci->main_model->get_store_settings('CURRENCY_SYMBOL');
		if($settings->num_rows()>0)
		{
			
			return $settings->row()->settingvalue;
		}
		return NULL;
		
	}
	
}
if(!function_exists('get_store_currency_code'))
{
	function get_store_currency_code()
	{
		$ci =& get_instance();
		//$ci->load->model('main_model');
		$settings=$ci->main_model->get_store_settings('CURRENCY_CODE');
		if($settings->num_rows()>0)
		{
			
			return $settings->row()->settingvalue;
		}
		return NULL;
		
	}
	
}

if(!function_exists('get_new_productid'))
{
	function get_new_productid()
	{
		$ci =& get_instance();
		$ci->load->model('products_model');
		return $ci->products_model->get_new_productid();
		
	}
	
}

if(!function_exists('get_product_price'))
{
	function get_product_price($product=NULL)
	{
		$price='';
		if($product)
		{
			if($product->dprice<=0 || $product->sprice<=0)
			$price=$product->sprice;
			else
			{
				$price=$product->sprice-( $product->dprice);
			}
		}
		return $price;
	}
}
if(!function_exists('get_product_price_percent'))
{
	function get_product_price_percent($product=NULL)
	{
		$price='';
		if($product)
		{
			if($product->dprice<=0 || $product->sprice<=0)
			$price=$product->sprice;
			else
			{
				$price=$product->sprice-(($product->sprice/100)*$product->dprice);
			}
		}
		return $price;
	}
}
if(!function_exists('get_product_price_old'))
{
	function get_product_price_old($product=NULL)
	{
		$price='<style>.price_container{direction:ltr}.price_container .pr{ display:inline-block;}</style><div>';
		if($product)
		{
			
			$product_price=get_product_price($product);
			
			$p2='<div class="pr">'.get_store_currency(). '</div> <div class="pr"> '.$product->sprice.'</div>';
			if(isrtl())
				$p2='<div class="pr">'.get_store_currency()  . '</div> <div class="pr"> '. $product->sprice .'</div>';
			if($product_price < $product->sprice)
			{
				$price.= '<div class="old-price">'.$p2.'</div> ';
			}
			
			
			$p= '<div class="pr">'.get_store_currency()  . '</div> <div class="pr"> '. $product_price.'</div> ';
			if(isrtl())
				$p='<div class="pr">'.get_store_currency()  . '</div> <div class="pr"> '.  $product_price.'</div> ';
			
			$price.= ' <div class="new-price">'.$p.'</div>';
			
		}
		return $price.'</div>';
	}
}
if(!function_exists('get_product_price_percent'))
{
	function get_product_price_percent($product=NULL)
	{
		$price='';
		if($product)
		{
			
			$product_price=get_product_price_percent($product);
			
			$p2=get_store_currency().$product->sprice;
			if(isrtl())
				$p2=get_store_currency()  . ' '. $product->sprice .'';
			if($product_price < $product->sprice)
			{
				$price.= '<span class="old-price">'.$p2.'</span> ';
			}
			
			
			$p= get_store_currency().$product_price;
			if(isrtl())
				$p=get_store_currency()  . ' '. $product_price;
			
			$price.= ' '.$p;
			
		}
		return $price;
	}
}


if(!function_exists('get_next_product_id'))
{
	function get_next_product_id($productid=0)
	{
		$ci =& get_instance();
		if($productid==0)
		return 0;
		
		$ci->load->model('products_model');
		$product=$ci->products_model->get_next_product($productid);
		if($product->num_rows()>0)
		return $product->row()->productid;
		else
		return 0;
	}
}

if(!function_exists('get_pre_product_id'))
{
	function get_pre_product_id($productid=0)
	{
		$ci =& get_instance();
		if($productid==0)
		return 0;
		
		$ci->load->model('products_model');
		$product=$ci->products_model->get_pre_product($productid);
		if($product->num_rows()>0)
		return $product->row()->productid;
		else
		return 0;
	}
}

if(!function_exists('product_seo_url'))
{
	function product_seo_url($obj_product,$onlysku=true)
	{
		if($onlysku)
		return ci_site_url('product/'.$obj_product->sku);
		return ci_site_url('products/detail/'.$obj_product->sku.'/'.$obj_product->product_slug);
	}
}
//FLATE_RATE_SHIPING
if(!function_exists('get_shiping_cost'))
{
	function get_shiping_cost($cart_id=0)
	{
		$ci =& get_instance();
		if($cart_id==0)
		$cart_id=$ci->session->userdata('cart_id');
		
		
		if($ci->session->userdata('shippingcityid') >0)
		{
			$city=$ci->main_model->get_city($ci->session->userdata('shippingcityid') );
			if($city->shippingcharges>0)
					return $shipingprice=$city->shippingcharges;
		}
		
		$settings=$ci->main_model->get_store_settings('FLATE_RATE_SHIPING');
		
		if($settings->num_rows()>0)
		{
			if($settings->row()->settingvalue==1)
			{
				$shippingcost=$ci->main_model->get_flate_shiping_charges($cart_id);
				return $shippingcost;
			}
			else
			{
				// other shiping charges
				return 0;
			}
		}
		else
		return 0;
	}
}

if(!function_exists('get_cart_ses_value'))
{
	function get_cart_ses_value($name)
	{
		$ci =& get_instance();
		if($ci->session->userdata('cartdata'))
		{
			$data=$ci->session->userdata('cartdata');
			if(isset($data[$name]))
			return $data[$name];
		}
		return '';
	}
}

if(!function_exists('get_cart_total_price'))
{
	function get_cart_total_price($cart_id=0)
	{
		$ci =& get_instance();
		if($cart_id==0)
		$cart_id=$ci->session->userdata('cart_id');
		
		$ci->load->model('products_model','PM');
		return $cart_amount=$ci->PM->cart_total_amount($cart_id);
	}
}