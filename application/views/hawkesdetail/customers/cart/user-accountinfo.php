<div class="row">
	<div class="col-md-12">
    	<div class="msg" id="msgcontainer">
        	<?php 
				if($this->session->userdata('order_error'))
				{
					echo $this->session->userdata('order_error');
					$this->session->unset_userdata('order_error');
				}
			?>
        </div>
    </div>
</div>
<?php if($this->session->userdata('loggedin')==false ){?>
<div class="row">
	<div class="col-md-12">
    	<h5>Login</h5>	
    	
        <div class="form-group">
            <input type="email" class="form-control" name="signinemail" id="signinemail" placeholder="Enter email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="signinpass" id="signinpass" placeholder="Password">
        </div>
        <button type="button" class="btn btn-info btn-sm" onclick="login()">Submit</button>
        
    </div>
</div>
<script>
      	function login()
		{
			$.ajax ( { 
						dataType:"json",
						type: "POST",
						url: "<?php echo ci_site_url('login/customer_login/');?>",
						data: { 
								is_ajax:true,
								email:$('#signinemail').val(),
								password:$('#signinpass').val(),
						},
					})
					.done(function( response ) {
						//console.log(response);
						if(response.status=='OK')
						window.location='<?php echo ci_site_url('customers/cart');?>';
						else
						{
							$('#msgcontainer').html(response.msg);
							setTimeout(function(){ $('#msgcontainer').html(''); }, 5000);
						}
			});
		}
      
      </script>
      
        
    	
      <?php }?>     
     
    
	<form method="post" action="<?php echo ci_site_url('customers/cart_preview_page');?>" enctype="multipart/form-data" id="checkoutform">   
    <input type="hidden" value="cartsubmitted" name="cartsubmitted"/>
    
     <?php if($this->session->userdata('loggedin')==false ){?>
     <div class="row">
            <div class="col-md-12">
               <h5>Create an Account</h5>
                
                <div class="form-group">
                    <input type="email" value="<?php echo get_cart_ses_value('signupemail');?>" class="form-control" name="signupemail" id="signupemail" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                        <input type="password" value="<?php echo get_cart_ses_value('password');?>" class="form-control" name="signuppass" id="signuppass" placeholder="Password">
                        </div>
                        <div class="col-xs-6">
                        <input type="password" value="<?php echo get_cart_ses_value('signuppass2');?>" class="form-control" name="signuppass2" id="signuppass2" placeholder="Confirm Password">
                        </div>
                    </div>
                   
                </div>
            </div>
		</div>
    <?php }?>   
    
    
        <div class="row">
            <div class="col-md-12">
                <h5>Shipping Address</h5>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('shippingfname');?>" class="form-control" name="shippingfname" id="shippingfname" placeholder="First Name" onchange="populate_samebilling()">
                        </div>
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('shippinglname');?>" class="form-control" name="shippinglname" id="shippinglname" placeholder="Last Name">
                        </div>
                    </div>
               </div>
                <div class="form-group">
                   <input type="text" value="<?php echo get_cart_ses_value('shippingaddress');?>" class="form-control" name="shippingaddress" id="shippingaddress" placeholder="Street Address">
                </div>
                <div class="form-group">
                    <input type="text" value="<?php echo get_cart_ses_value('shippingaddress2');?>" class="form-control" name="shippingaddress2" id="shippingaddress2" placeholder="Address 2">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('shippingstate');?>" class="form-control" name="shippingstate" id="shippingstate" placeholder="State">
                        </div>
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('shippingcity');?>" class="form-control" name="shippingcity" id="shippingcity" placeholder="City">
                        </div>
                    </div>
               </div>
                <div class="form-group">
                    <div class="row">
                    	 <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('shippingzip');?>" class="form-control" name="shippingzip" id="shippingzip" placeholder="Zipcode">
                        </div>
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('shippingphone');?>"  class="form-control" name="shippingphone" id="shippingphone" placeholder="Phone">
                        </div>
                       
                    </div>
                   
                </div>
            </div>
		</div>
        
        <div class="row">
            <div class="col-md-12">
            	
                <h5>Payment Information</h5>
                
                <div class="form-group">
                   <input type="text" value="<?php echo get_cart_ses_value('cardname');?>" class="form-control" name="cardname" id="cardname" placeholder="Card holder's name">
                </div>
                <div class="form-group">
                    <input type="text" value="<?php //echo get_cart_ses_value('cardno');?>" class="form-control" name="cardno" id="cardno" placeholder="Card No">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-4">
                        <select  class="form-control" name="cardmonth" id="cardmonth" placeholder="Month">
                        	<?php for($i=1;$i<=12;$i++){?>
                            <option value="<?php echo $i?>" 
							<?php if(get_cart_ses_value('cardmonth')==$i){echo 'selected="selected"';}?>><?php echo $i;?></option>
                            <?php }?>
                        </select>
                        </div>
                        <div class="col-xs-4">
                        <input type="text" value="<?php echo get_cart_ses_value('cardyear');?>" class="form-control" name="cardyear" id="cardyear" placeholder="Year">
                        </div>
                        <div class="col-xs-4">
                        <input type="text" value="<?php //echo get_cart_ses_value('cardcvv');?>" class="form-control" name="cardcvv" id="cardcvv" placeholder="CVV">
                        </div>
                    </div>
               </div>
            </div>
		</div>
      
      
      <div class="row">
            <div class="col-md-12">
                <h5>Billing Information</h5>
                <div class="form-group">
                    <div class="row">
                    	<div class="col-xs-1">
                        <input type="checkbox" value="billingsame"  name="billingsame" id="billingsame" <?php if(get_cart_ses_value('billingsame')=='billingsame'){echo 'checked="checked"';}?>  >
                        </div>
                        <div class="col-xs-6">
                        	Same as shipping
                        </div>
                        
                    </div>
               </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('billingfname');?>" class="form-control" name="billingfname" id="billingfname" placeholder="First Name">
                        </div>
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('billinglname');?>" class="form-control" name="billinglname" id="billinglname" placeholder="Last Name">
                        </div>
                    </div>
               </div>
                
               <div id="billingcontrolls">
                <div class="form-group">
                   <input type="text" value="<?php echo get_cart_ses_value('billingaddress');?>" class="form-control" name="billingaddress" id="billingaddress" placeholder="Street Address">
                </div>
                <div class="form-group">
                    <input type="text" value="<?php echo get_cart_ses_value('billingaddress2');?>" class="form-control" name="billingaddress2" id="billingaddress2" placeholder="Address 2">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('billingstate');?>" class="form-control" name="billingstate" id="billingstate" placeholder="State">
                        </div>
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('billingcity');?>" class="form-control" name="billingcity" id="billingcity" placeholder="City">
                        </div>
                    </div>
               </div>
                <div class="form-group">
                    <div class="row">
                    
                    	<div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('billingzip');?>" class="form-control" name="billingzip" id="billingzip" placeholder="Zipcode">
                        </div>
                        <div class="col-xs-6">
                        <input type="text" value="<?php echo get_cart_ses_value('billingphone');?>" class="form-control" name="billingphone" id="billingphone" placeholder="Phone">
                        </div>
                       
                    </div>
                   
                </div>
            </div>
            </div>
            
		</div>
        
         <div class="row">
            <div class="col-md-12">
            	<button type="button" id="checkout-btn" class="btn btn-info" onclick="getpayment_token()">Checkout</button>
            </div>
        </div>
        
  </form>      
  <?php //pre_print($this->session->userdata('cartdata'));?>
 <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
 <script>
 Stripe.setPublishableKey('<?php echo get_store_settings('STRIP_PUBLISHER_KEY');?>');
 function getpayment_token()
 {
	 //$('#checkoutform').submit();
	 //return;
		 // disable the submit button to prevent repeated clicks
		$('#checkout-btn').attr("disabled", "disabled");

		// createToken returns immediately - the supplied callback submits the form if there are no errors
		Stripe.createToken({
			number: $('#cardno').val(),
			cvc: $('#cardcvv').val(),
			exp_month: $('#cardmonth').val(),
			exp_year: $('#cardyear').val()
		}, stripeResponseHandler);
		return false; // submit from callback	 
	 //$('#checkoutform').submit();
 }


function stripeResponseHandler(status, response) {
	if (response.error) {
		// re-enable the submit button
		$('#checkout-btn').removeAttr("disabled");
		// show the errors on the form
		$("#msgcontainer").html(response.error.message);
	} else {
		var form$ = $("#checkoutform");
		// token contains id, last4, and card type
		var token = response['id'];
		// insert the token into the form so it gets submitted to the server
		form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
		// and submit
		$('#checkoutform').submit();
		
		//alert(token);
	}
}

$(document).ready(function(e) {
    $("#billingsame").change(function() {
		if(this.checked) {
			$('#billingfname').val($('#shippingfname').val());
			$('#billinglname').val($('#shippinglname').val());
			$('#billingaddress').val($('#shippingaddress').val());
			$('#billingaddress2').val($('#shippingaddress2').val());
			$('#billingstate').val($('#shippingstate').val());
			$('#billingcity').val($('#shippingcity').val());
			$('#billingzip').val($('#shippingzip').val());
			$('#billingphone').val($('#shippingphone').val());
		}
	});
});

function populate_samebilling()
{
	var chk=$('#billingsame');
	console.log(chk);
	console.log($('#billingsame').attr('selected'));
	if(chk.attr('checked')) {
			$('#billingfname').val($('#shippingfname').val());
			$('#billinglname').val($('#shippinglname').val());
			$('#billingaddress').val($('#shippingaddress').val());
			$('#billingaddress2').val($('#shippingaddress2').val());
			$('#billingstate').val($('#shippingstate').val());
			$('#billingcity').val($('#shippingcity').val());
			$('#billingzip').val($('#shippingzip').val());
			$('#billingphone').val($('#shippingphone').val());
		}
}

 </script>