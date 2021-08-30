<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Orders</title>

  </head>
  <body>
  		
  		<?php //$this->load->view('admin/sales/reports/reports-header');?>
        
      
        <?php  echo $html;?>
      
       
        <?php if($print){?>
        
         <script>window.print();  window.history.back();</script>
          
           <?php }?> 

  </body>
</html>