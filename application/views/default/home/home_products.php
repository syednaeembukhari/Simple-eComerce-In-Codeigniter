<?php 
if($products->num_rows()>0){
//print_r($products);
?>
	<?php
    	foreach($products->result() as $product){
	?>
    	<div class="col-lg-3 col-md-4 col-sm-6  col-xs-12 products"  style="margin-bottom:10px; margin-top:10px">
        	<div class="product">
        		<div class="product-image-container" style="position:relative; background:#CCC" >
                	<a href="<?php echo product_seo_url($product);?>">
                   		<?php $product_images=$this->products_model->get_product_images_array($product->productid);?>
                        <img src="<?php echo $product_images['img1'];?>" class="img-responsive"/>
                   </a>
                	<!--<div class="product-image" style="position:relative; z-index:999; width:100%; height:100%"><a href=""><img src="media/products/<?php echo $i;?>.jpg" class="img-responsive"/></a></div>-->
                </div>
                <div class="product-title" style="height:45px;overflow:hidden;">
                    <a href="<?php echo product_seo_url($product);?>">
                    	<?php echo $product->title;?>
                    </a>
                </div>
                
                <div class="product-price">
				<?php echo get_product_price_old($product);?>
                </div>
            </div>
        </div>
    
    	
	<?php }?>
<?php }?>