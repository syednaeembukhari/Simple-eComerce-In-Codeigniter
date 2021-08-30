<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Category</title>

</head>
<body>
<div class="container" style="width:300px; min-height:150px">
<h4>Edit/Delete Category</h4>
<div class="container-closer" style="height:150px; overflow:hidden">
<div class="main-container" id="main-container">
<?php if($category->num_rows()>0){
	$cat=$category->row();	
?>
    <div class="row">
        <div class="col-xs-12">
            <input type="text" value="<?php echo $cat->catname;?>" name="catname-edit" id="catname-edit" class="form-control"/>
        </div>
    </div>
    
    <div class="row" style="margin-top:20px; margin-bottom:20px">
        <div class="col-xs-6">
        <input type="button"  id="submit-btn" value="Delete"   class="btn btn-danger btn-sm btn-block updatebtns"  onclick="confirm_delete_category()"  />
        </div>
        <div class="col-xs-6">
        <input type="button"  id="submit-btn" value="Update"   class="btn btn-info btn-sm btn-block updatebtns"  onclick="update_category('<?php echo $cat->catid;?>')"  />
        </div>
    </div>

<?php }else{?>
    <div class="row">
        <div class="col-xs-12" id="msg" style="color:#FF0000">
            Selected category did not exists
        </div>
    </div>
<?php }?>
</div><!-- main contaner -->
    <div class="main-container-delete" id="main-container-delete" style="display:none">
        <div class="row">
            <div class="col-xs-12">
                Do you want to delete ? action could not be undone.
            </div>
        </div>
        
        <div class="row" style="margin-top:20px; margin-bottom:20px">
            <div class="col-xs-6">
            <input type="button" value="confirm" class="btn btn-danger btn-sm btn-block deletebtns" onclick="delete_category('<?php echo $cat->catid;?>')"  />
            </div>
            <div class="col-xs-6">
            <input type="button"   value="Cancel"   class="btn btn-info btn-sm btn-block deletebtns"  onclick="cancel_delete_category()"  />
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-xs-12" id="msg" style="color:#FF0000">
        
        </div>
    </div>
</div>
<script>
	function delete_category(catid)
	{
		$('.deletebtns').attr('disabled','disabled');
		$.ajax ( { 
			dataType: "json",
			type: "POST",
			url: base_url+ "admin/products/deletecategory",
			data: { is_ajax:true,catid: catid}
			
			})
			.done(function( data ) {
			$('.deletebtns').removeAttr('disabled');
			//alert(data.error)
			if(data.error=='no')
			{
				//console.log($("#category-menu-"+catid));
				parent.$("#category-menu-"+catid).hide();
				try{
						parent.jQuery.fancybox.close();
					}catch(err){
						parent.$('#fancybox-overlay').hide();
						parent.$('#fancybox-wrap').hide();
					}
			}
		});
	
	}
	function update_category(catid)
	{
		if($('#catname-edit').val()!=='')
		{
			$('.updatebtns').attr('disabled','disabled');
			$.ajax ( { 
				dataType: "json",
				type: "POST",
				url: base_url+ "admin/products/updatecategory",
				data: { is_ajax:true,catid: catid, catname:$('#catname-edit').val()}
				
				})
				.done(function( data ) {
				$('.updatebtns').removeAttr('disabled');
				//alert(data.error)
				if(data.error=='no')
				{
					//console.log($("#category-menu-"+catid));
					parent.$("#category-name-"+catid).html($('#catname-edit').val());
					try{
							parent.jQuery.fancybox.close();
						}catch(err){
							parent.$('#fancybox-overlay').hide();
							parent.$('#fancybox-wrap').hide();
						}
				}
			});
		}
	
	}
	function cancel_delete_category()
	{
		$('#main-container-delete').fadeOut();
		$('#main-container').fadeIn(500);
		
	}
	function confirm_delete_category()
	{
		
		$('#main-container').fadeOut();
		$('#main-container-delete').fadeIn(500);
		
	}
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
</body>
</html>