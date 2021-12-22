<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-4">
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
                <h4 class="card-title"><?= $this->lang->line('add_new_partner'); ?></h4>
                <hr>
                <?php echo form_open('parties/index') ?>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('type'); ?> <span class="text-danger">*</span></label>
                            <select name="type" class="form-control select2" id="party_type">
                                <option value=""><?= $this->lang->line('select_partner'); ?></option>
                                <option <?php if ($this->input->post('type') == PARTY_TYPE_CUSTOMER) {
                                            echo 'selected';
                                        } ?> value="<?= PARTY_TYPE_CUSTOMER ?>"><?= $this->lang->line('customer'); ?></option>
                                <option <?php if ($this->input->post('type') == PARTY_TYPE_SUPPLIER) {
                                            echo 'selected';
                                        } ?> value="<?= PARTY_TYPE_SUPPLIER ?>"><?= $this->lang->line('supplier'); ?></option>

                            </select>
                            <span class="text-danger"><?php echo form_error('type'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('Partner_Category'); ?> <span class="text-danger">*</span></label>
                            <select name="partycatid" class="form-control select2" id="partycats">
                                <option value=""><?= $this->lang->line('select_party_category'); ?></option>
                                <?php foreach ($partycategory as $c) { ?>
                                    <option <?php if ($this->input->post('partycatid') == $c['id']) {
                                                echo 'selected';
                                            } ?> value="<?= $c['id'] ?>"><?= $c['party_category_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('partycatid'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('code'); ?></label>
                            <input value="<?= $this->input->post('code') ?>" type="text" name="code" class="form-control" id="partycode">
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="formrow-firstname-input"><?= $this->lang->line('name'); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('name') ?>" name="name" class="form-control" id="formrow-firstname-input">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formrow-password-input"><?= $this->lang->line('phone_no'); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('phone') ?>" name="phone" class="form-control" id="formrow-password-input">
                            <span class="text-danger"><?php echo form_error('phone'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('email'); ?></label>
                            <input type="email" value="<?= $this->input->post('email') ?>" name="email" class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-password-input"><?= $this->lang->line('taxtion'); ?></label>
                            <input type="text" value="<?= $this->input->post('taxtion') ?>" name="taxtion" class="form-control" id="taxation_input">
                            <span class="text-danger"><?php echo form_error('taxtion'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label"><?= $this->lang->line('country'); ?> <span class="text-danger">*</span></label>
                    <select id="country_id" onchange="get_province_by_country_id()" name="country_id" class="form-control select2">
                        <option value=""><?= $this->lang->line('select_country'); ?></option>
                        <?php foreach ($countries as $c) { ?>
                            <option <?php if ($this->input->post('country_id') == $c['id']) {
                                        echo 'selected';
                                    } ?> value="<?= $c['id'] ?>"><?= $c['country_name'] ?></option>
                        <?php } ?>
                    </select>
                    <?php if ($this->input->post('country_id')) {  ?>
                        <script>
                            $(function() {
                                setTimeout(function() {
                                    $('#country_id').trigger('change');
                                }, 200);
                            })
                        </script>
                    <?php } ?>
                    <span class="text-danger"><?php echo form_error('country_id'); ?></span>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('province'); ?> <span class="text-danger">*</span></label>
                            <select name="province_id" onchange="get_city_by_province_id()" id="province_dd" class="form-control select2">
                                <option value=""><?= $this->lang->line('select_country_first'); ?></option>
                            </select>
                            <?php if ($this->input->post('province_id')) {  ?>
                                <script>
                                    $(function() {
                                        setTimeout(function() {
                                            $('#province_dd').val(<?= $this->input->post('province_id') ?>).trigger('change');
                                        }, 400);
                                    })
                                </script>
                            <?php } ?>
                            <span class="text-danger"><?php echo form_error('province_id'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('city'); ?></label>
                            <select name="city_id" id="city_dd" class="form-control select2">
                                <option value=""><?= $this->lang->line('select_province_first'); ?> <span class="text-danger">*</span></option>
                            </select>
                            <?php if ($this->input->post('city_id')) {  ?>
                                <script>
                                    $(function() {
                                        setTimeout(function() {
                                            $('#city_dd').val(<?= $this->input->post('city_id') ?>).trigger('change');
                                        }, 600);
                                    })
                                </script>
                            <?php } ?>
                            <span class="text-danger"><?php echo form_error('city_id'); ?></span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                <?php echo form_close() ?>
            </div>
        </div> 
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?= $this->lang->line('partners'); ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?= $this->lang->line('name'); ?></th>
                            <th><?= $this->lang->line('code'); ?></th>
                            <th><?= $this->lang->line('phone'); ?></th>
                            <th><?= $this->lang->line('email'); ?></th>
                            <th><?= $this->lang->line('email'); ?></th>
                            <th><?= $this->lang->line('type'); ?></th>
                            <th><?= $this->lang->line('Partner_Category'); ?></th>
                            <th><?= $this->lang->line('city'); ?> </th>
                            <th><?= $this->lang->line('province'); ?></th>
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
    function get_province_by_country_id() {
        $.ajax({
            url: "<?= base_url('city/get_province_by_country_id/') ?>" + $('#country_id').val(),
            success: function(result) {
                $("#province_dd").html(result);
            }
        });
    }

    function get_city_by_province_id() {
        provinceId = $('#province_dd').val();
        $.ajax({
            url: "<?= base_url('city/get_city_by_province_id/') ?>" + provinceId,
            success: function(result) {
                $("#city_dd").html(result);
            }
        });
    }

    $('#party_type').on('change', function(e) {
        var party_type = $(this).val();
        // Populate Categories
        $.ajax({
            url: "<?= base_url('partycategory/get_party_categories_/') ?>" + party_type,
            success: function(result) {
                $("#partycats").html(JSON.parse(result));
            }
        });

        // Gen. Code
        $.ajax({
            url: "<?= base_url('parties/get_code') ?>",
            success: function(result) {

                var code = ($('#party_type').val() == '<?php echo PARTY_TYPE_SUPPLIER ?>') ? 'Ven' + result : 'Cus' + result;

                $("#partycode").val(code);
            }
        });

    });

    $(document).ready(function() {
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
        $('#mydt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('parties/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "code"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "email"
                },
                {
                    "data": "taxtion"
                },
                {
                    "data": "type"
                },
                {
                    "data": "partycatid"
                },
                {
                    "data": "city"
                },
                {
                    "data": "province"
                },
                {
                    "data": "actions"
                }
            ]

        });

        // 
        $("#taxation_input").TouchSpin({
            min: 0,
            max: 100,
            step: .01,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            initval: 0
        });
    });
</script>