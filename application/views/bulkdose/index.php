<style>
    .avatar-lgx {
        height: 6rem;
    }

    .floatingButtonWrap {
        display: block;
        position: fixed;
        top: 155px;
        right: 45px;
        z-index: 999999999;
    }

    .floatingButtonInner {
        position: relative;
    }

    .floatingButton {
        display: block;
        width: 80px;
        height: 80px;
        text-align: center;
        background: -webkit-linear-gradient(45deg, #8769a9, #507cb3);
        background: -o-linear-gradient(45deg, #8769a9, #507cb3);
        background: linear-gradient(45deg, #8769a9, #507cb3);
        color: #fff;
        line-height: 75px;
        position: absolute;
        border-radius: 50% 50%;
        bottom: 0px;
        right: 0px;
        border: 5px solid #b2bedc;
        /* opacity: 0.3; */
        opacity: 1;
        transition: all 0.4s;
    }

    .floatingButton .fa {
        font-size: 22px !important;
    }

    .floatingButton.open,
    .floatingButton:hover,
    .floatingButton:focus,
    .floatingButton:active {
        opacity: 1;
        color: #fff;
    }


    .floatingButton .fa {
        transform: rotate(0deg);
        transition: all 0.4s;
    }

    .floatingButton.open .fa {
        transform: rotate(270deg);
    }

    .floatingMenu {
        position: absolute;
        top: 30px;
        right: 0px;
        /* width: 200px; */
        display: none;
    }

    .floatingMenu li {
        width: 100%;
        float: right;
        list-style: none;
        text-align: right;
        margin-bottom: 5px;
    }

    .floatingMenu li a {
        padding: 8px 15px;
        display: inline-block;
        background: #ccd7f5;
        color: #6077b0;
        border-radius: 5px;
        overflow: hidden;
        white-space: nowrap;
        transition: all 0.4s;
        /* -webkit-box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22);
    box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22); */
        -webkit-box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
        box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
    }

    .floatingMenu li a:hover {
        margin-right: 10px;
        text-decoration: none;
    }

    .text-truncate {
        font-size: 12px;
    }
    .datepicker{z-index:1151 !important;border: 1px solid lightgrey !important;}

    ul.select2-selection__rendered {
    padding-right: 30px !important;
}

ul.select2-selection__rendered:after {
    content: "";
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    border-top: 5px solid #ADB5BD;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
}
.select2-selection__rendered{
    cursor: pointer !important;
}
.select2Checkbox{
    cursor: pointer !important;
}
.checkboxlabel{
    margin-left: 4px !important;
    /*color: red !important*/

}
.card-title {
        margin: 0px 20px 15px 0px !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
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
        </div>
        <div class="card-title">
            <a href="#" style="float:right" class="btn btn-success btn-sm waves-effect waves-light"  onclick="get_animals_for_vaccine_cattle(null,null)" id="add_vaccination_btn" data-toggle='modal' data-target='.bs-vaccination-modal-sm_cattle'><?= $this->lang->line('Cattle_Management_Vaccination'); ?></a>

            <a href="#" style="float:right; margin-right:15px !important;" class="btn btn-success btn-sm waves-effect waves-light" onclick="get_animals_for_vaccine(null,null)" id="add_vaccination_btn" data-toggle='modal' data-target='.bs-vaccination-modal-sm'><?= $this->lang->line('animal_vaccination'); ?></a>


            </div>
            <div class="card-body">
                <!-- <table id="vaccination_table" style="background-color: #fff;" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Animal</th>
                                    <th>Vaccine</th>
                                    <th>Unit</th>
                                    <th>Vaccination Date</th>
                                    <th>Next Vaccination</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a onclick="get_vaccination_list_for_cattle_management()" class="nav-link active" data-toggle="tab" href="#home1" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block"><?= $this->lang->line('Cattle_Management_Animal_Bulk_Vaccinations'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="get_vaccination_list_for_live_stock()" class="nav-link" data-toggle="tab" href="#profile1" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block"><?= $this->lang->line('livestock_Animal_Bulk_Vaccination'); ?></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home1" role="tabpanel">

                        <table id="vaccination_table_cattle_management" style="background-color: #fff;" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('animal'); ?></th>
                                    <th><?= $this->lang->line('vaccine'); ?></th>
                                    <th><?= $this->lang->line('unit'); ?></th>
                                    <th><?= $this->lang->line('vaccination_date'); ?></th>
                                    <th><?= $this->lang->line('next_vaccination'); ?></th>
                                    <th><?= $this->lang->line('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="profile1" role="tabpanel">

                        <table id="vaccination_table" style="background-color: #fff;" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('animal'); ?></th>
                                    <th><?= $this->lang->line('vaccine'); ?></th>
                                    <th><?= $this->lang->line('unit'); ?></th>
                                    <th><?= $this->lang->line('vaccination_date'); ?></th>
                                    <th><?= $this->lang->line('next_vaccination'); ?></th>
                                    <th><?= $this->lang->line('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>


<!-- FAB Start -->


<!-- FAB End -->
<!--  Small modal example -->


<div class="modal fade bs-vaccination-modal-sm_cattle" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open('bulk_dose/vaccination_cattle') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel"><?= $this->lang->line('Cattle_Management_Vaccination'); ?></h5>
                </div>
                
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="id_SelectElement1"><?= $this->lang->line('Cattle_Management_Vaccination'); ?> <span class="text-danger">*</span></label>
                                <select name="vaccine_animal_cattle[]" id="id_SelectElement1" class="cattle_animal" placeholder="Select Text" multiple>
                                <option value="00" disabled>Select All</option>
                                <?php $this->db->select('fattening_animals.id, fattening_animals.name, fattening_animals.code');
                            $this->db->where('farm_id', $this->session->userdata('active_farm'));
                            $this->db->where_not_in('status',[DISEASED,SUSPENDED]);
                            $data = $this->db->get('fattening_animals')->result_array();

                            foreach ($data as $key => $value) {?>
                                echo "<option value="<?php echo $value['id'] ?>"> <?php echo $value['name'] ?> ( <?php echo $value['code'] ?> )</option>";
                          <?php   } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('vaccine_animal_cattle'); ?></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('select_category'); ?> <span class="text-danger">*</span></label>
                            <select name="category_id_cattle" id="category_id_cattle" onchange="get_category_products()" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('Loading'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('category_id_cattle'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('select_vaccine'); ?> <span class="text-danger">*</span></label>
                            <select name="vaccine_id_cattle" id="vaccine_id_cattle" class="form-control select2" style="width: 100%">
                                <option value="">Loading...</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('vaccine_id_cattle'); ?></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('dosage_quantity'); ?> <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('dosage_quantity_cattle') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="dosage_quantity_cattle" id="dosage_quantity_cattle" placeholder="Enter Quantity">
                            <span class="text-danger"><?php echo form_error('dosage_quantity_cattle'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('uom'); ?> <span class="text-danger">*</span></label>
                            <select name="uom_cattle" id="uom_cattle" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('Loading'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('uom_cattle'); ?></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('vaccine_date'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='vaccine_date_cattle' value="<?= date('d M,Y') ?>" name="vaccine_date_cattle" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('vaccine_date_cattle'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('booster_dose'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="booster_dose_cattle" class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('booster_dose_cattle'); ?></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('next_vaccine_date'); ?><small class="text-danger">(<?= $this->lang->line('leave_empty'); ?>)</small></label>
                            <div class="input-group">
                                <input type="text" id='next_vaccine_date_cattle' value="" name="next_vaccine_date_cattle" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('next_vaccine_date_cattle'); ?></span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="table_id" id="table_id">
            </div>
            <div class="modal-footer">
                <div class="col-12">
                    <button class="btn btn-success btn-sm btn-block" type="submit"><i class="fa fa-check-circle"></i> <?= $this->lang->line('save'); ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- New Vaccination Model -->
<div class="modal fade bs-vaccination-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open('bulk_dose/vaccination') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel"><?= $this->lang->line('bulk_animal_vaccination'); ?></h5>
                </div>
                
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="id_selectElement"><?= $this->lang->line('select_animal'); ?> <span class="text-danger">*</span></label>
                           
                              <select name="vaccine_animal[]" id="id_SelectElement" class="vaccine_animal" placeholder="Select Text" multiple>
                                <option value="0" disabled>Select All</option>
                                <?php $this->db->select('fattening_animals.id, fattening_animals.name, fattening_animals.code');
                            $this->db->where('farm_id', $this->session->userdata('active_farm'));
                            $this->db->where_not_in('status',[DISEASED,SUSPENDED]);
                            $data = $this->db->get('fattening_animals')->result_array();

                            foreach ($data as $key => $value) {?>
                                echo "<option value="<?php echo $value['id'] ?>"> <?php echo $value['name'] ?> ( <?php echo $value['code'] ?> )</option>";
                          <?php   } ?>
                   
                </select>
                            <span class="text-danger"><?php echo form_error('vaccine_animal'); ?></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('select_category'); ?> <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" onchange="get_category_products_animals()" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('Loading'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('category_id'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('select_vaccine'); ?> <span class="text-danger">*</span></label>
                            <select name="vaccine_id" id="vaccine_id" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('Loading'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('vaccine_id'); ?></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('dosage_quantity'); ?> <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('dosage_quantity') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="dosage_quantity" id="dosage_quantity" placeholder="Enter Quantity">
                            <span class="text-danger"><?php echo form_error('dosage_quantity'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('uom'); ?> <span class="text-danger">*</span></label>
                            <select name="uom" id="uom" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('Loading'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('uom'); ?></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('vaccine_date'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='vaccine_date' value="<?= date('d M,Y') ?>" name="vaccine_date" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('vaccine_date'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('booster_dose'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="booster_dose" class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('booster_dose'); ?></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('next_vaccine_date'); ?> <small class="text-danger">(<?= $this->lang->line('leave_empty'); ?>)</small></label>
                            <div class="input-group">
                                <input type="text" id='next_vaccine_date' value="" name="next_vaccine_date" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('next_vaccine_date'); ?></span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="table_id" id="table_id">
            </div>
            <div class="modal-footer">
                <div class="col-12">
                    <button class="btn btn-success btn-sm btn-block"  type="submit"><i class="fa fa-check-circle"></i> <?= $this->lang->line('save'); ?></button>
                    
                </div>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- New Vaccination Model End-->

<script>
   
    function get_animals_for_vaccine(animal_id = null, table_id = null) {
        // alert()
        // $.ajax({
        //     url: "<?= base_url('bulk_dose/get_animals_for_vaccine') ?>",
        //     success: function(result) {
        //         // console.log(result)
        //         $("#id_SelectElement").append(result);
        //     },
        //     complete: function(data) {
        //         if (animal_id) {
        //             $('#id_SelectElement').val(animal_id).trigger('change');
        //             $('#id_SelectElement').attr('readonly', true);
        //         }
        //     }
        // });
        $.ajax({
            url: "<?= base_url('bulk_dose/get_category_list_for_dd_cattle') ?>",
            success: function(result) {
                $("#category_id").html("");
                $("#category_id").html(result);
            },
            complete: function(data) {}
        });
        $.ajax({
            url: "<?= base_url('bulk_dose/get_uom') ?>",
            success: function(result) {
                $("#uom").html(result);
            },
            complete: function(data) {}
        });
        if (table_id) {
            $('#table_id').val(table_id);
        } else {
            $('#table_id').val("");
        }
    }

    // FAB JS
    function get_vaccination_list_for_live_stock() {
        // console.log('would');
        $("#vaccination_table").dataTable().fnDestroy();
        var oTable = $('#vaccination_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('bulk_dose/get_vaccination_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "animal"
                },
                {
                    "data": "vaccine"
                },
                {
                    "data": "uom"
                },
                {
                    "data": "vaccine_date"
                },
                {
                    "data": "next_vaccine_date"
                },
                {
                    "data": "actions"
                }
            ],
            "drawCallback": function(settings) {}

        });
    }

    function get_animals_for_vaccine_cattle(animal_id = null, table_id = null) {
        // $.ajax({
        //     url: "<?= base_url('bulk_dose/get_animals_for_vaccine_cattle') ?>",
        //     success: function(result) {
        //         $("#vaccine_animal_cattle").html("");
        //         $("#vaccine_animal_cattle").html(result);
        //     },
        //     complete: function(data) {
        //         if (animal_id) {
        //             $('#vaccine_animal_cattle').val(animal_id).trigger('change');
        //             $('#vaccine_animal_cattle').attr('readonly', true);
        //         }
        //     }
        // });
        $.ajax({
            url: "<?= base_url('bulk_dose/get_category_list_for_dd_cattle') ?>",
            success: function(result) {
                $("#category_id_cattle").html("");
                $("#category_id_cattle").html(result);
            },
            complete: function(data) {}
        });
        $.ajax({
            url: "<?= base_url('bulk_dose/get_uom') ?>",
            success: function(result) {
                $("#uom_cattle").html("");
                $("#uom_cattle").html(result);
            },
            complete: function(data) {}
        });
        if (table_id) {
            $('#table_id').val(table_id);
        } else {
            $('#table_id').val("");
        }
    }

    function get_vaccination_list_for_cattle_management() {
        $("#vaccination_table_cattle_management").dataTable().fnDestroy();
        var oTable = $('#vaccination_table_cattle_management').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('bulk_dose/get_vaccination_list_cattle_managment') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "animal"
                },
                {
                    "data": "vaccine"
                },
                {
                    "data": "uom"
                },
                {
                    "data": "vaccine_date"
                },
                {
                    "data": "next_vaccine_date"
                },
                {
                    "data": "actions"
                }
            ],
            "drawCallback": function(settings) {}

        });
    }
    $(document).ready(function() {
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
        get_vaccination_list_for_cattle_management();

        $('.floatingButton').on('click',
            function(e) {
                e.preventDefault();
                $(this).toggleClass('open');
                if ($(this).children('.fa').hasClass('fa-plus')) {
                    $(this).children('.fa').removeClass('fa-plus');
                    $(this).children('.fa').addClass('fa-times');
                } else if ($(this).children('.fa').hasClass('fa-times')) {
                    $(this).children('.fa').removeClass('fa-times');
                    $(this).children('.fa').addClass('fa-plus');
                }
                $('.floatingMenu').stop().slideToggle();
            }
        );
        $(this).on('click', function(e) {
            var container = $(".floatingButton");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && $('.floatingButtonWrap').has(e.target).length === 0) {
                if (container.hasClass('open')) {
                    container.removeClass('open');
                }
                if (container.children('.fa').hasClass('fa-times')) {
                    container.children('.fa').removeClass('fa-times');
                    container.children('.fa').addClass('fa-plus');
                }
                $('.floatingMenu').hide();
            }
        });
    });

    function get_category_products() {
        $.ajax({
            url: "<?= base_url('current_stock/get_category_products/') ?>" + $('#category_id_cattle').val(),
            success: function(result) {
                $("#vaccine_id_cattle").html(result);
            }
        });
    }

    function get_category_products_animals() {
        $.ajax({
            url: "<?= base_url('current_stock/get_category_products/') ?>" + $('#category_id').val(),
            success: function(result) {
                $("#vaccine_id").html(result);
            }
        });
    }
</script>
<script>
  //Start - Select 2 Multi-Select Code======================================================
var Select2MultiCheckBoxObj = [];
var id_selectElement = 'id_SelectElement';
var staticWordInID = 'state_';

function AddItemInSelect2MultiCheckBoxObj(id, IsChecked) {
    if (Select2MultiCheckBoxObj.length > 0) {
        let index = Select2MultiCheckBoxObj.findIndex(x => x.id == id);
        if (index > -1) {
            Select2MultiCheckBoxObj[index]["IsChecked"] = IsChecked;
        }
        else {
            Select2MultiCheckBoxObj.push({ "id": id, "IsChecked": IsChecked });
        }
    }
    else {
        Select2MultiCheckBoxObj.push({ "id": id, "IsChecked": IsChecked });
    }
}

function IsCheckedAllOption1(trueOrFalse) {
    $.map($('#' + id_selectElement + ' option'), function (option) {
            console.log(option)
        AddItemInSelect2MultiCheckBoxObj(option.value, trueOrFalse);
    });
    $('#' + id_selectElement + " > option").not(':first').prop("selected", trueOrFalse); //This will select all options and adds in Select2
    $("#" + id_selectElement).trigger("change");//This will effect the changes
    $(".select2-results__option").not(':first').attr("aria-selected", trueOrFalse); //This will make grey color of selected options

    $("input[id^='" + staticWordInID + "']").prop("checked", trueOrFalse);
}

$(document).ready(function () {
    //Begin - Select 2 Multi-Select Code
    $.map($('#' + id_selectElement + ' option'), function (option) {
        // console.log(option)
        AddItemInSelect2MultiCheckBoxObj(option.value, false);
    });

    function formatResult(state) {
        if (Select2MultiCheckBoxObj.length > 0) {
            var stateId = staticWordInID + state.id;
            let index = Select2MultiCheckBoxObj.findIndex(x => x.id == state.id);
            if (index > -1) {
                var checkbox = $('<div class="checkbox"><input class="select2Checkbox2" id="' + stateId + '" type="checkbox" ' + (Select2MultiCheckBoxObj[index]["IsChecked"] ? 'checked' : '') +
                    '><label for="checkbox' + stateId + '" class="checkboxlabel">' + state.text + '</label></div>', { id: stateId });
                return checkbox;
            }
        }
    }

    let optionSelect2 = {
        templateResult: formatResult,
        closeOnSelect: false,
        width: '100%'
    };

    let $select2 = $("#" + id_selectElement).select2(optionSelect2);

    //var scrollTop;
    //$select2.on("select2:selecting", function (event) {
    //    var $pr = $('#' + event.params.args.data._resultId).parent();
    //    scrollTop = $pr.prop('scrollTop');
    //    let xxxx = 2;
    //});

    $select2.on("select2:select", function (event) {
        $("#" + staticWordInID + event.params.data.id).prop("checked", true);
        AddItemInSelect2MultiCheckBoxObj(event.params.data.id, true);
        //If all options are slected then selectAll option would be also selected.
        if (Select2MultiCheckBoxObj.filter(x => x.IsChecked === false).length === 1) {
            AddItemInSelect2MultiCheckBoxObj(0, true);
            $("#" + staticWordInID + "0").prop("checked", true);
        }
    });

    $select2.on("select2:unselect", function (event) {
        $("#" + staticWordInID + "0").prop("checked", false);
        AddItemInSelect2MultiCheckBoxObj(0, false);
        $("#" + staticWordInID + event.params.data.id).prop("checked", false);
        AddItemInSelect2MultiCheckBoxObj(event.params.data.id, false);
    });

    $(document).on("click", "#" + staticWordInID + "0", function () {
        //var b = !($("#state_SelectAll").is(':checked'));
        var b = $("#" + staticWordInID + "0").is(':checked');

        IsCheckedAllOption1(b);
        //state_CheckAll = b;
        //$(window).scroll();
    });
    $(document).on("click", ".select2Checkbox2", function (event) {
        let selector = "#" + this.id;
        let isChecked = Select2MultiCheckBoxObj[Select2MultiCheckBoxObj.findIndex(x => x.id == this.id.replaceAll(staticWordInID, ''))]['IsChecked'];
        $(selector).prop("checked", isChecked);
    });

});


//====End - Select 2 Multi-Select Code==
</script>
<script>
  //Start - Select 2 Multi-Select Code======================================================
var Select2MultiCheckBoxObj1 = [];
var id_selectElement1 = 'id_SelectElement1';
var staticWordInID1 = 'state_';

function AddItemInSelect2MultiCheckBoxObj1(id, IsChecked) {
    if (Select2MultiCheckBoxObj1.length > 0) {
        let index = Select2MultiCheckBoxObj1.findIndex(x => x.id == id);
        if (index > -1) {
            Select2MultiCheckBoxObj1[index]["IsChecked"] = IsChecked;
        }
        else {
            Select2MultiCheckBoxObj1.push({ "id": id, "IsChecked": IsChecked });
        }
    }
    else {
        Select2MultiCheckBoxObj1.push({ "id": id, "IsChecked": IsChecked });
    }
}

function IsCheckedAllOption(trueOrFalse) {
    $.map($('#' + id_selectElement1 + ' option'), function (option) {
        AddItemInSelect2MultiCheckBoxObj1(option.value, trueOrFalse);
    });
    $('#' + id_selectElement1 + " > option").not(':first').prop("selected", trueOrFalse); //This will select all options and adds in Select2
    $("#" + id_selectElement1).trigger("change");//This will effect the changes
    $(".select2-results__option").not(':first').attr("aria-selected", trueOrFalse); //This will make grey color of selected options

    $("input[id^='" + staticWordInID1 + "']").prop("checked", trueOrFalse);
}

$(document).ready(function () {
    //Begin - Select 2 Multi-Select Code
    $.map($('#' + id_selectElement1 + ' option'), function (option) {
        AddItemInSelect2MultiCheckBoxObj1(option.value, false);
    });

    function formatResult(state) {
        if (Select2MultiCheckBoxObj1.length > 0) {
            var stateId1 = staticWordInID1 + state.id;
            let index = Select2MultiCheckBoxObj1.findIndex(x => x.id == state.id);
            if (index > -1) {
                var checkbox = $('<div class="checkbox"><input class="select2Checkbox1" id="' + stateId1 + '" type="checkbox" ' + (Select2MultiCheckBoxObj1[index]["IsChecked"] ? 'checked' : '') +
                    '><label for="checkbox' + stateId1 + '" class="checkboxlabel">' + state.text + '</label></div>', { id: stateId1 });
                return checkbox;
            }
        }
    }

    let optionSelect3 = {
        templateResult: formatResult,
        closeOnSelect: false,
        width: '100%'
    };

    let $select3 = $("#" + id_selectElement1).select2(optionSelect3);

    //var scrollTop;
    //$select3.on("select2:selecting", function (event) {
    //    var $pr = $('#' + event.params.args.data._resultId).parent();
    //    scrollTop = $pr.prop('scrollTop');
    //    let xxxx = 2;
    //});

    $select3.on("select2:select", function (event) {
        $("#" + staticWordInID1 + event.params.data.id).prop("checked", true);
        AddItemInSelect2MultiCheckBoxObj1(event.params.data.id, true);
        //If all options are slected then selectAll option would be also selected.
        if (Select2MultiCheckBoxObj1.filter(x => x.IsChecked === false).length === 1) {
            AddItemInSelect2MultiCheckBoxObj1(0, true);
            $("#" + staticWordInID1 + "00").prop("checked", true);
        }
    });

    $select3.on("select2:unselect", function (event) {
        $("#" + staticWordInID1 + "00").prop("checked", false);
        AddItemInSelect2MultiCheckBoxObj1(0, false);
        $("#" + staticWordInID1 + event.params.data.id).prop("checked", false);
        AddItemInSelect2MultiCheckBoxObj1(event.params.data.id, false);
    });

    $(document).on("click", "#" + staticWordInID1 + "00", function () {
        //var b = !($("#state_SelectAll").is(':checked'));
        var b1 = $("#" + staticWordInID1 + "00").is(':checked');

        IsCheckedAllOption(b1);
        //state_CheckAll = b;
        //$(window).scroll();
    });
    $(document).on("click", ".select2Checkbox1", function (event) {
        let selector1 = "#" + this.id;
        // console.log(selector1)
        let isChecked = Select2MultiCheckBoxObj1[Select2MultiCheckBoxObj1.findIndex(x => x.id == this.id.replaceAll(staticWordInID1, ''))]['IsChecked'];
        $(selector1).prop("checked", isChecked);
    });

});


//====End - Select 2 Multi-Select Code==
</script>