<div class="row">
	<div class="col-md-12">
	<hr/>
	</div>
</div>
<script language="javascript" src="<?php echo base_url('assets/common/jqueryvalidator/jquery.validate.min.js')?>"></script>
<form id="productform" action="<?php echo site_url('customers/contactformsubmit/'.$productid)?>" accept-charset="UTF-8" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label ><?php echo $this->lang->line('frm_fullname');?></label>
			<input required="required" type="text" class="form-control" name="frm_fullname" id="frm_fullname" placeholder="<?php echo $this->lang->line('frm_fullname');?>">
		 </div>
		 
		 <div class="form-group">
			<label ><?php echo $this->lang->line('frm_phone');?></label>
			<input  required="required"  type="number" class="form-control" name="frm_phone" id="frm_phone" placeholder="<?php echo $this->lang->line('frm_phone');?>">
		 </div>
		 <div class="form-group">
			<label ><?php echo $this->lang->line('frm_city');?></label>
			<input  type="hidden" value="<?php echo get_store_settings('FLATE_RATE_SHIPING_PRICE');?>" name="defaultshippingcharges" id="defaultshippingcharges" />
			
			<input type="hidden" value="" name="cityid" id="cityid" />
			
			<select required="required" class="form-control" onChange="calculateprice()" name="frm_city" id="frm_city" placeholder="<?php echo $this->lang->line('frm_city');?>" >
				<?php if(LANG=='arabic'){?>
      		   <option selected value="">إختر المدينة</option>
       		  <?php }else{?>
       		   <option selected value="" data-shippingprice="0">Select City</option>
       		    <?php } ?>  
        		 <?php foreach($cities as $city){?>
        		    	<?php $cityname= (LANG=='arabic'?$city->arabicname:$city->name);?>
        		    	<?php if($cityname!=''){?>
         		    	<option  value="<?php echo $city->id;?>" data-shippingprice="<?php echo $city->shippingcharges;?>" data-cityid="<?php echo $city->id;?>"><?php echo $cityname;?></option>
         		    	<?php }?>
          		 <?php }?>    
			</select>
		  </div>
		 <div class="form-group">
			<label ><?php echo $this->lang->line('frm_address');?></label>
			<input required="required" type="text" class="form-control" name="frm_address" id="frm_address" placeholder="<?php echo $this->lang->line('frm_address');?>">
		 </div>
		<?php /*?> <div class="row">
		 	<div class="col-md-12">
		 		<div class="form-group">
					<label ><?php echo $this->lang->line('frm_quantity');?></label>
					<input type="number" onChange="if($(this).val()<=0){$(this).val(1)}calculateprice()" value="1" class="form-control" name="frm_quantity" id="frm_quantity" placeholder="<?php echo $this->lang->line('frm_quantity');?>">
				 </div>
		 	</div>
		 	</div><?php */?>
		 	<br/>
		 <div class="row">
		 	<div class="col-md-12">
		 	<?php $productinfo=$product->row();?>
				<style> td .price_container .pr {padding-left:5px}  td .price_container {margin:0px}
					.bold{ font-weight:bold}
					.input-group-btn:not(:first-child):not(:last-child) > .btn {
					  border-radius: 0;
					  height: 100%;
					}
				</style>
		 		<table width="100%" border="0" class="table table-strip">
					  <tbody>
					  	<tr>
					  	 <?php /*?> <td><strong><?php echo $this->lang->line('orderitem');?></strong></td><?php */?>
						 
						  
						  <td colspan="2"><strong><?php echo $this->lang->line('orderquantity');?></strong></td>
						  <td ><strong><?php echo $this->lang->line('orderprice');?></strong></td>
						</tr>
					  	<tr>
					  	 <?php /*?> <td><?php echo $productinfo->title;?></td><?php */?>
							<td  >&nbsp;</td>
						  	<td  width="200px "id="proqty" valign="middle"  >	<br/>	
							 <div class="input-group">
							  <span class="input-group-addon" onClick="minusqty()"><i class="fas fa-minus-circle"></i></span>
							  <input type="text"  onChange="if($(this).val()<=0){$(this).val(1)}calculateprice()" value="1" class="form-control" name="frm_quantity" id="frm_quantity" placeholder="<?php echo $this->lang->line('frm_quantity');?>">
							 <span class="input-group-addon"  onClick="addqty()"><i class="fas fa-plus-circle"></i></span>
							</div>
					  		</td>
					  		<td  width="100px" align="right"  style="text-align: right">
					  		<?php $product_images=$this->products_model->get_product_images_array($productid,false);?>
						  	<img    src="<?php echo $product_images['img1'];?>" class="img-responsive" id="img-0"/>
						  		 <div class="price_container hidden">
						  		<div class="pr"><?php echo get_store_settings('CURRENCY_SYMBOL');?></div>
						  		<div class="pr" id="pprice"><?php echo get_product_price($productinfo);?></div>  
								</div>  
							</td>
						  	
						</tr>
						
						<tr>
						 
						  <td  colspan="2">
						  	<div class="price_container">
						  		<div class="pr"><?php echo get_store_settings('CURRENCY_SYMBOL');?></div>
						  		<div class="pr" id="prototal"><?php echo get_product_price($productinfo);?></div>  
							</div>
						  </td>
						   <td  ><strong><?php echo $this->lang->line('ordertotal');?></strong></td>
						</tr> 
						   
						<tr>
						 
						  <td  colspan="2">
						  	<div class="price_container">
						  		<div class="pr"><?php echo get_store_settings('CURRENCY_SYMBOL');?></div>
						  		<div class="pr" id="cartshiping"><?php echo get_product_price($productinfo);?></div>  
							</div>
						  </td>
						   <td  ><strong><?php echo $this->lang->line('shippingcharges');?></strong></td>
						</tr>
						
						
						
						<tr>
					 	 <td  colspan="2">
						    <div class="price_container">
						  		<div class="pr bold red"><?php echo get_store_settings('CURRENCY_SYMBOL');?></div>
						  		<div class="pr bold red" id="carttotal"><?php echo get_product_price($productinfo);?></div>  
							</div>
						  </td>
						  <td  ><strong class="red"><?php echo $this->lang->line('ordertotalcharges');?></strong></td>
						  
						</tr>
					  </tbody>
					</table>

			 </div>
		 	<div class="col-md-6">
		 		<div class="form-group">
			 		<label > &nbsp;</label>
					<input type="button" onclick="validatefrm()" class="btn btn-info  btn-block" name="frm_confirmation" id="frm_confirmation" value="<?php echo $this->lang->line('frm_confirmation');?>">
				 </div>
		 	</div>
		 </div>
		 
		 <div class="form-group"> 
			 <a href="<?php echo site_url('/')?>" class="btn btn-primary btn-block"> <?php echo $this->lang->line('frm_alloffers');?></a>
		 </div>
		 
		 
		 
		 
	</div>
</div>
<div class="row">
	<div class="col-md-12">
	<hr/>
	</div>
</div>
<div class="row">
	<?php if(get_store_settings('WHATSAPP')!=''){?>
	 <?php $url ='   أريد الحصول على '.   $productinfo->title.'   '.product_seo_url($productinfo).' ';?>
	<div class="col-md-6">
		<div id="whatsaapcopy" style="display:none">https://wa.me/<?php echo get_store_settings('WHATSAPP');?>?text=أريد الحصول على <?php echo $product->row()->title; ?> </div>
		<a class="btn btn-success  btn-block" href="https://wa.me/<?php echo get_store_settings('WHATSAPP');?>?text=<?php echo urlencode($url); ?> " target="_blank" <?php /*?>onClick="copy('#whatsaapcopy')"<?php */?>> <?php echo get_store_settings('WHATSAPP');?> واتساب  <i class="fab fa-whatsapp"></i></a>
  		<br/>
	</div>
	<?php } ?>
	<?php if(get_store_settings('SERVICE_PHONE')!=''){?>
	<div class="col-md-6">
		<a class="btn btn-primary btn-block" href="tel:<?php echo get_store_settings('SERVICE_PHONE');?>"> <?php echo get_store_settings('SERVICE_PHONE');?>  إتصل بنا <i class="fas fa-phone"></i></a>
  
	</div>
	<?php } ?>
</div>



</form>
<div class="modal fade" tabindex="-1" role="dialog" id="confirmmodel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('frm_confirmation');?></h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onClick="$('#frm_confirmation').show();" data-dismiss="modal"><?php echo $this->lang->line('frm_return');?></button>
        <button type="button" class="btn btn-primary" onClick="$('#productform' ).submit();"><?php echo $this->lang->line('frm_confirm');?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
		/*$.validator.setDefaults( {
			submitHandler: function () {
				//alert( "submitted!" );
				 
				$('#confirmmodel').modal('show')
				
			}
		} );*/
		
	function addqty(){
		$('#frm_quantity').val( parseFloat($('#frm_quantity').val())+1 )
		calculateprice()
	}
	function minusqty(){
		$('#frm_quantity').val( parseFloat($('#frm_quantity').val())-1 )
		if(parseFloat($('#frm_quantity').val())<=0)
		$('#frm_quantity').val(1)	
		calculateprice()
	}
	function  calculateprice()
	{
		
		var total=parseFloat($('#pprice').html()) * parseFloat($('#frm_quantity').val());
		$('#prototal').html(total.toFixed(2));
		 
		var shipping=$('#defaultshippingcharges').val();
		var shippingcity=$('#frm_city').find('option:selected').attr('data-shippingprice');
		
		$('#cityid').val($('#frm_city').find('option:selected').attr('data-cityid'));
		
		console.log(shippingcity);
		if(parseFloat(shippingcity)>0)
			shipping=shippingcity;
		var shipping2=parseFloat(shipping);
		$('#cartshiping').html(shipping2.toFixed(2));
		var grndtotal=parseFloat(total)+parseFloat(shipping2);	
		$('#carttotal').html(grndtotal.toFixed(2));
	}
	
		$( document ).ready( function () {
			calculateprice()
			$( "#productform" ).validate( {
				rules: {
					frm_fullname: "required",
					 
					frm_phone: {
						required: true,
						number: true,
						minlength:10,
						maxlength:10
					},
					frm_city: "required",
					
					frm_quantity: {
						required: true,
						number: true,
						range: [1, 100000]
					},
					frm_address: "required",
					
					
					
				},
				messages: {
					frm_fullname: "<?php echo $this->lang->line('frm_fullname_err');?>",
					 
					frm_phone: {
						required: "<?php echo $this->lang->line('frm_phone_err');?>",
						number: "<?php echo $this->lang->line('frm_phone_err');?>",
						//exactlength: "<?php echo $this->lang->line('frm_phone_err2');?>",
						minlength:"<?php echo $this->lang->line('frm_phone_err');?>",
						maxlength:"<?php echo $this->lang->line('frm_phone_err');?>",
						
					},
					frm_city: "<?php echo $this->lang->line('frm_city_err');?>",
					
					frm_quantity: {
						required: "<?php echo $this->lang->line('frm_quantity_err');?>",
						number: "<?php echo $this->lang->line('frm_quantity_err2');?>",
						range: "<?php echo $this->lang->line('frm_quantity_err2');?>",
						
					},
					 
					frm_address: "<?php echo $this->lang->line('frm_address_err');?>",
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
			} ) ;
			
		});
	
	
	function validatefrm()
	{
		$('#frm_confirmation').hide();
		
		var str=$('#frm_phone').val()
		/*if(phone_validate(str))
		{
		   $('#productform' ).submit();
		}
		else
		{
			//alert('<?php echo $this->lang->line('frm_phone_err');?>');
			$('#frm_confirmation').show();
			return;
		}*/
		if ($("#productform").valid()) {
			
			 
			
		   if(phone_validate(str))
			{
			   $('#productform' ).submit();
			}
		  	else
			{
				alert('<?php echo $this->lang->line('frm_phone_err');?>');
			}
			
			 
            //$('#confirmmodel').modal('show');
			
			 
			$('#frm_confirmation').show();
        }else
			$('#frm_confirmation').show();
		calculateprice()
	}

function phone_validate(mobilephoneno) 
   { 
     var checkPattern =new RegExp(/^[0-9-+]+$/);
     return checkPattern.test(mobilephoneno); 
   } 
function copy(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
	alert('<?php echo $this->lang->line('urlcopiedtoclip')?>')
}
 
	
</script>
