<?php


if(! function_exists("head_title"))
{
	function head_title($title='')
	{
		if($title=='')
		return SITE_NAME;
		else
		return $title;
	}
}

if(! function_exists("is_admin_logged"))
{
	function is_admin_logged()
	{
		$ci =& get_instance();
		//print_r($ci->session->all_userdata()) ;
		if($ci->session->userdata('loggedin'))
			if($ci->session->userdata('usertype')==='admin')
			return TRUE;
			else
			return FALSE;
		else
		return FALSE;
	}
}


if(! function_exists("is_admin_user"))
{
	function is_admin_user()
	{
		//var_dump( is_admin_logged());
		if(!is_admin_logged())
		redirect('login');
	}
}

if(! function_exists("is_user_logged"))
{
	function is_user_logged()
	{
		$ci =& get_instance();
		if($ci->session->userdata('loggedin'))
			if($ci->session->userdata('loginid')>0)
			return TRUE;
			else
			return FALSE;
		else
		return FALSE;
	}
}


if(! function_exists("check_user_login"))
{
	function check_user_login()
	{
		if(!is_user_logged())
		redirect('login');
	}
}
