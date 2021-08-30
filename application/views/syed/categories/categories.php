<!DOCTYPE html>
<html lang="en">
  <head>
	<?php $this->load->view(active_theme().'/common/scripts');?>   
    <link href="<?php echo base_url();?>assets/templates/<?php echo active_theme();?>/login.css" rel="stylesheet">
  </head>
  <body>
   	 <?php $this->load->view(active_theme().'/common/header');?>  
     
     
    
    <div class="container-fluid productscontaner">
    	<div class="row ">
    		<div class="col-md-2  col-sm-3">
                	<?php $this->load->view( active_theme().'/products/category_tags');?>
            </div>
        	<div class="col-md-10  col-sm-9 ">
            <div class="row ">
               <?php $this->load->view(active_theme().'/categories/categories_products',$this->data);?>
             </div>
         </div>
    </div>
     
     
     
     
     
     <?php $this->load->view(active_theme().'/common/footer');?>   
  </body>
</html>