<style>
    .card-title {
    margin: 10px 20px 0px 15px !important;
}
.datepicker{z-index:1151 !important;border: 1px solid lightgrey !important;}
</style>
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

        <div class="">
            <div class="card">
                <div class="card-title"><?= $this->lang->line('livestock_vaccination'); ?> &nbsp;
                    <button type="button" style="float:right !important;" onclick="get_animals_for_vaccine(null,null)" data-toggle='modal' data-target='.bs-vaccination-modal-sm' class="btn btn-success btn-sm" id="fattening_live_stock_vaccination"><i class="uil-syringe"></i>&nbsp;<?= $this->lang->line('new_vaccination'); ?>
                </button>&nbsp;

                    </div>
                <div class="card-body">

                    
                    <table id="vaccination_table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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


<!-- New Vaccination Model -->
<div class="modal fade bs-vaccination-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open('fattening_animals/vaccination') ?>
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
                            <label class="control-label"><?= $this->lang->line('select_animal'); ?> <span class="text-danger">*</span></label>
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
                     <button class="btn btn-success btn-sm btn-block" type="submit"><i class="fa fa-check-circle"></i> <?= $this->lang->line('save'); ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- New Vaccination Model End-->

<script>
    function get_animals_for_vaccine(animal_id = null, table_id = null) {
        $.ajax({
            url: "<?= base_url('fattening_animals/get_animals_for_vaccine') ?>",
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
            url: "<?= base_url('fattening_animals/get_product_list_for_dd_cattle') ?>",
            success: function(result) {
                $("#vaccine_id").html(result);
            },
            complete: function(data) {}
        });
        if (table_id) {
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

        var oTable = $('#vaccination_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('fattening_animals/get_vaccination_list') ?>",
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