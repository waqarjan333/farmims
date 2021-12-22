<div class="row">
 
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?=  $this->lang->line('receipt_voucher') ?> <a href="<?=base_url('sale/newrv')?>" class="btn btn-success btn-sm  waves-effect" style="float: right;"> <i class="fa fa-plus-circle"></i> <?=  $this->lang->line('new_receipt') ?></a></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?=  $this->lang->line('date') ?></th>
                            <th><?=  $this->lang->line('customer') ?></th>
                            <th><?=  $this->lang->line('amount') ?></th>
                            <th><?=  $this->lang->line('invoice') ?></th>
                            <th><?=  $this->lang->line('payment_mode') ?></th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<script>
    $(document).ready(function() {
        $('#mydt').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('sale/get_rv_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "date"
                },
                {
                    "data": "customer"
                },
                {
                    "data": "amount"
                },
                {
                    "data": "invoice"
                },
                {
                    "data": "payment_mode"
                }
            ]

        });
    });
</script>