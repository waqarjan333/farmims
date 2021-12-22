<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add City</h4>
                <?php echo form_open('city/index') ?>

                <div class="row">
                <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="uil uil-exclamation-octagon mr-2"></i>
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="formrow-firstname-input">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="formrow-firstname-input">
                        </div>
                        <span class="text-danger"><?php echo form_error('name'); ?></span>
                        <div class="form-group">
                        <label for="formrow-firstname-input">Country<span class="text-danger">*</span></label>
                            <select id="country_id" onchange="get_province_by_country_id()" name="country_id" class="form-control select2">
                                <option value="">Select Country</option>
                            <?php foreach ($countries as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['country_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('country_id'); ?></span>
                        </div>
                        <div class="form-group">
                        <label for="formrow-firstname-input">Province<span class="text-danger">*</span></label>
                            <select name="province_id" id="province_dd" class="form-control select2">
                                <option value="">Select Country First</option>
                            </select>
                            
                            <span class="text-danger"><?php echo form_error('province_id'); ?></span>
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

                <h4 class="card-title">Cities</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>Province</th>
                            <th>Action</th>
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
    function get_province_by_country_id() {
        $.ajax({
            url: "<?=base_url('city/get_province_by_country_id/')?>"+$('#country_id').val(),
            success: function(result) {
                $("#province_dd").html(result);
            }
        });
    }

    function get_province_by_country_id_u() {
        $.ajax({
            url: "<?=base_url('city/get_province_by_country_id/')?>"+document.getElementById('swal-input2').value,
            success: function(result) {
                $("#swal-input3").html(result);
            }
        });
    }

    $(document).ready(function() {
        $('#mydt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('city/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "name"
                }, 
                {
                    "data": "province"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

    // City Delete Function
    $(document).on('click', ".btn-delete", function() {
        $city_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This City will be deleted",
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
                    url: "<?= base_url('city/delete_city/') ?>" + $city_id,
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
        $city_id = $(this).attr('code');
        $country_id = $(this).attr('country');
        $province_id = $(this).attr('province');
        // $obj = $(this);
        city = $(this).parents('tr').children('td:first').text().trim();
        province = $(this).parents('tr').children('td').eq(1).text().trim();

        countries = document.getElementById('country_id').options;
        countries_select_option = '';

        countries.forEach(element => {
            countries_select_option += '<option value="' + element.value + '"';

            if (element.value == country_id) {
                countries_select_option += " selected ";
            }
            countries_select_option += ">" + element.text + "</option>";
        });

        console.log(countries_select_option);

        Swal.fire({
            title: 'Update City',
            html: '<input id="swal-input1" class="swal2-input" value="' + city + '">' +
                '<select id="swal-input2" class="swal2-input" id="country_id_u" onchange="get_province_by_country_id_u()">' + countries_select_option + '</select>'+
                '<select id="swal-input3" class="swal2-input"></select>',
            confirmButtonText: 'Save',
            focusConfirm: false,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value,
                    document.getElementById('swal-input3').value
                ]
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('city/update_city/') ?>" + $city_id,
                    method: 'POST',
                    data: {
                        name: result.value[0],
                        country_id: result.value[1],
                        province_id:result.value[2]
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



    // Edit
    $(document).on('click', ".btn-edit", function() {
        $city_id = $(this).attr('code');
        $country_id = $(this).attr('country');
        $province_id = $(this).attr('province');
        // $obj = $(this);
        city = $(this).parents('tr').children('td:first').text().trim();
        province = $(this).parents('tr').children('td').eq(1).text().trim();

        countries = document.getElementById('country_id').options;
        countries_select_option = '';

        countries.forEach(element => {
            countries_select_option += '<option value="' + element.value + '"';

            if (element.value == country_id) {
                countries_select_option += " selected ";
            }
            countries_select_option += ">" + element.text + "</option>";
        });

        console.log(countries_select_option);

        Swal.fire({
            title: 'Update City',
            html: '<input id="swal-input1" class="swal2-input" value="' + city + '">' +
                '<select id="swal-input2" class="swal2-input" id="country_id_u" onchange="get_province_by_country_id_u()">' + countries_select_option + '</select>'+
                '<select id="swal-input3" class="swal2-input"></select>',
            confirmButtonText: 'Save',
            focusConfirm: false,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value,
                    document.getElementById('swal-input3').value
                ]
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('city/update_city/') ?>" + $city_id,
                    method: 'POST',
                    data: {
                        name: result.value[0],
                        country_id: result.value[1],
                        province_id:result.value[2]
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
