<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('admin/template/scripts')?>
    <link href="<?php echo base_url();?>assets/common/bootstrap/datepicker/css/datepicker.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/common/bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
     
 
  </head>
  <body>
  		
  		<?php $this->load->view('admin/template/header')?>
    	<?php $this->load->view('admin/sales/sales_inner')?>
    	<?php $this->load->view('admin/template/footer')?>
    
  </body>
</html>