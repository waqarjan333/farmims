<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $this->lang->line('add_animal_bread') ?></h4>
                <?php echo form_open('animalbreed/index') ?>
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
                        <div class="form-group">
                            <label class="control-label"><?php echo $this->lang->line('name') ?> <span class="text-danger">*</span></label>
                            <input type="text" name="animalbreed" class="form-control" id="formrow-password-input">
                            <span class="text-danger"><?php echo form_error('animalbreed'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> <?php echo $this->lang->line('animal_type') ?> <span class="text-danger">*</span></label>
                            <select name="animaltype" id="animaltypeid" class="form-control select2">
                                <option value=""><?php echo $this->lang->line('select_animal_type') ?></option>
                                <?php foreach ($animaltypeid as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['animal_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('animaltype'); ?></span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?php echo $this->lang->line('save') ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?php echo $this->lang->line('animal_bread') ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('name') ?></th>
                            <th><?php echo $this->lang->line('animal_type') ?></th>
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
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
        $('#mydt').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('animalbreed/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "animal_type"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

     // Animaltype Delete Function
     $(document).on('click', ".btn-delete", function() {
        $animalbreed_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Animal breed will be deleted",
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
                    url: "<?= base_url('animalbreed/delete_animalbreed/') ?>" + $animalbreed_id,
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
        $animabreed_id = $(this).attr('code');
        // $obj = $(this);
        animabreed = $(this).parents('tr').children('td:first').text().trim();
        breed_type = $(this).parents('tr').children('td').eq(1).text().trim();

        breed_types = document.getElementById('animaltypeid').options;
        breed_types_select_option = '';

        breed_types.forEach(element => {
            breed_types_select_option += '<option value="' + element.value + '"';

            if (element.text == breed_type) {
                breed_types_select_option += " selected ";
            }
            breed_types_select_option += ">" + element.text + "</option>";
        });

        console.log(breed_types_select_option);

        Swal.fire({
            title: 'Update Anima Breed',
            html: '<input id="swal-input1" class="swal2-input" value="' + animabreed + '">' +
                '<select id="swal-input2" class="swal2-input">' + breed_types_select_option + '</select>',
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
                    url: "<?= base_url('animalbreed/update_animabreed/') ?>" + $animabreed_id,
                    method: 'POST',
                    data: {
                        breedname: result.value[0],
                        breedtype: result.value[1]
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