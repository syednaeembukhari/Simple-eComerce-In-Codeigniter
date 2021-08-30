<div class="container-fluid mainnbanner">
 	<?php $current_banner=get_store_settings('BANNER_IMG');?>
             <?php  if ($current_banner==''){
						$current_banner=base_url().'assets/images/banner.png';
			 		}
					else
					$current_banner=base_url().MEDIA_UPLOAD_PATH.'/banners/'.$current_banner;
			 ?>
             <img src="<?php echo $current_banner;?>" class="img-responsive" id="banner_image" style="background:#CCCCCC; width:100%"/>
    		 <div class="page-main-heading">Home</div>
</div>
<div class="container-fluid productscontaner">
	<div class="row ">
    	<?php
		$this->data['offset']=0;
		$this->data['limit']=20;
		$this->data['products']=$this->products_model->get_products($this->data['offset'],$this->data['limit']);
		?>
        <?php $this->load->view(active_theme().'/home/home_products',$this->data);?>
   		
       
    </div>
</div>