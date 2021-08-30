<?php $orderno='';?>  
      <?php if($orderinfo->num_rows()>0){?>
      <?php $order=$orderinfo->row();?>
<div class="container" style="margin-bottom:20px;">

    <div class="row">
        <div class="col-xs-6"><h3 class="admin_title"><?php echo $this->lang->line('orderdetail');?></h3></div>
        <div class="col-xs-6" style="text-align:right">
        <?php if($order->orderstatus<3){?>
        <a href="<?php echo ci_site_url('admin/sales/shiporder/'.$orderid);?>"  class="fancybox fancybox.iframe btn btn-success btn-sm">Ship it</a>
        <?php }?>
        <a href="javascript:void(0)" onclick="print_order()" class="btn btn-primary btn-sm">Print</a>
        </div>
    </div>
</div>

<div class="container" id="order-print">
   <?php $this->load->view('admin/sales/orders/order-inner-table',array('order'=>$order))?>
    
</div>
<script type="text/javascript">
         function print_order() {
            var divContents = $("#order-print").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><link href="<?php echo base_url();?>assets/common/bootstrap/css/bootstrap.min.css" rel="stylesheet"><title>Order no:<?php echo $orderno;?> </title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
 <?php }?>