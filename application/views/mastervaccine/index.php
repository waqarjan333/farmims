<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-4">
        <?php echo form_open('master_vaccine/') ?>
        <div class="card">
            <div class="row" style="margin:10px !important;">
                <div class="col-8">
                    <div class="card-title"><?= $this->lang->line('add_master_vaccine'); ?></div>
                </div>
               
            </div>
            <hr>
            
                
                
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
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('products'); ?></label>
                            <select name="product_id" class="form-control select2" id="product_id">
                                <option value=""><?= $this->lang->line('select_product'); ?></option>
                                <?php foreach ($product as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['product_name'] ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="product_details"></div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('expiry_date'); ?></label>
                            <input type="text" id='expdate' value="<?= ($this->input->post('expdate')) ? $this->input->post('expdate') : date('Y-m-d');  ?>" name="expdate" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <span class="text-danger"><?php echo form_error('expdate'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('purchase_date'); ?></label>
                            <input type="text" id='purchase_date' value="<?= ($this->input->post('purchase_date')) ? $this->input->post('purchase_date') : date('Y-m-d');  ?>" name="purchase_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <span class="text-danger"><?php echo form_error('purchase_date'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('stock_available'); ?> <span class="text-danger">*</span></label>
                            <input type="number" name="stock_available" readonly class="form-control" id="product-stock-input">
                            <span class="text-danger"><?php echo form_error('stock_available'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('store_instruction'); ?> <span class="text-danger">*</span></label>
                            <select name="store_instruction" class="form-control select2">
                                <option value="">All</option>
                                <option value="<?= STORE_INSTRUCTION_ROOM_TEMPERATURE; ?>"><?= $this->lang->line('room_temprature'); ?></option>
                                <option value="<?= STORE_INSTRUCTION_FRIDGE; ?>"><?= $this->lang->line('fridge'); ?></option>
                                <option value="<?= STORE_INSTRUCTION_FREEZER; ?>"><?= $this->lang->line('freezer'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('store_instruction'); ?></span>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('name_of_diesese'); ?> <span class="text-danger">*</span></label>
                            <select name="disease_name" class="form-control select2">
                                <option value=""><?= $this->lang->line('select_diesese'); ?> </option>
                                <?php foreach ($disease as $d) { ?>
                                    <option value="<?= $d['id'] ?>"><?= $d['name'] ?> </option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('disease_name'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('age_at_first_dose'); ?> <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('age_at_first_dose') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="age_at_first_dose" id="age_at_first_dose">
                            <span class="text-danger"><?php echo form_error('age_at_first_dose'); ?></span>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-firstname-input"><?= $this->lang->line('booster_dose'); ?> <span class="text-danger">*</span></label>
                            <select name="booster_dose" class="form-control select2">
                                <option value=""><?= $this->lang->line('select_booster_dose'); ?></option>
                                <option value="1"><?= $this->lang->line('yes'); ?></option>
                                <option value="0"><?= $this->lang->line('no'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('booster_dose'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('subsequent_dose'); ?></label>
                            <input required class="form-group form-control weight" data-toggle="touchspin" name="subsequent_dose" id="subsequent_dose" >

                            <span class="text-danger"><?php echo form_error('subsequent_dose'); ?></span>
                        </div>
                    </div>
                </div>



                <div class="modal-footer">
                     <div class="col-12">
                    <button class="btn btn-success btn-sm btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?= $this->lang->line('vaccine_master'); ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?= $this->lang->line('name'); ?></th>
                            <th><?= $this->lang->line('code'); ?></th>
                            <th><?= $this->lang->line('expiry_date'); ?></th>
                            <th><?= $this->lang->line('purchase_date'); ?></th>
                            <th><?= $this->lang->line('store_instruction'); ?></th>
                            <th><?= $this->lang->line('name_of_diesese'); ?></th>
                            <th><?= $this->lang->line('age_at_first_dose'); ?></th>
                            <th><?= $this->lang->line('booster_dose'); ?></th>
                            <th><?= $this->lang->line('subsequent_dose'); ?></th>
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
<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
    $(document).ready(function() {
        $(".weight").TouchSpin({
            min: 0,
            max: 9999999,
            step: 1,
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
            "order": [
                [1, "desc"]
            ],
            "ajax": {
                "url": "<?php echo base_url('master_vaccine/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "product_name"
                },
                {
                    "data": "expdate"
                },
                {
                    "data": "purchase_date"
                },
                {
                    "data": "store_instruction"
                },
                {
                    "data": "disease_name"
                },
                {
                    "data": "age_at_first_dose"
                },
                {
                    "data": "booster_dose"
                },
                {
                    "data": "subsequent_dose"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

    // function get_category_products() {
    //     $.ajax({
    //         url: "<?= base_url('master_vaccine/get_category_products/') ?>" + $('#productcatid').val(),
    //         success: function(result) {
    //             $("#product_id").html(result);
    //         }
    //     });
    // }
    // function get_product_details() {
    //         $.ajax({
    //             url: "<?= base_url('master_vaccine/get_product_details/') ?>" + $('#product_id').val(),
    //             success: function(result) {
    //                 $("#product_details").html(result);
    //             }
    //         });
    //     }



    $(document).ready(function() {
        // Set Default Exp Date
        $('#expdate').val(new moment().add(1, 'M').format('YYYY-MM-DD'));
    });

    // Delete Function
    $(document).on('click', ".btn-delete", function() {
        $farm_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Master Vaccine will be deleted",
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
                    url: "<?= base_url('master_vaccine/delete_master_vaccine/') ?>" + $farm_id,
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


    $('#product_id').on('change', function (e) {
    var optionSelected = $('#product_id').find(":selected").val();
    // $("option:selected", this);

    $.get("<?= base_url('product/stock/') ?>"+optionSelected, function(data, status){

        stock = parseInt(JSON.parse(data));
        $('#product-stock-input').val(stock);

    });
    
});
</script>