<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('admin/template/scripts')?>
    
  </head>
  <body>
  		
  		<?php $this->load->view('admin/template/header')?>
        <div class="container-fluid">
			<div class="row" >
                <div class="col-md-12">
                    <div class="container">
                       <?php $this->load->view('admin/settings/settings-menu');?>   
                        <div class="row" >
                            <div class="col-md-12">
                                <h4>Store Settings</h4>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 alert " id="msg-display">
                                
                            </div>
						</div>
                          <div class="row"   >
                           
                            <div class="col-md-12">
                                <table width="100%" border="0" class="table">
                                    <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Country </label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                   <?php $countryiso3= get_store_settings('COUNTRYISO3');?>
                                                    <select   name="COUNTRYISO3" id="COUNTRYISO3" class="form-control" 
                                                    value="<?php echo get_store_settings('COUNTRYISO3');?>"  
                                                    >
                                                    <?php foreach($countries->result() as $row){?>
                                                    <option value="<?php echo $row->iso3;?>"  <?php if($row->iso3==$countryiso3){echo ' selected="selected"';}?>  ><?php echo $row->country;?></option>
                                                    <?php }?>
														</select>
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('COUNTRYISO3',$('#COUNTRYISO3').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Currency Symbol</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="CURRENCY_SYMBOL" id="CURRENCY_SYMBOL" class="form-control" 
                                                    value="<?php echo get_store_settings('CURRENCY_SYMBOL');?>"  
                                                    placeholder="$">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('CURRENCY_SYMBOL',$('#CURRENCY_SYMBOL').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Currency Code</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="CURRENCY_CODE" id="CURRENCY_CODE" class="form-control" 
                                                    value="<?php echo get_store_settings('CURRENCY_CODE');?>"  
                                                    placeholder="USD">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('CURRENCY_CODE',$('#CURRENCY_CODE').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                   </table>
                                 </div>
                             </div>
                             
                             <div class="row" >
                                <div class="col-md-12">
                                    <h4>Store Email Settings</h4>
                                </div>
                        	</div> 
                            
                            <div class="row" >
                           		<div class="col-md-12">
                                <table width="100%" border="0" class="table">      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Staff Email</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="STAFF_EMAIL" id="STAFF_EMAIL" class="form-control" 
                                                    value="<?php echo get_store_settings('STAFF_EMAIL');?>"  
                                                    placeholder="staff@store.com">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('STAFF_EMAIL',$('#STAFF_EMAIL').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Common Email</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="COMMON_EMAIL" id="COMMON_EMAIL" class="form-control" 
                                                    value="<?php echo get_store_settings('COMMON_EMAIL');?>"  
                                                    placeholder="non-reply@store.com">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('COMMON_EMAIL',$('#COMMON_EMAIL').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Custom Service Email</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="SERVICE_EMAIL" id="SERVICE_EMAIL" class="form-control" 
                                                    value="<?php echo get_store_settings('SERVICE_EMAIL');?>"  
                                                    placeholder="service@store.com">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('SERVICE_EMAIL',$('#SERVICE_EMAIL').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Custom Service Phone Number</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="SERVICE_PHONE" id="SERVICE_PHONE" class="form-control" 
                                                    value="<?php echo get_store_settings('SERVICE_PHONE');?>"  
                                                    placeholder="01-444-1234">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('SERVICE_PHONE',$('#SERVICE_PHONE').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Whats App  Number</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="WHATSAPP" id="WHATSAPP" class="form-control" 
                                                    value="<?php echo get_store_settings('WHATSAPP');?>"  
                                                    placeholder="01-444-1234">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('WHATSAPP',$('#WHATSAPP').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      
                                      
                                      
                                      
                                      
                                      
                                    </table>
    
                                    
                                </div>
                                
                                
                            </div>
                            
                         <div class="row" >
                            <div class="col-md-12">
                                <h4>Use Checkout Or Contact Form Method</h4>
                            </div>
                        </div> 
                        
                        <div class="row" >
                           		<div class="col-md-12">
                                <table width="100%" border="0" class="table">      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Sale Method</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <select   name="SALE_METHOD" id="SALE_METHOD" class="form-control" 
                                                    value="<?php echo get_store_settings('SALE_METHOD');?>" >
                                                    <option value="CHECKOUT" <?php if(get_store_settings('SALE_METHOD')=='CHECKOUT'){echo ' selected="selected"';}?> >Checkout and Shoping cart</option>
                                                     <option value="CONTACTFORM" <?php if(get_store_settings('SALE_METHOD')=='CONTACTFORM'){echo ' selected="selected"';}?> >Contact form and email</option>
													</select>
                                                    
                                                    
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('SALE_METHOD',$('#SALE_METHOD').val(),'msg-display');/*if($('#SALE_METHOD').val()=='CHECKOUT'){$('#checkoutrelated').show()}else{$('#checkoutrelated').hide()}*/"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
									</table>
							</div>
						</div>
                        
                        
                        
                        <div id="checkoutrelated" style="<?php if(get_store_settings('SALE_METHOD')=='CHECKOUT' || true){ echo '';}else{  echo 'display:none'; }?>">    
                         <div class="row" >
                            <div class="col-md-12">
                                <h4>Flat Rate Shipping Setting</h4>
                            </div>
                        </div>
                          <div class="row" >
                           
                            <div class="col-md-12">
                                <table width="100%" border="0" class="table">
                                    
                                      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Flat Rate Shipping Price</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="FLATE_RATE_SHIPING_PRICE" id="FLATE_RATE_SHIPING_PRICE" class="form-control" 
                                                    value="<?php echo get_store_settings('FLATE_RATE_SHIPING_PRICE');?>"  
                                                    placeholder="$">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('FLATE_RATE_SHIPING_PRICE',$('#FLATE_RATE_SHIPING_PRICE').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      <?php /*
                                      <tr>
                                        <td width="23%">
                                        <label for="exampleInputEmail1">Flat Rate Shipping Price (International)</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="FLATE_RATE_SHIPING_PRICE_INTERNATIONAL" 
                                                    id="FLATE_RATE_SHIPING_PRICE_INTERNATIONAL" class="form-control" 
                                                  value="<?php echo get_store_settings('FLATE_RATE_SHIPING_PRICE_INTERNATIONAL');?>"  
                                                    placeholder="$">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    
                                                    onClick="settings_update_msg('FLATE_RATE_SHIPING_PRICE_INTERNATIONAL',$('#FLATE_RATE_SHIPING_PRICE_INTERNATIONAL').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                     */ ?> 
                                      <tr>
                                        <td width="23%">
                                        <label for="exampleInputEmail1">Business Zip Code</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="SHIPPING_ZIPCODE" 
                                                    id="SHIPPING_ZIPCODE" class="form-control" 
                                                  value="<?php echo get_store_settings('SHIPPING_ZIPCODE');?>"  
                                                    placeholder="Business Zip Code">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('SHIPPING_ZIPCODE',$('#SHIPPING_ZIPCODE').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td width="23%">
                                        <label for="exampleInputEmail1">Business Address</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="SHOPADDRESS" 
                                                    id="SHOPADDRESS" class="form-control" 
                                                  value="<?php echo get_store_settings('SHOPADDRESS');?>"  
                                                    placeholder="Business Address">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('SHOPADDRESS',$('#SHOPADDRESS').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      <?php /*?> <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Free Shipping Over </label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="FREE_SHIPPING_OVER" id="FREE_SHIPPING_OVER" class="form-control" 
                                                    value="<?php echo get_store_settings('FREE_SHIPPING_OVER');?>"  
                                                    placeholder="$">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('FREE_SHIPPING_OVER',$('#FREE_SHIPPING_OVER').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      <?php */?>
                                      
                                  </table>
                               </div>
                               
                             </div>   
                                  
						</div>  
                         
                        <div class="row" style="display:none">
                            <div class="col-md-12">
                                <h4>Strip  Setting</h4>
                            </div>
                        </div>
                          <div class="row" style="display:none">
                           
                            <div class="col-md-12">
                                <table width="100%" border="0" class="table">
                                    
                                      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Secrect Key</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="STRIP_SECRECT_KEY" id="STRIP_SECRECT_KEY" class="form-control" 
                                                    value="<?php echo get_store_settings('STRIP_SECRECT_KEY');?>"  
                                                    placeholder="$">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('STRIP_SECRECT_KEY',$('#STRIP_SECRECT_KEY').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      
                                      <tr>
                                        <td width="23%">
                                        <label for="exampleInputEmail1">Publisher Key</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" name="STRIP_PUBLISHER_KEY" 
                                                    id="STRIP_PUBLISHER_KEY" class="form-control" 
                                                  value="<?php echo get_store_settings('STRIP_PUBLISHER_KEY');?>"  
                                                    placeholder="$">
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    
                                                    onClick="settings_update_msg('STRIP_PUBLISHER_KEY',$('#STRIP_PUBLISHER_KEY').val(),'msg-display')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
                                      
                                      
                                  </table>
                               </div>
                               
                             </div>   
                        
                        <div class="row" >
                           		<div class="col-md-12">
                                <table width="100%" border="0" class="table">      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Facebook Pixel Code</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <textarea   name="FACEBOOKPIXEL" id="FACEBOOKPIXEL" 
                                                    class="form-control" style="height: 200px; min-width: 300px"><?php echo get_store_settings('FACEBOOKPIXEL');?> </textarea><br/><br/>
                                                    
                                                    
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('FACEBOOKPIXEL',$('#FACEBOOKPIXEL').val(),'msg-display');"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
									</table>
							</div>
						</div>
                        
                        
                        <div class="row" >
                           		<div class="col-md-12">
                                <table width="100%" border="0" class="table">      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Google Code</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <textarea   name="GOOGLECODE" id="GOOGLECODE" 
                                                    class="form-control"  style="height: 200px; min-width: 300px"><?php echo get_store_settings('GOOGLECODE');?> </textarea><br/><br/>
                                                    
                                                    
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('GOOGLECODE',$('#GOOGLECODE').val(),'msg-display');"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
									</table>
							</div>
						</div>
                        
                         <div class="row" >
                           		<div class="col-md-12">
                                <table width="100%" border="0" class="table">      
                                      <tr>
                                        <td width="23%"><label for="exampleInputEmail1">Copy Rights</label></td>
                                        <td width="41%">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <textarea   name="COPYRIGHT" id="COPYRIGHT" 
                                                    class="form-control"  style="height: 50px; min-width: 300px"><?php echo get_store_settings('COPYRIGHT');?> </textarea><br/><br/>
                                                    
                                                    
                                                    <input type="button" value="Update" class="btn btn-info" 
                                                    onClick="settings_update_msg('COPYRIGHT',$('#COPYRIGHT').val(),'msg-display');"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="36%">&nbsp;</td>
                                      </tr>
									</table>
							</div>
						</div>                  
                          
                            
                     </div>
                    </div>
                </div>
            </div>
            
                  
               
           
  
        
				<script language="javascript">
                function addproduct()
                {
                    //console.log($('input[name="catname[]"]:checked').serialize());
                    //var cats=$('input:checkbox:checked.catname_check');
                    //console.log(cats);
                    //return;
                    $.ajax ( { 
                                dataType:"json",
                                type: "POST",
                                url: "<?php echo ci_site_url('admin/products/addproducts/'.$productid);?>",
                                data: { 
                                        is_ajax:true,
                                        productid: $('#productid').val(), 	sku: $('#sku').val(), 				title: $('#title').val(), 
                                        price: $('#price').val(),			dprice: $('#dprice').val(), 		
                                        detail: CKEDITOR.instances['detail'].getData(),
                                        productcats: $('#productid').val(), instock: $('#instock').val(),
                                        categories:$('input[name="catname[]"]:checked').serializeArray()
                                },
                            })
                            .done(function( response ) {
                                
                                $('#msgcontainer').html(response.msg);
                                setTimeout(function(){ $('#msgcontainer').html(''); }, 5000);
                    });
                }
            
            </script>
    	</div>
		<?php $this->load->view('admin/template/footer')?>
    
  </body>
</html>