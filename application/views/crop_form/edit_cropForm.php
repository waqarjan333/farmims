<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Area Crop Update</h4>
                <?php echo form_open_multipart('Cropform/UpdateCropInfo/'.$edit_id) ?>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Land Type <span class="text-danger">*</span></label>
                                 <select style="width:100%" name="type_of_land" class="form-control select2" id="type_of_land">
                                        <option value="">Select Type Of Land</option>
                                        <?php foreach ($landType as $tol) { ?>
                                            <option  value="<?= $tol['id'] ?>" <?php if($cropFormData->land_type_id==$tol['id']){ echo 'selected=""'; } ?>><?= $tol['land_management_data'] ?></option>
                                        <?php } ?>
                                        <input type="hidden" value="<?php echo  $cropFormData->batch_no_id?>" id="hiddenLandID">
                                    </select>
                                <span class="text-danger"><?php echo form_error('type_of_land'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Select Batch</label>
                                 <select style="width:100%" name="land_batch" class="form-control select2" id="land_batch">
                                        <option value="">Select Batch</option>
                                      

                                    </select>
                                    <input type="hidden" value="<?php echo  $cropFormData->area_id?>" id="hiddenBatchID">
                                    <input type="hidden" value="<?php echo  $cropFormData->invoice?>" id="hiddenInvoice">
                                    <span class="text-danger"><?php echo form_error('land_batch'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Select Area</label>
                                <select style="width:100%" name="land_area" class="form-control select2" id="land_area">
                                        <option value="">Select Area</option>
                                      

                                    </select>
                                    <span class="text-danger"><?php echo form_error('land_area'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="formrow-firstname-input">Sewing Date</label>
                            <div class="input-group">
                                <input type="text" id="sewing_date" value="<?= $cropFormData->sewing_date ?>" name="sewing_date" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true" >
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Select Crop Here <span class="text-danger">*</span></label>
                                <select style="width:100%" name="crop_form_id" class="form-control select2" id="crop_tenure">
                                        <option value="" data-tenure="">Select Crop</option>
                                        <?php  foreach ($CropForm as $crop) { ?>
                                            <option value="<?php echo $crop->id ?>" <?php if($cropFormData->crop_form_id==$crop->id){ echo 'selected=""'; } ?> data-tenure="<?php echo $crop->crop_tenure ?>" ><?php echo $crop->crop_name ?>  </option>
                                        <?php } ?>
                                    </select>
                                <span class="text-danger"><?php echo form_error('crop_tenure'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Selected Crop Tenure</label>
                                <input type="text" name="tenure" value="<?= $cropFormData->crop_tenure ?>" readonly="" class="form-control" id="tenure">
                                
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Crop Date <span class="text-danger">*</span></label>
                                <input type="text" value="<?= $cropFormData->crop_date ?>" name="cropdate" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true"class="form-control" id="">
                                <span class="text-danger"><?php echo form_error('cropdate'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Expected Completion Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="completion_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Select Status<span class="text-danger">*</span></label>
                                <select style="width:100%" name="crop_status" class="form-control select2" id="crop_status">
                                        <option value="">Select Status Here</option>
                                        <option value="1" <?php if($cropFormData->crop_form_id==1){ echo 'selected=""'; } ?>>Status 1</option>
                                        <option value="2" <?php if($cropFormData->crop_form_id==2){ echo 'selected=""'; } ?>>Status 2</option>
                                        <option value="3" <?php if($cropFormData->crop_form_id==3){ echo 'selected=""'; } ?>>Status 3</option>
                                      

                                    </select>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Update</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
  
</div> <!-- end row -->


<!-- Update Modal -->


<script>

    function select_img() {
        $('#prof_img').trigger('click');
    }

    function get_file_name() {
        var filename = $('#prof_img').val().split('\\').pop();
        $('#select_file_btn').html(filename);
        // console.log(filename);
    }
    $(document).ready(function() {
        var val=$('#type_of_land option:selected').text();
        // alert(val)
        var valID=$('#hiddenLandID').val();
        getBatchLand(val,valID);

            var areaID=$('#hiddenBatchID').val();
        var val1=$('#hiddenInvoice').val();
        // alert(val1);
         getBatchArea(val1,val,areaID);


        $('.s2ss').select2({
            placeholder: 'Search Farm User Has Access To',
            ajax: {
                url: '<?= base_url('farm/get_search_dd') ?>',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });


    });




    $('#type_of_land').on('change',function(){
        var val=$('#type_of_land option:selected').text();
        var valID=0;
         getBatchLand(val,valID);

    })
    function getBatchLand(val,valID)
    {
            $.ajax({
                    url: "<?= base_url('Cropform/getLandBatch/') ?>",
                    method:'POST',
                    data:{val:val,valID:valID},
                    success: function(result) {
                        $('#land_batch').html('');
                        $('#land_batch').html(result);
                    }
                });
    }
    $('#land_batch').on('change',function(){
        var val1=$(this).find(':selected').attr('data-invoice');
        var land_type=$('#type_of_land option:selected').text();
        // alert(val)
          var areaID=0;
          getBatchArea(val1,land_type,areaID);
    })

    function getBatchArea(val1,land_type,areaID)
    {
        // alert(areaID)
           $.ajax({
                    url: "<?= base_url('Cropform/getLandArea/') ?>",
                    method:'POST',
                    data:{invoice:val1,land_type:land_type,areaID:areaID},
                    success: function(result) {
                        $('#land_area').html('');
                        $('#land_area').html(result);
                    }
                });
    }



    $('#crop_tenure').on('change',function(){
         var tenure=$(this).find(':selected').attr('data-tenure');
         (tenure !='') ? $('#tenure').val(tenure+' month') : $('#tenure').val('');
    })



</script>