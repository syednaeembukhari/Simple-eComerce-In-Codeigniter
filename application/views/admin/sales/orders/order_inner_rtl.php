<?php $orderno='';?>  
      <?php if($orderinfo->num_rows()>0){?>
      <?php $order=$orderinfo->row();?>
<div class="container" style="margin-bottom:20px;">

    <div class="row">
        <div class="col-xs-6"><h3 class="admin_title"><?php echo $this->lang->line('orderdetail');?></h3></div>
        <div class="col-xs-6" style="text-align:right">
        <?php if($order->orderstatus<3){?>
        <a href="<?php echo ci_site_url('admin/sales/shiporder/'.$orderid);?>"  class="fancybox fancybox.iframe btn btn-success btn-sm">Ship it</a>
        <?php }?>
        <a href="javascript:void(0)" onclick="print_order()" class="btn btn-primary btn-sm">Print</a>
        </div>
    </div>
</div>

<div class="container" id="order-print">
   
   <link href="<?php echo base_url();?>assets/common/bootstrap/css/bootstrap.rtl.css" rel="stylesheet">
<style>
	body, input,textarea,select {  text-align: right }
</style>
   
    <div class="row">
        <div class="col-md-12">
        
      
      <div class="row">
        <div class="col-md-12">
        		<strong><?php echo $this->lang->line('orderno');?> - <?php echo $orderno=$order->orderid;?></strong>
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
                    
                <?php }else{?>
                    <p><?php echo $order->billingfname;?> <?php echo $order->billinglname;?></p>
                    <p><?php echo $order->billingaddress;?></p>
                    <p><?php echo $order->billingaddress2;?></p>
                    <p><?php echo $order->billingcity;?>,<?php echo $order->billingstate;?> <?php echo $order->billingzip;?></p>
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
              <td width="20%"><strong><?php echo $this->lang->line('ordertotalprice');?></strong></td>
              <td width="15%"><strong><?php echo $this->lang->line('orderquantity');?></strong></td> 
              <td width="11%"><strong><?php echo $this->lang->line('orderprice');?></strong></td>
              <td width="42%"><strong><?php echo $this->lang->line('orderitem');?></strong></td>
               <td width="10%"><strong><?php echo $this->lang->line('ordercode');?></strong></td>
                <td width="2%"><strong>#</strong></td>
                
                
                
               	
                
                
                
              </tr>
              <?php $i=0;?>
              <?php $cart_total=0;?>
              <?php foreach ( $orderinfo->result() as $row){?>
              <?php $i++;?>
              <?php $product=$this->products_model->get_product_byid($row->productid);?>
               <?php $productinfo=$product->row();?>
              <tr>
               
               
               <td width="20%"><?php echo $itemtotal=$row->quantity*$row->price;?>&nbsp;</td>
                <td width="15%"><?php echo $row->quantity;?>&nbsp;</td>
                <td width="11%"><?php echo $row->price;?>&nbsp;</td> 
               <td width="42%"><?php echo $productinfo->title;?>&nbsp;</td>
               <td width="10%"><?php echo $productinfo->sku;?>&nbsp;</td>
                <td width="2%"><?php echo $i;?>&nbsp;</td>
                
                
               
               
                
                
                
                
              </tr>
              <?php 
			  	$cart_total=$itemtotal+$cart_total;
			  ?>
              <?php }?>
              <tr>
              	
                <td   colspan="3">
                    <table border="0" width="100%">
                      <tr>
                        <td width="43%">
                        <strong><?php echo get_store_currency();?> <?php echo $cart_total;?></strong>&nbsp;
                        </td>
                        <td width="57%" ><strong><?php echo $this->lang->line('ordertotalprice');?></strong></td>
                       
                      </tr>
                      <tr>
                       <td width="43%">
                        <strong> <?php echo $order->shippingchareges;?>  <?php echo get_store_currency();?></strong>&nbsp;
                        </td>
                        <td  ><strong><?php echo $this->lang->line('ordershippingprice');?></strong></td>
                        
                      </tr>
                      <tr>
                       <td width="43%">
                        <strong><?php echo get_store_currency();?> <?php echo $order->grandtotal;?>&nbsp;</strong>
                        </td>
                        <td  align=""><strong><?php echo $this->lang->line('ordergrandtotal');?></strong></td>
                        
                      </tr>
                  </table>
              </td>
              <td   colspan="3">&nbsp;
                
                </td>
              </tr>
              
            </table>

            </div>
         </div>
         
        
         
         
        </div>
    </div>
</div>
<script type="text/javascript">
         function print_order() {
            var divContents = $("#order-print").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><link href="<?php echo base_url();?>assets/common/bootstrap/css/bootstrap.min.css" rel="stylesheet"><title>Order no:<?php echo $orderno;?> </title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
 <?php }?>