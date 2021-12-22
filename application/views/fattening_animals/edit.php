<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-4">
        <div class="card">
        <?php echo form_open_multipart('fattening_animals/index') ?>
            <div class="card-body">
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
                                <input type="text" id='dob' data-date-min-view-mode="1" value="<?= ($this->input->post('dob')) ? $this->input->post('dob') : date('d M,Y') ?>" name="dob" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
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
                                <option value=""><?= $this->lang->line('select_animal_first'); ?>t</option>

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

                <button class="btn btn-success btn-block waves-effect waves-light mt-2"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
            </div>
            <?php echo form_close() ?>
    </div> <!-- end col -->

</div> <!-- end row -->
<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>

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

        
</script>