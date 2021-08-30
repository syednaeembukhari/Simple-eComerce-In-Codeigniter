<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('admin/template/scripts')?>
    <link href="<?php echo base_url();?>assets/common/bootstrap/datepicker/css/datepicker.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/common/bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/common/js/jquery.jscroll.js"></script>
  </head>
  <body>
  		
  		<?php $this->load->view('admin/template/header')?>
        
        
        
        
        
        
        
        <div class="container">
	<?php $this->load->view('admin/sales/sales-menu');?>
    <div class="row">
        <div class="col-sm-6"><h3 class="admin_title">Sales</h3></div>
         <div class="col-sm-6">
         	<div class="row">
            	<div class="col-xs-5">
                <input type="text" id="dpd1" class="form-control" value="<?php echo date('Y-m-d')?>"  data-date-format="yyyy-mm-dd" placeholder="From date" readonly>
                </div>
                <div class="col-xs-5">
                <input type="text" id="dpd2"  class="form-control" value="" data-date-format="yyyy-mm-dd" placeholder="To Date" readonly>
                </div>
                <div class="col-xs-2">
                <input type="button" class="btn btn-info btn-sm" id="dpd2" value="Submit" class="span2" onClick="get_pending_order_bydate()">
                </div>
             </div>
             <script>
			 	 
			 	$(document).ready(function(e) {
                           
							var nowTemp = new Date('2014-12-01');
							var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
					
							var checkin = $('#dpd1').datepicker({
							  onRender: function(date) {
								return date.valueOf() < now.valueOf() ? 'disabled' : '';
							  }
							}).on('changeDate', function(ev) {
							  if (ev.date.valueOf() > checkout.date.valueOf()) {
								var newDate = new Date(ev.date)
								newDate.setDate(newDate.getDate() + 1);
								checkout.setValue(newDate);
							  }
							  checkin.hide();
							  $('#dpd2')[0].focus();
							}).data('datepicker');
							var checkout = $('#dpd2').datepicker({
							  onRender: function(date) {
								return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
							  }
							}).on('changeDate', function(ev) {
							  checkout.hide();
							}).data('datepicker');
							
		
						});
						 function get_pending_order_bydate()
						 {
							 if($('#dpd1').val()!='' && $('#dpd2').val()!='')
							 {
								 window.location='<?php echo ci_site_url('admin/sales/orders_completed_bydate');?>'+'/0/'+$('#dpd1').val()+'/'+$('#dpd2').val();
							 }
						 }
			 </script>    
         	
         </div>
    </div>
     <div class="row" style="min-height:40px; margin-top:5px">
        <div class="col-md-6">
        <h4 class="admin_title">Orders Completed</h4>
        <?php 
				if($fromdate!='')
				{
				echo '<strong>From:</strong> '. $fromdate;  
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>To:</strong> '. $todate;  
				}
			?>
        </div>
        <?php if($orders->num_rows()>0){?>
        <div class="col-md-6" style="text-align:right">
        	<?php $from_to='';
			
				if($fromdate!='' && $todate!='' )
				{
					$from_to="/".$offset.'/'.$fromdate.'/'.$todate;
				}
			?>
			<a href="<?php echo ci_site_url('admin/sales/pdf_orders_completed').$from_to;?>" class="btn btn-info btn-sm">
            	Download PDF
            </a>
        </div>
        <?php }?>
    </div>
    
        	
    <div class="row">
		<div class="col-md-12">
        <?php //pre_print($orders);?>
        	<table width="100%" id="completedorders" border="0" class="table table-striped table-bordered" id="order_container">
             
               <thead>
               <tr>
               
                <th width="7%"><strong>Order#</strong></th>
                <th width="15%"><strong>Products</strong></th>
                <th width="26%"><strong>Customer Shipping Info</strong></th>
                <?php if(is_sale_method_checkout()){?>
                <th width="26%"><strong>Customer Billing Info</strong></th>
                <?php }?>
                <th width="9%"><strong>Amount</strong></th>
                <th width="10%"><strong>OrderDate</strong></th>
                <th width="20%" class="disabled-sorting no-sort">&nbsp;</th>
              </tr>
              </thead>
              <tbody>
              <?php $this->load->view('admin/sales/orders_completed/orders_completed_inner')?>
               </tbody>
            </table>

        </div>     
    </div>

</div>
        
 <?php /*?><script>

$(window).ready(function(){
	$('#order_container').jscroll( {
		loadingHtml: '<img class="loading" align="absmiddle" src="assets/images/loading.gif" alt="Loading" /> Loading...',
		nextSelector: 'a.jscroll-next:last'
	});
});
</script>
       <?php */?>
        
        
 <script type="text/javascript">
    $(document).ready(function() {
		//$('a [rel="tooltip"]').tooltip();
      
       $('#completedorders').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[ 25, 50, 100, 150, -1], [ 25, 50, 100, 150, "All"]],
            responsive: false,
            "aoColumnDefs": [
				{ 
				  "bSortable": false, 
				  "aTargets": [ -1 ] // <-- gets last column and turns off sorting
				 } 
			 ],
            language: {
				search: "_INPUT_",
            	searchPlaceholder: "Search records",
			}

        });
	});
	</script>         
        
        
        
        
        
        
        
        
    	
    	<?php $this->load->view('admin/template/footer')?>
    
  </body>
</html>