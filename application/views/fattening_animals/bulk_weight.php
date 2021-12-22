<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-body">
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
                <div class="row">

                    <div class="col-md-4 col-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('batch_number'); ?></label>
                            <select name="batch_number" id="batch_number" onchange="get_batch_animals_weight()" class="form-control select2" style="width: 100%">
                                <option value="0"><?= $this->lang->line('select_batch_no'); ?></option>
                                <?php foreach ($batchs as $batch) { ?>
                                    <option value="<?= $batch['id'] ?>"><?= $batch['code'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                 </div>
        </div>
        </div>
        <div class="card">
        <div class="card-body">
        <?php echo form_open('bulk_weight/update_bulk_weight') ?>
        
        <div class="row">
        <div class="col-12 mb-3">
            <button class="btn btn-success btn-sm" style="width:10% !important; float:right !important;" type="submit"><i class="fa fa-check-circle"></i> <?= $this->lang->line('update'); ?></button>
        </div>
                <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?= $this->lang->line('sr'); ?></th>
                            <th><?= $this->lang->line('code'); ?></th>
                            <th><?= $this->lang->line('name'); ?></th>
                            <th><?= $this->lang->line('purchase_weight'); ?></th>
                            <th><?= $this->lang->line('last_weight'); ?></th>
                            <th><?= $this->lang->line('last_weight_date'); ?></th>
                            <th><?= $this->lang->line('today_weight'); ?></th>
                            <th><?= $this->lang->line('today_weight_date'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="batch_animals">
                    
                    </tbody>
                </table>
                
        
        </div>
        
        <?php echo form_close(); ?>
        </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<script>
$(document).ready(function() {
    $(".select2").select2({});
});

function get_batch_animals_weight() {
    if($('#batch_number').val()==0){
        $("#batch_animals").html("");
    } else {
        $.ajax({
            url: "<?= base_url('bulk_weight/get_batch_animals_weight/') ?>" + $('#batch_number').val(),
            success: function(result) {
                $("#batch_animals").html(result);
            }
        });
    }
        
    }
</script>
