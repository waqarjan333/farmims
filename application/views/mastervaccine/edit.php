<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-6">
        <?php echo form_open('master_vaccine/item/'.$item['id']) ?>
        <div class="card">
           
            <div class="row" style="margin:10px !important;">
                <div class="col-8">
                    <div class="card-title"><?= $this->lang->line('update_master_vaccine'); ?></div>
                </div>
                <div class="col-4">
                    <button class="btn btn-success btn-sm" style="float:right !important; width:80% !important;"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('update'); ?></button>
                </div>
            </div>
            <hr>
            <div class="card-body">
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
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formrow-email-input">Products</label>
                            <select name="product_id" class="form-control select2" id="product_id">
                                <option value="">Select Product</option>
                                <?php foreach ($product as $c) { ?>
                                    <option value="<?= $c['id'] ?>" <?php if ($c['id'] == $item['product_id']) {
                                                                        echo 'selected';
                                                                    } ?>><?= $c['product_name'] ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="product_details"></div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Expiry Date</label>
                            <input type="text" id='expdate' value="<?= ($this->input->post('expdate')) ? $this->input->post('expdate') : $item['expiry_date'];  ?>" name="expdate" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <span class="text-danger"><?php echo form_error('expdate'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Purchase Date</label>
                            <input type="text" id='purchase_date' value="<?= ($this->input->post('purchase_date')) ? $this->input->post('purchase_date') : $item['purchase_date'];  ?>" name="purchase_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <span class="text-danger"><?php echo form_error('purchase_date'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Stock Available <span class="text-danger">*</span></label>
                            <input type="text" name="stock_available" readonly class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('stock_available'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Store Instructions <span class="text-danger">*</span></label>
                            <select name="store_instruction" class="form-control select2">
                                <option value="">All</option>
                                <option <?php if ($item['store_instruction'] == STORE_INSTRUCTION_ROOM_TEMPERATURE) {
                                            echo 'selected';
                                        } ?> value="<?= STORE_INSTRUCTION_ROOM_TEMPERATURE; ?>">Room Tempreture</option>
                                <option <?php if ($item['store_instruction'] == STORE_INSTRUCTION_FRIDGE) {
                                            echo 'selected';
                                        } ?> value="<?= STORE_INSTRUCTION_FRIDGE; ?>">Fridge</option>
                                <option <?php if ($item['store_instruction'] == STORE_INSTRUCTION_FREEZER) {
                                            echo 'selected';
                                        } ?> value="<?= STORE_INSTRUCTION_FREEZER; ?>">Freezer</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('store_instruction'); ?></span>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Name Of Disease <span class="text-danger">*</span></label>
                            <select name="disease_name" class="form-control select2">
                                <option value="">Select Disease </option>
                                <?php foreach ($disease as $d) { ?>
                                    <option value="<?= $d['id'] ?>" <?php if ($item['disease_name'] == $d['id']) {
                                                                        echo 'selected';
                                                                    } ?>><?= $d['name'] ?> </option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('disease_name'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Age at first Dose <span class="text-danger">*</span></label>
                            <input value="<?= ($this->input->post('age_at_first_dose')) ? $this->input->post('age_at_first_dose') : $item['age_at_first_dose']; ?>" required class="form-group form-control weight" data-toggle="touchspin" name="age_at_first_dose" id="age_at_first_dose">
                            <span class="text-danger"><?php echo form_error('age_at_first_dose'); ?></span>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Booster Dose <span class="text-danger">*</span></label>
                            <select name="booster_dose" class="form-control select2">
                                <option value="">Select Booster Dose</option>
                                <option <?php if ($item['booster_dose'] == 1) {
                                            echo 'selected';
                                        } ?> value="1">Yes</option>
                                <option <?php if ($item['booster_dose'] == 0) {
                                            echo 'selected';
                                        } ?> value="0">No</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('booster_dose'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Subsequent Dose</label>
                            <input value="<?= ($this->input->post('subsequent_dose'))?$this->input->post('subsequent_dose'):$item['subsequent_dose']; ?>" required class="form-group form-control weight" data-toggle="touchspin" name="subsequent_dose" id="subsequent_dose" >

                            <span class="text-danger"><?php echo form_error('subsequent_dose'); ?></span>
                        </div>
                    </div>
                </div>



                
                <?php echo form_close() ?>
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


    });

    function get_category_products() {
        $.ajax({
            url: "<?= base_url('master_vaccine/get_category_products/') ?>" + $('#product_id').val(),
            success: function(result) {
                $("#product_id").html(result);
            }
        });
    }
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
</script>