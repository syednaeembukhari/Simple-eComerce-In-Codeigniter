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
                                <h3>Cities Management</h3>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 alert " id="msg-display">
                                
                            </div>
						</div>
                          
                        	<input type="hidden" name="countryid" id="countryid" value="<?php echo $country->countryid;?>"   >     
                            <input type="hidden" name="timezone" id="timezone"   value="<?php echo $timezone;?>"  >
							   
                        <div class="row" >
						 
							<div class="col-md-4"><h4><?php echo $this->lang->line('cityadd');?></h4>
						</div>
								

							</div>	
							        
						<div class="row" >
						 
							<div class="col-md-3">
								<div class="form-group">
									<input type="text" name="name" id="name" class="form-control" value=""   placeholder="<?php echo $this->lang->line('cityname');?>">
								</div>
								

							</div>
							<div class="col-md-3">
								<div class="form-group">
									<input type="text" name="arabicname" id="arabicname" class="form-control" value=""   placeholder="<?php echo $this->lang->line('citynamearabic');?>">
								</div>
								

							</div>
							<div class="col-md-3">
								<div class="form-group has-feedback feedback-left">
									<input type="text" name="shippingcharges" id="shippingcharges" class="form-control" value=""   placeholder="<?php echo $this->lang->line('shippingcharges');?>">
								
									<div class="form-control-feedback " aria-hidden="true" id="percent">
                                     	<a class="btn btn-default" href=""><?php echo get_store_currency();?></a>
                                     </div>
								</div>
								

							</div>
							<div class="col-md-3">
								<input type="button" value="<?php echo $this->lang->line('cityadd');?>" class="btn btn-info"  onClick="settings_addcity()"/>
							</div>
						</div>
                       
                       
                        <div class="row" >
							<div class="col-md-12">
								<h4>Cities</h4>
							</div>
						</div>    
                          
                         <div class="row" >
							<div class="col-md-12">
								<table width="100%" border="0" class="table table-striped table-bordered">
									  <tr>
										<td width="2%"><strong>#</strong></td>
										<td width="20%"><strong><?php echo $this->lang->line('cityname');?></strong></td>
										<td width="20%"><strong><?php echo $this->lang->line('citynamearabic');?></strong></td>
										
										<td width="20%"><strong><?php echo $this->lang->line('shippingcharges');?></strong></td>
										
										<td width="18%">&nbsp;</td>
									  </tr>
									  <?php $i=0;?>
									  <?php foreach($country_cities->result() as $row){ $i++;?>
									  <tr id="cityrow<?php echo $row->id;?>">
										<td ><?php echo $i;?></td>
										<td  id="nameshow<?php echo $row->id;?>"><?php echo $row->name;?></td>
										<td  id="arabicnameshow<?php echo $row->id;?>"><?php   echo $row->arabicname;?></td>
										<td  id="shippingchargesshow<?php echo $row->id;?>"><?php   echo $row->shippingcharges;?></td>
									
										<td >
											<a href="javascript:void(0)" onclick="deletecity('<?php echo $row->id;?>')"  class="btn btn-danger btn-xs"><?php echo $this->lang->line('citydelete');?></a>
											<a href="javascript:void(0)" onclick="editcity('<?php echo $row->id;?>')"  class="btn btn-info btn-xs"><?php echo $this->lang->line('cityedit');?></a>
										
									  </td>

									  </tr>
									  <tr id="cityrowedit<?php echo $row->id;?>" style="display:none">
										<td ><?php echo $i;?><input type="hidden" name="id<?php echo $row->id;?>" id="id<?php echo $row->id;?>"  value="<?php echo $row->id;?>"/>
										<input type="hidden" name="countryid<?php echo $row->id;?>" id="countryid<?php echo $row->id;?>"  value="<?php echo $row->countryid;?>"/>
										</td>
										<td><input type="text" name="name<?php echo $row->id;?>" id="name<?php echo $row->id;?>" class="form-control" value="<?php echo $row->name;?>"/></td>
										<td ><input type="text" name="arabicname<?php echo $row->id;?>" id="arabicname<?php echo $row->id;?>" class="form-control" value="<?php echo $row->arabicname;?>"/></td>
										<td >
											<div class="form-group has-feedback feedback-left">
												<input type="text" name="shippingcharges<?php echo $row->id;?>" id="shippingcharges<?php echo $row->id;?>" class="form-control" value="<?php echo $row->shippingcharges;?>"/>
												<div class="form-control-feedback " aria-hidden="true" id="percent">
													<a class="btn btn-default" href=""><?php echo get_store_currency();?></a>
												 </div>
											</div>
										</td>
										
										<td >
											<a href="javascript:void(0)" onclick="updatecity('<?php echo $row->id;?>')"  class="btn btn-info btn-xs"><?php echo $this->lang->line('cityupdate');?></a>
													<a href="javascript:void(0)" onclick="canceleditcity('<?php echo $row->id;?>')"  class="btn btn-info btn-xs"><?php echo $this->lang->line('cityeditcancel');?></a>
										
									  </td>

									  </tr>
									 <?php }?> 
									</table>
							</div>
						</div>
                         
                        
                        
                        
                         
                         
                              
                        
                         
                        
                        
                         
                        
                                           
                          
                            
                     </div>
                    </div>
                </div>
            </div>
            
                  
               
           
  
        
				<script language="javascript">
					
				function editcity(id)
				{
					$('#cityrow'+id+ '').hide();
					$('#cityrowedit'+id+ '').show();
				}
				function canceleditcity(id)
				{
					$('#cityrowedit'+id+ '').hide();
					$('#cityrow'+id+ '').show();
				}
				function updatecity(id)
				{
					console.log($('#countryid'+id).val());
					$.ajax ( { 
                                dataType:"json",
                                type: "POST",
                                url: "<?php echo ci_site_url('admin/ajax/updatecity/');?>",
                                data: { 
                                        is_ajax:true,
                                        countryid: $('#countryid'+id).val(),
										id: id,
                                        name: $('#name'+id).val(),			
                                        arabicname: $('#arabicname'+id).val(),
									 	shippingcharges: $('#shippingcharges'+id).val()
                                },
                            })
                            .done(function( response ) {
                                
                                $('#msg-display').html(response.message);
								if(response.result=='success')
								{
								 	$('#msg-display').addClass('alert-success').removeClass('alert-danger');
									$('#nameshow'+id).html($('#name'+id).val());
									$('#arabicnameshow'+id).html($('#arabicname'+id).val());
									$('#shippingchargesshow'+id).html($('#shippingcharges'+id).val());
									canceleditcity(id)
								}
								else
									$('#msg-display').addClass('alert-danger').removeClass('alert-success');
                                setTimeout(function(){ $('#msg-display').html('').removeClass('alert-danger').removeClass('alert-success'); }, 5000);
                    });	
				}
					
                function settings_addcity()
                {
                    //console.log($('input[name="catname[]"]:checked').serialize());
                    //var cats=$('input:checkbox:checked.catname_check');
                    //console.log(cats);
                    //return;
                    $.ajax ( { 
                                dataType:"json",
                                type: "POST",
                                url: "<?php echo ci_site_url('admin/ajax/addcity/');?>",
                                data: { 
                                        is_ajax:true,
                                        countryid: $('#countryid').val(),  
										timezone: $('#timezone').val(), 
                                        name: $('#name').val(),			
                                        arabicname: $('#arabicname').val(),
									 	shippingcharges: $('#shippingcharges').val(),
                                },
                            })
                            .done(function( response ) {
                                
                                $('#msg-display').html(response.message);
								if(response.result=='success')
								 	$('#msg-display').addClass('alert-success').removeClass('alert-danger');
								else
									$('#msg-display').addClass('alert-danger').removeClass('alert-success');
                                setTimeout(function(){ $('#msg-display').html('').removeClass('alert-danger').removeClass('alert-success'); }, 5000);
                    });
                }
            	function deletecity(id)
                {
					if(confirm('Do you want to delete city?')){
						
						$('#cityrow'+id+ ' td a').hide();

						$.ajax ( { 
									dataType:"json",
									type: "POST",
									url: "<?php echo ci_site_url('admin/ajax/delcity/');?>",
									data: { 
											is_ajax:true,
											id:id,  

									},
								})
								.done(function( response ) {
									 
									$('#msg-display').html(response.message);
									if(response.result=='success'){
										$('#cityrow'+id+ '').hide();
										$('#msg-display').addClass('alert-success').removeClass('alert-danger');
									}else
										$('#msg-display').addClass('alert-danger').removeClass('alert-success');
									setTimeout(function(){ $('#msg-display').html('').removeClass('alert-danger').removeClass('alert-success'); }, 5000);
						});
                	}
				}
            </script>
    	</div>
		<?php $this->load->view('admin/template/footer')?>
    
  </body>
</html>