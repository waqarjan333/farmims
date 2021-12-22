<style>
    .img-thumbnailx {
        height: 70px !important;
    }

    .table td:nth-child(2) {
        text-align: center;
    }
    .card-title {
    margin: 10px 20px 0px 15px !important;
}
.datepicker{z-index:1151 !important;border: 1px solid lightgrey !important;}
</style>
<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
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
        <div class="card">
            <div class="card-title"><?php echo $this->lang->line('all_fattering_animals') ?>
                    &nbsp;<button type="button" style="float:right" class="btn btn-success btn-sm waves-effect waves-light" id="add_new_animal_btn" onclick="get_modal_data_for_add()" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="uil-plus"></i>&nbsp;<?= $this->lang->line('add_animals'); ?></button>
                    &nbsp;<button type="button" style="float:right; margin: 0px 10px !important;" class="btn btn-success btn-sm waves-effect waves-light" id="add-batch"><i class="uil-plus"></i>&nbsp;<?= $this->lang->line('add_batch'); ?></button>
                    <button style="float:right; margin-left:10px !important;" type="button" disabled class="btn btn-success btn-sm waves-effect waves-light" id="feed_selected_animals" data-toggle="modal" data-target=".bs-example-modal-feed-animals"><i class="uil-plus"></i>&nbsp;<?= $this->lang->line('feed_selected_animals'); ?></button>
                    <button type="button" style="float:right" class="btn btn-success btn-sm waves-effect waves-light" id="add_new_animal_btn_import" data-toggle="modal" data-target=".bs-example-modal-lg_import"><i class="uil-plus"></i>&nbsp;<?= $this->lang->line('import_animals'); ?></button>
                </div>
            <div class="card-body">
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?= $this->lang->line('code'); ?></th>
                            <th><?= $this->lang->line('name'); ?></th>
                            <th><?= $this->lang->line('age'); ?></th>
                            <th><?= $this->lang->line('breed'); ?></th>
                            <th><?= $this->lang->line('type'); ?></th>
                            <th><?= $this->lang->line('sex'); ?></th>
                            <th><?= $this->lang->line('batch_no'); ?></th>
                            <th><?= $this->lang->line('weight1'); ?></th>
                            <th><?= $this->lang->line('status'); ?></th>
                            <th><?= $this->lang->line('action'); ?></th>
                            <th><?= $this->lang->line('dop'); ?></th>
                            <th><?= $this->lang->line('father'); ?></th>
                            <th><?= $this->lang->line('mother'); ?></th>
                        </tr>
                    </thead>
                    <tbody> </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<style>
    .animal-alfatar {
        border-radius: 50px;
        background-color: grey;
        padding: 5px;
        cursor: pointer;
        border: solid 1px lightgrey;
        box-shadow: 0px 0px 5px lightgrey;
        color: #fff;
        transition: all 500ms ease;
        white-space: nowrap;
    }

    .animal-alfatar:hover {
        line-height: 3;
        background-color: #606060;
        z-index: 10002;
    }

    .animal-avatar-list {
        overflow-x: scroll;
    }
</style>

<!--  Large modal example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open_multipart('fattening_animals/index') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"><?= $this->lang->line('add_fettering_animals'); ?></h5>
                </div>
               
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
            </div>
            
            <div class="modal-body">
                <!-- <div class="row">
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
                </div> -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('animal_batch'); ?> <span class="text-danger">*</span></label>
                            <select name="batch_id" id="batch_id" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('Loading'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('batch_id'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"> <?= $this->lang->line('code'); ?> <span class="text-danger">*</span></label>
                            <input type="text" readonly value="<?= $code ?>" name="code" class="form-control" id="code">
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input"> <?= $this->lang->line('name'); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('name') ?>" name="name" class="form-control" id="formrow-firstname-input">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?= $this->lang->line('date_of_birth'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='dob' data-date-min-view-mode="1" value="<?= ($this->input->post('dob')) ? $this->input->post('dob') : date('d M,Y') ?>" name="dob" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('dob'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?= $this->lang->line('date_of_purchase'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='dop' value="<?= ($this->input->post('dop')) ? $this->input->post('dop') : date('d M,Y') ?>" name="dop" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('dop'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('quarantine_period'); ?> <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('quarantine_period') ?>" required class="form-group form-control" data-toggle="touchspin" name="quarantine_period" id="quarantine_period" placeholder="Enter Quarantine Days">
                            <span class="text-danger"><?php echo form_error('quarantine_period'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('animal_type'); ?> <span class="text-danger">*</span></label>
                            <select name="animaltype" id="animaltypeid" onchange="get_breed_by_animaltype_id(),get_animal_by_animaltype_id()" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_type'); ?></option>
                                <?php foreach ($animaltypeid as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['animal_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('animaltype'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('animal_breed'); ?> <span class="text-danger">*</span></label>
                            <select name="breedid" id="breedid" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_first'); ?> </option>
                            </select>
                            <span class="text-danger"><?php echo form_error('breedid'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('weight'); ?> <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('weight') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="weight" id="weight" placeholder="Enter Animal Weight">
                            <span class="text-danger"><?php echo form_error('weight'); ?></span>
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
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('father'); ?></label>
                            <select name="fatherid" id="fatherid" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_first'); ?></option>

                            </select>
                            <span class="text-danger"><?php echo form_error('fatherid'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('mother'); ?></label>
                            <select name="motherid" id="motherid" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_first'); ?></option>

                            </select>
                            <span class="text-danger"><?php echo form_error('motherid'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Mendatory Vaccine -->
                    <div class="col-md-6">
                        <label class="control-label"><?= $this->lang->line('mandatory_vaccine'); ?></label>
                        <select name="mendatory_vaccines[]" multiple="multiple" id="mendatoryvaccine" class="form-control select2" style="width: 100%">
                            <?php foreach ($vaccines as $key => $vaccine) {
                                echo "<option value='{$vaccine->id}'>$vaccine->product_name</option>";
                            } ?>
                        </select>
                        <!-- <span class="text-danger"><?php echo form_error('motherid'); ?></span> -->
                    </div>

                    <div class="col-md-6">
                        <label class="control-label"><?= $this->lang->line('mandatory_test'); ?></label>
                        <select name="mendatory_tests[]" multiple="multiple" id="mendatorytest" class="form-control select2" style="width: 100%">
                            <?php foreach ($tests as $key => $test) {
                                echo "<option value='{$test->id}'>$test->test_name</option>";
                            } ?>
                        </select>
                        <!-- <span class="text-danger"><?php echo form_error('motherid'); ?></span> -->
                    </div>
                </div>

                
            </div>
            <div class="modal-footer">
                 <div class="col-12">
                    <button class="btn btn-success btn-sm btn-block" ><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-lg_import" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open_multipart('fattening_animals/importAnimals') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"><?= $this->lang->line('import_animals'); ?></h5>
                </div>
                
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        &nbsp;</div>
                    <div class="col-md-4 wrapperx">
                        <div class="box">
                            <div class="js--image-preview"></div>
                            <div class="upload-options">
                                <label>
                                    <input type="file" name="upload_file" class="image-upload" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('animal_type'); ?> <span class="text-danger">*</span></label>
                            <select name="animaltypeid_import" id="animaltypeid_import" onchange="get_breed_by_animaltype_id_import()" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_type'); ?></option>
                                <?php foreach ($animaltypeid as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['animal_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('animaltype'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('animal_breed'); ?> <span class="text-danger">*</span></label>
                            <select name="breedid_import" id="breedid_import" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_first'); ?> </option>
                            </select>
                            <span class="text-danger"><?php echo form_error('breedid_import'); ?></span>
                        </div>
                    </div>

                </div>
                
                
               
            </div>
            <div class="modal-footer">
                <div class="col-12">
                     <button type="submit" name="import" class="btn btn-success btn-sm btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('import'); ?></button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Update Animal Start -->
<!--  Large modal example -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open_multipart('fattening_animals/index') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"><?= $this->lang->line('update_fettering_animals'); ?></h5>
                </div>
                
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
            </div>
            
            <input type="hidden" name="id" id="fattening_animal_id">
            <div class="modal-body">
                <!-- <div class="row">
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
                </div> -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('animal_batch'); ?> <span class="text-danger">*</span></label>
                            <select name="batch_idu" id="batch_idu" class="form-control select2" style="width: 100%">
                                <!-- <option value="">Loading...</option> -->
                            </select>
                            <span class="text-danger"><?php echo form_error('batch_idu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"> <?= $this->lang->line('code'); ?> <span class="text-danger">*</span></label>
                            <input type="text" readonly value="<?= $code ?>" name="codeu" class="form-control" id="codeu">
                            <span class="text-danger"><?php echo form_error('codeu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input"> <?= $this->lang->line('name'); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('nameu') ?>" name="nameu" class="form-control" id="nameu">
                            <span class="text-danger"><?php echo form_error('nameu'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?= $this->lang->line('date_of_birth'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='dobu' data-date-min-view-mode="1" value="<?= ($this->input->post('dobu')) ? $this->input->post('dobu') : date('d M,Y') ?>" name="dobu" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('dobu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" id='dopu' value="<?= ($this->input->post('dopu')) ? $this->input->post('dopu') : date('d M,Y') ?>" name="dopu" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('dopu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('quarantine_period'); ?> <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('quarantine_periodu') ?>" required class="form-group form-control" data-toggle="touchspin" name="quarantine_periodu" id="quarantine_periodu" placeholder="Enter Quarantine Days">
                            <span class="text-danger"><?php echo form_error('quarantine_periodu'); ?></span>
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
                            <select name="breedidu" id="breedidu" class="form-control select2" style="width: 100%">
                                <!-- <option value="">Select Animal Type First </option> -->
                            </select>
                            <span class="text-danger"><?php echo form_error('breedidu'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('weight'); ?> <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('weightu') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="weightu" id="weightu" placeholder="Enter Animal Weight">
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
                                    <input <?php if ($this->input->post('sex') == MALE) {
                                                echo 'checked';
                                            } ?> type="radio" name="sexu" id="maleu" value="<?= MALE ?>" checked />&nbsp;<?= $this->lang->line('male'); ?>
                                </button>
                                <button for="female" type="button" class="btn_choose_sent bg_btn_chose_2 waves-effect waves-dark">
                                    <input <?php if ($this->input->post('sex') == FEMALE) {
                                                echo 'checked';
                                            } ?> type="radio" name="sexu" id="femaleu" value="<?= FEMALE ?>" />&nbsp;<?= $this->lang->line('female'); ?>
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('father'); ?></label>
                            <select name="fatherid" id="fatheridu" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_first'); ?></option>

                            </select>
                            <span class="text-danger"><?php echo form_error('fatheridu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('mother'); ?></label>
                            <select name="motheridu" id="motheridu" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_animal_first'); ?></option>

                            </select>
                            <span class="text-danger"><?php echo form_error('motheridu'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Mendatory Vaccine -->
                    <div class="col-md-6">
                        <label class="control-label"><?= $this->lang->line('mandatory_vaccine'); ?></label>
                        <select name="mendatory_vaccinesu[]" multiple="multiple" id="mendatoryvaccineu" class="form-control select2" style="width: 100%">
                            <?php foreach ($vaccines as $key => $vaccine) {
                                echo "<option value='{$vaccine->id}'>$vaccine->product_name</option>";
                            } ?>
                        </select>
                        <!-- <span class="text-danger"><?php echo form_error('motherid'); ?></span> -->
                    </div>

                    <div class="col-md-6">
                        <label class="control-label"><?= $this->lang->line('mandatory_test'); ?></label>
                        <select name="mendatory_testsu[]" multiple="multiple" id="mendatorytestu" class="form-control select2" style="width: 100%">
                            <?php foreach ($tests as $key => $test) {
                                echo "<option value='{$test->id}'>$test->test_name</option>";
                            } ?>
                        </select>
                        <!-- <span class="text-danger"><?php echo form_error('motherid'); ?></span> -->
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


<!--  Large modal example -->
<div class="modal fade bs-example-modal-feed-animals" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('animals/feed') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"><?= $this->lang->line('feed'); ?> <span class="selected_animals"></span> <?= $this->lang->line('selected_animals'); ?></h5>
                </div>
               
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center" id="selected-animals-columns">

                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <input type="hidden" name="selected_animals" id="selected_animals_input" value="">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('select_feed'); ?> <small>(<?= $this->lang->line('multiple'); ?>)</small> <span class="text-danger">*</span></label>
                            <select required multiple name="feed_dd[]" id="feed_dd" onchange="toggle_given_feed()" class="form-control select2" style="width: 100%">
                                <option value=""><?= $this->lang->line('select_feed'); ?></option>
                                <?php foreach ($feed_dd as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['feed_code'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('feed_dd'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('feed_date'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input required type="text" id='feed_date' value="<?= date('d M,Y') ?>" name="feed_date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('feed_date'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?= $this->lang->line('feed_time'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="time" id='feed_time' name="feed_time" class="form-control" required>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('feed_time'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12" id="feed-form">

                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                 <div class="col-12">
                    <button class="btn btn-success btn-sm btn-block" ><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open('fattening_animals/add_weight') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel"><?= $this->lang->line('enter_weight_cycle'); ?></h5>
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
                <div class="row">
                    <div class="col-md-12 mt-20">
                        <input type="hidden" name="weight_animal_id" id="weight_animal_id">
                        <div class="form-group">
                            <label for="formrow-email-input"> <?= $this->lang->line('enter_weight'); ?> (Kg.)<span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('weight') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="new_weight" id="new_weight" placeholder="Enter Animal Weight">
                            <span class="text-danger"><?php echo form_error('milk_qty'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?= $this->lang->line('weight_date'); ?></label>
                            <div class="input-group">
                                <input type="text" id='weight_date' value="<?= date('d M,Y') ?>" name="weight_date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('weight_date'); ?></span>
                        </div>
                    </div>
                </div>
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

<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>

<script>
    function get_modal_data_for_add() {
        $.ajax({
            url: "<?= base_url('fattening_animals/get_batch_list_dd') ?>",
            success: function(result) {
                $('#batch_id').html(result);
            },
            complete: function(result) {}
        });
    }

    // Animal Delete Function
    $(document).on('click', ".delete-fanimal-btn", function() {
        $animal_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This fattening animal will be deleted",
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
                    url: "<?= base_url('fattening_animals/delete_feterning_animal/') ?>" + $animal_id,
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

    $('#add-batch').click(function() {
        $.ajax({
            url: "<?= base_url('fattening_animals/get_batch_code') ?>",
            success: function(result) {
                Swal.fire({
                    title: 'You want to add a new batch?',
                    text: "New batch number will be " + result,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes! Create new batch.',
                    cancelButtonText: 'No! Cancel',
                    confirmButtonClass: 'btn btn-success mt-2',
                    cancelButtonClass: 'btn btn-danger ml-2 mt-2',
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "<?= base_url('fattening_animals/create_new_batch') ?>",
                            success: function(result) {},
                            complete: function(result) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'New batch added successfuly',
                                    icon: 'success'
                                });
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {}
                });
            }
        });
    });    

    <?php if (isset($_POST) && count($_POST) > 0 && !isset($_POST['id'])) { ?>
        $('#add_new_animal_btn').trigger('click');
    <?php } ?>


    $('#feed_dd').on('change', function(e) {
        var cacheEle = $('#feed-form');
        $(this).find('option').each(function(index, element) {
            if (element.selected) {
                if (cacheEle.find('input[name="feed\\[' + element.value + '\\]"]').length == 0) {
                    cacheEle.append('<input required class="form-group form-control" type="text" name="feed[' + element.value + ']" placeholder="Enter Quantity For ' + element.text + '">')
                }
            } else {
                cacheEle.find('input[name="feed\\[' + element.value + '\\]"]').remove();
            }
        });
    });

    function get_breed_by_animaltype_id() {
        $.ajax({
            url: "<?= base_url('animals/get_breed_by_animaltype_id/') ?>" + $('#animaltypeid').val(),
            success: function(result) {
                $("#breedid").html(result);
            }
        });
    }
    function get_breed_by_animaltype_id_import() {
        $.ajax({
            url: "<?= base_url('animals/get_breed_by_animaltype_id_import/') ?>" + $('#animaltypeid_import').val(),
            success: function(result) {
                $("#breedid_import").html(result);
            }
        });
    }
    function get_breed_by_animaltype_id_u() {
        $.ajax({
            url: "<?= base_url('animals/get_breed_by_animaltype_id/') ?>" + $('#animaltypeidu').val(),
            success: function(result) {
                $("#breedidu").html(result);
            }
        });
    }

    function fill_animal_id_in_weight_modal(animal_id, old_weight) {
        $('#weight_animal_id').val(animal_id);
        $('#new_weight').val(old_weight);
    }

    function get_animal_by_animaltype_id() {
        animalid = $('#animaltypeid').val();
        $.ajax({
            url: "<?= base_url('animals/get_animal_by_animaltype_id_male/') ?>" + animalid,
            success: function(result) {
                $("#fatherid").html(result);
            }
        });

        $.ajax({
            url: "<?= base_url('animals/get_animal_by_animaltype_id_female/') ?>" + animalid,
            success: function(result) {
                $("#motherid").html(result);
            }
        });
    }

    function get_animal_by_animaltype_id_u() {
        animalid = $('#animaltypeidu').val();
        $.ajax({
            url: "<?= base_url('animals/get_animal_by_animaltype_id_male/') ?>" + animalid,
            success: function(result) {
                $("#fatheridu").html(result);
            }
        });

        $.ajax({
            url: "<?= base_url('animals/get_animal_by_animaltype_id_female/') ?>" + animalid,
            success: function(result) {
                $("#motheridu").html(result);
            }
        });
    }

    $(document).ready(function() {
        $(".weight").TouchSpin({
            min: 0,
            max: 9999999,
            step: .5,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            initval: 50
        });

        $("#quarantine_period").TouchSpin({
            min: 0,
            max: 9999999,
            step: 1,
            decimals: 0,
            boostat: 1,
            maxboostedstep: 10,
            initval: 7
        });
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
        var oTable = $('#mydt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('fattening_animals/get_list') ?>",
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
                    "data": "batch_no"
                },
                {
                    "data": "weight"
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
                }
            ],
            "drawCallback": function(settings) {
                count_total_selected();

            }

        });
        $('#mydt tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
            count_total_selected();
        });

        function count_total_selected() {
            var totalSelected = oTable.rows('.selected').data().length;
            var selectedAnimalsList = oTable.rows('.selected').data();
            if (totalSelected > 0) {
                $('#feed_selected_animals').attr('disabled', false);
            } else {
                $('#feed_selected_animals').attr('disabled', true);
            }
            $('.selected_animals').html(totalSelected);
            var avatar_list = '';
            var selected_animals_input = '';
            $.each(selectedAnimalsList, function(index, value) {
                avatar_list = avatar_list + '<span class="animal-alfatar">' + value.name + '</span>';
                selected_animals_input = selected_animals_input + value.id + ',';
            })
            $('#selected-animals-columns').html(avatar_list);
            $('#selected_animals_input').val(selected_animals_input);
        }

    });

    function imgError(image) {
        image.onerror = "";
        image.src = "<?= base_url('assets/images/cow.png') ?>";
        return true;
    }


    $(document).on('click', ".btn-edit", function($id=null) {
        // console.log($id);
        $fattening_animal_id = (isNaN($id))?$(this).attr('code'):$id;
        console.log($fattening_animal_id);
        $.ajax({
            url: "<?= base_url('fattening_animals/get_fattening_animal/') ?>" + $fattening_animal_id,
            success: function(result) {},
            complete: function(result) {
                // Set Values
                $fattening_animal = JSON.parse(result.responseText);
                $('#fattening_animal_id').val($fattening_animal.id);
                $('#codeu').val($fattening_animal.code);
                $('#nameu').val($fattening_animal.name);
                $('#dobu').val($fattening_animal.preety_dob);
                $('#dopu').val($fattening_animal.preety_dop);
                $('#quarantine_periodu').val($fattening_animal.quarantine_period);
                $('#weightu').val($fattening_animal.weight);
                // Gender Check
                if ($fattening_animal.sex == '<?php echo FEMALE; ?>') {
                    $('#femaleu').attr('checked', true)
                }

                // Set the value, creating a new option if necessary
                if ($('#batch_idu').find("option[value='" + $fattening_animal.batch_id + "']").length) {
                    $('#batch_idu').val($fattening_animal.batch_id).trigger('change');
                } else {
                    // Create a DOM Option and pre-select by default
                    var newOption = new Option($fattening_animal.batch_code, $fattening_animal.batch_id, true, true);
                    // Append it to the select
                    $('#batch_idu').append(newOption).trigger('change');
                }

                // Animal Breed
                $('#breedidu').html($fattening_animal.breeds);
                // Set the value, creating a new option if necessary
                if ($('#breedidu').find("option[value='" + $fattening_animal.animal_breed + "']").length) {
                    $('#breedidu').val($fattening_animal.animal_breed).trigger('change');
                } else {
                    // Create a DOM Option and pre-select by default
                    var newOption = new Option($fattening_animal.breed_name, $fattening_animal.animal_breed, true, true);
                    // Append it to the select
                    $('#breedidu').append(newOption).trigger('change');
                }

                // Animal Fathers
                $('#fatheridu').html($fattening_animal.fathers);

                // Animal Mothers
                $('#motheridu').html($fattening_animal.mothers);
                // Mothers 
                // Set the value, creating a new option if necessary
                $('#motheridu').val($fattening_animal.animal_breed).trigger('change');
                $('#fatheridu').val($fattening_animal.animal_breed).trigger('change');
                $('#mendatorytestu').val(JSON.parse($fattening_animal.mendatory_tests)).trigger('change');

                $('#mendatoryvaccineu').val(JSON.parse($fattening_animal.mendatory_vaccines)).trigger('change');


                // $('#mendatorytestu').trigger('change');
                // $('#mendatoryvaccineu').trigger('change');

                $('#updateModal').modal('show');
                console.log(JSON.parse(result.responseText));
            }
        });

        <?php if (isset($_POST['id'])) { ?>
            $('.btn-edit').trigger('click',<?php echo $_POST['id']; ?>);
            // $('#updateModal').modal('show');
        <?php } ?>

    });
</script>