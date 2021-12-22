<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Country</h4>
                <?php echo form_open('country/index') ?>
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
                        <input type="text" name="name" class="form-control" id="formrow-firstname-input">
                        <span class="text-danger"><?php echo form_error('name'); ?></span>
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

                <h4 class="card-title">Countrys</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Country</th>
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
                "url": "<?php echo base_url('country/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

    // Country Delete Function
    $(document).on('click', ".btn-delete", function() {
            $country_id = $(this).attr('code');
            Swal.fire({
                title: 'are you sure ?',
                text: "This Country will be deleted",
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
                        url: "<?= base_url('country/delete_country/') ?>" + $country_id,
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
        // Edit Country
        $(document).on('click', ".btn-edit", function() {
            $country_id = $(this).attr('code');
            // $obj = $(this);
            inputValue = $(this).parents('tr').children('td:first').text();
            Swal.fire({
                title: 'Update country',
                input: 'text',
                inputLabel: 'Country',
                inputValue: inputValue,
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value || value.length<3) {
                    return 'You need to write at least 3 char. !'
                    }
                }
            }).then(function(action) {
                if (action.isConfirmed) {
                    // console.log(action);
                    $.ajax({
                        url: "<?= base_url('country/update_country/') ?>" + $country_id,
                        data:{country:action.value},
                        method:'POST',
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