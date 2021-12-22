<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Province</h4>

                <?php echo form_open('province/index') ?>
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
                    <input type="text" name="name" class="form-control" id="formrow-firstname-input">
                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>
                <div class="form-group">
                    <label class="control-label">Country<span class="text-danger">*</span></label>
                    <select name="country_id" id="countries_select" class="form-control select2 custom-select">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $c) { ?>
                            <option value="<?= $c['id'] ?>"><?= $c['country_name'] ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('country_id'); ?></span>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">All Provinces</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
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
                "url": "<?php echo base_url('province/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "country"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

    // province Delete Function
    $(document).on('click', ".btn-delete", function() {
        $province_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Province will be deleted",
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
                    url: "<?= base_url('province/delete_province/') ?>" + $province_id,
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
        $province_id = $(this).attr('code');
        // $obj = $(this);
        province = $(this).parents('tr').children('td:first').text().trim();
        country = $(this).parents('tr').children('td').eq(1).text().trim();

        countries = document.getElementById('countries_select').options;
        countries_select_option = '';

        countries.forEach(element => {
            countries_select_option += '<option value="' + element.value + '"';

            if (element.text == country) {
                countries_select_option += " selected ";
            }
            countries_select_option += ">" + element.text + "</option>";
        });

        console.log(countries_select_option);

        Swal.fire({
            title: 'Update Province',
            html: '<input id="swal-input1" class="swal2-input" value="' + province + '">' +
                '<select id="swal-input2" class="swal2-input">' + countries_select_option + '</select>',
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
                    url: "<?= base_url('province/update_province/') ?>" + $province_id,
                    method: 'POST',
                    data: {
                        name: result.value[0],
                        country_id: result.value[1]
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