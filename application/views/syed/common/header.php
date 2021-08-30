<div class="container-fluid mainheader">
	<div class="row toprow">
   		<div class="col-md-6 col-sm-12">
        	<div class="row">
            	<div class="col-xs-4">
        			<i class="fa fa-mobile"></i> <?php echo get_store_settings('SERVICE_PHONE');?>
            	</div>
                
            	<?php $freeshiping=get_store_settings('FREE_SHIPPING_OVER');?>
				<?php if($freeshiping>0){?>
                <div class="col-xs-8">
                        <i class="fa fa-bus"></i> 
                        Free Shipping  On Order Over <?php echo get_store_currency();?><?php echo get_store_settings('FREE_SHIPPING_OVER');?>
                </div>
                <?php }?>
          	</div>  
        </div>
    	<div class="col-md-6 col-sm-12 topmenu">
            <ul class="nav nav-pills pull-right">
      			<li role="presentation"><a href="#">My Account</a></li>
      			<li role="presentation"><a href="#">Checkout</a></li>
      			<li role="presentation"><a href="#">Login</a></li>
    		</ul>
        </div>
    </div>
</div>
<div class="container-fluid logocontainer">
	<div class="row ">
   		<div class="col-md-5 col-sm-4  col-xs-6">
        	  <a href="<?php echo ci_site_url('/');?>" title="<?php echo SITE_NAME?>" class="sitelogo">
              <img src="<?php echo base_url();?>assets/images/logo.png" alt="<?php echo SITE_NAME?>" class="logo"/>
              </a>
        </div>
    	<div class="col-md-2 col-sm-4 col-xs-6">
        	<div class="form-group">
            <div class="input-group">
              	<input type="text" class="form-control" id="search" placeholder="Search">
              	<div class="input-group-addon">
                	<i class="fa fa-search"></i>
				</div>
            </div>
          </div>  
        </div>
        <div class="col-md-5 col-sm-4 hidden-xs cartcontainer">
        		<div>
        	  		<i class="fa fa-shopping-cart"></i> Item | $0.00
              </div>
        </div>
    </div>
</div>
<?php echo $this->load->view(active_theme().'/common/mainnav');?>