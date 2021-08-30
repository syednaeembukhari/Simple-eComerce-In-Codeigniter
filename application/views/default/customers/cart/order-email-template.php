


<?php if($orderinfo->num_rows()>0){?>
      <?php $order=$orderinfo->row();?>
      
      	<table width="100%" border="0">
          <tr>
            <td width="64%">
                <?php $current_logo=get_store_settings('LOGO_IMG');?>
                 <?php  if ($current_logo==''){
                            $current_logo=base_url().'assets/images/logo.png';
                        }
                        else
                        $current_logo=base_url().MEDIA_UPLOAD_PATH.'/common/'.$current_logo;
                 ?>
                <img src="<?php echo $current_logo;?>"  height="100px"/>
            </td>
            <td width="36%"  style="text-align:right"><strong>Order Number: <?php echo $order->orderid;?>&nbsp;</strong></td>
          </tr>
        </table>
      
    	<table width="100%" border="0">
          <tr>
            <td width="50%">
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
            
            </td>
            <td>
            	<h5>Shipping Address</h5>
                 <p><?php echo $order->shippingfname;?> <?php echo $order->shippinglname;?></p>
                <p><?php echo $order->shippingaddress;?></p>
                <p><?php echo $order->shippingaddress2;?></p>
                <p><?php echo $order->shippingcity;?>,<?php echo $order->shippingstate;?> <?php echo $order->shippingzip;?></p>
                   
            </td>
          </tr>
        </table>
        
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

         
         <?php }?>