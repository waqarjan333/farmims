<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-6" style="margin: auto;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?=  $this->lang->line('add_expense') ?></h4>
                <?php echo form_open_multipart('expense/edit_landExpense/'.$edit_id) ?>
                <div class="row">
                    <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="uil uil-exclamation-octagon mr-2"></i>
                                <?= $this->session->flashdata('success') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        <?php } ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Expense Type<span class="text-danger">*</span></label>
                            <br>
                            <select name="expense_type" id="expense_type" class="select2" style="width: 100%;">
                                <option value="">Select Expense Type</option>
                                    <option value="land" selected="">Land</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('expense_type'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12" style="" id="type_land">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Land Type <span class="text-danger">*</span></label>
                                 <select style="width:100%" name="type_of_land" class="form-control select2" id="type_of_land">
                                        <option value="">Select Type Of Land</option>
                                        <?php foreach ($landType as $tol) { ?>
                                            <option  value="<?= $tol['id'] ?>" <?php if($landExpenseData->land_type==$tol['id']) { echo 'selected'; } ?> ><?= $tol['land_management_data'] ?></option>
                                        <?php } ?>

                                    </select>
                                    <input type="hidden" value="<?php echo  $landExpenseData->land_batch_no?>" id="hiddenLandID">
                                <span class="text-danger"><?php echo form_error('type_of_land'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-12" style="" id="batch_land">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Select Batch</label>
                                 <select style="width:100%" name="land_batch" class="form-control select2" id="land_batch">
                                        <option value="">Select Batch</option>
                                      

                                    </select>
                                    <span class="text-danger"><?php echo form_error('land_batch'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-12" style="" id="area_land">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Select Area</label>
                                <select style="width:100%" name="land_area" class="form-control select2" id="land_area">
                                        <option value="">Select Area</option>
                                      

                                    </select>
                                      <input type="hidden" value="<?php echo  $landExpenseData->land_area_no?>" id="hiddenBatchID">
                                    <input type="hidden" value="<?php echo  $landExpenseData->invoice?>" id="hiddenInvoice">
                                    <span class="text-danger"><?php echo form_error('land_area'); ?></span>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> <?=  $this->lang->line('name') ?> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="<?php echo  $landExpenseData->name?>" id="formrow-password-input">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> <?=  $this->lang->line('expense_category') ?><span class="text-danger">*</span></label>
                            <select name="expense_cat_id" id="expense_cat_id" class="form-control select2">
                                <option value=""><?=  $this->lang->line('select_expense_category') ?></option>
                                <?php foreach ($expense_category as $c) { ?>
                                    <option value="<?= $c['id'] ?>" <?php if($landExpenseData->expense_cat_id==$c['id']) { echo 'selected'; } ?>><?= $c['expense_category_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('expense_cat_id'); ?></span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?=  $this->lang->line('expense_date') ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='date' value="<?php echo  $landExpenseData->date?>" name="date" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?=  $this->lang->line('amount') ?> <span class="text-danger">*</span></label>
                            <input required class="form-group form-control" value="<?php echo  $landExpenseData->amount?>" data-toggle="touchspin" name="amount" id="amount" placeholder="<?=  $this->lang->line('expense_amount') ?>">
                            <span class="text-danger"><?php echo form_error('amount'); ?></span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?=  $this->lang->line('update') ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
   
</div> <!-- end row -->



</div>

<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
    $(document).ready(function() {


            var areaID=$('#hiddenBatchID').val();
        var val1=$('#hiddenInvoice').val();
        // alert(val1);
         var val=$('#type_of_land option:selected').text();
        // alert(val)
        var valID=$('#hiddenLandID').val();
        getBatchLand(val,valID);

         getBatchArea(val1,val,areaID);
        $("#amount").TouchSpin({
            min: 0,
            max: 9999999,
            step: 50,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            initval: 1
        });
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
    });

    // $('#expense_type').on('change',function(){
    //     var val=$(this).val();
    //     if(val=='land'){
    //         $('#type_land').show("500");
    //         $('#batch_land').show("500");
    //         $('#area_land').show("500");
    //     } else if (val=='other'){
    //         $('#type_land').hide("500");
    //         $('#batch_land').hide("500");
    //         $('#area_land').hide("500");
    //     } else{
    //         $('#type_land').hide("500");
    //         $('#batch_land').hide("500");
    //         $('#area_land').hide("500");
    //     }

    // })
    $('#type_of_land').on('change',function(){
        var val=$('#type_of_land option:selected').text();
        var valID=0;
        getBatchLand(val,valID)

    })
        function getBatchLand(val,valID)
    {
            $.ajax({
                    url: "<?= base_url('Cropform/getLandBatch/') ?>",
                    method:'POST',
                    data:{val:val,valID:valID},
                    success: function(result) {
                        $('#land_batch').html('');
                        $('#land_batch').html(result);
                    }
                });
    }
    $('#land_batch').on('change',function(){
        var val1=$(this).find(':selected').attr('data-invoice');
        var land_type=$('#type_of_land option:selected').text();
        // alert(val)
            var areaID=0;
          getBatchArea(val1,land_type,areaID);

    })
    function getBatchArea(val1,land_type,areaID)
    {
        // alert(areaID)
           $.ajax({
                    url: "<?= base_url('Cropform/getLandArea/') ?>",
                    method:'POST',
                    data:{invoice:val1,land_type:land_type,areaID:areaID},
                    success: function(result) {
                        $('#land_area').html('');
                        $('#land_area').html(result);
                    }
                });
    }
 

    <?php if($this->input->post('id')){?>
        $('#editModal').modal('show');
    <?php } ?>
</script>