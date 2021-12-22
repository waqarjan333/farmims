<div class="row">

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Animal Type</h4>
                <?php echo form_open('animaltype/index') ?>

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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Animal Type</label>

                                    <input type="text" value="<?=$this->input->post('animaltype')?>" name="animaltype" class="form-control" id="formrow-password-input">
                                    <span class="text-danger"><?php echo form_error('animaltype'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Pregnancy Age (Months)</label>

                                    <input type="text" value="<?=$this->input->post('pregnancy_age')?>" name="pregnancy_age" class="form-control" id="formrow-password-input">
                                    <span class="text-danger"><?php echo form_error('pregnancy_age'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Pregnancy Period (Months)</label>

                                    <input type="text" value="<?=$this->input->post('pregnancy_period')?>" name="pregnancy_period" class="form-control" id="formrow-password-input">
                                    <span class="text-danger"><?php echo form_error('pregnancy_period'); ?></span>
                                </div>
                            </div>
                        </div>
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

                <h4 class="card-title">Animal Type</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Type Of Animal</th>
                            <th>Pregnancy Age</th>
                            <th>Pregnancy Period</th>
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
                "url": "<?php echo base_url('animaltype/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "pregnancy_age"
                },
                {
                    "data": "pregnancy_period"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

    // Animaltype Delete Function
    $(document).on('click', ".btn-delete", function() {
        $animaltype_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Animal Type will be deleted",
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
                    url: "<?= base_url('animaltype/delete_animaltype/') ?>" + $animaltype_id,
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
        $animaltype_id = $(this).attr('code');
        var obj = this;
        animaltype_type = $(obj).parents('tr').children('td:first').text().trim();
        animaltype_age = $(obj).parents('tr').children('td').eq(1).text().trim().split(" ")[0];
        animaltype_period = $(obj).parents('tr').children('td').eq(2).text().trim().split(" ")[0];

        Swal.fire({
            title: 'Update animaltype',
            html: '<label class="text-left">Animal Type</label><input id="swal-input1" class="swal2-input" value="' + animaltype_type + '">' +
                '<label class="text-left">Pregnancy Age (Months)</label><input id="swal-input2" class="swal2-input" value="' + animaltype_age + '">'+
                '<label class="text-left">Pregnancy Period (Months)</label><input id="swal-input3" class="swal2-input" value="' + animaltype_period + '">',
                confirmButtonText: 'Save',
            focusConfirm: false,
            preConfirm: () => {
                return [document.getElementById('swal-input1').value, document.getElementById('swal-input2').value, document.getElementById('swal-input3').value];
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('animaltype/update_animaltype/') ?>" + $animaltype_id,
                    method: 'POST',
                    data: {
                        type: result.value[0],
                        age: result.value[1],
                        period:result.value[2]
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