<?php /*?><div class="container-fluid page_title_container">
	<div class="row">
    	<div class="col-md-12">
    		 <div class="page-heading">Shop</div>
        </div>
    </div>
</div><?php */?>
<div class="container-fluid productcontainer">
	 <?php 
	//print_r($productdata);
	if($product->num_rows()>0)
	{
		//echo "here";
		$productinfo=$product->row();
	?>
    <div class="row ">
    	
              	<div class="col-md-2  col-sm-3">
                	<?php $this->load->view( active_theme().'/products/category_tags');?>
                    
                </div>
                <div class="col-md-10  col-sm-9 ">
                	
                    	<?php //echo $productid;?>
           				<?php $product_images=$this->products_model->get_product_images_array($productid,false);?>
                  <div class="row" >
                    <div class="col-md-4  col-sm-5 product_images">
                        <div class="row">
                            <div  class="col-md-12" >
                      			<img src="<?php echo $product_images['img1'];?>" class="img-responsive" id="img-0"/>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<?php $imgcount=0;?>
                        	<?php foreach($product_images as $img){?>
                            <?php $imgcount++;?>
                        	<?php if($img!=''){?>
                            <div  class="col-sm-3 col-xs-6 pro-img">
                            	<img src="<?php echo $img;?>" class="img-responsive" id="img-<?php $imgcount?>" onClick="chnage_img('<?php echo $img;?>')"/>
                                
                            </div>
                            <?php }?>
                            <?php }?>
                           
                        </div>
                    </div>
                    <div class="col-md-8  col-sm-7">
                   
                        
                        <input type="hidden" value="<?php echo $productid;?>" name="productid" id="productid"/>
                       <div class="row">
                       	<div class="col-md-12">
                        	<h2 class="product_title"><?php echo $productinfo->title;?><small>(<?php echo $productinfo->sku;?>)</small></h2>
                        </div>
                       </div>
                       
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
                       
                       <div class="row">
                       	<div class="col-md-12 instock_container">
                        	<?php if($productinfo->instock>0){?>
                        	<span class="label label-warning instock">Instock</span> 
							<?php }else{?>
                            <span class="label label-success outstock">Out of Stock</span> 
                            <?php }?>
                        </div>
                       </div>
                      
                                
                           
                            
                         <?php if($productinfo->instock>0){?>      
                        <div class="row">
                       	<div class="col-md-12">
                        	 <button type="button" class="btn btn-success btn-sm" onClick="addtocart('<?php echo $productinfo->productid;?>')" id="addtocart<?php echo $productid;?>">Add to Cart </button>
                        </div>
                       </div>     
                       <?php }?>      

                     
                       
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