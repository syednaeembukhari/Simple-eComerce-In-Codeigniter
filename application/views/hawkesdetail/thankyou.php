<!DOCTYPE html>
<html lang="en">
  <head>
	<?php $this->load->view(active_theme().'/common/scripts');?>   
    <link href="<?php echo base_url();?>assets/templates/<?php echo active_theme();?>/login.css" rel="stylesheet">
  </head>
  <body>
   	 <?php $this->load->view(active_theme().'/common/header');?>  
     <div class="container productcontainer" style="min-height:400px">
     <div class="row ">
        <div class="col-md-12">
        	<h4 style="text-align:center">Thank you</h4>
        </div>
      </div>
      
      <?php if($orderinfo->num_rows()>0){?>
      <?php $order=$orderinfo->row();?>
    	<div class="row thankyou-order" >
            <div class="col-md-6 col-sm-6">
           		<h5>Billing Address</h5>
				<?php if($order->billingsame=='billingsame'){?>
                	<p><?php echo $order->shippingfname;?> <?php echo $order->shippinglname;?></p>
                    <p><?php echo $order->shippingaddress;?></p>
                    <p><?php echo $order->shippingaddress2;?></p>
                    <p><?php echo $order->shippingcity;?>,<?php echo $order->shippingstate;?> <?php echo $order->shippingzip;?></p>
                    
                <?php }else{?>
                    <p><?php echo $order->billingfname;?> <?php echo $order->billinglname;?></p>
                    <p><?php echo $order->billingaddress;?></p>
                    <p><?php echo $order->billingaddress2;?></p>
                    <p><?php echo $order->billingcity;?>,<?php echo $order->billingstate;?> <?php echo $order->billingzip;?></p>
                <?php }?>
               
            </div>
           
            <div class="col-md-6 col-sm-6">
           		<h5>Shipping Address</h5>
                 <p><?php echo $order->shippingfname;?> <?php echo $order->shippinglname;?></p>
                <p><?php echo $order->shippingaddress;?></p>
                <p><?php echo $order->shippingaddress2;?></p>
                <p><?php echo $order->shippingcity;?>,<?php echo $order->shippingstate;?> <?php echo $order->shippingzip;?></p>
                    
            </div>
         </div>
         <div class="row thankyou-order" >
            <div class="col-md-12">
            <table width="100%" border="0" class="table">
              <tr>
                <td width="3%">#</td>
                <td width="14%">Code</td>
                <td width="43%">Item</td>
                <td width="14%">Price</td>
               	<td width="11%">Quantity</td> 
                <td width="15%">Total Price</td>
              </tr>
              <?php $i=0;?>
              <?php $cart_total=0;?>
              <?php foreach ( $orderinfo->result() as $row){?>
              <?php $i++;?>
              <?php $product=$this->products_model->get_product_byid($row->productid);?>
               <?php $productinfo=$product->row();?>
              <tr>
                <td width="3%"><?php echo $i;?>&nbsp;</td>
                <td width="14%"><?php echo $productinfo->sku;?>&nbsp;</td>
                <td width="43%"><?php echo $productinfo->title;?>&nbsp;</td>
               
                <td width="15%"><?php echo $row->price;?>&nbsp;</td> 
                <td width="14%"><?php echo $row->quantity;?>&nbsp;</td>
                <td width="11%"><?php echo $itemtotal=$row->quantity*$row->price;?>&nbsp;</td>
              </tr>
              <?php 
			  	$cart_total=$itemtotal+$cart_total;
			  ?>
              <?php }?>
              <tr>
              	<td   colspan="3">&nbsp;
                
                </td>
                <td   colspan="3">
                    <table border="0" width="100%">
                      <tr>
                        <td width="72%" ><strong>Total Price</strong></td>
                        <td width="28%">
                        <strong><?php echo get_store_currency();?> <?php echo $cart_total;?></strong>&nbsp;
                        </td>
                      </tr>
                      <tr>
                        <td  ><strong>Shipping Price</strong></td>
                        <td width="28%">
                        <strong><?php echo get_store_currency();?> <?php echo $order->shippingchareges;?></strong>&nbsp;
                        </td>
                      </tr>
                      <tr>
                        <td ><strong>Grand Total</strong></td>
                        <td width="28%">
                        <strong><?php echo get_store_currency();?> <?php echo $order->grandtotal;?>&nbsp;</strong>
                        </td>
                      </tr>
                  </table>
              </td>
              </tr>
            </table>

            </div>
         </div>
         
         <?php }?>
         
         
     </div>
     <div>
     
     <?php //echo $emailtext;?>
     
     </div>
     <?php $this->load->view(active_theme().'/common/footer');?>   
  </body>
</html>
<?php //$this->session->unset_userdata('cartdata');?>