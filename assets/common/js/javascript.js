// JavaScript Document

function addtocart(productid)
{
	$('#addtocart'+productid).attr('disabled','disabled');
			
	$.ajax ( { 
		dataType:"json",
		type: "POST",
		url: base_url+ "products/addtocart/"+productid,
		data: { is_ajax:true,productid: productid }
		})
		.done(function( resp ) {
			$('#addtocart'+productid).removeAttr('disabled');
			$('#cart_count').html(resp.itemcount);
	});
	setTimeout(function() {
      $('#addtocart'+productid).removeAttr('disabled');
	}, 5000);
	
	
}