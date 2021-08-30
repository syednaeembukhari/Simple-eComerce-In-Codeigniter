<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Help Line Number</title>

<link href="xxstyle/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="upload-wrapper"  style="width:300px">
<div align="center">
<h3>Change Help Line Number</h3>
Call for Help
<input type="text" value="<?php echo get_store_settings('SERVICE_PHONE');?>" name="SERVICE_PHONE" id="SERVICE_PHONE"/>
<input type="button"  id="submit-btn" value="Change"   class="btn btn-info"  onclick="settings_update_top('SERVICE_PHONE',$('#SERVICE_PHONE').val())"  />

<script>
	

	function settings_update_top(name,val)
	{   
		$('#submit-btn').attr('disabled','disabled');
			
		$.ajax ( { type: "POST",
			url: base_url+ "admin/ajax/update_settings",
			data: { is_ajax:true,name: name, values: val }
			})
			.done(function( msg ) {
			$('#submit-btn').removeAttr('disabled');
			parent.$("#PARRENT_SERVICE_PHONE").html('Call for Help ' + val);	
		});
	
	}
</script>
<div id="msg" style="color:#FF0000"></div>
</div>

</div>

</body>
</html>