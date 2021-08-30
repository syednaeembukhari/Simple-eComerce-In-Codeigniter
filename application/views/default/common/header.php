<div class="container logocontainer">
	<div class="row hidden-xs">
   		<div class="<?php if(is_sale_method_checkout()){?>col-md-4 col-sm-6  col-xs-6<?php }else{ ?>col-md-12 text-center<?php }?>">
        	  <a href="<?php echo ci_site_url('/');?>" title="<?php echo SITE_NAME?>" class="sitelogo">
             
              <?php $current_logo=get_store_settings('LOGO_IMG');?>
				 <?php  if ($current_logo==''){
                            $current_logo=base_url().'assets/images/logo.png';
                        }
                        else
                        $current_logo=base_url().MEDIA_UPLOAD_PATH.'/common/'.$current_logo;
                 ?>
            	<img src="<?php echo $current_logo;?>"  alt="<?php echo store_name()?>" class="logo"/>
              </a>
        </div>
        <?php  if(is_sale_method_checkout()){?>
    	<div class="col-md-4 col-sm-6 col-xs-6 freeshiping-header" >
        	<div class="row ">
            	<div class="col-xs-12 freeshiping-header-phone" >
        			<i class="fa fa-mobile"></i> <?php echo get_store_settings('SERVICE_PHONE');?>
            	</div> 
                <div class="col-xs-12" >
        			<?php $freeshiping=get_store_settings('FREE_SHIPPING_OVER');?>
					<?php if($freeshiping>0){?>
               		<i class="fa fa-bus"></i> 
                       Free Shipping  On Order Over <?php echo get_store_currency();?><?php echo get_store_settings('FREE_SHIPPING_OVER');?>
            
                <?php }?>
            	</div>  
            </div>
        </div>
       
        <div class="col-md-4 col-sm-6 cartcontainer">
       
       	  <div>	  		
            <a href="<?php echo ci_site_url('customers/cart');?>" class="btn btn-warning cart-btn">My Cart <span id="cart_count" class="badge"><?php echo count_temp_cart_items();?></span></a>
            </div>
       
        </div> 
        <?php }?>
    </div>
</div>
<?php //echo $this->load->view(active_theme().'/common/mainnav');?>












