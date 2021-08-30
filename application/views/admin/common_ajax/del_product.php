<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Product</title>

<link href="xxstyle/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="upload-wrapper"  style="width:300px">
<div align="center">
<h4><?php echo $this->lang->line('prodelconfirm');?></h4>

<input type="button"  id="submit-btn" value="<?php echo $this->lang->line('prodelete');?>"   class="btn btn-danger"  onclick="settings_update_top('SERVICE_PHONE',$('#SERVICE_PHONE').val())"  />
<a href="javascript:void(0)" onClick="cancel_del()" class="btn btn-info" ><?php echo $this->lang->line('procancel');?></a>

<script>
	

	function settings_update_top(name,val)
	{   
		$('#submit-btn').attr('disabled','disabled');
			
		$.ajax ( { type: "POST",
			url: base_url+ "admin/ajax/delete_product",
			data: { is_ajax:true,productid:'<?php echo $productid?>'}
			})
			.done(function( msg ) {
			$('#submit-btn').removeAttr('disabled');
			//alert(msg)
			window.location=base_url+ "admin/products/prep_product_id"
		});
	
	}
	
	function cancel_del()
	{
		try{
        	parent.jQuery.fancybox.close();
		}catch(err){
			parent.$('#fancybox-overlay').hide();
			parent.$('#fancybox-wrap').hide();
		}
	}
</script>
<div id="msg" style="color:#FF0000"></div>
</div>

</div>

</body>
</html>