<?php
if(!function_exists('active_theme'))
{
	function active_theme()
	{
		//return 'syed';
		return 'default';
	}
}

if(!function_exists('store_name'))
{
	function store_name()
	{
		//return 'syed';
		return SITE_NAME;
	}
}
if(!function_exists('sale_method'))
{
	function sale_method()
	{
		return get_store_settings('SALE_METHOD');
		
	}
}
if(!function_exists('is_sale_method_checkout'))
{
	function is_sale_method_checkout()
	{
		$method= get_store_settings('SALE_METHOD');
		 
		if($method=='CHECKOUT')
			return true;
		return false;
	}
}


if(!function_exists('get_shop_categories'))
{
	function get_shop_categories($status=1)
	{
		$ci =& get_instance();
		$ci->load->model('categories_model');
		return $categories=$ci->categories_model->get_categories($status);
		
	}
}

if(!function_exists('get_product_categories_ids'))
{
	function get_product_categories_ids($status=1)
	{
		$ci =& get_instance();
		$ci->load->model('categories_model');
		return $categories=$ci->categories_model->get_product_categories_ids($status);
		
	}
}

if(!function_exists('ckeditor_create'))
{
	function ckeditor_create($areaname,$defaultcontents='',$loadbase=false)
	{
		$baseload='';
		if($loadbase==true)
		$baseload='<script src="'.base_url().'ckeditor/ckeditor.js"></script>';
		
		$editorscript="
		<textarea name=\"".$areaname."\"  id=\"".$areaname."\"  >".$defaultcontents."</textarea>
		<script language=\"javascript\">
			var custom_toolbar=[
			{ name: 'html', items: [ 'Source' ,'Cut', 'Copy', 'Paste', 'Undo', 'Redo'] },
			{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
			{ name: 'style', items: [ 'Bold', 'Italic', 'Underline', 'Strike' ] },
			
			{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
			
			];
			//$( window ).load(function() {	CKEDITOR.replace( '".$areaname."')});
			$( window ).load(function() {	CKEDITOR.replace( '".$areaname."',{toolbar: custom_toolbar} );	});
		</script>
		
		
		";
		
		return $baseload.$editorscript;
		
	}
}

function getWordpressMenu() {
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        // no theme output
        define('WP_USE_THEMES', false);
        // initializes the entire Wordpress
        require $_SERVER['DOCUMENT_ROOT'] . '/tyler/hawks/wp-blog-header.php';
        wp_nav_menu('primary');


}

function pre_print($str='')
{
	echo "<pre>";
	print_r($str);
	echo "</pre>";
}

if(!function_exists('get_temp_cart_items'))
{
	function get_temp_cart_items()
	{
		$ci =& get_instance();
		$ci->load->model('products_model');
		return $cart_items=$ci->products_model->cart_temp_items($ci->session->userdata('cart_id'));
		
	}
}

if(!function_exists('count_temp_cart_items'))
{
	function count_temp_cart_items()
	{
		$ci =& get_instance();
		$ci->load->model('products_model');
		return $cart_items=$ci->products_model->cart_temp_items_count($ci->session->userdata('cart_id'));
		
	}
}

if(!function_exists('create_cartid'))
{
	function create_cartid()
	{
		$ci =& get_instance();
		pre_print($ci->session->all_userdata());
		if(!$ci->session->userdata('cart_id') && $ci->session->userdata('cart_id')!='')
		$ci->session->set_userdata(array('cart_id'=>$ci->session->userdata('session_id')));
		else
		echo "session_found";
		
	}
}
