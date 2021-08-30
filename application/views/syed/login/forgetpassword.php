<!DOCTYPE html>
<html lang="en">
  <head>
	<?php $this->load->view(active_theme().'/common/scripts');?>   
    <link href="<?php echo base_url();?>assets/templates/<?php echo active_theme();?>/login.css" rel="stylesheet">
  </head>
  <body>
   	 	<?php $this->load->view(active_theme().'/login/login_header');?>   
     	<div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                	<h3>Forget Password </h3>
                	<form role="form" action="<?php echo ci_site_url('login/forgetpassword')?>" method="post" enctype="multipart/form-data">
                    	<div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                         </div>
                    
                         <div class="row">
                             <div class="col-sm-6"><button type="submit" class="btn btn-default">Get Password</button></div>
                             <div class="col-sm-6" style="padding-top:5px; text-align:right"><a href="<?php echo ci_site_url('login')?>">login</a></div>
                         </div>
                         <div class="row">
                             <div class="col-sm-12 message">
                             	<?php echo $msg;?>
                                <?php if(isset($_SESSION['forgetpassword_message'])){
										if($_SESSION['forgetpassword_message']!='')	
										echo $_SESSION['forgetpassword_message'];
								}
								unset($_SESSION['forgetpassword_message']);
								?>
                             </div>
                        </div>
					</form>
                </div>
                
            </div>
   		 </div>
     <br/><br/>
     
     <?php $this->load->view(active_theme().'/common/footer');?>   
  </body>
</html>