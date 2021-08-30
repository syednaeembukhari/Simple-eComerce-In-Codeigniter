<!DOCTYPE html>
<html lang="en">
  <head>
	<?php $this->load->view(active_theme().'/common/scripts');?>   
    <link href="<?php echo base_url();?>assets/templates/<?php echo active_theme();?>/login.css" rel="stylesheet">
  </head>
  <body>
   	 <?php $this->load->view(active_theme().'/common/header');?>  
      
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
	if($cartitems->num_rows()>0)
	{
		//echo "here";
		
	?>
        <div class="row ">
            
             <div class="col-md-8  col-sm-8 ">
             	<h4>Shoping Cart</h4>
             	
                <?php $cart_total=0;?>
                <?php foreach($cartitems->result() as $cartrow){?>
                <?php $product=$this->products_model->get_product_byid($cartrow->productid);?>
                <?php if($product->num_rows()>0){?>
                <?php $productinfo=$product->row();?>
                <?php $product_images=$this->products_model->get_product_images_array($productinfo->productid,false);?>
                <?php $itemtotal=0;?>
                <?php $itemtotal=(int)$cartrow->qty * (float)$cartrow->price;?>
                <?php $cart_total=(float)$cart_total + $itemtotal;?>
                <div class="row cart-item">
                	<div class="col-sm-4 col-xs-4">
                    	<img src="<?php echo $product_images['img1'];?>"   class="img-responsive"  style="max-width:150px; width:100%"/>
                    </div>	
                    <div class="col-sm-6 col-xs-8">
                    	<div class="product-title"><?php echo $productinfo->title;?></div>
                        <div class="product-qty">Quantity: <input name="<?php echo $cartrow->productid;?>" class="qty-edit" type="number" min="1" value="<?php echo $cartrow->qty;?>" style="width:60px; padding:0px 3px ; display:inline-block"/></div>
                        <div class="product-peritem">Price per Item: <?php echo get_store_currency();?> <?php echo $cartrow->price;?></div>
                        <div class="product-peritem hidden-md hidden-sm hidden-lg">
                        <div class="price"><?php echo get_store_currency();?> <?php echo $itemtotal;?></div>
                        <a href="<?php echo ci_site_url('products/cartitem_remove/'.$cartrow->temp_id)?>" class="cart-itemremove fancybox fancybox.iframe" style="position:absolute; right:1px; top:1px"><i class="fa fa-times-circle"></i></a>
                        </div>
                        
                    </div>	
                    <div class="col-xs-2 hidden-xs">
                    	<div class="price"><?php echo get_store_currency();?> <?php echo $itemtotal;?></div>
                        <a href="<?php echo ci_site_url('products/cartitem_remove/'.$cartrow->temp_id)?>" class="cart-itemremove fancybox fancybox.iframe" style="position:absolute; right:1px; top:1px"><i class="fa fa-times-circle"></i></a>
                    </div>
                    
                </div>
                <?php } ?>
                <?php } ?>
                <?php //echo get_store_currency();?>
                <div class="row cart-item">
                	<div class="col-xs-3" >
                    <button  type="button" class="btn btn-info btn-sm" onclick="UpdateCart();">Update Cart</button> 
                    </div>
                	<div class="col-xs-6" style="text-align:right">
                    	<div class="total-price">Total</div>
                        <div class="total-shiping">Shiping Estimate</div>
                        <div class="total-order">Order Total</div>
                    </div>
                    <div class="col-xs-3">
                    	
                    	<div class="total-price">
							<?php echo get_store_currency();?> <?php echo $cart_total;?>
                        </div>
                        <div class="total-shiping">
							<?php echo get_store_currency();?> <?php echo $shiping_cost=get_shiping_cost();?>
                        </div>
                        <div class="total-order">
							<?php echo get_store_currency();?> <?php echo (float)$shiping_cost+(float)$cart_total;?>
                        </div>
                        
                    </div>
                
                </div>
             </div>
                   
             <div class="col-md-4  col-sm-3">
                	<?php $this->load->view( active_theme().'/customers/cart/user-accountinfo');?>
             </div>      
                  
        </div>
     <?php }else{?>
     	<div class="row ">
            <div class="col-md-12">
              	Your cart is empty..   
           	</div>
        </div>  
     <?php }?>
     
    </div>
</div>
	<?php $this->load->view(active_theme().'/common/footer');?>   
  </body>
</html>