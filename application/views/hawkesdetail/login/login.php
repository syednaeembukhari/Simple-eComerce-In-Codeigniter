<!DOCTYPE html>
<html lang="en">
  <head>
	<?php $this->load->view(active_theme().'/common/scripts');?>   
    <link href="<?php echo base_url();?>assets/templates/<?php echo active_theme();?>/login.css" rel="stylesheet">
  </head>
  <body>
   	 	<?php $this->load->view(active_theme().'/login/login_header');
		//pre_print($this->session->all_userdata());
		?>   
     	<div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                	<h3>Login</h3>
                	<form role="form" action="<?php echo ci_site_url('login')?>" method="post" enctype="multipart/form-data">
                    	<div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                         </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                         </div>
                         <div class="row">
                             <div class="col-sm-6"><button type="submit" class="btn btn-primary">login</button></div>
                             <div class="col-sm-6" style="padding-top:5px; text-align:right"><a href="<?php echo ci_site_url('login/forgetpassword')?>"> Forget Password </a></div>
                         </div>
                         <div class="row">
                             <div class="col-sm-12 message">
                             	<?php echo $msg;?>
                                <?php if(isset($_SESSION['resetpassword_message'])){
										if($_SESSION['resetpassword_message']!='')	
										echo $_SESSION['resetpassword_message'];
								}
								unset($_SESSION['resetpassword_message']);
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