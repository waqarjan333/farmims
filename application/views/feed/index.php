<div class="row">
    <style>
           .datepicker{z-index:1151 !important;border: 1px solid lightgrey !important;}
    </style>
    <div class="col-md-4">
        <?php echo form_open() ?>
        <div class="card">
            <div class="row" style="margin:10px !important;">
                <div class="col-8">
                    <h4 class="card-title"><?= $this->lang->line('Add_Feed'); ?></h4>
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

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('Feed_Code'); ?> <span class="text-danger">*</span></label>
                            <input type="text" readonly value="<?= $code ?>" value="<?= $this->input->post('feedcode') ?>" name="feedcode" class="form-control" id="feedcode">
                            <span class="text-danger"><?php echo form_error('feedcode'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="crop_date_label"><?= $this->lang->line('Crop_Date'); ?> </label>
                            <div class="input-group">
                                <input type="text" id='cropdate' value="<?= $this->input->post('cropdate') ?>" name="cropdate" class="form-control" data-provide="datepicker" data-date-format="M, yyyy" data-date-autoclose="true" data-date-min-view-mode="1">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('cropdate'); ?></span>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('Processed'); ?> <span class="text-danger">*</span></label>
                            <br>
                            <select onchange="check_if_formula_required()" id="processed" name="processed" class="form-control select2">
                                <option value=""><?= $this->lang->line('select_process'); ?></option>
                                <option <?php if ($this->input->post('processed') == FEED_RAW) {
                                            echo 'selected';
                                        } ?> value="<?= FEED_RAW ?>"><?= $this->lang->line('raw_type'); ?></option>
                                <option <?php if ($this->input->post('processed') == FEED_PROCESSED) {
                                            echo 'selected';
                                        } ?> value="<?= FEED_PROCESSED ?>"><?= $this->lang->line('chopped'); ?></option>
                                <option <?php if ($this->input->post('processed') == FEED_MIXTURE) {
                                            echo 'selected';
                                        } ?> value="<?= FEED_MIXTURE ?>"><?= $this->lang->line('mixture'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('processed'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('Feed_Category'); ?> <span class="text-danger">*</span></label>
                            <br>
                            <select name="feedid" class="form-control select2">
                                <option value=""><?= $this->lang->line('select_feed'); ?> </option>
                                <?php foreach ($feedcategory as $c) { ?>
                                    <option <?php if ($this->input->post('feedid') == $c['id']) {
                                                echo 'selected';
                                            } ?> value="<?= $c['id'] ?>"><?= $c['feed_category_name'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('feedid'); ?></span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5><?= $this->lang->line('crop_type'); ?> <span class="text-danger">*</span></h5>
                        <div class="form-group">
                            <div class="form-check mb-3">
                                <input checked <?php if ($this->input->post('crop_type') == LOCAL_CROP) {
                                                    echo 'checked';
                                                } ?> class="form-check-input" type="radio" name="crop_type" id="local_crop" value="<?= LOCAL_CROP ?>">
                                <label class="form-check-label" for="local_crop">
                                    <?= $this->lang->line('local'); ?>
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input <?php if ($this->input->post('crop_type') == PURCHASED_CROP) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="crop_type" id="purchased_crop" value="<?= PURCHASED_CROP ?>">
                                <label class="form-check-label" for="purchased_crop">
                                    <?= $this->lang->line('purchase'); ?>
                                </label>
                            </div>
                            <span class="text-danger"><?php echo form_error('pregneny_type'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('Quantity'); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('qty') ?>" name="qty" class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('qty'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('uom'); ?> <span class="text-danger">*</span></label>
                            <br>
                            <select name="uom" class="form-control select2" style="width: 100%;">
                                <option value=""><?= $this->lang->line('measurement'); ?> </option>
                                <?php foreach ($uom as $c) { ?>
                                    <option <?php if ($this->input->post('uom') == $c['id']) {
                                                echo 'selected';
                                            } ?> value="<?= $c['id'] ?>"><?= $c['name'] ?> (<?= $c['symbol'] ?>)</option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('uom'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" id="formation_formula_input" style="display: none;">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('formula_formation'); ?> <span class="text-danger">*</span></label>
                            <select style="width: 100%;" multiple id="formulaformation" name="formulaformation[]" class="form-control select2">
                            </select>
                            <span class="text-danger"><?php echo form_error('formulaformation'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12" id="feed-form">

                    </div>
                </div>

                <div class="modal-footer">
                     <div class="col-12">
                     <button class="btn btn-success btn-sm btn-block" >
                        <i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?>
                    </button>
                </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?= $this->lang->line('feed'); ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?= $this->lang->line('code'); ?></th>
                            <th><?= $this->lang->line('formula_formation'); ?></th>
                            <th><?= $this->lang->line('Crop_Date'); ?></th>
                            <th><?= $this->lang->line('qty'); ?></th>
                            <th><?= $this->lang->line('processed'); ?></th>
                            <th><?= $this->lang->line('Feed_Category'); ?></th>
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


<!-- Update Modal Starts -->
<div class="modal fade" id="updateModalCenter" tabindex="-1" role="dialog" aria-labelledby="updateModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <?php echo form_open() ?>
            <div class="modal-header">
                <div class="col-6">
                    <h4 class="card-title"><?= $this->lang->line('update_feed'); ?></h4>
                </div>
                
                <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                
                
                <input type="hidden" name="id" value="<?php echo set_value('id'); ?>">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('Feed_Code'); ?> <span class="text-danger">*</span></label>
                            <input type="text" readonly value="<?= $code ?>" value="<?= set_value('feedcodeu') ?>" name="feedcodeu" class="form-control" id="feedcodeu">
                            <span class="text-danger"><?php echo form_error('feedcodeu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="crop_date_label"><?= $this->lang->line('Crop_Date'); ?> </label>
                            <div class="input-group">
                                <input type="text" id='cropdateu' value="<?= set_value('cropdateu') ?>" name="cropdateu" class="form-control datepicker" data-provide="datepicker" data-date-format="M, yyyy" data-date-autoclose="true" data-date-min-view-mode="1">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('cropdateu'); ?></span>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('processed'); ?> <span class="text-danger">*</span></label>
                            <select onchange="check_if_formula_required()" style="width: 100%;" id="processedu" name="processedu" class="form-control select2">
                                <option value=""><?= $this->lang->line('select_process'); ?></option>
                                <option <?php if (set_value('processedu') == FEED_RAW) {
                                            echo 'selected';
                                        } ?> value="<?= FEED_RAW ?>"><?= $this->lang->line('raw_type'); ?></option>
                                <option <?php if (set_value('processedu') == FEED_PROCESSED) {
                                            echo 'selected';
                                        } ?> value="<?= FEED_PROCESSED ?>"><?= $this->lang->line('chopped'); ?></option>
                                <option <?php if (set_value('processedu') == FEED_MIXTURE) {
                                            echo 'selected';
                                        } ?> value="<?= FEED_MIXTURE ?>"><?= $this->lang->line('mixture'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('processedu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('Feed_Category'); ?> <span class="text-danger">*</span></label>
                            <select name="feedidu" id="feedidu" style="width: 100%;" class="form-control select2">
                                <option value=""><?= $this->lang->line('select_feed'); ?> </option>
                                <?php foreach ($feedcategory as $c) { ?>
                                    <option <?php if (set_value('feedidu') == $c['id']) {
                                                echo 'selected';
                                            } ?> value="<?= $c['id'] ?>"><?= $c['feed_category_name'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('feedidu'); ?></span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5><?= $this->lang->line('crop_type'); ?> <span class="text-danger">*</span></h5>
                        <div class="form-group">
                            <div class="form-check mb-3">
                                <input checked <?php if (set_value('crop_typeu') == LOCAL_CROP) {
                                                    echo 'checked';
                                                } ?> class="form-check-input" type="radio" name="crop_typeu" id="local_cropu" value="<?= LOCAL_CROP ?>">
                                <label class="form-check-label" for="local_crop">
                                    <?= $this->lang->line('local'); ?>
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input <?php if (set_value('crop_typeu') == PURCHASED_CROP) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="crop_typeu" id="purchased_cropu" value="<?= PURCHASED_CROP ?>">
                                <label class="form-check-label" for="purchased_crop">
                                    <?= $this->lang->line('Purchase'); ?>
                                </label>
                            </div>
                            <span class="text-danger"><?php echo form_error('crop_typeu'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('Quantity'); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?= set_value('qtyu') ?>" name="qtyu" class="form-control" id="qtu">
                            <span class="text-danger"><?php echo form_error('qtyu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('uom'); ?> <span class="text-danger">*</span></label>
                            <select name="uomu" class="form-control select2" style="width: 100%;">
                                <option value=""><?= $this->lang->line('measurement_unit'); ?> </option>
                                <?php foreach ($uom as $c) { ?>
                                    <option <?php if ($this->input->post('uom') == $c['id']) {
                                                echo 'selected';
                                            } ?> value="<?= $c['id'] ?>"><?= $c['name'] ?> (<?= $c['symbol'] ?>)</option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('uomu'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" id="formation_formula_input" style="display: none;">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('formula_formation'); ?> <span class="text-danger">*</span></label>
                            <select style="width: 100%;" multiple id="formulaformationu" name="formulaformationu[]" class="form-control select2">
                            </select>
                            <span class="text-danger"><?php echo form_error('formulaformationu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12" id="feed-form">

                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-12">
                    <button class="btn btn-success btn-sm btn-block" ><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                </div>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<!-- Update Modal Ends -->

<script>
    $('#formulaformation').on('change', function(e) {
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

    function check_if_formula_required() {
        if ($('#processed').val() == <?= FEED_MIXTURE ?>) {
            $.ajax({
                url: "<?= base_url('feed/get_mixture_dd') ?>",
                success: function(result) {
                    $("#formulaformation").html(result);
                    $("#formulaformation").attr('required', true);
                },
                complete: function(result) {
                    $('#formation_formula_input').show(500);
                }
            });
        } else {
            $('#formation_formula_input').hide(500);
            $("#formulaformation").attr('required', false);
        }
    }
    $("input[type='radio']").change(function() {
        change_code_and_date();
    });

    function change_code_and_date() {
        var radioValue = $("input[name='crop_type']:checked").val();
        if (radioValue == <?= LOCAL_CROP ?>) {
            $('#feedcode').val('LF<?= $code ?>');
            $('#crop_date_label').hide().html('Crop Date <span class="text-danger">*</span>').fadeIn(500);
        } else if (radioValue == <?= PURCHASED_CROP ?>) {
            $('#crop_date_label').hide().html('Purchase Date <span class="text-danger">*</span>').fadeIn(500);
            $('#feedcode').val('PF<?= $code ?>');
        }
    }

    $(document).ready(function() {
        change_code_and_date();
        check_if_formula_required();
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
        $('#mydt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('feed/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "code"
                },
                {
                    "data": "formula"
                },
                {
                    "data": "cropdate"
                },
                {
                    "data": "qty"
                },
                {
                    "data": "processed"
                },
                {
                    "data": "feedid"
                },

                {
                    "data": "actions"
                }
            ]

        });


        // feed Delete Function
        $(document).on('click', ".btn-delete", function() {
            $feed_id = $(this).attr('code');
            Swal.fire({
                title: 'are you sure ?',
                text: "This Feed will be deleted",
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
                        url: "<?= base_url('feed/delete_feed/') ?>" + $feed_id,
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



        // Feed Update Function
        $(document).on('click', ".btn-edit", function($id) {
            $feed_id = ($id) ? $(this).attr('code') : $id;

            // console.log('Updating ',$feed_id);

            $.ajax({
                url: "<?= base_url('feed/get_feed/') ?>" + $feed_id,
                success: function(result) {},
                complete: function(result) {
                    // Set Values
                    $feed = JSON.parse(result.responseText);
                    $('#updateModalCenter').modal('show');
                    $('#codeu').val($feed.code);
                    $('#cropdateu').val($feed.cropdate);
                    $('#processedu').val($feed.processed).trigger('change');
                    $('#feedidu').val($feed.feed_id).trigger('change');
                    $('#qtu').val($feed.qty);
                    $('#uomu').val($feed.uom);
                    if ($feed.crop_typeu == '<?= LOCAL_CROP ?>') {
                        $('#local_cropu').attr('checked', true);
                    } else {
                        $('#purchased_cropu').attr('checked', true);
                    }
                }
            });

        });

    });
</script>