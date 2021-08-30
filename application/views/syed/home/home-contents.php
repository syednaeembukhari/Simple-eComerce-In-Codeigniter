<div class="container-fluid mainnbanner">
 	<img src="assets/images/mainbanner.png"  class="img-responsive" style="width:100%"/>
    <div class="page-main-heading">Home</div>
</div>
<div class="container-fluid productscontaner">
	<div class="row ">
    	<?php for($i=1;$i<=6;$i++){?>
   		<div class="col-lg-3 col-md-4 col-sm-6  col-xs-12 products"  style="margin-bottom:10px; margin-top:10px">
        	<div class="product">
        		<div class="product-image-container" style="position:relative; background:#CCC" >
                	<a href=""><img src="assets/images/product.png" class="img-responsive" style="background:url(<?php echo base_url();?>media/products/<?php echo $i;?>.jpg) ; background-size:100%; background-position:center; width:100% "/></a>
                	<!--<div class="product-image" style="position:relative; z-index:999; width:100%; height:100%"><a href=""><img src="media/products/<?php echo $i;?>.jpg" class="img-responsive"/></a></div>-->
                </div>
                <div class="product-title"><a href="">Product Title</a></div>
                <div class="product-rating">
                	<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                </div>
                <div class="product-price">
				<span><?php echo get_store_currency();?>6555.55</span>
				<?php echo get_store_currency();?>5555.55
                </div>
            </div>
        </div>
        <?php }?>
       
    </div>
</div>