<style>
    .avatar-lgx {
        height: 6rem;
    }

    .floatingButtonWrap {
        display: block;
        position: fixed;
        bottom: 75px;
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
        bottom: 60px;
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
                <a href="#" id="add_pregnancy_btn"  style="float:right" class="btn btn-success btn-sm waves-effect waves-light" data-toggle='modal' data-target='.bs-example-modal-lg' onclick="$('.floatingButton').trigger('click');"><?= $this->lang->line('add_pregnancy'); ?></a>
                <a href="#" onclick="get_animals_for_vaccine(null,null)" style="float:right; margin-right:15px !important;" class="btn btn-success btn-sm waves-effect waves-light" id="add_vaccination_btn" data-toggle='modal' data-target='.bs-vaccination-modal-sm'><?= $this->lang->line('animal_vaccination'); ?></a>
            </div>
            
            <div class="card-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home1" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block"><?= $this->lang->line('pregnancy'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="get_vaccination_list()" class="nav-link" data-toggle="tab" href="#profile1" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block"><?= $this->lang->line('vaccination'); ?></span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home1" role="tabpanel">
                        <div class="row">
                            <!-- <pre>
                                <?= print_r($pregnanat_animals) ?>
                            </pre> -->
                            <?php foreach ($pregnanat_animals as $key => $value) {  ?>
                                <div class="col-xl-2 col-sm-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <div class="dropdown float-right">
                                                    <a class="text-body dropdown-toggle font-size-16" href="#" role="button" data-toggle="dropdown" aria-haspopup="true">
                                                        <i class="uil uil-ellipsis-h"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" onclick="fill_deliver_baby_info(<?= $value['id'] ?>,<?= $value['animal_id'] ?>,<?= ($value['father_id']) ? $value['father_id'] : 0 ?>,<?= $value['animal_type'] ?>,<?= $value['animal_breed'] ?>)" href="javascript:void(0)" data-toggle='modal' data-target='.bs-deliver-baby-modal-sm'><?= $this->lang->line('deliver_baby'); ?></a>
                                                    </div>
                                                </div>

                                                <img src="<?= base_url() ?>assets/images/cow.png" alt="" class="avatar-lgx">
                                            </div>
                                            <h5 class="font-size-16 mb-0"><a href="#" class="text-dark"><?= $value['name'] ?></a></h5>
                                            <p class="text-muted mb-0"><?= $value['code'] ?></p>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-outline-light text-truncate"> <?= $this->lang->line('date'); ?><br> <?= date('d M,Y', strtotime($value['date'])) ?></button>
                                            <button type="button" class="btn btn-outline-light text-truncate"> <?= $this->lang->line('delivery'); ?><br> <?= date('d M,Y', strtotime($value['expected_delivery_date'])) ?></button>
                                        </div>
                                        <div class="progress progress-xl animated-progess p-0">
                                            <?php
                                            $birthday = new DateTime($value['date']);
                                            $diff = $birthday->diff(new DateTime());
                                            $months = $diff->format('%m') + 12 * $diff->format('%y');
                                            $width = ($months / $value['pregnancy_period']) * 100;
                                            if ($width <= 60) {
                                                $bg = 'bg-success';
                                            } else if ($width > 60 && $width <= 85) {
                                                $bg = 'bg-warning';
                                            } else if ($width > 85) {
                                                $bg = 'bg-danger';
                                            }
                                            ?>
                                            <div class="progress-bar <?= $bg ?>" role="progressbar" style="width: <?= $width ?>%" aria-valuenow="<?= $months ?>" aria-valuemin="0" aria-valuemax="<?= $value['pregnancy_period'] ?>"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div> <!-- end row -->
                    </div>
                    <div class="tab-pane" id="profile1" role="tabpanel">

                        <table id="vaccination_table" style="background-color: #fff;" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('animals'); ?></th>
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('animals/pregnancy') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel"><?= $this->lang->line('add_animal_pregnancy'); ?></h5>
                </div>
                
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img style="height: 70px;" src="<?= base_url() ?>assets/images/cow.png" data-holder-rendered="true">
                    </div>
                </div>
                <div class="row mt-20">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('select_animal_type'); ?> <span class="text-danger">*</span></label>
                            <select onchange="get_mother()" name="animaltypeid" id="animaltypeid" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_option'); ?></option>
                                <?php foreach ($animaltypeid as $at) { ?>
                                    <option value="<?= $at['id'] ?>"><?= $at['animal_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('motherid'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('pregnancy_date'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='pregnancy_date' value="<?= date('d M,Y') ?>" name="pregnancy_date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('pregnancy_date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('selected_animals'); ?> <span class="text-danger">*</span></label>
                            <select name="motherid" id="motherid" class="form-control select2" style="width: 100%">
                                <option value="">--<?= $this->lang->line('select_animal_first'); ?>--</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('motherid'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <h5><?= $this->lang->line('pregneny_type'); ?> <span class="text-danger">*</span></h5>
                        <div class="form-group">
                            <div class="form-check mb-3">
                                <input <?php if ($this->input->post('pregneny_type') == PREGNENCY_TYPE_INTERNAL_BREED) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="pregneny_type" id="internal_breed" value="<?= PREGNENCY_TYPE_INTERNAL_BREED ?>">
                                <label class="form-check-label" for="internal_breed">
                                    <?= $this->lang->line('internal_breed'); ?>
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input <?php if ($this->input->post('pregneny_type') == PREGNENCY_TYPE_EXTERNAL_SEMEN) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="pregneny_type" id="external_semen" value="<?= PREGNENCY_TYPE_EXTERNAL_SEMEN ?>">
                                <label class="form-check-label" for="external_semen">
                                    <?= $this->lang->line('external_breed'); ?>
                                </label>
                            </div>
                            <span class="text-danger"><?php echo form_error('pregneny_type'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-12" style="display: none" id="father_field">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('select_father'); ?> <span class="text-danger">*</span></label>
                            <select name="father_id" id="father_id" class="form-control select2" style="width: 100%">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12" style="display: none" id="semen_field">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('select_semen'); ?> <span class="text-danger">*</span></label>
                            <select name="semen_id" id="semen_id" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('Loading'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-12">
                    <button class="btn btn-success btn-sm btn-block" type="submit">
                        <i class="fa fa-check-circle"></i> <?= $this->lang->line('save'); ?>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Deliver Baby Model -->
<div class="modal fade bs-deliver-baby-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel"><?= $this->lang->line('deliver_baby'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('animals/deliver_baby') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"> <?= $this->lang->line('code'); ?> <span class="text-danger">*</span></label>
                            <input type="text" readonly value="<?= $code ?>" name="code" class="form-control" id="code">
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-firstname-input"> <?= $this->lang->line('name'); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('name') ?>" name="name" class="form-control" id="formrow-firstname-input">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('delivery_date'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='delivery_date' value="<?= date('d M,Y') ?>" name="delivery_date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('delivery_date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('gender'); ?> <span class="text-danger">*</span></label>
                            <div class="form-check mb-3">

                                <button for="male" type="button" class="btn_choose_sent bg_btn_chose_1 waves-effect waves-dark">
                                    <input <?php if ($this->input->post('sex') == MALE) {
                                                echo 'checked';
                                            } ?> type="radio" name="sex" id="male" value="<?= MALE ?>" checked />&nbsp;<?= $this->lang->line('male'); ?>
                                </button>
                                <button for="female" type="button" class="btn_choose_sent bg_btn_chose_2 waves-effect waves-dark">
                                    <input <?php if ($this->input->post('sex') == FEMALE) {
                                                echo 'checked';
                                            } ?> type="radio" name="sex" id="female" value="<?= FEMALE ?>" />&nbsp;<?= $this->lang->line('female'); ?>
                                </button>

                            </div>
                        </div>
                        <input type="hidden" name="pregnancy_id" id="pregnancy_id"><input type="hidden" name="db_mother_id" id="db_mother_id"><input type="hidden" name="db_animal_breed" id="db_animal_breed"><input type="hidden" name="db_father_id" id="db_father_id"><input type="hidden" name="db_animal_type" id="db_animal_type">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm waves-effect waves-light btn-block" type="submit"><i class="fa fa-check-circle"></i> <?= $this->lang->line('save'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Deliver Baby Model End-->

<!-- New Vaccination Model -->
<div class="modal fade bs-vaccination-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open('animals/vaccination') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel"><?= $this->lang->line('animal_vaccination'); ?></h5>
                </div>
               
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('selected_animals'); ?> <span class="text-danger">*</span></label>
                            <select name="vaccine_animal" id="vaccine_animal" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('Loading'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('motherid'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('select_vaccine'); ?> <span class="text-danger">*</span></label>
                            <select name="vaccine_id" id="vaccine_id" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('Loading'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('motherid'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?= $this->lang->line('vaccine_date'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='vaccine_date' value="<?= date('d M,Y') ?>" name="vaccine_date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('vaccine_date'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
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
    function get_vaccination_list() {
        $("#vaccination_table").dataTable().fnDestroy();
        var oTable = $('#vaccination_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('animals/get_vaccination_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "animal"
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

    function get_animals_for_vaccine(animal_id = null, table_id = null) {
        $.ajax({
            url: "<?= base_url('animals/get_animals_for_vaccine') ?>",
            success: function(result) {
                $("#vaccine_animal").html(result);
            },
            complete: function(data) {
                if (animal_id) {
                    $('#vaccine_animal').val(animal_id).trigger('change');
                    $('#vaccine_animal').attr('readonly', true);
                }
            }
        });
        $.ajax({
            url: "<?= base_url('animals/get_product_list_for_dd') ?>",
            success: function(result) {
                $("#vaccine_id").html(result);
            },
            complete: function(data) { 
            }
        });
        if(table_id){
            $('#table_id').val(table_id);
        } else {
            $('#table_id').val("");
        }
    }
 

    function fill_deliver_baby_info(pregnancy_id, mother_id, father_id, animal_type, animal_breed) {
        $('#db_mother_id').val(mother_id);
        $('#db_father_id').val(father_id);
        $('#db_animal_breed').val(animal_breed);
        $('#db_animal_type').val(animal_type);
        $('#pregnancy_id').val(pregnancy_id);
    }
    $(function() {
        <?php if (isset($_POST) && count($_POST) > 0) { ?>
            $('#add_pregnancy_btn').trigger('click');
        <?php } ?>
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });

        $("input[type='radio']").change(function() {
            var radioValue = $("input[name='pregneny_type']:checked").val();
            if (radioValue == <?= PREGNENCY_TYPE_INTERNAL_BREED ?>) {
                $('#father_field').show(500);
                $('#semen_field').hide(500);
                $.ajax({
                    url: "<?= base_url('animals/get_fathers') ?>",
                    success: function(result) {
                        $("#father_id").html(result);
                    }
                });
            } else if (radioValue == <?= PREGNENCY_TYPE_EXTERNAL_SEMEN ?>) {
                $.ajax({
                    url: "<?= base_url('animals/get_product_list_for_dd') ?>",
                    success: function(result) {
                        $("#semen_id").html(result);
                    }
                });
                $('#semen_field').show(500);
                $('#father_field').hide(500);
            }
        });
    });

    function get_mother() {
        $.ajax({
            url: "<?= base_url('animals/get_mothers/') ?>" + $('#animaltypeid').val(),
            success: function(result) {
                $("#motherid").html(result);
            }
        });
    }

    // FAB JS

    $(document).ready(function() {
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
</script>