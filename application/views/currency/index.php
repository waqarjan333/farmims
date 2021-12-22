<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Currency</h4>
                <?php echo form_open('currency/index') ?>
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formrow-firstname-input">Symbol <span class="text-danger">*</span></label>
                        <input type="text" name="symbol" class="form-control" id="formrow-firstname-input">
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

                <h4 class="card-title">Currency</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Symbol</th>
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
                "url": "<?php echo base_url('currency/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "symbol"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });


    // currency Delete Function
    $(document).on('click', ".btn-delete", function() {
        $currency_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Currency will be deleted",
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
                    url: "<?= base_url('currency/delete_currency/') ?>" + $currency_id,
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
        $currency_id = $(this).attr('code');
        // $obj = $(this);
        currency_name = $(this).parents('tr').children('td:first').text().trim();
        currency_symbol = $(this).parents('tr').children('td').eq(1).text().trim();

        Swal.fire({
            title: 'Update Currency',
            html: '<label class="text-left">Currency Name</label><input id="swal-input1" class="swal2-input" value="' + currency_name + '">' +
                '<label class="text-left">Currency Symbol</label><input id="swal-input2" class="swal2-input" value="' + currency_symbol + '">',
            confirmButtonText: 'Save',
            focusConfirm: false,
            inputValidator: (value) => {
                if (!(document.getElementById('swal-input1').value || document.getElementById('swal-input2').value)) {
                    return 'You need to write something!';
                }
            },
            preConfirm: () => {
                return [document.getElementById('swal-input1').value, document.getElementById('swal-input2').value];
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('currency/update_currency/') ?>" + $currency_id,
                    method: 'POST',
                    data: {
                        name: result.value[0],
                        symbol: result.value[1]
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