<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $this->lang->line('add_animal_test') ?></h4>

                <?php echo form_open('animal_test/index') ?>
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
                    <label for="formrow-firstname-input"><?php echo $this->lang->line('name') ?><span class="text-danger">*</span></label>
                    <input type="text" name="test_name" class="form-control" id="formrow-firstname-input">
                    <span class="text-danger"><?php echo form_error('test_name'); ?></span>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo $this->lang->line('description') ?>
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>
                    <span class="text-danger"><?php echo form_error('description'); ?></span>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?php echo $this->lang->line('save') ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?php echo $this->lang->line('add_animal_test') ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('name') ?></th>
                            <th><?php echo $this->lang->line('description') ?></th>
                            <th><?php echo $this->lang->line('action') ?></th>
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
                "url": "<?php echo base_url('animal_test/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "test_name"
                },
                {
                    "data": "description"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

    // test Delete Function
    $(document).on('click', ".btn-delete", function() {
        $test_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Test will be deleted",
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
                    url: "<?= base_url('animal_test/delete_animal_test/') ?>" + $test_id,
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
        $test_id = $(this).attr('code');
        // $obj = $(this);
        test_name = $(this).parents('tr').children('td:first').text().trim();
        description = $(this).parents('tr').children('td').eq(1).text().trim();

        Swal.fire({
            title: 'Update Animal Test',
            html: '<input id="swal-input1" class="swal2-input" value="' + test_name + '">' +
                '<textarea id="swal-input2" class="swal2-input">' + description + '</textarea>',
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
                    url: "<?= base_url('animal_test/update_animal_test/') ?>" + $test_id,
                    method: 'POST',
                    data: {
                        test_name: result.value[0],
                        description: result.value[1]
                    },
                    success: function(result) {},
                    complete: function(result) {
                        if (result.responseText == '1') {
                            $('#mydt').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'Success!',
                                text: 'updated successfuly',
                                icon: 'success'
                            });
                        } else {
                            // $('#mydt').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'Ooooops',
                                text: result.responseText,
                                icon: 'error'
                            });
                        }

                    }
                });
            }
        });

    });
</script>