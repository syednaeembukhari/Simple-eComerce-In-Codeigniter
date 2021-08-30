<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cart Item Remove</title>
</head>

<body>
<div class="container" style="width:300px">
	<div class="row">
    	<div class="col-md-12">
        	<h5>Do you want to remove this item from cart?</h5>
        </div>
    
    </div>
    <div class="row">
    	<div class="col-xs-6" style="text-align:right">
        	<button class="btn btn-info btn-sm"   onclick="closedialog()">No</button>
        </div>
        <div class="col-xs-6" style="text-align:right">
        	<button class="btn btn-danger btn-sm" onclick="deletecartitem('<?php echo $tempid;?>')">Yes</button>
        </div>
    
    </div>
</div>
<script>
function deletecartitem(id)
{
	$.ajax ( { 
						
						type: "POST",
						url: "<?php echo ci_site_url('products/cartitem_removed_confirmed/');?>/"+id,
						data: { 
								is_ajax:true,
								tempid:id
						},
					})
					.done(function( response ) {
						//console.log(response);
						window.location='<?php echo ci_site_url('customers/cart');?>';
						//$('#msgcontainer').html(response.msg);
						//setTimeout(function(){ $('#msgcontainer').html(''); }, 5000);
			});
}
function closedialog()
{
	try{
        	parent.jQuery.fancybox.close();
		}catch(err){
			parent.$('#fancybox-overlay').hide();
			parent.$('#fancybox-wrap').hide();
		}
}
</script>
</body>
</html>