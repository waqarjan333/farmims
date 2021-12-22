<div class="row">
 
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?=  $this->lang->line('purchase_invoice') ?> <a href="<?=base_url('purchase/newinvoice')?>" class="btn btn-success btn-sm  waves-effect" style="float: right;"> <i class="fa fa-plus-circle"></i> <?=  $this->lang->line('create_invoice') ?></a></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?=  $this->lang->line('invoice_no') ?>.</th>
                            <th><?=  $this->lang->line('po_no') ?>.</th>
                            <th><?=  $this->lang->line('date') ?></th>
                            <th><?=  $this->lang->line('supplier') ?></th>
                            <th><?=  $this->lang->line('tax') ?></th>
                            <th><?=  $this->lang->line('net_total') ?></th>
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
                "url": "<?php echo base_url('purchase/get_pi_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "invoice_no"
                },
                {
                    "data": "po_no"
                },
                {
                    "data": "date"
                },
                {
                    "data": "supplier"
                },
                {
                    "data": "tax_per"
                },
                {
                    "data": "net_total"
                }
            ]

        });
    });
</script>