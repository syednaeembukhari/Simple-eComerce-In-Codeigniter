<div class="row">
        <div class="col-sm-12" style="padding-bottom:5px">
        	<ul class="nav nav-pills">
             <li role="presentation"><a href="<?php echo ci_site_url('admin/sales')?>"><?php echo $this->lang->line('salerecentorder');?></a></li>
              <li role="presentation"><a href="<?php echo ci_site_url('admin/sales/pending_orders')?>"><?php echo $this->lang->line('salereceivedorders');?></a></li>
              <li role="presentation"><a href="<?php echo ci_site_url('admin/sales/completed_orders')?>"><?php echo $this->lang->line('salecompleteorders');?></a></li>
              <li role="presentation"><a href="<?php echo ci_site_url('admin/sales/sales_report')?>"><?php echo $this->lang->line('salereports');?></a></li>
             <?php /*?> <li role="presentation"><a href="#">Sales by Product</a></li><?php */?>
            </ul>
        </div>
        
    </div>