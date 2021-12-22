<style>
    .img-thumbnailx {
        height: 70px !important;
    }

    .table td:nth-child(2) {
        text-align: center;
    }
    .datepicker{z-index:1151 !important;border: 1px solid lightgrey !important;}
</style>
<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
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
        <div class="">
            <div class="card-body">
                <table id="vaccination_table" style="background-color: #fff;" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?= $this->lang->line('code'); ?></th>
                            <th><?= $this->lang->line('name'); ?></th>
                            <th><?= $this->lang->line('age'); ?></th>
                            <th><?= $this->lang->line('breed'); ?></th>
                            <th><?= $this->lang->line('type'); ?></th>
                            <th><?= $this->lang->line('sex'); ?></th>
                            <th><?= $this->lang->line('yesterday_yield'); ?></th>
                            <th><?= $this->lang->line('today_yield'); ?></th>
                            <th><?= $this->lang->line('status'); ?></th>
                            <th><?= $this->lang->line('action'); ?></th>
                            <th><?= $this->lang->line('dop'); ?></th>
                            <th><?= $this->lang->line('father'); ?></th>
                            <th><?= $this->lang->line('mother'); ?></th>
                            <th><?= $this->lang->line('weight1'); ?></th>
                        </tr>
                    </thead>
                    <tbody> </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


<!-- Update Animal Start -->
<!--  Large modal example -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open_multipart('quarantine_animals/index') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"><?= $this->lang->line('update_animal'); ?></h5>
                </div>
              
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
            </div>
            
            <input type="hidden" name="id" id="update_animal_id" value="<?php echo set_value('id'); ?>">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        &nbsp;</div>
                    <div class="col-md-4 wrapperx">
                        <div class="box">
                            <div class="js--image-preview"></div>
                            <div class="upload-options">
                                <label>
                                    <input type="file" name="animalimage" class="image-upload" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"> <?= $this->lang->line('Code'); ?> <span class="text-danger">*</span></label>
                            <input type="text" readonly value="<?php echo set_value('codeu'); ?>" name="codeu" class="form-control" id="codeu">
                            <span class="text-danger"><?php echo form_error('codeu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-firstname-input"> <?= $this->lang->line('name'); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo set_value('nameu'); ?>" name="nameu" class="form-control" id="nameu">
                            <span class="text-danger"><?php echo form_error('nameu'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('date_of_birth'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='dobu' data-date-min-view-mode="1" value="<?= (set_value('dobu')) ? set_value('dobu') : date('d M,Y') ?>" name="dobu" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('dobu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('date_of_purchase'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='dopu' value="<?= (set_value('dopu')) ? set_value('dopu') : date('d M,Y') ?>" name="dopu" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('dopu'); ?></span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"> Animal Type <span class="text-danger">*</span></label>
                            <select name="animaltypeu" id="animaltypeidu" onchange="get_breed_by_animaltype_id_u(),get_animal_by_animaltype_id_u()" class="form-control select2" style="width: 100%">
                                <option value="">Select Animal Type</option>
                                <?php foreach ($animaltypeid as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['animal_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('animaltype'); ?></span>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('animal_breed'); ?> <span class="text-danger">*</span></label>
                            <select name="breedidu" id="breedidu" value="<?php echo set_value('breedidu'); ?>" class="form-control select2" style="width: 100%">
                                <!-- <option value="">Select Animal Type First </option> -->
                            </select>
                            <span class="text-danger"><?php echo form_error('breedidu'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('weight'); ?> <span class="text-danger">*</span></label>
                            <input value="<?= set_value('weightu') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="weightu" id="weightu" placeholder="Enter Animal Weight">
                            <span class="text-danger"><?php echo form_error('weightu'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <span class="text-danger"><?php echo form_error('sex'); ?></span>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('gender'); ?>
                                <!-- <span class="text-danger">*</span> -->
                            </label>
                            <div class="form-check mb-3">

                                <button for="male" type="button" class="btn_choose_sent bg_btn_chose_1 waves-effect waves-dark">
                                    <input <?php if (set_value('sex') == MALE) {
                                                echo 'checked';
                                            } ?> type="radio" name="sexu" id="maleu" value="<?= MALE ?>" checked />&nbsp;<?= $this->lang->line('male'); ?>
                                </button>
                                <button for="female" type="button" class="btn_choose_sent bg_btn_chose_2 waves-effect waves-dark">
                                    <input <?php if (set_value('sex') == FEMALE) {
                                                echo 'checked';
                                            } ?> type="radio" name="sexu" id="femaleu" value="<?= FEMALE ?>" />&nbsp;<?= $this->lang->line('female'); ?>
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('father'); ?></label>
                            <select name="fatherid" value="<?php echo set_value('fatherid') ?>" id="fatheridu" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_first'); ?></option>

                            </select>
                            <span class="text-danger"><?php echo form_error('fatheridu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('mother'); ?></label>
                            <select name="motheridu" value="<?php echo set_value('motheridu') ?>" id="motheridu" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_first'); ?></option>

                            </select>
                            <span class="text-danger"><?php echo form_error('motheridu'); ?></span>
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="modal-footer">
                  <div class="col-12">
                    <button class="btn btn-success btn-sm btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Update Animal Ends -->

<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
    function imgError(image) {
        image.onerror = "";
        image.src = "<?= base_url('assets/images/cow.png') ?>";
        return true;
    }

    $(document).ready(function() {
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
        $('#vaccination_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('quarantine_animals/get_animals_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "code"
                },
                {
                    "data": "name"
                },
                {
                    "data": "dob"
                },
                {
                    "data": "breedid"
                },
                {
                    "data": "animaltype"
                },
                {
                    "data": "sex"
                },
                {
                    "data": "yes_yeild"
                },
                {
                    "data": "today_yeild"
                },
                {
                    "data": "status"
                },
                {
                    "data": "actions"
                },
                {
                    "data": "dop"
                },
                {
                    "data": "fatherid"
                },
                {
                    "data": "motherid"
                },
                {
                    "data": "weight"
                }
            ]

        });
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


    $(document).on('click', ".btn-edit", function($id = null) {
        $animal_id = ($id != null) ? $(this).attr('code') : $id;
        $.ajax({
            url: "<?= base_url('animals/get_animal/') ?>" + $animal_id,
            success: function(result) {},
            complete: function(result) {
                // Set Values
                $animal = JSON.parse(result.responseText);
                $('#update_animal_id').val($animal.id);
                $('#codeu').val($animal.code);
                $('#nameu').val($animal.name);
                $('#dobu').val($animal.preety_dob);
                $('#dopu').val($animal.preety_dop);
                $('#quarantine_periodu').val($animal.quarantine_period);
                $('#weightu').val($animal.weight);
                // Gender Check
                if ($animal.sex == '<?php echo FEMALE; ?>') {
                    $('#femaleu').attr('checked', true)
                }

                // Set the value, creating a new option if necessary
                if ($('#batch_idu').find("option[value='" + $animal.batch_id + "']").length) {
                    $('#batch_idu').val($animal.batch_id).trigger('change');
                } else {
                    // Create a DOM Option and pre-select by default
                    var newOption = new Option($animal.batch_code, $animal.batch_id, true, true);
                    // Append it to the select
                    $('#batch_idu').append(newOption).trigger('change');
                }

                // Animal Breed
                $('#breedidu').html($animal.breeds);
                // Set the value, creating a new option if necessary
                if ($('#breedidu').find("option[value='" + $animal.animal_breed + "']").length) {
                    $('#breedidu').val($animal.animal_breed).trigger('change');
                } else {
                    // Create a DOM Option and pre-select by default
                    var newOption = new Option($animal.breed_name, $animal.animal_breed, true, true);
                    // Append it to the select
                    $('#breedidu').append(newOption).trigger('change');
                }

                // Animal Fathers
                $('#fatheridu').html($animal.fathers);

                // Animal Mothers
                $('#motheridu').html($animal.mothers);
                // Mothers 
                // Set the value, creating a new option if necessary
                $('#motheridu').val($animal.animal_breed).trigger('change');
                $('#fatheridu').val($animal.animal_breed).trigger('change');

                // $('#mendatorytestu').trigger('change');
                // $('#mendatoryvaccineu').trigger('change');

                $('#updateModal').modal('show');
                console.log(JSON.parse(result.responseText));
            }
        });


    });
</script>