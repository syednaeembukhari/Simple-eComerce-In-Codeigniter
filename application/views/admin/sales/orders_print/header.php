<table width="100%" border="0">
  <tr>
   <?php $current_logo=get_store_settings('LOGO_IMG'); 
	  if ($current_logo==''){
			$current_logo=base_url().'assets/images/logo.png';
		}
		else
		$current_logo=base_url().MEDIA_UPLOAD_PATH.'/common/'.$current_logo;
 	?>
    <td width="44%"><img src="<?php echo $current_logo?>" height="90px"/></td>
    <td width="56%" style="text-align:right">
    	 
        
    </td>
  </tr>
</table>
<hr/>
