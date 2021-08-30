<div class="row cart-item">
                	<div class="col-sm-4 col-xs-4">
                    	<img src="<?php echo $product_images['img1'];?>"   class="img-responsive"  style="max-width:150px; width:100%"/>
                    </div>	
                    <div class="col-sm-6 col-xs-8">
                    	<div class="product-title"><?php echo $productinfo->title;?></div>
                        <div class="product-qty">Quantity: <?php echo $cartrow->qty;?></div>
                        <div class="product-peritem">Price per Item: <?php echo get_store_currency();?> <?php echo $cartrow->price;?></div>
                        <div class="product-peritem hidden-md hidden-sm hidden-lg">
                        <div class="price"><?php echo get_store_currency();?> <?php echo $itemtotal;?></div>
                        <a href="" class="cart-itemremove" style="position:absolute; right:1px; top:1px"><i class="fa fa-times-circle"></i></a>
                        </div>
                        
                    </div>	
                    <div class="col-xs-2 hidden-xs">
                    	<div class="price"><?php echo get_store_currency();?> <?php echo $itemtotal;?></div>
                        <a href="" class="cart-itemremove" style="position:absolute; right:1px; top:1px"><i class="fa fa-times-circle"></i></a>
                    </div>
                    
                </div>