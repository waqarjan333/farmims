<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $this->lang->line('add_crop'); ?></h4>
                <?php echo form_open_multipart('Cropform/index') ?>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('crop_name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" name="cropname" class="form-control" id="">
                                <span class="text-danger"><?php echo form_error('cropname'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('crop_tenure'); ?><span class="text-danger">*</span></label>
                                <select name="croptenure" class="form-control" id="">
                                	<option value="">Select Months</option>
                                	<option value="1">1 Month</option>
                                	<option value="2">2 Month</option>
                                	<option value="3">3 Month</option>
                                	<option value="4">4 Month</option>
                                	<option value="5">5 Month</option>
                                	<option value="6">6 Month</option>
                                	<option value="7">7 Month</option>
                                	<option value="8">8 Month</option>
                                	<option value="9">9 Month</option>
                                	<option value="10">10 Month</option>
                                	<option value="11">11 Month</option>
                                	<option value="12">12 Month</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('croptenure'); ?></span>
                            </div>
                        </div>

                    </div>

                    
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Users</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Crop Name</th>
                            <th>Crop Tenure</th>
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
                "url": "<?php echo base_url('Cropform/get_cropForm') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "crop_name"
                },
                {
                    "data": "crop_tenure"
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
        $user_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This User will be deleted",
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
                    url: "<?= base_url('user/delete_user/') ?>" + $user_id,
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
</script>