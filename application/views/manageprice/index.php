<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $this->lang->line('manage_price'); ?></h4>

                <hr>


                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-octagon mr-2"></i>
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-octagon mr-2"></i>
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>
                


                <?php echo form_open() ?>

                <div class="row">

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="formrow-firstname-input"><?= $this->lang->line('price_amount'); ?></label>
                            <input type="text" class="form-control" name="amount" id="formrow-firstname-input">
                        </div>
                    </div>

                </div>

                
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('product'); ?></label>
                            <select class="form-control select2" name="product_id">
                                <option><?= $this->lang->line('select_product'); ?> </option>
                                <?php foreach ($products as $pro) { ?>
                                    <option value="<?= $pro['id'] ?>"><?= $pro['product_name'] ?> (<?= $pro['product_code'] ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('partner'); ?></label>
                            <select class="form-control select2" name="party_id">
                                <option><?= $this->lang->line('select_partner'); ?></option>
                                <?php foreach ($parties as $p) { ?>
                                    <option value="<?= $p['id'] ?>"><?= $p['partie_name'] ?> (<?= $p['partie_code'] ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('uom'); ?></label>
                            <select class="form-control select2" name="uom">
                                <option><?= $this->lang->line('select_uom'); ?></option>
                                <?php foreach ($item_uom as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?> (<?= $c['symbol'] ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('Save'); ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?= $this->lang->line('manage_price'); ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?= $this->lang->line('price_amount'); ?></th>
                            <th><?= $this->lang->line('unit'); ?></th>
                            <th><?= $this->lang->line('product'); ?></th>
                            <th><?= $this->lang->line('partner'); ?></th>
                            <th><?= $this->lang->line('action'); ?></th>
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
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });

        $('#mydt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('Manageprice/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "amount"
                },
                {
                    "data": "measureunit"
                },

                {
                    "data": "product"
                },
                {
                    "data": "party"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });


     // Delete Function
     $(document).on('click', ".btn-delete", function() {
        $farm_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Price Amount will be deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes! Delete.',
            cancelButtonText: 'No! Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-danger ml-2 mt-2',
            buttonsStyling: false
        }).then(function(action) {
            if (action.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('manageprice/delete_price/') ?>" + $farm_id,
                    success: function(result) {},
                    complete: function(result) {
                        $('#mydt').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Success!',
                            text: 'deleted successfuly',
                            icon: 'success'
                        });
                    }
                });
            }
        });

    });
</script>