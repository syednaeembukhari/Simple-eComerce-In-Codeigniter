<div class="row">
        <div class="col-md-12">
     <link href="<?php echo base_url();?>assets/admin/style.css" rel="stylesheet">
      
      <div class="row">
        <div class="col-md-12">
        		<strong><?php echo $this->lang->line('orderno');?> : <?php echo $orderno=$order->orderid;?></strong>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        		<strong>Date : <?php echo  date('m/d/y h:i A',strtotime($order->orderdate));?></strong>
        </div>
      </div>
    	<div class="row thankyou-order" >
           
            <?php if(is_sale_method_checkout()){?>
           
            <div class="col-md-6 col-sm-6">
           		<h4><?php echo $this->lang->line('orderbillingaddress');?></h4>
				<?php if($order->billingsame=='billingsame'){?>
                	<p><?php echo $order->shippingfname;?> <?php echo $order->shippinglname;?></p>
                    <p><?php echo $order->shippingaddress;?></p>
                    <p><?php echo $order->shippingaddress2;?></p>
                    <p><?php echo $order->shippingcity;?>,<?php echo $order->shippingstate;?> <?php echo $order->shippingzip;?></p>
                     <p><?php echo $order->shippingphone;?></p> 
                <?php }else{?>
                    <p><?php echo $order->billingfname;?> <?php echo $order->billinglname;?></p>
                    <p><?php echo $order->billingaddress;?></p>
                    <p><?php echo $order->billingaddress2;?></p>
                    <p><?php echo $order->billingcity;?>,<?php echo $order->billingstate;?> <?php echo $order->billingzip;?></p>
                	 <p><?php echo $order->shippingphone;?></p> 
                <?php }?>
               
            </div>
           
            <div class="col-md-6 col-sm-6">
           		<h4><?php echo $this->lang->line('ordershipingaddress');?></h4>
                <p><?php echo $order->shippingfname;?> <?php echo $order->shippinglname;?></p>
                <p><?php echo $order->shippingaddress;?></p>
                <p><?php echo $order->shippingaddress2;?></p>
                <p><?php echo $order->shippingcity;?>,<?php echo $order->shippingstate;?> <?php echo $order->shippingzip;?></p>
                 <p><?php echo $order->shippingphone;?></p>   
            </div>
            
            <? }else{ ?>
            
            <div class="col-md-6 col-sm-6">
           		<h4><?php echo $this->lang->line('ordercustomerinfo');?></h4>
                <p><?php echo $order->shippingfname;?> <?php echo $order->shippinglname;?></p>
                <p><?php echo $order->shippingaddress;?></p>
                <p><?php echo $order->shippingaddress2;?></p>
                <p><?php echo $order->shippingcity;?>,<?php echo $order->shippingstate;?> <?php echo $order->shippingzip;?></p>
                <p><?php echo $order->shippingphone;?></p>  
                    
            </div>
            <?php } ?>
         </div>
         <div class="row thankyou-order" >
            <div class="col-md-12">
            <table width="100%" border="0" class="table">
              <tr>
                <td width="2%"><strong>#</strong></td>
                <td width="10%"><strong><?php echo $this->lang->line('ordercode');?></strong></td>
                <td width="32%"><strong><?php echo $this->lang->line('orderitem');?></strong></td>
                <td width="20%"><strong><?php echo $this->lang->line('orderprice');?></strong></td>
               	<td width="15%"><strong><?php echo $this->lang->line('orderquantity');?></strong></td> 
                <td width="25%"><strong><?php echo $this->lang->line('ordertotalprice');?></strong></td>
              </tr>
              <?php $i=0;?>
              <?php $cart_total=0;?>
              <?php foreach ( $orderinfo->result() as $row){?>
              <?php $i++;?>
              <?php $product=$this->products_model->get_product_byid($row->productid);?>
               <?php $productinfo=$product->row();?>
              <tr>
                <td ><?php echo $i;?>&nbsp;</td>
                <td ><?php echo $productinfo->sku;?>&nbsp;</td>
                <td ><?php echo $productinfo->title;?>&nbsp;</td>
               
                <td >
                    <div class="product-price normal">
						<div class="pr" style="display: inline-block"><?php echo get_store_currency();?></div> 
						<div class="pr" style="display: inline-block"><?php echo number_format($row->price,2);?></div>&nbsp;
					</div>
               	</td> 
                <td ><?php echo $row->quantity;?>&nbsp;</td>
                <td ><?php $itemtotal=$row->quantity*$row->price;?> 
                       	<div class="product-price normal">
                        	<div class="pr" style="display: inline-block"><?php echo get_store_currency();?></div> 
                        	<div class="pr" style="display: inline-block"><?php echo number_format($itemtotal,2)  ?></div>&nbsp;
						</div>
             		</td>
              </tr>
              <?php 
			  	$cart_total=$itemtotal+$cart_total;
			  ?>
              <?php }?>
              <tr>
              	<td   colspan="3" style="border-top:1px solid #cccccc">&nbsp;
                
                </td>
                <td   colspan="3" style="border-top:1px solid #cccccc">
                    <table border="0" width="100%">
                      <tr>
                        <td width="64%" ><strong><?php echo $this->lang->line('ordertotalprice');?></strong></td>
                        <td width="38%">
                        <div class="product-price">
                        	<div class="pr" style="display: inline-block"><?php echo get_store_currency();?></div> 
                        	<div class="pr" style="display: inline-block"><?php echo number_format($cart_total,2);?></div>&nbsp;
							</div>
                        </td>
                      </tr>
                      <tr>
                        <td  ><strong><?php echo $this->lang->line('ordershippingprice');?></strong></td>
                        <td >
                        <div class="product-price">
                        	<div class="pr" style="display: inline-block"><?php echo get_store_currency();?></div> 
                        	<div class="pr" style="display: inline-block"><?php echo $order->shippingchareges;?></div>&nbsp;
							</div>
                        </td>
                      </tr>
                      <tr>
                        <td ><strong><?php echo $this->lang->line('ordergrandtotal');?></strong></td>
                        <td>
                        <div class="product-price">
                        	<div class="pr" style="display: inline-block"><?php echo get_store_currency();?></div> 
                        	<div class="pr"  style="display: inline-block"><?php echo $order->grandtotal;?></div>&nbsp;
							</div>
                        </td>
                      </tr>
                  </table>
              </td>
              </tr>
            </table>

            </div>
         </div>
         
        
         
         
        </div>
    </div>