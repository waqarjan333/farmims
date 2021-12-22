<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?=  $this->lang->line('add_new_expense_category') ?></h4>
                <?php echo form_open('expense_category/index') ?>
                <div class="form-group">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="uil uil-exclamation-octagon mr-2"></i>
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>
                    <label for="formrow-firstname-input"><?=  $this->lang->line('category_name') ?></label>
                    <input type="text" name="name" class="form-control" id="formrow-firstname-input">
                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>

                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?=  $this->lang->line('save') ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?=  $this->lang->line('expense_categories') ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?=  $this->lang->line('name') ?></th>
                            <th><?=  $this->lang->line('action') ?></th>
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
                "url": "<?php echo base_url('expense_category/get_list') ?>",
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


    // Expense Category Delete Function
    $(document).on('click', ".btn-delete", function() {
        $expense_category_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Expense Category will be deleted",
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
                    url: "<?= base_url('expense_category/delete_expense_category/') ?>" + $expense_category_id,
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
        $expense_category_id = $(this).attr('code');

        expense_category = $(this).parents('tr').children('td:first').text().trim();

        Swal.fire({
            title: 'Update Expense Category',
            html: '<input id="swal-input1" class="swal2-input" value="' + expense_category + '">',
            confirmButtonText: 'Save',
            focusConfirm: false,
            preConfirm: () => {
                return document.getElementById('swal-input1').value;
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('expense_category/update_expense_category/') ?>" + $expense_category_id,
                    method: 'POST',
                    data: {
                        name: result.value
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