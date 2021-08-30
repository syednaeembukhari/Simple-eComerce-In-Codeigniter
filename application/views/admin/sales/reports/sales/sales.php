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
               
                <td width="7%"><strong>Order#</strong></td>
                <th width="15%"><strong>Products</strong></th>
                <th width="26%"><strong>Customer Shipping Info</strong></th>
                <?php if(is_sale_method_checkout()){?>
                <th width="26%"><strong>Customer Billing Info</strong></th>
                <?php }?>
                <td width="9%"><strong>Amount</strong></td>
                <td width="10%"><strong>OrderDate</strong></td>
                <td width="16%">&nbsp;</td>
              </tr>
              <?php $this->load->view('admin/sales/reports/sales/sales_inner')?>
              
            </table>

  </body>
</html>