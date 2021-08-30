<li id="category-menu-<?php echo $cat->catid;?>">
    <div class="row">
        <div class="col-xs-10">
        <?php //print_r($product_cats);?>
            <input type="checkbox" value="<?php echo $cat->catid;?>" class='catname_check' name="catname[]"
            	<?php if(isset($product_cats)){?> 
					 <?php if( in_array($cat->catid,$product_cats)){?>
                     checked="checked"
                     <?php }?>
              	<?php }?>
            /> <span id="category-name-<?php echo $cat->catid;?>"><?php echo $cat->catname;?></span>
        </div>
        <div class="col-xs-2">
            <a href="<?php echo ci_site_url('admin/products/category_edit/'.$cat->catid);?>" class="fancybox fancybox.iframe">
            	<i class="fa fa-pencil-square-o"></i>
            </a>
        </div>
    </div>
</li>