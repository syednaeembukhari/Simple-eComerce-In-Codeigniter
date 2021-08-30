<?php /*?><div class="container-fluid page_title_container">
	<div class="row">
    	<div class="col-md-12">
    		 <div class="page-heading">Shop</div>
        </div>
    </div>
</div><?php */?>
<div class="container productcontainer">
	 <?php 
	//print_r($productdata);
	if($product->num_rows()>0)
	{
		//echo "here";
		$productinfo=$product->row();
	?>
				<div class="row">
				<div class="col-md-12">
					<h2 class="product_title"><?php echo $productinfo->title;?> <!--<small>(<?php echo $productinfo->sku;?>)</small>--></h2>
					<hr/>
		   		</div>
			   </div>
    			<div class="row">
    			<?php if(get_store_settings('CATEMENUSHOW')=='1'){?>
              	<div class="col-md-2  col-sm-3  hidden-xs">
                	<?php $this->load->view( active_theme().'/products/category_tags');?>
                    
                </div>
                <?php }?>
                <div class="<?php if(get_store_settings('CATEMENUSHOW')=='1'){?>col-md-10  col-sm-9<?php }else{?>col-md-12<?php } ?>  col-xs-12">
                	
                    	<?php //echo $productid;?>
           				<?php $product_images=$this->products_model->get_product_images_array($productid,false);?>
                  <div class="row" >
                    <div class="col-md-4  col-sm-5 product_images">
                        <div class="row">
                            <div  class="col-md-12" >
                      			<img src="<?php echo $product_images['img1'];?>" class="img-responsive" id="img-0"/>
                            </div>
                        </div>
                        <?php $countimages=0; foreach($product_images as $img){ 
								if($img!=''){ $countimages++;} 
							 }?>
                        <?php  if($countimages>1){?>
                        <div class="row">
                        	<?php $imgcount=0;?>
                        	<?php foreach($product_images as $img){?>
                            <?php $imgcount++;?>
                        	<?php if($img!=''){?>
                            <div  class="col-sm-3 col-xs-3 pro-img">
                            	<img src="<?php echo $img;?>" class="img-responsive" id="img-<?php $imgcount?>" onClick="chnage_img('<?php echo $img;?>')"/>
                                
                            </div>
                            <?php }?>
                            <?php }?>
                           
                        </div>
                         <?php }?>
                    </div>
                    <div class="col-md-8  col-sm-7">
                   
                        
                        <input type="hidden" value="<?php echo $productid;?>" name="productid" id="productid"/>
                       
                       
                       <div class="row">
                       	<div class="col-md-12 price_container">
                        	<span class="product_price"><?php echo get_product_price_old($productinfo);?></span>
                        </div>
                       </div>
                       
                       <div class="row">
                       	<div class="col-md-12 product_description">
                        	<?php echo $productinfo->description;?>
                        </div>
                       </div>
                       <?php if(get_store_settings('SALE_METHOD')!='CONTACTFORM'){  ?>
                       <div class="row">
                       	<div class="col-md-12 instock_container">
                        	<?php if($productinfo->instock>0){?>
                        	<span class="label label-warning instock"><?php echo $this->lang->line('instock');?></span> 
							<?php }else{?>
                            <span class="label label-success outstock"><?php echo $this->lang->line('outofstock');?></span> 
                            <?php }?>
                        </div>
                       </div>
                      <?php }?>
                                
                           
                            
                         <?php if($productinfo->instock>0 &&  get_store_settings('SALE_METHOD')=='CHECKOUT'){?>      
                        <div class="row">
                       	<div class="col-md-12">
                        	 <button type="button" class="btn btn-success btn-sm" onClick="addtocart('<?php echo $productinfo->productid;?>')" id="addtocart<?php echo $productid;?>">Add to Cart </button>
                        </div>
                       </div>     
                       <?php }?>      
						<?php if(get_store_settings('SALE_METHOD')=='CONTACTFORM'){
								$this->load->view(active_theme().'/products/contactform'); 
						}?>
                     
                       
                    </div>
                    <?php }?> 
    
                  </div>
                  
               </div>
            </div>
       
    </div>
</div>
<script>
function chnage_img(newsrc)
{
	$('#img-0').attr('src',newsrc);
}
</script>