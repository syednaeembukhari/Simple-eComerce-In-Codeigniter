<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Product Image</title>
<?php //$this->load->view('admin/template/scripts')?>
<script type="text/javascript" src="<?php echo base_url()?>assets/common/js/jquery.form.min.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			uploadProgress: OnProgress, //upload progress callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
		

//function after succesful file upload (when server response)
function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
	$('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar
	var output=$(this).html();
	//output='';
	var obj = jQuery.parseJSON( output );
	//console.log(output);
	if(obj.error=='yes')
	{
		$('#msg').html(obj.msg);
	}
	else
	{
		
		if(obj.imgno==1)
		$('#img-0', parent.document).attr('src',obj.fileurl)
		
		$('#img-'+obj.imgno, parent.document).attr('src',obj.fileurl)
		//console.log(parent.jQuery.fancybox)
		try{
        	parent.jQuery.fancybox.close();
		}catch(err){
			parent.$('#fancybox-overlay').hide();
			parent.$('#fancybox-wrap').hide();
		}
	}
}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#FileInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#FileInput')[0].files[0].size; //get file size
		var ftype = $('#FileInput')[0].files[0].type; // get file type
		

		//allow file types 
		switch(ftype)
        {
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html':
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 5 MB (1048576)
		if(fsize>5242880) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//progress bar function
function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
	$('#progressbox').show();
    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
    $('#statustxt').html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 

</script>
<link href="xxstyle/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="upload-wrapper"  style="width:300px">
<div class="container-fluid"align="center">
<h3><?php echo $this->lang->line('proimageupoader');?></h3>
<?php if($productid>0){?>
<form action="<?php echo ci_site_url('admin/ajax/upload_image/'.$productid.'/'.$imageno)?>" method="post" enctype="multipart/form-data" id="MyUploadForm">
<div class="row">
	<div class="col-md-12">
    <input name="FileInput" id="FileInput" type="file" />
    </div>
</div>
<div class="row">
	<div class="col-md-12">
    <input type="submit"  id="submit-btn" value="<?php echo $this->lang->line('proimageupload');?>" class="btn btn-primary" />
    </div>
</div>

<input type="hidden" value="<?php $imageno;?>" name="imageno"/>
<input type="hidden" value="<?php $productid;?>" name="productid"/>
<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
</form>
<div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>
<div id="output" style="display:none"></div>
<div id="msg" style="color:#FF0000"></div>
</div>
<?php }
else
{
	echo '<h4>'.$this->lang->line('errologinlogout').'</h4>';
}
?>
</div>

</body>
</html>