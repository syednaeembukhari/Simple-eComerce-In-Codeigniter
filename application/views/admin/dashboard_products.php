<?php 
if($products->num_rows()>0){
?>
	<?php
    	foreach($products->result() as $product){
	?>
    	<div class="col-lg-3 col-md-4 col-sm-6 ">
       		<div class="productitem">
        	<div class="img-upload-btn" style="display: none">
            <a href="<?php echo ci_site_url('admin/products/addproducts/'.$product->productid);?>" class="btn btn-danger btn-xs">
            	<i class="fa fa-pencil"></i> Edit Product Details
                    
             </a>
             </div>
        	
                <div class="product-dashboard">
                    <a href="<?php echo ci_site_url('admin/products/addproducts/'.$product->productid);?>">
                    <div class="img">
                        <?php //print_r($product);?>
                        <?php $product_images=$this->products_model->get_product_images_array($product->productid);?>
                        <img src="<?php echo $product_images['img1'];?>" class="img-responsive"/>
                    </div>
                  
                    <div class="title" ><?php echo $product->title;?></div> 
                   </a>
                    <?php /*?> <div class="name"><?php echo get_product_price($product);?></div> <?php */?>
                    <div class="product-price">
					<?php echo get_product_price_old($product);?>
					
                    </div> 
                
                </div> 
                <div class="product-dashboard ">
                	<a href="<?php echo ci_site_url('admin/products/addproducts/'.$product->productid);?>"
                	 class="btn btn-danger btn-xs" title="Edit Product Details">
						<i class="fas fa-edit"></i> 

					 </a>
					<a  href="javascript:void(0)"   id="hideprobtn<?php echo $product->productid?>" 
					style="<?php if($product->status=='Inactive'){ echo 'display:none';}?>"
					class="  btn btn-danger btn-xs" onClick="hideproduct('<?php echo $product->productid?>')" title="<?php echo $this->lang->line('prohidebtn');?>" >
						<i class="fas fa-eye-slash"></i>
					</a>
					<a  href="javascript:void(0)"  id="showprobtn<?php echo $product->productid?>"
					 style="<?php if($product->status=='Active'){ echo 'display:none';}?>"
					class=" btn btn-warning btn-xs" onClick="showproduct('<?php echo $product->productid?>')"  title="<?php echo $this->lang->line('proshowbtn');?>"
					 >
						 <i class="fas fa-eye"></i>
					</a>
				</div>
           </div>
            
        </div>
	<?php }?>
<?php }?>


<script>
function hideproduct(id)
		{
			//console.log($('input[name="catname[]"]:checked').serialize());
			//var cats=$('input:checkbox:checked.catname_check');
			//console.log(cats);
			//return;
			$.ajax ( { 
						dataType:"json",
						type: "POST",
						url: "<?php echo ci_site_url('admin/products/hide_product');?>/"+id,
						data: { 
								is_ajax:true,
								productid: $('#productid').val()
						},
					})
					.done(function( response ) {
						$('#showprobtn'+id).show();
						$('#hideprobtn'+id).hide();
						//$('#msgcontainer').html(response.msg);
						//setTimeout(function(){ $('#msgcontainer').html(''); }, 5000);
			});
		}
		function showproduct(id)
		{
			//console.log($('input[name="catname[]"]:checked').serialize());
			//var cats=$('input:checkbox:checked.catname_check');
			//console.log(cats);
			//return;
			$.ajax ( { 
						dataType:"json",
						type: "POST",
						url: "<?php echo ci_site_url('admin/products/show_product');?>/"+id,
						data: { 
								is_ajax:true,
								productid: $('#productid').val()
						},
					})
					.done(function( response ) {
						$('#showprobtn'+id).hide();
						$('#hideprobtn'+id).show();
						//$('#msgcontainer').html(response.msg);
						//setTimeout(function(){ $('#msgcontainer').html(''); }, 5000);
			});
		}
</script>