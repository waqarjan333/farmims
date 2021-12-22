<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Product Category</h4>
                <?php echo form_open('productcategory/index') ?>
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
                    <label for="formrow-firstname-input">Name</label>
                    <input type="text" name="productcategory" class="form-control" id="formrow-firstname-input">
                    <span class="text-danger"><?php echo form_error('productcategory'); ?></span>
                </div>
   
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Product category</h4>
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
                "url": "<?php echo base_url('productcategory/get_list') ?>",
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

    // Productcategory Delete Function
    $(document).on('click', ".btn-delete", function() {
            $productcategory_id = $(this).attr('code');
            Swal.fire({
                title: 'are you sure ?',
                text: "This Product Category will be deleted",
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
                        url: "<?= base_url('productcategory/delete_productcategory/') ?>" + $productcategory_id,
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
        $productcategory_id = $(this).attr('code');
        productcategory = $(this).parents('tr').children('td:first').text().trim();

        Swal.fire({
            title: 'Update Product Category',
            html: '<input id="swal-input1" class="swal2-input" value="' + productcategory + '">',
            confirmButtonText: 'Save',
            focusConfirm: false,
            preConfirm: () => {
                return document.getElementById('swal-input1').value;
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('productcategory/update_productcategory/') ?>" + $productcategory_id,
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