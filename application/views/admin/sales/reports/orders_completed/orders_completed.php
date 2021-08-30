<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pending orders report</title>

  </head>
  <body>
  		
  		<?php $this->load->view('admin/sales/reports/reports-header');?>
        
       
        <?php //pre_print($orders);?>
        	<table width="100%" border="1"  style="border-collapse:collapse">
              <tr>
               
                <td width="10%"><strong>Order#</strong></td>
                <td width="30%"><strong>Customer Shipping Info</strong></td>
                <td width="35%"><strong>Customer Billing Info</strong></td>
                <td width="11%"><strong>Amount</strong></td>
                <td width="14%"><strong>OrderDate</strong></td>
               
              </tr>
              <?php $this->load->view('admin/sales/reports/orders_completed/orders_completed_inner')?>
              
            </table>

  </body>
</html>