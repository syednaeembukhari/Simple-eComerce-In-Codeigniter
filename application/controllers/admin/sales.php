<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Dompdf\Dompdf;
class sales extends CI_Controller {
	var $data;
	function __construct()
	{
		parent::__construct();
		$this->data['msg']='';
		is_admin_user();
		
		$this->load->helper('thumb');
		$this->load->model('products_model');
		$this->load->model('orders_model');
		$this->load->library('form_validation');
		$this->lang->load('front', ADMINLANG);
	}
	public function index()
	{
		redirect('admin/sales/orders');
	}
	
	function orders($pageno=0,$fromdate='',$todate='')
	{
		header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', FALSE);
		header('Pragma: no-cache');
		$orderstatus=1;
		$this->data['orders']=$this->orders_model->get_orders_bystatus($orderstatus);
		$this->load->view('admin/sales/sales',$this->data);
	}
	function order($orderid=0)
	{
		$this->data['orderid']=$orderid;
		$orderstatus=1;
		$this->data['orderinfo']=$this->orders_model->get_order_byid($orderid);
		$this->load->view('admin/sales/orders/order',$this->data);
	}
	
	function shiporder($orderid=0)
	{
		$this->data['orderid']=$orderid;
		$this->data['orderinfo']=$this->orders_model->get_order_byid($orderid);
		$this->load->view('admin/sales/orders/shipit',$this->data);
	}
	function cancel_order($orderid=0)
	{
		$this->data['orderid']=$orderid;
		$this->data['orderinfo']=$this->orders_model->get_order_byid($orderid);
		$this->load->view('admin/sales/orders/cancel_order',$this->data);
	}
	
	
	
	function pending_orders($offset=0,$fromdate='',$todate='')
	{
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		
		$this->data['orders']=$this->orders_model->get_pending_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$this->load->view('admin/sales/orders_pending/orders_pending',$this->data);
	}
	
	function pending_orders_next($offset=0,$fromdate='',$todate='')
	{
	
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		
		$this->data['orders']=$this->orders_model->get_pending_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$this->load->view('admin/sales/orders_pending/orders_pending/',$this->data);
	}
	
	function pending_orders_bydate($offset=0,$fromdate='',$todate='')
	{
	
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		
		$this->data['orders']=$this->orders_model->get_pending_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$this->load->view('admin/sales/orders_pending/orders_pending',$this->data);
	}
	
	function pdf_orders_pending($offset=0,$fromdate='',$todate='')
	{
		//error_reporting(0);
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		$this->data['report_title']='Order Received Report';
		$this->data['orders']=$this->orders_model->get_pending_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$html = $this->load->view('admin/sales/reports/orders_pending/orders_pending',$this->data,true);
		
		 $d=ci_url_title($fromdate).'_'.ci_url_title($todate);
		$file_time='salesreport-'.$d.'.pdf';
		//$this->load->library('fpdf');
		ini_set('memory_limit','32M'); // boost the memory limit if it's low ;)	

		$this->load->library('pdf');
		$dompdf = new Dompdf();
		$dompdf->set_option('isRemoteEnabled', true);
		$dompdf->loadHtml($html);
		// Render the HTML as PDF
		$dompdf->render();
		$dompdf->stream($file_time);
		
	}
	
	//----------------- get_completed_orders ---------------------------------------
	function completed_orders($offset=0,$fromdate='',$todate='')
	{
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		
		$this->data['orders']=$this->orders_model->get_completed_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$this->load->view('admin/sales/orders_completed/orders_completed',$this->data);
	}
	
	function completed_orders_next($offset=0,$fromdate='',$todate='')
	{
	
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		
		$this->data['orders']=$this->orders_model->get_completed_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$this->load->view('admin/sales/orders_completed/orders_completed/',$this->data);
	}
	
	
	
	
	function orders_completed_bydate($offset=0,$fromdate='',$todate='')
	{
	
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		
		$this->data['orders']=$this->orders_model->get_completed_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$this->load->view('admin/sales/orders_completed/orders_completed',$this->data);
	}
	
	function pdf_orders_completed($offset=0,$fromdate='',$todate='')
	{
		//error_reporting(0);
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		$this->data['report_title']='Orders Completed Report';
		$this->data['orders']=$this->orders_model->get_pending_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$html = $this->load->view('admin/sales/reports/orders_completed/orders_completed',$this->data,true);
		
		//$this->load->helper(array('dompdf', 'file'));
		//pdf_create($html, ci_url_title($this->data['report_title']));
		//pdf_create($html, ci_url_title($this->data['report_title']),true);
			$d=ci_url_title($fromdate).'_'.ci_url_title($todate);
			$file_time=ci_url_title($this->data['report_title']).$d.'.pdf';
 			//$this->load->library('fpdf');
	 		ini_set('memory_limit','32M'); // boost the memory limit if it's low ;)	
 	 	
		
			$this->load->library('pdf');
			 		 // reference the Dompdf namespace
			// instantiate and use the dompdf class
			$dompdf = new Dompdf();
			$dompdf->set_option('isRemoteEnabled', true);
			//$html=str_replace('Download','',$html);
			//$html=str_replace('print','',$html);
			$dompdf->loadHtml($html);
			// Render the HTML as PDF
			$dompdf->render();
			$dompdf->stream($file_time);
		
		
		//$this->load->helper(array('dompdf', 'file'));
		//pdf_create($html, ci_url_title($this->data['report_title']));
		//pdf_create($html, ci_url_title($this->data['report_title']),true);
		
	}
	//----------------- END get_completed_orders ---------------------------------------
	
	
	
	// ------------- Sales Report------------------------------------
	
	
	
	
	function sales_report($offset=0,$fromdate='',$todate='')
	{
	
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		
		$this->data['orders']=$this->orders_model->get_completed_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$this->load->view('admin/sales/reports/reports',$this->data);
	}
	
	function pdf_sales_report($offset=0,$fromdate='',$todate='')
	{
		//error_reporting(0);
		$this->data['offset']=$offset;
		$this->data['fromdate']=$fromdate;
		$this->data['todate']=$todate;
		$this->data['limit']=PAGING_LIMIT;
		$this->data['report_title']='Sale Report';
		$this->data['orders']=$this->orders_model->get_pending_orders($this->data['offset'],$this->data['limit'],$this->data['fromdate'], $this->data['todate']);
		$html = $this->load->view('admin/sales/reports/sales/sales',$this->data,true);
		
		
		
			$d=ci_url_title($fromdate).'_'.ci_url_title($todate);
			$file_time='salesreport-'.$d.'.pdf';
 			//$this->load->library('fpdf');
	 		ini_set('memory_limit','32M'); // boost the memory limit if it's low ;)	

			$this->load->library('pdf');
			$dompdf = new Dompdf();
			$dompdf->set_option('isRemoteEnabled', true);
			$dompdf->loadHtml($html);
			// Render the HTML as PDF
			$dompdf->render();
			$dompdf->stream($file_time);
		
		
		
		
	}
	
	
	function print_orders()
	{
		$ordershtml='';
		$this->data['print']=false;
		if(@count($_POST['orderids'])>0){
		foreach($_POST['orderids'] as $orderid)
		{
			$this->data['orderinfo']=$this->orders_model->get_order_byid($orderid);
			$this->data['order']=$this->data['orderinfo']->row();
			$ordershtml.=' <div style="width: 800px; margin: 0px auto; margin-bottom:20px">';
			$ordershtml.=$this->load->view('admin/sales/orders_print/header',$this->data,true);
			$ordershtml.=$this->load->view('admin/sales/orders/order-inner-table',$this->data,true);
			$ordershtml.= '<div style="page-break-after: always;">&nbsp;</div>'; 
			$ordershtml.=' </div>';
		}
			$this->data['print']=true;
		}
		else
		{
			$ordershtml='You Did not select any order to print';
		}
		$this->data['html']=$ordershtml;
		$this->load->view('admin/sales/orders_print/orders',$this->data);
		
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */