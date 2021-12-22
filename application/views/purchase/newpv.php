<div class="row">

    <div class="col-md-4"></div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <center><h4 class="card-title"><?=  $this->lang->line('createpurchasevouchers') ?></h4></center>
                <?php echo form_open('purchase/newpv', array('id' => 'rv-form')) ?>
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-octagon mr-2"></i>
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>

                <div class="row">
                    
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('supplier_paidto') ?><span class="text-danger">*</span></label>
                            <select required name="supplier_id" class="form-control select2">
                                <option value="">--<?=  $this->lang->line('select_supplier') ?>--</option>
                                <?php foreach ($supliers as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['partie_name'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('supplier_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?=  $this->lang->line('date') ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input required type="text" id='date' value="<?= $this->input->post('date') ?>" name="date" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                        </div>

                    </div>
                     <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('receipt_against_invoice') ?><span class="text-danger">*</span></label>
                            <select required name="invoice_id" class="form-control select2" id="receipt_against_invoice">
                                <option value="">--<?=  $this->lang->line('select_invoice') ?>--</option>
                                <?php foreach ($pis as $c) { ?>
                                    <option value="<?= $c['id'] ?>" amount="<?php echo $c['net_tot'] ?>" ><?= $c['invoice_no'] ?> (<?= $c['date'] ?>)</option>
                                <?php } ?> 
                            </select>
                            <span class="text-danger"><?php echo form_error('invoice_id'); ?></span>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('payment_mode') ?><span class="text-danger">*</span></label>
                            <select required name="payment_mode" class="form-control select2">
                                <option value="<?=PM_CASH?>"><?=  $this->lang->line('cash') ?></option> 
                                <option value="<?=PM_BANKTRANSFER?>"><?=  $this->lang->line('bank_transfer') ?></option> 
                            </select>
                            <span class="text-danger"><?php echo form_error('payment_mode'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formrow-password-input"><?=  $this->lang->line('amount') ?></label>
                            <input required type="text" name="amount" class="form-control" id="amount">
                            <span class="text-danger"><?php echo form_error('amount'); ?></span>
                        </div>
                    </div>
                   
                </div>  
                
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?=  $this->lang->line('save') ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row --> 
<script>
    $(document).ready(function() {
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
    });
   $('#receipt_against_invoice').on('change',function(){
    var amount=$('option:selected', this).attr('amount');
    // alert();
    $('#amount').val(amount);
</script>