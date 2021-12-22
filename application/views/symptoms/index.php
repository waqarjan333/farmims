<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $this->lang->line('add_diesese_symptoms'); ?></h4>
                <?php echo form_open('symptoms/index') ?>
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
                        <!-- <div class="form-group">
                            <label class="control-label">Disease<span class="text-danger">*</span></label>
                            <select name="disease" class="form-control custom-select" id="select-disease">
                                <option value="" selected>Select Disease</option>
                                <?php
                                foreach ($diseases as $key => $value) {
                                    echo "<option value='$value->id' >$value->name</option>";
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('disease'); ?></span>
                        </div> -->
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('symptoms'); ?><span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Inflammation">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('description'); ?><span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" cols="30" rows="5" placeholder="More info ..."></textarea>
                            <span class="text-danger"><?php echo form_error('description'); ?></span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?= $this->lang->line('disease_symptoms'); ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?= $this->lang->line('symptoms'); ?></th>
                            <th><?= $this->lang->line('description'); ?>n</th>
                            <th><?= $this->lang->line('action'); ?></th>
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
        // $(".select2").select2({
        //     width: 'resolve' // need to override the changed default
        // });
        $('#mydt').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('symptoms/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "name"
            }
            , {
                "data": "description"
            }
            , {
                "data": "actions"
            }]

        });
    });


    $(document).on('click', ".btn-delete", function() {
        $id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Symptom will be deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes ! Delete.',
            cancelButtonText: 'No ! Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-danger ml-2 mt-2',
            buttonsStyling: false
        }).then(function(action) {
            if (action.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('symptoms/delete_symptom/') ?>" + $id,
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
        var id = $(this).attr('code');
        var name = $(this).parents('tr').children('td').eq(0).text().trim();
		var description = $(this).parents('tr').children('td').eq(1).text().trim();
        Swal.fire({
            title: 'Update Symptom',
            html:
                '<input id="swal-input1" class="swal2-input" value="'+name+'">' +
                '<textarea id="swal-input2" class="swal2-input" cols="30" rows="5">'+description+'</textarea>',
            confirmButtonText: 'Update',
            preConfirm: function () {
                return new Promise(function (resolve) {
                    // Validate input
                    if ($('#swal-input1').val() == '') {
                        swal.showValidationMessage("Enter Sympton"); // Show error when validation fails.
                        swal.enableConfirmButton(); // Enable the confirm button again.
                    } else {
                        swal.resetValidationMessage(); // Reset the validation message.
                        resolve([
                            $('#swal-input1').val(),
                            $('#swal-input2').val()
                        ]);
                    }
                })
            },
            onOpen: function () {
                $('#swal-input1').focus(),
                swal.getInput().addEventListener('keyup', function(e) {
                    if(e.target.value === '') {
                        swal.disableConfirmButton();
                    } else {
                        swal.enableConfirmButton();
                    }
                })
            }
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result.value[0]);
                console.log(result.value[1]);
                $.ajax({
                    url: "<?= base_url('symptoms/update_symptom') ?>",
                    data: {
                        id: id,
                        name: result.value[0],
                        description : result.value[1],
                    },
                    dataType: "text",
                    cache: false,
                    method: 'POST',
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