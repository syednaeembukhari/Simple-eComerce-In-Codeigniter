<div class="container-fluid admin-menu product-menu admin-topmenu-bg" style="margin-bottom:20px">
	<div class="row admin-topmenu" >
    	
        
    	<div class="col-sm-9">
        	<ul class="admin-top-menu">
            	<?php 
						$pid=0;
						if(isset($productid))
						$pid=$productid;
						
						$productid=$pid;
				?>
                <?php /*?><li>
                	
                	<?php $preid=get_pre_product_id($productid);?>
                    
                    <?php if($preid>0){?>
                    <a href="<?php echo ci_site_url('admin/products/addproducts/'.$preid)?>" title="Previous" class="btn">
                    <i class="fa fa-long-arrow-left"></i>
                    	<small>Previous</small>
                    </a>
					<?php }else{
						?>
                        <a href="javascript:void(0)" title="Previous" class="btn" style="color:#CCCCCC">
                    		<i class="fa fa-long-arrow-left"></i>
                            <small>Previous</small>
                    	</a>
                        <?php
						}?>
                </li><?php */?>
                <?php /*?><li>
                	<?php $nextid=get_next_product_id($productid);?>
                	<?php if($nextid<0){?>
                    <a href="javascript:void(0)" title="Next" class="btn" style="color:#CCCCCC">
                    	<i class="fa fa-long-arrow-right"></i>
                        <small>Next</small>
                    </a>
                    <?php }else{?>
                    <a href="<?php echo ci_site_url('admin/products/addproducts/'.($nextid));?>" title="Next" class="btn">
                    	<i class="fa fa-long-arrow-right"></i>
                        <small>Next</small>
                    </a>
                    <?php }?>
                </li><?php */?>
                <li>
                    <a href="<?php echo ci_site_url('admin/dashboard')?>"  title="Add new">
                    
                    	<i class="fa fa-home"></i><span>Home
                    </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ci_site_url('admin/products/addproducts')?>"  title="Add new">
                    	
                        <i class="fa fa-plus"></i><span>Add Item
                    	</span>
                    </a>
                </li>
               
             
            	<li>
                    <a href="<?php echo ci_site_url('admin/sales');?>"  title="Sales">
                       
                        	<i class="fa fa-print"></i> <span>sales
                        </span>
                    </a>
                </li>
                <?php /*?><li>
                 <a href="#<?php echo ci_site_url('admin/inv_prices');?>" class="btn" title="Inventory and prices">
                    <i class="fa fa-twitch"></i>
                    <small>Inventory &amp; prices</small>
                </a>
                </li>
                <li>
                <a href="<?php echo ci_site_url('admin/reports');?>" class="btn" title="Reports">
                    <i class="fa fa-bar-chart"></i>
                    <small>Reports</small>
                    
                </a>
                </li><?php */?>
                <li>
                    <a href="<?php echo ci_site_url('admin/settings');?>"  title="Settings">
                        
                        <i class="fa fa-cog"></i><span>settings
						</span>
                    </a>
                </li>
                <?php /*?><li>
                 <a href="<?php echo ci_site_url('admin/help');?>"  title="Help">
                    
                    <i class="fa fa-question-circle"></i> <span>Help</span>
                </a>
                </li><?php */?>
                
                <li>
                 <a href="<?php echo ci_site_url('logout');?>"  title="Help">
                   
                      <i class="mega-octicon octicon-sign-out"></i>
 					 <span>Log Out</span>
                </a>
                </li>
        
       	 	</ul>
        </div>
    </div>
    
</div>
<div class="container" style="margin-bottom:20px; border-bottom:1px solid #EFEFEF; padding-bottom:5px">
<div class="row">
    	<div class="col-sm-4">
        	
        	<div class="img-upload-btn" style=" right:0px;" >
            <a href="<?php echo ci_site_url('admin/dashboard/upload_logo');?>"  class="fancybox fancybox.iframe btn btn-warning btn-sm" style="font-size:14px; line-height:16px"><i class="fa fa-camera"></i>
 Change Logo
             </a>
             </div>
         	<a href="<?php echo ci_site_url('admin/dashboard/upload_logo');?>"  class="fancybox fancybox.iframe sitelogo">
            	<?php $current_logo=get_store_settings('LOGO_IMG');?>
				 <?php  if ($current_logo==''){
                            $current_logo=base_url().'assets/images/logo.png';
                        }
                        else
                        $current_logo=base_url().MEDIA_UPLOAD_PATH.'/common/'.$current_logo;
                 ?>
            	<img src="<?php echo $current_logo;?>" id="admin_logo" align="Site logo" title="Click to upload logo"/>

            </a>
       
        </div>
    </div>
   </div>