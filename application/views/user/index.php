<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $this->lang->line('add_user'); ?></h4>
                <?php echo form_open_multipart('user/index') ?>
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('first_name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" name="fname" class="form-control" id="">
                                <span class="text-danger"><?php echo form_error('fname'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('last_name'); ?></label>
                                <input type="text" name="lname" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('phone_no'); ?></label>
                                <input type="text" name="phone_no" class="form-control" id="">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('mobile_no'); ?> <span class="text-danger">*</span></label>
                                <input type="text" name="mobile_no" class="form-control" id="">
                                <span class="text-danger"><?php echo form_error('mobile_no'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('email'); ?> <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="">
                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('password'); ?> <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" id="">
                                <span class="text-danger"><?php echo form_error('password'); ?></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="formrow-firstname-input">User Level <span class="text-danger">*</span></label>
                                <select name="role" class="form-control custom-select" id="role">
                                    <option value="<?= ROLE_FARM_MANAGER ?>">Farm Manager</option>
                                    <option value="<?= ROLE_FARM_OPERATOR ?>">Farm Operator</option>
                                    <option value="<?= ROLE_FARM_OWNER ?>">Farm Owner</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="formrow-firstname-input">Farm Access<span class="text-danger">*</span></label>
                                <select name="farm_id" class="form-control s2ss" id="farm_id"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="formrow-firstname-input">&nbsp;</label>
                                <input type="file" name="image" style="display:none" id='prof_img' onchange="get_file_name()">
                                <button type="button" id="select_file_btn" class="btn btn-block btn-info" onclick="select_img()"><i class="uil-image-plus"></i> Select Profile Image </button>
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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Role</th>
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
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('user/index') ?>
                <!-- <div class="col-md-12"> -->
                <input type="hidden" name="id" id="user_id">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="fnameu" class="form-control" id="fnameu">
                            <span class="text-danger"><?php echo form_error('fnameu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Last Name</label>
                            <input type="text" name="lnameu" class="form-control" id="lnameu">
                        </div>
                    </div>
                    <span class="text-danger"><?php echo form_error('lnameu'); ?></span>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input"><?= $this->lang->line('phone_no'); ?>Phone No</label>
                            <input type="text" name="phone_nou" class="form-control" id="phone_nou">
                        </div>
                    </div>
                    <span class="text-danger"><?php echo form_error('phone_nou'); ?></span>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input"><?= $this->lang->line('mobile_no'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="mobile_nou" class="form-control" id="mobile_nou">
                            <span class="text-danger"><?php echo form_error('mobile_nou'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input"><?= $this->lang->line('email'); ?> <span class="text-danger">*</span></label>
                            <input type="email" name="emailu" class="form-control" id="emailu">
                            <span class="text-danger"><?php echo form_error('emailu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input"><?= $this->lang->line('password'); ?> </label>
                            <input type="password" name="passwordu" class="form-control" id="">
                            <span class="text-danger"><?php echo form_error('passwordu'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input"><?= $this->lang->line('user_level'); ?>  <span class="text-danger">*</span></label>
                            <select name="roleu" class="form-control custom-select" id="roleu">
                                <option value="<?= ROLE_FARM_MANAGER ?>"><?= $this->lang->line('farm_manager'); ?></option>
                                <option value="<?= ROLE_FARM_OPERATOR ?>"><?= $this->lang->line('farm_operator'); ?></option>
                                <option value="<?= ROLE_FARM_OWNER ?>"><?= $this->lang->line('farm_owner'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input"><?= $this->lang->line('farm_access'); ?><span class="text-danger">*</span></label>
                            <select name="farm_idu" class="form-control s2ss" style="width: 100%;" id="farm_id_u"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-firstname-input">&nbsp;</label>
                            <input type="file" name="image" style="display:none" id='prof_img' onchange="get_file_name()">
                            <button type="button" id="select_file_btn" class="btn btn-block btn-info" onclick="select_img()"><i class="uil-image-plus"></i><?= $this->lang->line('select_profile_img'); ?>  </button>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

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
                "url": "<?php echo base_url('user/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "fname"
                },
                {
                    "data": "phone_no"
                },
                {
                    "data": "mobile_no"
                },
                {
                    "data": "email"
                },
                {
                    "data": "role"
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