<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('admin/template/scripts')?>
    
  </head>
  <body>
  		
  		<?php $this->load->view('admin/template/header')?>
        <div class="container">
			<style>
				.imgcontainer:hover  .imgdelbtn{ display: block}
				.imgcontainer img {margin-bottom: 0px !important}
				.imgdelbtn{position:absolute; border-radius:15px; display: none}
			</style>
              <div class="row" >
              	<div class="col-md-2  col-sm-3" style="margin-bottom:20px">
                	<?php $this->load->view( 'admin/categories/category_menu');?>
                    
                </div>
                <div class="col-md-10  col-sm-9 ">
                	<?php /*?><h3 class="admin_title">Add Products</h3><?php */?>
                    	<?php //echo $productid;?>
           				<?php $product_images=$this->products_model->get_product_images_array($productid);?>
                  <div class="row" >
                    <div class="col-md-4  col-sm-5 product_images">
                        <div class="row">
                            <div  class="col-md-12 pro-img" >
                            	<div class="img-upload-btn">
                                	<a href="<?php echo ci_site_url('admin/products/add_image/'.$productid.'/1');?>" 
                                    class="fancybox fancybox.iframe btn btn-warning"><i class="fa fa-camera"></i> <?php echo $this->lang->line('proimageupload');?></a>
                                </div>
                                <img src="<?php echo $product_images['img1'];?>" class="img-responsive" id="img-0"/>
                            </div>
                        </div>
                        <div class="row">
                            <div  class="col-md-12 pro-img" >
                           	 <h5><?php echo $this->lang->line('proimagesbox');?></h5>
                           	 <br/>
                            </div>
                        </div>    
                        <div class="row">
                            <div  class="col-sm-3 col-xs-6 pro-img imgcontainer">
                            	
                               <a href="<?php echo ci_site_url('admin/products/add_image/'.$productid.'/1');?>" class="fancybox fancybox.iframe">
                                <img src="<?php echo $product_images['img1'];?>" class="img-responsive" id="img-1"/>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-xs imgdelbtn"   onclick="deleteimg('1','<?php echo $productid;?>')"><i class="fas fa-trash"></i></a>
                            	
                            </div>
                            <div  class="col-sm-3  col-xs-6 pro-img imgcontainer">
                            	
                               <a href="<?php echo ci_site_url('admin/products/add_image/'.$productid.'/2');?>" class="fancybox fancybox.iframe">
                                <img src="<?php echo $product_images['img2'];?>" class="img-responsive" id="img-2"/>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-xs imgdelbtn" onclick="deleteimg('2','<?php echo $productid;?>')"><i class="fas fa-trash"></i></a>
                            	
                            </div>
                            <div  class="col-sm-3  col-xs-6 pro-img imgcontainer">
                            	
                            	<a href="<?php echo ci_site_url('admin/products/add_image/'.$productid.'/3');?>" class="fancybox fancybox.iframe">
                                <img src="<?php echo $product_images['img3'];?>" class="img-responsive" id="img-3"/>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-xs imgdelbtn" onclick="deleteimg('3','<?php echo $productid;?>')"><i class="fas fa-trash"></i></a>
                            	
                            </div>
                            <div  class="col-sm-3  col-xs-6 imgcontainer">
								<a href="<?php echo ci_site_url('admin/products/add_image/'.$productid.'/4');?>" class="fancybox fancybox.iframe">
                            	<img src="<?php echo $product_images['img4'];?>" class="img-responsive" id="img-4"/>
                                </a>
                               	<a href="javascript:void(0)" class="btn btn-danger btn-xs imgdelbtn"  onclick="deleteimg('4','<?php echo $productid;?>')"><i class="fas fa-trash"></i></a>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8  col-sm-7">
                    <?php 
					//print_r($productdata);
					if($productdata->num_rows()>0)
					{
						//echo "here";
						$productinfo=$productdata->row();
					?>
                        
                        <input type="hidden" value="<?php echo $productid;?>" name="productid" id="productid"/>
                       
                        	<div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('protitle');?></label>
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo $productinfo->title;?>"  placeholder="Enter Product Title ">
                            </div>
                            
                            
                            
                            <div class="form-group">
                            	<div class="row">
                                	<div class="col-sm-6 has-feedback feedback-left">
                                     <label for="exampleInputEmail1"><?php echo $this->lang->line('prosaleprice');?></label>
                                     <div class="form-control-feedback " aria-hidden="true" id="percent">
                                     	<a class="btn btn-default" href=""><?php echo get_store_currency();?></a>
                                     </div>
                                        <input type="text" name="price" id="price" class="form-control" value="<?php echo $productinfo->sprice;?>"  placeholder="Enter Sale Price ">
                                        <input type="hidden" name="sprice" id="sprice" class="form-control" value="<?php echo $productinfo->sprice;?>"  placeholder="Enter Sale Price ">
                                    </div>
                                </div>
                            
                                        
                             </div>
                            
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('prodescription');?></label>
                                <?php echo ckeditor_create('detail',$productinfo->description,true);?>
                            </div>
                        
                                
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('prostatus');?></label>
                                    </div>
                                    <div class="col-md-9 col-sm-6">
                                    <select  name="instock" id="instock" class="form-control" 
                                    value="<?php echo $productinfo->instock;?>" >
                                    <option  value="1" <?php if($productinfo->instock>0){echo  'selected="selected"';}?> >In Stock</option>
                                    <option  value="0" <?php if($productinfo->instock<=0){echo  'selected="selected"';}?> >Out of Stock</option>
                                    </select>
                                    </div>
                                </div>
							</div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('prodiscountper');?></label>
                                    </div>
                                    <div class="col-md-9 col-sm-6">
                                    	<div class="form-group">
                                            <input type="text" name="dprice" id="dprice" class="form-control" 
                                            value="<?php echo $productinfo->dprice;?>" aria-describedby="percent"  placeholder="Discount in %">
                                             
                                        </div>
                                    </div>
                                </div>
							</div>
                           
                              
                                 
                                       
                            
                            <div class="form-group" >
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('prosku');?> </label>
                                    </div>
                                    <div class="col-md-9 col-sm-6">
                                    <input type="text" name="sku" id="sku" class="form-control" 
                                    value="<?php echo $productsku;?>"  placeholder="Enter SKU">
                                    </div>
                                </div>
							</div>

                            <div class="form-group">
                            <button type="button" class="btn btn-success" onClick="addproduct()">
								<?php if($productinfo->sku=='') {echo $this->lang->line('prosavebtn'); }else{echo $this->lang->line('proupdatebtn');}?>
                            </button>
							<?php if($productinfo->sku!='') {?>
                           
                            <a  href="<?php echo ci_site_url('admin/products/del_product/'.$productid);?>"  
                            class="fancybox fancybox.iframe  btn btn-danger" onClick="delproduct()" >
								<?php echo $this->lang->line('prodeletebtn');?>
                            </a>
                            <a  href="javascript:void(0)"   id="hideprobtn" 
                            style="<?php if($productinfo->status=='Inactive'){ echo 'display:none';}?>"
                            class="  btn btn-danger" onClick="hideproduct()" >
								<?php echo $this->lang->line('prohidebtn');?>
                            </a>
                            <a  href="javascript:void(0)"  id="showprobtn"
                             style="<?php if($productinfo->status=='Active'){ echo 'display:none';}?>"
                            class=" btn btn-warning" onClick="showproduct()" >
								<?php echo $this->lang->line('proshowbtn');?>
                            </a>
                            
                            <div style="clear:both"></div>
							<?php }?>
                            </div>
                        
                      <?php }?>
                        <div class="row">
                             <div class="col-sm-12 message" id="msgcontainer">
                                <?php echo $msg;?>
                             </div>
                        </div>
                    </div>
                    
    
                  </div>
                  
               </div>
            </div>
              
              
        </div>
        <br/><br/><br/><br/>
        
    	<script language="javascript">
		function deleteimg(imgno,id)
		{
			//console.log($('input[name="catname[]"]:checked').serialize());
			//var cats=$('input:checkbox:checked.catname_check');
			//console.log(cats);
			//return;
			$.ajax ( { 
						dataType:"json",
						type: "POST",
						url: "<?php echo ci_site_url('admin/ajax/deleteimg/'.$productid);?>",
						data: { 
								is_ajax:true,
								productid: id, 	 
								deleteimg: imgno
						},
					})
					.done(function( response ) {
						alert('Image successfully removed')
						window.location.reload(); 
			});
		}
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
								pprice: $('#price').val(),	sprice: $('#sprice').val(), 		dprice: $('#dprice').val(), 		
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
	function hideproduct()
		{
			//console.log($('input[name="catname[]"]:checked').serialize());
			//var cats=$('input:checkbox:checked.catname_check');
			//console.log(cats);
			//return;
			$.ajax ( { 
						dataType:"json",
						type: "POST",
						url: "<?php echo ci_site_url('admin/products/hide_product/'.$productid);?>",
						data: { 
								is_ajax:true,
								productid: $('#productid').val()
						},
					})
					.done(function( response ) {
						$('#showprobtn').show();
						$('#hideprobtn').hide();
						//$('#msgcontainer').html(response.msg);
						//setTimeout(function(){ $('#msgcontainer').html(''); }, 5000);
			});
		}
		function showproduct()
		{
			//console.log($('input[name="catname[]"]:checked').serialize());
			//var cats=$('input:checkbox:checked.catname_check');
			//console.log(cats);
			//return;
			$.ajax ( { 
						dataType:"json",
						type: "POST",
						url: "<?php echo ci_site_url('admin/products/show_product/'.$productid);?>",
						data: { 
								is_ajax:true,
								productid: $('#productid').val()
						},
					})
					.done(function( response ) {
						$('#showprobtn').hide();
						$('#hideprobtn').show();
						//$('#msgcontainer').html(response.msg);
						//setTimeout(function(){ $('#msgcontainer').html(''); }, 5000);
			});
		}
	</script>
		<?php $this->load->view('admin/template/footer')?>
    
  </body>
</html>