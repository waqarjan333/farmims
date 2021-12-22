<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Land Management Type</h4>
                <?php echo form_open('landManagementType/index') ?>
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
                    <div class="form-group">
                        <label for="formrow-firstname-input">Name <span class="text-danger">*</span></label>
                        <input type="text" name="land_management_type" class="form-control" id="formrow-firstname-input">
                        <span class="text-danger"><?php echo form_error('land_management_type'); ?></span>
                    </div>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Land Management Type</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
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
                "url": "<?php echo base_url('landManagementType/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "land_management_type"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });


    // Land Management Type Delete Function
    $(document).on('click', ".btn-delete", function() {
        $id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Land Management Type will be deleted",
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
                    url: "<?= base_url('landManagementType/delete_LandManagementType/') ?>" + $id,
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
        $id = $(this).attr('code');
        // $obj = $(this);
        name = $(this).parents('tr').children('td:first').text().trim();

        Swal.fire({
            title: 'Update Land Management Type',
            html: '<label class="text-left">Name</label><input id="swal-input1" class="swal2-input" value="' + name + '">',
            confirmButtonText: 'Update',
            focusConfirm: false,
            inputValidator: (value) => {
                if (!(document.getElementById('swal-input1').value)) {
                    return 'You need to write something!';
                }
            },
            preConfirm: () => {
                return document.getElementById('swal-input1').value;
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('landManagementType/update_LandManagementType/') ?>" + $id,
                    method: 'POST',
                    data: {
                        land_management_type: result.value
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