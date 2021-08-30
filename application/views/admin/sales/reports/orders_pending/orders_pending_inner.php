<?php $i=0;?>
  <?php foreach($orders->result() as $row){ $i++;?>
  <tr>
    
     <td ><?php echo $row->orderid;?></td>
    <td >
    <p style="margin-bottom:0px"><?php echo $row->shippingfname;?> <?php echo $row->shippinglname;?></p>
    <p style="margin-bottom:0px"><?php echo $row->shippingaddress;?></p>
    
    </td>
    <td >
    <?php if($row->billingsame=='billingsame'){?>
    <p style="margin-bottom:0px">Same as Shipping</p>
    <?php }else{?>
    <p style="margin-bottom:0px"><?php echo $row->shippingfname;?> <?php echo $row->shippinglname;?></p>
    <p style="margin-bottom:0px"><?php echo $row->shippingaddress;?></p>
    <?php }?>
    </td>
    
    <td ><?php echo $row->grandtotal;?></td>
    <td ><?php echo $row->orderdate;?></td>
    
    
  </tr>
  <?php 
   $offset = $offset + 1;
  ?>
 <?php }?> 
 <?php /*?><a href="<?php echo ci_site_url('admin/sales/pending_orders_next/'.$offset.'/' );?>" class="jscroll-next"></a><?php */?>