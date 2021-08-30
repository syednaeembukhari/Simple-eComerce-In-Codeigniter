<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Product Image</title>

<link href="xxstyle/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="upload-wrapper"  style="width:300px">
<div align="center">
<h3>Change Free Shipping</h3>
Free Shipping on order over $
<input type="text" value="<?php echo get_store_settings('FREE_SHIPPING_OVER');?>" name="FREE_SHIPPING_OVER" id="FREE_SHIPPING_OVER"/>
<input type="button"  id="submit-btn" value="Change"   class="btn btn-info"  onclick="settings_update_top('FREE_SHIPPING_OVER',$('#FREE_SHIPPING_OVER').val())"  />

<script>
	

	function settings_update_top(name,val)
	{   
		$('#submit-btn').attr('disabled','disabled');
			
		$.ajax ( { type: "POST",
			url: base_url+ "admin/ajax/update_settings",
			data: { is_ajax:true,name: name, values: val }
			})
			.done(function( msg ) {
				parent.$("#PARRENT_FREE_SHIPPING_OVER").html('Free Shipping on order over $' + val);
				$('#submit-btn').removeAttr('disabled');	
		});
	
	}
</script>
<div id="msg" style="color:#FF0000"></div>
</div>

</div>

</body>
</html>