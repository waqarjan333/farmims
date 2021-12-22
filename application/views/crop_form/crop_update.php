<style>
    .card-title {
    margin: 10px 20px 0px 15px !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <?php echo form_open_multipart('Cropform/InsertCropInfo') ?>
        <div class="card">
            <div class="card-title">
                    <button class="btn btn-success btn-sm" style="float:right !important; width:15% !important;"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
                </div>
            
            <div class="card-body">
                <h4 class="card-title">Area Crop Update</h4>
                <hr>
                
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
                                            <option  value="<?= $tol['id'] ?>"><?= $tol['land_management_data'] ?></option>
                                        <?php } ?>

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
                            <div class="form-group">
                                <label for="formrow-firstname-input">Area Code</label>
                                <input type="text" name="areacode" readonly="" value="CC000<?php echo $invoice;  ?>" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="formrow-firstname-input">Sewing Date</label>
                            <div class="input-group">
                                <input type="text" id="sewing_date" value="<?= date('d M,Y') ?>" name="sewing_date" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true" >
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Select Crop Here <span class="text-danger">*</span></label>
                                <select style="width:100%" name="crop_form_id" class="form-control select2" id="crop_tenure">
                                        <option value="" data-tenure="">Select Crop</option>
                                        <?php  foreach ($CropForm as $crop) { ?>
                                            <option value="<?php echo $crop->id ?>" data-tenure="<?php echo $crop->crop_tenure ?>" ><?php echo $crop->crop_name ?>  </option>
                                        <?php } ?>
                                    </select>
                                <span class="text-danger"><?php echo form_error('crop_tenure'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Selected Crop Tenure</label>
                                <input type="text" name="tenure" value="" readonly="" class="form-control" id="tenure">
                                
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Crop Date <span class="text-danger">*</span></label>
                                <input type="text" value="<?= date('d M,Y') ?>" name="cropdate" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true"class="form-control" id="">
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
                                        <option value="1">Status 1</option>
                                        <option value="2">Status 2</option>
                                        <option value="3">Status 3</option>
                                      

                                    </select>
                            </div>
                        </div>
                       
                    </div>
                </div>
                
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Area Crop Update Details</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Land Type</th>
                            <th>Batch No</th>
                            <th>Area No</th>
                            <th>Area Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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


        $('#mydt').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('Cropform/get_cropUpdateForm') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "land_type_id"
                },
                {
                    "data": "batch_no_id"
                },
                {
                    "data": "area_id"
                },
                {
                    "data": "area_code"
                },
                {
                    "data": "status"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

    // User Delete Function
    $(document).on('click', ".btn-delete", function() {
        $edit_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Record will be deleted",
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
                    url: "<?= base_url('Cropform/delete_cropForm/') ?>" + $edit_id,
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


    $('#type_of_land').on('change',function(){
        var val=$('#type_of_land option:selected').text();
             $.ajax({
                    url: "<?= base_url('Cropform/getLandBatch/') ?>" + val,
                    success: function(result) {
                        $('#land_batch').html('');
                        $('#land_batch').html(result);
                    }
                });

    })
    $('#land_batch').on('change',function(){
        var val=$(this).find(':selected').attr('data-invoice');
        var land_type=$('#type_of_land option:selected').text();
        // alert(val)
             $.ajax({
                    url: "<?= base_url('Cropform/getLandArea/') ?>",
                    method:'POST',
                    data:{invoice:val,land_type:land_type},
                    success: function(result) {
                        $('#land_area').html('');
                        $('#land_area').html(result);
                    }
                });

    })

    $('#crop_tenure').on('change',function(){
         var tenure=$(this).find(':selected').attr('data-tenure');
         (tenure !='') ? $('#tenure').val(tenure+' month') : $('#tenure').val('');
    })

    $(document).on('click', ".btn-edit", function() {
        $user_id = $(this).attr('code');
        $.ajax({
            url: "<?= base_url('user/get_user/') ?>" + $user_id,
            success: function(result) {},
            complete: function(result) {

                // Set Values
                $user = JSON.parse(result.responseText);
                $('#user_id').val($user.id);
                $('#fnameu').val($user.fname);
                $('#lnameu').val($user.lname);
                $('#phone_nou').val($user.phone_no);
                $('#mobile_nou').val($user.mobile_no);
                $('#emailu').val($user.email);
                // $('#').val($user.);
                $('#roleu').val($user.role);
                // $('#').val($user.);

                $('#userModal').modal('show');
                console.log(JSON.parse(result.responseText));
            }
        });


    });


    <?php if ($this->input->post('id')) { ?>
        $('#userModal').modal('show');
    <?php } ?>
  $(document).on('click', ".btn-status", function() {
        var id = $(this).attr('code');
        var status = $(this).attr('data-status');
        var msg="";
        if(status==1){msg="Suspended";}else{msg="Active";}

        Swal.fire({
            title: 'are you sure ?',
            text: "This Record will be "+msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes! '+msg,
            cancelButtonText: 'No! Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-danger ml-2 mt-2',
            buttonsStyling: false
        }).then(function(action) {
            if (action.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('Cropform/updateStatus/') ?>",
                    method:'POST',
                    data:{id:id,status:status},
                    success: function(result) {},
                    complete: function(result) {
                        $('#mydt').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Success!',
                            text: 'Operation successfuly',
                            icon: 'success'
                        });
                    }
                });
            }
        });

    });
</script>