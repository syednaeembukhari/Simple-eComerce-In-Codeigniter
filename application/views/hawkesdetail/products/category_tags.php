<?php $cats=get_shop_categories(1);?>
<h5>Categories</h5>
<ul style="list-style:none; padding:0px; margin:0px">
<?php foreach ($cats->result() as $cat){?>
	<li>
    <a href="<?php echo ci_site_url('products/category/'.$cat->catslug);?>" class="btn btn-xs" style="font-size:14px">
        <?php echo $cat->catname;?>
    </a>
    </li>
<?php }?>
</ul>