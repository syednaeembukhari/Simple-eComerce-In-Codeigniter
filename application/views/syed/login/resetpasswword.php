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
                	<h3>Reset Password</h3>
                	<form role="form" action="" method="post" enctype="multipart/form-data">
                    	 <div class="form-group">
                            <label for="exampleInputEmail1">Enter Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                         </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Re-Enter Password</label>
                            <input type="password" name="password2" class="form-control"  placeholder="Re-Enter Password">
                         </div>
                         <div class="row">
                             <div class="col-sm-6"><button type="submit" class="btn btn-info">Reset Password</button></div>
                             <div class="col-sm-6" style="padding-top:5px; text-align:right"></div>
                         </div>
                         <div class="row">
                             <div class="col-sm-12 message">
                             	<?php echo $msg;?>
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