<!DOCTYPE html>
<html lang="en">
  <head>
	<?php $this->load->view(active_theme().'/common/scripts');?>   
    <link href="<?php echo base_url();?>assets/templates/<?php echo active_theme();?>/login.css" rel="stylesheet">
  </head>
  <body>
   	 <?php $this->load->view(active_theme().'/common/header');?>  
      <?php $this->load->view(active_theme().'/home/home-contents');?>  
     <?php $this->load->view(active_theme().'/common/footer');?>   
  </body>
</html>