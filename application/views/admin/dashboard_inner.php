
<div class="container  main-banner">

	<div class="row" >
	<div class="col-md-12 alert " id="msg-display">

	</div>
	</div>
	<div class="row">
    	<div class="col-md-12">
       	
        	<div class="img-upload-btn" style="top:10px; padding-left:10px">
             <a href="<?php echo ci_site_url('admin/dashboard/upload_banner');?>"  class="btn btn-info fancybox fancybox.iframe  ">	
             	<i class="fa fa-camera"></i> Change Banner Image
             </a>

          		
                <a href="javascript:void(0)" id="bannershow" onClick="settings_update_msg('MAINBANNER','1','msg-display');$('#bannershow').hide();$('#bannerhide').show()" class="btn btn-primary" style="<?php if(get_store_settings('MAINBANNER')=='1'){ echo  'display:none';}?>" >Show Banner</a>
               
                <a href="javascript:void(0)" id="bannerhide" onClick="settings_update_msg('MAINBANNER','0','msg-display');$('#bannershow').show();$('#bannerhide').hide()"   class="btn btn-primary" style="<?php if(get_store_settings('MAINBANNER')=='0'){ echo  'display:none';}?>" >Hide Banner</a>
                
             
             </div>
             <?php $current_banner=get_store_settings('BANNER_IMG');?>
             <?php  if ($current_banner==''){
						$current_banner=base_url().'assets/images/banner.png';
			 		}
					else
					$current_banner=base_url().MEDIA_UPLOAD_PATH.'/banners/'.$current_banner;
			 ?>
             <img src="<?php echo $current_banner;?>" class="img-responsive" id="banner_image" style="background:#CCCCCC; width:100%"/>
            
        </div>
	</div>
</div>
<div class="container">
	<div class="row" id="autoloaderinner">
<?php
$this->data['offset']=0;
$this->data['limit']=20;
$this->data['products']=$this->products_model->get_products($this->data['offset'],$this->data['limit']);
?>
<?php $this->load->view('admin/dashboard_products',$this->data);?>

	</div>
</div>
<?php if(false){?>
<div class="container-fluid">
	<div class="row">
    	<div class="col-md-12">
        	<h3 style="text-align:center">Welcome to administration area</h3>
            <div class="row">
            	<div class="col-md-3 col-sm-4 col-xs-6 dashboard-item">
                	<a href="<?php echo ci_site_url('admin/products')?>">
                    	<i class="fa fa-list-alt"></i>
                    	<div>Products</div>
                    </a>
                </div>
                
                <div class="col-md-3 col-sm-4 col-xs-6 dashboard-item">
                	<a href="<?php echo ci_site_url('admin/categories')?>">
                    	<i class="fa fa-tags"></i>
                    	<div>Categories and Tags</div>
                    </a>
                </div>
                
                <div class="col-md-3 col-sm-4 col-xs-6 dashboard-item">
                	<a href="<?php echo ci_site_url('admin/reports')?>">
                    	<i class="fa fa-bar-chart"></i>
                    	<div>Reports</div>
                    </a>
                </div>
                
                <div class="col-md-3 col-sm-4 col-xs-6 dashboard-item">
                	<a href="<?php echo ci_site_url('admin/inv_prices')?>">
                    	<i class="fa fa-twitch"></i>
                    	<div>Inventory</div>
                    </a>
                </div>
                
                <div class="col-md-3 col-sm-4 col-xs-6 dashboard-item">
                	<a href="<?php echo ci_site_url('admin/inv_prices')?>">
                    	<i class="fa fa-money"></i>
                    	<div>Prices</div>
                    </a>
                </div>
                
                <div class="col-md-3 col-sm-4 col-xs-6 dashboard-item">
                	<a href="<?php echo ci_site_url('admin/orders')?>">
                    	<i class="fa fa-book"></i>
                    	<div>Orders</div>
                    </a>
                </div>
                
                <div class="col-md-3 col-sm-4 col-xs-6 dashboard-item">
                	<a href="<?php echo ci_site_url('admin/settings')?>">
                    	<i class="fa fa-cog"></i>
                    	<div>Settings</div>
                    </a>
                </div>
                
                 <div class="col-md-3 col-sm-4 col-xs-6 dashboard-item">
                	<a href="<?php echo ci_site_url('admin/myaccount')?>">
                    	<i class="fa fa-user"></i>
                    	<div>My Account</div>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php }?>