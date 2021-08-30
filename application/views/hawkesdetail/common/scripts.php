<base href="<?php echo base_url();?>">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo head_title();?></title>

<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/common/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/common/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script language="javascript">
     var base_url='<?php echo base_url(); ?>';
</script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->    
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="<?php echo base_url();?>assets/templates/<?php echo active_theme();?>/style.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/common/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/common/js/javascript.js"></script>
<script src="assets/common/fancybox/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="assets/common/fancybox/jquery.fancybox.css">
<script language="javascript">
	$(document).ready(function(e) {
	   $(".fancybox").fancybox({type: 'ajax'});
	});
</script>