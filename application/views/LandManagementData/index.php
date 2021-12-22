<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Land Management Data</h4>
                <hr>
                <?php echo form_open('landManagementData/index') ?>
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-octagon mr-2"></i>
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="formrow-firstname-input">Name<span class="text-danger">*</span></label>
                    <input type="text" name="land_management_data" class="form-control" id="formrow-firstname-input">
                    <span class="text-danger"><?php echo form_error('land_management_data'); ?></span>
                </div>
                <div class="form-group">
                    <label class="control-label">Land Management Type<span class="text-danger">*</span></label>
                    <select name="land_management_type_id" id="land_management_type_id" class="form-control select2 custom-select">
                        <option value="">Select Land Management Type</option>
                        <?php foreach ($LandManagementType as $lmt) { ?>
                            <option value="<?= $lmt['id'] ?>"><?= $lmt['land_management_type'] ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('land_management_type_id'); ?></span>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">All Land Management Data</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Land Management Data</th>
                            <th>Land Management Type</th>
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
    $(document).ready(function() {
        $('#mydt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('LandManagementData/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "land_management_data"
                },
                {
                    "data": "land_management_type_id"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

    // province Delete Function
    $(document).on('click', ".btn-delete", function() {
        var id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Land Management Data will be deleted",
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
                    url: "<?= base_url('LandManagementData/delete/') ?>" + id,
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
    // Edit
    $(document).on('click', ".btn-edit", function() {
        var id = $(this).attr('code');
        LandManagementData = $(this).parents('tr').children('td:first').text().trim();
        LandManagementType = $(this).parents('tr').children('td').eq(1).text().trim();

        land_management_type = document.getElementById('land_management_type_id').options;
        land_management_type_select_option = '';

        land_management_type.forEach(element => {
            land_management_type_select_option += '<option value="' + element.value + '"';

            if (element.text == LandManagementType) {
                land_management_type_select_option += " selected ";
            }
            land_management_type_select_option += ">" + element.text + "</option>";
        });

        console.log(land_management_type_select_option);

        Swal.fire({
            title: 'Update Land Management Data',
            html: '<input id="swal-input1" class="swal2-input" value="' + LandManagementData + '">' +
                '<select id="swal-input2" class="swal2-input">' + land_management_type_select_option + '</select>',
            confirmButtonText: 'Save',
            focusConfirm: false,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value
                ]
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('LandManagementData/update/') ?>" + id,
                    method: 'POST',
                    data: {
                        land_management_data: result.value[0],
                        land_management_type_id: result.value[1]
                    },
                    success: function(result) {},
                    complete: function(result) {
                        $('#mydt').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Success!',
                            text: 'updated successfuly',
                            icon: 'success'
                        });
                    }
                });
            }
        });

    });
</script>