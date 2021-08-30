// JavaScript Document
function settings_update(name,val)
{
	$.ajax ( { type: "POST",
		url: base_url+ "admin/ajax/update_settings",
		data: { is_ajax:true,name: name, values: val }
		})
		.done(function( msg ) {console.log('msg',msg)
			$('#msg-container').html(msg)
			 
	});

}

function settings_update_msg(name,val,msgcontainer)
{
	//alert('callig')
	$('#'+msgcontainer).html(' ').removeClass('alert-success').removeClass('alert-danger');
	$.ajax ( { 
			dataType:"json",
			type: "POST",
			url: base_url+ "admin/ajax/update_settings",
			data: { is_ajax:true, 		name: name, 	values: val		}
			}).done(function( response ) {   
				console.log('msg',response);
				$('#'+msgcontainer).html(response.message).show();
				if(response.result=='success')
				$('#'+msgcontainer).addClass('alert-success').removeClass('alert-danger')
				else
					$('#'+msgcontainer).addClass('alert-danger').removeClass('alert-success');
		
				setTimeout(function() { 
						$('#'+msgcontainer).html(' ').removeClass('alert-success').removeClass('alert-danger');
					}, 3000);
		
			});
	
 
}