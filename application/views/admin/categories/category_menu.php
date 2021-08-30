<?php $product_cats=array();?>
<?php if(isset($productid)){?>
<?php $product_cats=get_product_categories_ids($productid);?>
<?php }?>
	<div class="row" style="margin-bottom:5px">
    	
        <div class="col-xs-10"><span class="label label-default"><?php echo $this->lang->line('procategories');?></span></div>
        <div class="col-xs-2"></div>
    </div>
	<ul class="" style="list-style:none; padding:0px ; margin:0px" id="categories_list">
		<?php $cats=get_shop_categories(1);?>
		<?php foreach ($cats->result() as $cat){?>
			<?php $this->load->view( 'admin/categories/category_li' , array('cat'=>$cat,'product_cats'=>$product_cats));?>
		<?php }?>
		
	</ul>
	<ul style="list-style:none; padding:0px ; margin:0px; margin-top:5px">
		<li >
		<div class="row">
			<div class="col-xs-9">
				<input type="text" value="" id="catname" placeholder="<?php echo $this->lang->line('procatnew');?>" style="font-size:12px;"/>
			</div>
			<div class="col-xs-3">
				<a href="javascript:void(0)" onClick="addcategory()" class="btn btn-default btn-xs"><?php echo $this->lang->line('procatsave');?></a>
			</div>
			
		</div>
		<div class="msg" id="cat-error"></div>
		 </li>
	</ul>
	<div class="row">
		<div class="col-md-12" style="margin-top:20px ">
					
                <a href="javascript:void(0)" id="catmenushow" onClick="settings_update_msg('CATEMENUSHOW','1','msg-display');$('#catmenushow').hide();$('#catmenuhide').show()" class="btn btn-primary btn-xs" style="<?php if(get_store_settings('CATEMENUSHOW')=='1'){ echo  'display:none';}?>" ><?php echo $this->lang->line('procatshow');?></a>
               
                <a href="javascript:void(0)" id="catmenuhide" onClick="settings_update_msg('CATEMENUSHOW','0','msg-display');$('#catmenushow').show();$('#catmenuhide').hide()"   class="btn btn-danger btn-xs" style="<?php if(get_store_settings('CATEMENUSHOW')=='0'){ echo  'display:none';}?>" ><?php echo $this->lang->line('procathide');?></a>
                
            
		</div>
	</div>
	<script language="javascript">
		function addcategory()
		{
			$.ajax ( { 
					dataType: "json",
					type: "POST",
					url: base_url+ "admin/ajax/add_category",
					data: { is_ajax:true,catname: $('#catname').val() },
					
					})
					.done(function( response ) {
						if(response.msg=='added')
						{
							$('#categories_list li:last').after(response.catli);
							$('#catname').val('')
						}
						else
						{
							$('#cat-error').html(response.msg);
							setTimeout(function(){ $('#cat-error').html(''); }, 5000);
						}
					
			});
		}
	
	</script>
