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
            <div class="card-title"><?php echo $this->lang->line('all_animals') ?>
                    &nbsp;<button type="button" style="float:right" class="btn btn-success btn-sm waves-effect waves-light" id="add_new_animal_btn" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="uil-plus"></i>&nbsp;<?php echo $this->lang->line('add_animals') ?></button>
                    <button  type="button" style="float:right; margin: 0px 10px !important;" disabled class="btn btn-success btn-sm waves-effect waves-light" id="feed_selected_animals" data-toggle="modal" data-target=".bs-example-modal-feed-animals"><i class="uil-plus"></i>&nbsp;<?php echo $this->lang->line('feed_selected_animals') ?></button>
                    &nbsp;<button type="button" style="float:right; margin-left:10px !important;" class="btn btn-success btn-sm waves-effect waves-light" id="feed_selected_animals" data-toggle='modal' data-target='.bs-example-modal-lg-bulk-milking'><i class="uil-water-glass"></i>&nbsp;<?php echo $this->lang->line('bulk_milking') ?></button>&nbsp;
                    <button type="button" style="float:right;" class="btn btn-success btn-sm waves-effect waves-light" id="add_new_animal_btn_import" data-toggle="modal" data-target=".bs-example-modal-lg_import"><i class="uil-plus"></i>&nbsp;<?php echo $this->lang->line('import_animals') ?></button>

                </div>
            <div class="card-body">

                
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('code') ?></th>
                            <th><?php echo $this->lang->line('name') ?></th>
                            <th><?php echo $this->lang->line('age') ?></th>
                            <th><?php echo $this->lang->line('bread') ?></th>
                            <th><?php echo $this->lang->line('Type') ?></th>
                            <th><?php echo $this->lang->line('gender') ?></th>
                            <th><?php echo $this->lang->line('yesterday_yield') ?></th>
                            <th><?php echo $this->lang->line('today_yield') ?></th>
                            <th><?php echo $this->lang->line('status') ?></th>
                            <th><?php echo $this->lang->line('action') ?></th>
                            <th><?php echo $this->lang->line('date_of_birth') ?></th>
                            <th><?php echo $this->lang->line('father') ?></th>
                            <th><?php echo $this->lang->line('mother') ?></th>
                            <th><?php echo $this->lang->line('weight') ?></th>
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
            <?php echo form_open_multipart('animals/index') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"><?php echo $this->lang->line('add_animals') ?></h5>
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
                                    <input type="file" name="animalimage" class="image-upload" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"> <?php echo $this->lang->line('code') ?> <span class="text-danger">*</span></label>
                            <input type="text" readonly value="<?= $code ?>" name="code" class="form-control" id="code">
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input"> <?php echo $this->lang->line('name') ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('name') ?>" name="name" class="form-control" id="formrow-firstname-input">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"> <?php echo $this->lang->line('weight') ?> <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('weight') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="weight" id="weight" placeholder="Enter Animal Weight">
                            <span class="text-danger"><?php echo form_error('weight'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('date_of_birth') ?><span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='dob' value="<?= ($this->input->post('dob')) ? $this->input->post('dob') : date('d M, Y') ?>" name="dob" class="form-control datepicker" data-provide="datepicker" data-date-min-view-mode="1" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('dob'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('date_of_purchase') ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='dop' value="<?= ($this->input->post('dop')) ? $this->input->post('dop') : date('d M, Y') ?>" name="dop" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?php echo $this->lang->line('animal_type') ?><span class="text-danger">*</span></label>
                            <select name="animaltype" id="animaltypeid" onchange="get_breed_by_animaltype_id(),get_animal_by_animaltype_id()" class="form-control select2" style="width: 100%">
                                <option value=""><?php echo $this->lang->line('animal_type') ?></option>
                                <?php foreach ($animaltypeid as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['animal_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('animaltype'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?php echo $this->lang->line('animal_bread') ?> <span class="text-danger">*</span></label>
                            <select name="breedid" id="breedid" class="form-control select2" style="width: 100%">
                                <option value=""><?php echo $this->lang->line('animal_bread') ?> </option>
                            </select>
                            <span class="text-danger"><?php echo form_error('breedid'); ?></span>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <span class="text-danger"><?php echo form_error('sex'); ?></span>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang->line('gender') ?>
                                <!-- <span class="text-danger">*</span> -->
                            </label>
                            <div class="form-check mb-3">
                                <button for="male" type="button" class="btn_choose_sent bg_btn_chose_1 waves-effect waves-dark">
                                    <input <?php if ($this->input->post('sex') == MALE) {
                                                echo 'checked';
                                            } ?> type="radio" name="sex" id="male" value="<?= MALE ?>" checked />&nbsp;<?php echo $this->lang->line('male') ?>
                                </button>

                                <button for="female" type="button" class="btn_choose_sent bg_btn_chose_2 waves-effect waves-dark">
                                    <input <?php if ($this->input->post('sex') == FEMALE) {
                                                echo 'checked';
                                            } ?> type="radio" name="sex" id="female" value="<?= FEMALE ?>" />&nbsp;<?php echo $this->lang->line('female') ?>
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang->line('father') ?></label>
                            <select name="fatherid" id="fatherid" class="form-control select2" style="width: 100%">
                                <option value=""><?php echo $this->lang->line('select_father') ?></option>

                            </select>
                            <span class="text-danger"><?php echo form_error('fatherid'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang->line('mother') ?></label>
                            <select name="motherid" id="motherid" class="form-control select2" style="width: 100%">
                                <option value=""><?php echo $this->lang->line('select_mother') ?></option>

                            </select>
                            <span class="text-danger"><?php echo form_error('motherid'); ?></span>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-body">
                <!-- <div class="col-5"> -->
                    <button class="btn btn-success btn-sm btn-block" ><i class="fa fa-check-circle"></i>&nbsp;<?php echo $this->lang->line('save') ?></button>
                <!-- </div> -->
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade bs-example-modal-lg_import" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open_multipart('animals/importAnimals') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"><?php echo $this->lang->line('import_animals') ?></h5>
                </div>
                
                <div class="col-5">
                    
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
                            <label class="control-label"> <?php echo $this->lang->line('animal_type') ?> <span class="text-danger">*</span></label>
                            <select name="animaltypeid_import" id="animaltypeid_import" onchange="get_breed_by_animaltype_id_import()" class="form-control select2" style="width: 100%">
                                <option value=""><?php echo $this->lang->line('selected_animal_type') ?></option>
                                <?php foreach ($animaltypeid as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['animal_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('animaltype'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?php echo $this->lang->line('animal_breed') ?> <span class="text-danger">*</span></label>
                            <select name="breedid_import" id="breedid_import" class="form-control select2" style="width: 100%">
                                <option value=""><?php echo $this->lang->line('selected_animal_type') ?> </option>
                            </select>
                            <span class="text-danger"><?php echo form_error('breedid_import'); ?></span>
                        </div>
                    </div>

                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" name="import" class="btn btn-success btn-block">
                        <i class="fa fa-check-circle"></i>&nbsp;<?php echo $this->lang->line('import') ?>
                    </button>
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--  Large modal example -->
<div class="modal fade bs-example-modal-feed-animals" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('animals/feed') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"><?= $this->lang->line('feed'); ?> <span class="selected_animals"></span> <?php echo $this->lang->line('selected_animals') ?></h5>
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
                                <input required type="text" id='feed_date' value="<?= date('d M, Y') ?>" name="feed_date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
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
                <!-- <div class="col-5"> -->
                    <button class="btn btn-success btn-sm btn-block" >
                        <i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?>
                    </button>
                <!-- </div> -->
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
       <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Milking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <div class="modal-body milkingYeildRoutin">
          <!-- <p>Some text in the modal.</p> -->
          <!-- <form action=""> -->
              
              <input type="hidden" id="yeildAnimalID">
          <!-- </form> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info updateMilking" >Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Milking Modal -->
<!--  Small modal example -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel"><?= $this->lang->line('milking'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('animals/add_yeild') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img style="height: 70px;" src="<?= base_url() ?>assets/images/cow.png" data-holder-rendered="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-20">
                        <input type="hidden" name="animal_id" id="animal_id">
                        <div class="form-group">
                            <label for="formrow-email-input"> <?= $this->lang->line('milking_qty'); ?><span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('milk_qty') ?>" name="milk_qty" class="form-control" id="milk_qty">
                            <span class="text-danger"><?php echo form_error('milk_qty'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?= $this->lang->line('milking_date'); ?></label>
                            <div class="input-group">
                                <input type="text" id='milking_date' value="<?= date('d M,Y') ?>" name="milking_date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('milking_date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <div class="form-check mb-3">
                                <input <?php if ($this->input->post('yelid') == MILK_YEILD_APPROX) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="yelid" id="approx" value="<?= MILK_YEILD_APPROX ?>" checked>
                                <label class="form-check-label" for="approx">
                                    <?= $this->lang->line('approximate'); ?>
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input <?php if ($this->input->post('sex') == MILK_YEILD_EXACT) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="yelid" id="exact" value="<?= MILK_YEILD_EXACT ?>">
                                <label class="form-check-label" for="exact">
                                    <?= $this->lang->line('exact'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('milking_routine'); ?> <span class="text-danger">*</span></label>
                            <select required name="routine" id="routine" class="form-control select2" style="width: 100%">
                                <option value="<?= MILKING_ROUTINE_MORNING ?>"><?= $this->lang->line('morning'); ?></option>
                                <option value="<?= MILKING_ROUTINE_AFTERNOON ?>"><?= $this->lang->line('afternoon'); ?></option>
                                <option value="<?= MILKING_ROUTINE_EVENING ?>"><?= $this->lang->line('evening'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('routine'); ?></span>
                        </div>
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


<!--  Small modal example -->
<div class="modal fade bs-example-modal-lg-bulk-milking" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open('animals/add_yeild_bulk') ?>
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel"><?= $this->lang->line('bulk_milking'); ?></h5>
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
                    <div class="col-md-12  mt-20">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('animal_type'); ?> <span class="text-danger">*</span></label>
                            <select required name="bm_animal_type" id="bm_animal_type" class="form-control select2" style="width: 100%">
                                <option value="">--<?= $this->lang->line('select_animal_type'); ?> -- </option>
                                <?php foreach ($animaltypeid as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['animal_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('animal_type'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formrow-email-input"> <?= $this->lang->line('milking_qty'); ?><span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('bm_milk_qty') ?>" name="bm_milk_qty" class="form-control" id="bm_milk_qty">
                            <span class="text-danger"><?php echo form_error('bm_milk_qty'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?= $this->lang->line('milking_date'); ?></label>
                            <div class="input-group">
                                <input type="text" id='bm_milking_date datepicker' value="<?= date('d M, Y') ?>" name="bm_milking_date" class="form-control datepicker" data-provide="datepicker"  data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('bm_milking_date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <div class="form-check mb-3">
                                <input <?php if ($this->input->post('bm_yelid') == MILK_YEILD_APPROX) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="bm_yelid" id="approx" value="<?= MILK_YEILD_APPROX ?>" checked>
                                <label class="form-check-label" for="approx">
                                    <?= $this->lang->line('approximate'); ?>
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input <?php if ($this->input->post('bm_yelid') == MILK_YEILD_EXACT) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="bm_yelid" id="exact" value="<?= MILK_YEILD_EXACT ?>">
                                <label class="form-check-label" for="exact">
                                    <?php echo $this->lang->line('exact') ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('milking_routine'); ?> <span class="text-danger">*</span></label>
                            <select required name="bm_routine" id="bm_routine" class="form-control select2" style="width: 100%">
                                <option value="<?= MILKING_ROUTINE_MORNING ?>"><?= $this->lang->line('morning'); ?></option>
                                <option value="<?= MILKING_ROUTINE_AFTERNOON ?>"><?= $this->lang->line('afternoon'); ?></option>
                                <option value="<?= MILKING_ROUTINE_EVENING ?>"><?= $this->lang->line('evening'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('bm_routine'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm btn-block"  type="submit">
                        <i class="fa fa-check-circle"></i> <?= $this->lang->line('save'); ?>
                    </button>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Update Animal Start -->
<!--  Large modal example -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open_multipart('animals/index') ?>
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
                            <label for="formrow-email-input"> <?= $this->lang->line('code'); ?> <span class="text-danger">*</span></label>
                            <input type="text" required readonly value="<?php echo set_value('codeu'); ?>" name="codeu" class="form-control" id="codeu">
                            <span class="text-danger"><?php echo form_error('codeu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-firstname-input"> <?= $this->lang->line('name'); ?> <span class="text-danger">*</span></label>
                            <input type="text" required value="<?php echo set_value('nameu'); ?>" name="nameu" class="form-control" id="nameu">
                            <span class="text-danger"><?php echo form_error('nameu'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?= $this->lang->line('date_of_birth'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" required id='dobu' value="<?= (set_value('dobu')) ? set_value('dobu') : date('d M, Y') ?>" name="dobu" class="form-control datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('dobu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?= $this->lang->line('date_of_purchase'); ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" required id='dopu' value="<?= (set_value('dopu')) ? set_value('dopu') : date('d M, Y') ?>" name="dopu" class="form-control datepicker datepicker" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
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
                            <input value="<?= $this->input->post('quarantine_period') ?>" required class="form-group form-control" data-toggle="touchspin" name="quarantine_period_up" id="quarantine_period_up" placeholder="Enter Quarantine Days">
                            <span class="text-danger"><?php echo form_error('quarantine_period_up'); ?></span>
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
                            <select required name="breedidu" id="breedidu" value="<?php echo set_value('breedidu'); ?>" class="form-control select2" style="width: 100%">
                                <!-- <option value="">Select Animal Type First </option> -->
                            </select>
                            <span class="text-danger"><?php echo form_error('breedidu'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"> <?= $this->lang->line('weight'); ?> <span class="text-danger">*</span></label>
                            <input required value="<?= set_value('weightu') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="weightu" id="weightu" placeholder="Enter Animal Weight">
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
                            <select name="fatheridu" value="<?php echo set_value('fatherid') ?>" id="fatheridu" class="form-control select2" style="width: 100%">
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
                 <!-- <div class="col-5"> -->
                    <button type="submit" class="btn btn-success btn-sm btn-block" ><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('update'); ?></button>
                <!-- </div> -->
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Update Animal Ends -->


<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
    $(document).ready(function(){
         $("#quarantine_period").TouchSpin({
            min: 0,
            max: 9999999,
            step: .5,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            initval: 50
        });
    })
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

    function fcidim(animal_id) {
        $('#animal_id').val(animal_id);
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


        $(".weight").TouchSpin({
            min: 0,
            max: 9999999,
            step: .5,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            initval: 50
        });
           
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
        var oTable = $('#mydt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('animals/get_list') ?>",
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
                console.log(value)
                avatar_list = avatar_list + '<span class="animal-alfatar">' + value.name + '</span>';
                selected_animals_input = selected_animals_input + value.id + ',';
            })
            $('#selected-animals-columns').html(avatar_list);
            $('#selected_animals_input').val(selected_animals_input);
        }


        // Animal Delete Function
        $(document).on('click', ".delete-animal-btn", function() {
            $animal_id = $(this).attr('code');
            Swal.fire({
                title: 'are you sure ?',
                text: "This Animal will be deleted",
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
                        url: "<?= base_url('animals/delete_animal/') ?>" + $animal_id,
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

        <?php if (isset($_POST['id'])) { ?>
            $('.btn-edit').trigger('click', <?php echo $_POST['id']; ?>);
            // $('#updateModal').modal('show');
        <?php } ?>

    
    function imgError(image) {
        image.onerror = "";
        image.src = "<?= base_url('assets/images/cow.png') ?>";
        return true;
    }

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
     $(document).on('click','.animalYeild',function(){
            var id=$(this).data('code');
            $('#yeildAnimalID').val(id);
            $.ajax({
                url: '<?= base_url('animals/yield_animals_milking') ?>',
                method:'POST',
                data: {id: id},
                success:function(data)
                {
                    $('.milkingYeildRoutin').html(data);
                }
            });

            $('.updateMilking').on('click',function(){
                var animal_yelid_id=$('#yeildAnimalID').val();
                var animlal_yeild_qty = [];
                var animal_ids = [];
                var farm_id = [];
                var approx_exac = [];
                var created_by = [];
                var routine = [];
                var date_created = [];
                $('.morningMilking').each(function(){
                      animlal_yeild_qty.push($(this).val());
                  });

                   $('.animal_ids').each(function(){
                      animal_ids.push($(this).val());
                  });
                   $('.farm_id').each(function(){
                      farm_id.push($(this).val());
                  });
                   $('.approx_exac').each(function(){
                      approx_exac.push($(this).val());
                  });
                   $('.created_by').each(function(){
                      created_by.push($(this).val());
                  });
                   $('.date_created').each(function(){
                      date_created.push($(this).val());
                  });
                   $('.routine').each(function(){
                      routine.push($(this).val());
                  });
              $.ajax({
                url: '<?= base_url('animals/update_yield_animals_milking') ?>',
                method:'POST',
                data: {id: id,animlal_yeild_qty:animlal_yeild_qty,animal_ids:animal_ids,farm_id:farm_id,approx_exac:approx_exac,created_by:created_by,date_created:date_created,routine:routine},
                success:function(data)
                {
                    Swal.fire({
                                title: 'Success!',
                                text: 'Updated successfuly',
                                icon: 'success'
                            });
                    location.reload();
                    // $('.milkingYeildRoutin').html(data);
                }
            });
                

            })
             })
</script>