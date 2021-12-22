<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-octagon mr-2"></i>
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>
                <h4 class="card-title">Add Feed Category</h4>
                <?php echo form_open('feedcategory/index') ?>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Feed Category</label>
                            <input type="text" name="feedcategory" class="form-control" id="formrow-firstname-input">
                            <span class="text-danger"><?php echo form_error('feedcategory'); ?></span>
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

                <h4 class="card-title">Feed Category</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Feed Category</th>
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
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
        $('#mydt').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('feedcategory/get_list') ?>",
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

    // feed Delete Function
    $(document).on('click', ".btn-delete", function() {
        $feed_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Feed will be deleted",
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
                    url: "<?= base_url('feedcategory/delete_feed/') ?>" + $feed_id,
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
        $feed_id = $(this).attr('code');
        // $obj = $(this);
        feed_name = $(this).parents('tr').children('td:first').text().trim();

        Swal.fire({
            title: 'Update Feed Category',
            html: '<label class="text-left">Feed Category</label><input id="swal-input1" class="swal2-input" value="' + feed_name + '">',            confirmButtonText: 'Save',
            focusConfirm: false,
            inputValidator: (value) => {
                if (!(document.getElementById('swal-input1').value)) {
                    return 'You need to write something!';
                }
            },
            preConfirm: () => {
                return [document.getElementById('swal-input1').value];
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('feedcategory/update_feed/') ?>" + $feed_id,
                    method: 'POST',
                    data: {
                        name: result.value[0]
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