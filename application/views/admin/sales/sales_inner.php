<div class="container">
	<?php $this->load->view('admin/sales/sales-menu');?>
    <div class="row">
        <div class="col-md-12"><h3 class="admin_title"><?php echo $this->lang->line('sales');?></h3></div>
    </div>
     <div class="row">
        <div class="col-md-6"><h5 class="admin_title"><?php echo $this->lang->line('salerecentorder');?></h5></div>
		 <div class="col-md-6 text-right"><a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="$('#print_orders').submit()">Print Selected</a></div>
    </div>
    <hr/>
        	
    <div class="row">
    	<form id="print_orders" method="post" action="<?php echo site_url('admin/sales/print_orders')?>" enctype="multipart/form-data">
		<div class="col-md-12">
        <?php //pre_print($orders);?>
        	<table width="100%" id="salestbl" border="0" class="table table-striped table-bordered">
             <thead>
               <tr>
                <th width="2%">#</th>
                <th width="8%"><?php echo $this->lang->line('orderno');?></th>
                <th width="15%">Product</th>
               <?php if(is_sale_method_checkout()){?>
                <th width="33%"><?php echo $this->lang->line('ordershipingaddress');?></th>
               <?php }?>
                <th width="43%"><?php echo $this->lang->line('orderbillingaddress');?></th>
                <th width="9%"><?php echo $this->lang->line('ordertotalprice');?></th>
                <th width="15%">&nbsp;</td>
              </tr>
              </thead>
              <tbody>
              <?php $i=0;?>
              <?php foreach($orders->result() as $row){ $i++;?>
              <tr>
                <td><?php echo $i;?> <input type="checkbox" name="orderids[]" class="orderids" value="<?php echo $row->orderid;?>"/></td>
                 <td><?php echo $row->orderid;?></td>
                 <td>
                		
                		<?php $pros=$this->orders_model->get_order_products($row->orderid);
					 		foreach($pros as $pro){
					 	?>
                		
                 		<?php $product_images=$this->products_model->get_product_images_array($pro->productid,false);?>
              			<img src="<?php echo $product_images['img1'];?>"  style="height: 70px" id="img-0"/><br/>
              			<small>sku:<?php echo $pro->sku; ?></small>
              		<?php }?>
				  </td>
                <td>
                <p style="margin-bottom:0px"><?php echo $row->shippingfname;?> <?php echo $row->shippinglname;?></p>
                <p style="margin-bottom:0px"><?php echo $row->shippingaddress;?></p>
                <p style="margin-bottom:0px"><?php echo $row->shippingcity;?></p>
                <p><?php echo $row->shippingphone;?></p>
                
                </td>
                <?php if(is_sale_method_checkout()){?>
                <td>
                <?php if($row->billingsame=='billingsame'){?>
                <p style="margin-bottom:0px"><?php echo $this->lang->line('orderbillingsame');?></p>
                <?php }else{?>
                <p style="margin-bottom:0px"><?php echo $row->shippingfname;?> <?php echo $row->shippinglname;?></p>
                <p style="margin-bottom:0px"><?php echo $row->shippingaddress;?></p>
                <p><?php echo $row->shippingphone;?></p>
                <?php }?>
                </td>
                <?php }?>
                <td><?php echo $row->grandtotal;?></td>
                <td>
                	<a href="<?php echo ci_site_url('admin/sales/order/'.$row->orderid);?>"  class="btn btn-info btn-xs"><?php echo $this->lang->line('saledetail');?></a>
                	<a  href="<?php echo ci_site_url('admin/sales/shiporder/'.$row->orderid);?>"  class="fancybox fancybox.iframe btn btn-success btn-xs"><?php echo $this->lang->line('saleshipit');?></a>
                    <a  href="<?php echo ci_site_url('admin/sales/cancel_order/'.$row->orderid);?>"  class="fancybox fancybox.iframe btn btn-warning btn-xs"><?php echo $this->lang->line('salecancel');?></a>
                
                </td>
                
              </tr>
             <?php }?>
             </tbody> 
            </table>

        </div>   
        
		</form>  
    </div>
 <script type="text/javascript">
    $(document).ready(function() {
		//$('a [rel="tooltip"]').tooltip();
      
       $('#salestbl').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[ 25, 50, 100, 150, -1], [ 25, 50, 100, 150, "All"]],
            responsive: false,
            "ordering": true,
		   "aoColumnDefs": [
				{ 
				  "bSortable": false, 
				  "aTargets": [ -1 ] // <-- gets last column and turns off sorting
				 } 
			 ],
            language: {
				search: "_INPUT_",
            	searchPlaceholder: "Search records",
			}

        });
	});
	</script>
</div>