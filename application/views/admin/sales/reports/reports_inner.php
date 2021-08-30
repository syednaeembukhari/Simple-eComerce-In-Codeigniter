<?php $i=0;?>
  <?php foreach($orders->result() as $row){ $i++;?>
  <tr>
    
     <td ><?php echo $row->orderid;?></td>
     <td ><?php $pros=$this->orders_model->get_order_products($row->orderid);
			foreach($pros as $pro){
		?>

		<?php $product_images=$this->products_model->get_product_images_array($pro->productid,false);?>
		<img src="<?php echo $product_images['img1'];?>"  style="height: 70px" id="img-0"/><br/>
		<small>sku:<?php echo $pro->sku; ?></small>
	<?php }?>
    </td> 
    <td >
    <p style="margin-bottom:0px"><?php echo $row->shippingfname;?> <?php echo $row->shippinglname;?></p>
    <p style="margin-bottom:0px"><?php echo $row->shippingaddress;?></p>
    <p style="margin-bottom:0px"><?php echo $row->shippingcity;?></p>
    <p><?php echo $row->shippingphone;?></p>
    
    </td>
     <?php if(is_sale_method_checkout()){?>
    <td >
   
    <?php if($row->billingsame=='billingsame'){?>
    <p style="margin-bottom:0px">Same as Shipping</p>
    <?php }else{?>
    <p style="margin-bottom:0px"><?php echo $row->shippingfname;?> <?php echo $row->shippinglname;?></p>
    <p style="margin-bottom:0px"><?php echo $row->shippingaddress;?></p>
    <?php }?>
    </td>
     <?php }?>
    <td ><?php echo $row->grandtotal;?></td>
    <td ><?php echo $row->orderdate;?></td>
    <td >
        <a href="<?php echo ci_site_url('admin/sales/order/'.$row->orderid);?>"  class="btn btn-info btn-sm">Detail</a>
    </td>
    
  </tr>
  <?php 
   $offset = $offset + 1;
  ?>
 <?php }?> 
 <?php /*?><a href="<?php echo ci_site_url('admin/sales/pending_orders_next/'.$offset.'/' );?>" class="jscroll-next"></a><?php */?>