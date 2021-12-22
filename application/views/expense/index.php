<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<style>
    .datepicker{z-index:1151 !important;border: 1px solid lightgrey !important;}
</style>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?=  $this->lang->line('add_expense') ?></h4>
                <?php echo form_open('expense/index') ?>
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
                                    <option value="land">Land</option>
                                    <option value="other">Other</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('expense_type'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:none;" id="type_land">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Land Type <span class="text-danger">*</span></label>
                                 <select style="width:100%" name="type_of_land" class="form-control select2" id="type_of_land">
                                        <option value="">Select Type Of Land</option>
                                        <?php foreach ($landType as $tol) { ?>
                                            <option  value="<?= $tol['id'] ?>"><?= $tol['land_management_data'] ?></option>
                                        <?php } ?>

                                    </select>
                                <span class="text-danger"><?php echo form_error('type_of_land'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-12" style="display:none;" id="batch_land">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Select Batch</label>
                                 <select style="width:100%" name="land_batch" class="form-control select2" id="land_batch">
                                        <option value="">Select Batch</option>
                                      

                                    </select>
                                    <span class="text-danger"><?php echo form_error('land_batch'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-12" style="display:none;" id="area_land">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Select Area</label>
                                <select style="width:100%" name="land_area" class="form-control select2" id="land_area">
                                        <option value="">Select Area</option>
                                      

                                    </select>
                                    <span class="text-danger"><?php echo form_error('land_area'); ?></span>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> <?=  $this->lang->line('name') ?> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="formrow-password-input">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> <?=  $this->lang->line('expense_category') ?><span class="text-danger">*</span></label>
                            <select name="expense_cat_id" id="expense_cat_id" class="form-control select2">
                                <option value=""><?=  $this->lang->line('select_expense_category') ?></option>
                                <?php foreach ($expense_category as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['expense_category_name'] ?></option>
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
                                <input type="text" id='date' value="<?= date('d M,Y') ?>" name="date" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
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
                            <input required class="form-group form-control" data-toggle="touchspin" name="amount" id="amount" placeholder="<?=  $this->lang->line('expense_amount') ?>">
                            <span class="text-danger"><?php echo form_error('amount'); ?></span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?=  $this->lang->line('save') ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?=  $this->lang->line('all_expenses') ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?=  $this->lang->line('expense') ?></th>
                            <th><?=  $this->lang->line('category') ?></th>
                            <th><?=  $this->lang->line('date') ?></th>
                            <th><?=  $this->lang->line('amount') ?></th>
                            <th><?=  $this->lang->line('action') ?></th>
                        </tr>
                    </thead>


                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


<!-- Edit Expense Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="card-title"><?=  $this->lang->line('edit_expense') ?></h4>
                <?php echo form_open('expense/index') ?>
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" value="" name="id" id="editing_id">
                        
                        <div class="form-group">
                            <label class="control-label"> <?=  $this->lang->line('name') ?> <span class="text-danger">*</span></label>
                            <input type="text" name="ename" id="editing_name" class="form-control" id="formrow-password-input">
                            <span class="text-danger"><?php echo form_error('ename'); ?></span>
                        </div>
                    </div>
                 </div>
                 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> <?=  $this->lang->line('expense_category') ?><span class="text-danger">*</span></label>
                            <br>
                            <select name="eexpense_cat_id" id="editing_expense_cat_id" class="select2" style="width: 100%;">
                                <option value=""><?=  $this->lang->line('select_expense_category') ?></option>
                                <?php foreach ($expense_category as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['expense_category_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('eexpense_cat_id'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?=  $this->lang->line('expense_date') ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='editing_date' value="<?= date('d M,Y') ?>" name="edate" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('edate'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?=  $this->lang->line('amount') ?> <span class="text-danger">*</span></label>
                            <input required class="form-group form-control" data-toggle="touchspin" name="eamount" id="editing_amount" placeholder="Expense Amount">
                            <span class="text-danger"><?php echo form_error('eamount'); ?></span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?=  $this->lang->line('save') ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
    $(document).ready(function() {
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
        $('#mydt').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('expense/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "category"
                },
                {
                    "data": "date"
                },
                {
                    "data": "amount"
                },
                 {
                    "data": "actions"
                }
            ]

        });
    });

    // Expense Delete Function
    $(document).on('click', ".btn-delete", function() {
        $expense_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Expense will be deleted",
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
                    url: "<?= base_url('expense/delete_expense/') ?>" + $expense_id,
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

    $('#expense_type').on('change',function(){
        var val=$(this).val();
        if(val=='land'){
            $('#type_land').show("500");
            $('#batch_land').show("500");
            $('#area_land').show("500");
        } else if (val=='other'){
            $('#type_land').hide("500");
            $('#batch_land').hide("500");
            $('#area_land').hide("500");
        } else{
            $('#type_land').hide("500");
            $('#batch_land').hide("500");
            $('#area_land').hide("500");
        }

    })
    $('#type_of_land').on('change',function(){
        var val=$('#type_of_land option:selected').text();
             $.ajax({
                    url: "<?= base_url('Cropform/getLandBatch/') ?>",
                    method:'POST',
                    data:{val:val},
                    success: function(result) {
                        $('#land_batch').html('');
                        $('#land_batch').html(result);
                    }
                });

    })
    $('#land_batch').on('change',function(){
        var val=$(this).find(':selected').attr('data-invoice');
        var land_type=$('#type_of_land option:selected').text();
        // alert(val)
             $.ajax({
                    url: "<?= base_url('Cropform/getLandArea/') ?>",
                    method:'POST',
                    data:{invoice:val,land_type:land_type},
                    success: function(result) {
                        $('#land_area').html('');
                        $('#land_area').html(result);
                    }
                });

    })
    // Edit
    $(document).on('click', ".btn-edit", function() {
        obj = this;
        $editing_id = $(obj).attr('code');
        $country_id = $(obj).attr('country');
        $province_id = $(obj).attr('province');
        // $obj = $(obj);
        ename = $(obj).parents('tr').children('td:first').text().trim();
        ecategory = $(obj).parents('tr').children('td').eq(1).text().trim();
        edate = $(obj).parents('tr').children('td').eq(2).text().trim();
        amount = $(obj).parents('tr').children('td').eq(3).text().trim();

        $("select#editing_expense_cat_id option").filter(function() {
            console.log("Compairing",$(this).text(),ecategory,$(this).text() == ecategory);
            if($(this).text() == ecategory){
                $('#editing_expense_cat_id').val($(this).val());
                $('#editing_expense_cat_id').select2().trigger('change');
                return true;
            }else{
                return false;
            }
        }).prop('selected', true);

        $('#editing_id').val($editing_id);
        $('#editing_name').val(ename);
        // $('#editing_expence_cat_id').text(ecategory);
        $('#editing_date').val(edate);
        $('#editing_amount').val(amount);

        $('#editModal').modal('show');

    });


    <?php if($this->input->post('id')){?>
        $('#editModal').modal('show');
    <?php } ?>
</script>