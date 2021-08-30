<!DOCTYPE html>
<html lang="en">
  <head>
    <?php //$this->load->view('admin/template/scripts')?>
  </head>
  <body>
  		
        <div class="container" style="max-width:600px">
        	<div class="row">
            	<div class="col-md-12">
                	<h4>Shipping the order</h4>
                    <?php if($orderinfo->num_rows()>0){?>
                    <?php $order=$orderinfo->row();?>
                    <h5>ORDER no: <?php echo $order->orderid;?> </h5>
                    <?php if($order->orderstatus>=3){?>
                    Order already shipped or canceled
                    <?php }else{ ?>
                    <?php //pre_print($orderinfo);?>
                    	<div class="form-group">
                        	<label>Shipping Label</label>
                        	<input type="text" class="form-control" value="" id="shippinglabel" Placeholder="Shipping label"/>
                        </div>	
                        <div class="from-group">
                        	
                        	<input type="button" id="shipbtn" value="Ship" class="btn btn-info" onClick="shiptheorder()"/>
                        </div>
                        <script>
                        	function shiptheorder()
							{
								$('shipbtn').attr('disabled','disabled');
								$.ajax ( { 
											dataType:"json",
											type: "POST",
											url: "<?php echo ci_site_url('admin/ajax/ship_order/');?>",
											data: { 
													is_ajax:true,
													orderid: '<?php echo $order->orderid;?>', 	
													shippinglabel: $('#shippinglabel').val() 
											},
										})
										.done(function( response ) {
											$('shipbtn').removeAttr('disabled');
											try{
													parent.jQuery.fancybox.close();
												}catch(err){
													parent.$('#fancybox-overlay').hide();
													parent.$('#fancybox-wrap').hide();
												}
											
								});
							}
                        
                        </script>
                        
                        
                        
                      <?php } ?>  
                    <?php }else{?>
                    	invalid order selected
                    <?php }?>
                </div>
            </div>
        	
        </div>
    
  </body>
</html>