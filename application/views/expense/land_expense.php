<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?=  $this->lang->line('all_expenses') ?></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                           <th><?=  $this->lang->line('expense') ?></th>
                            <th><?=  $this->lang->line('category') ?></th>
                            <th><?=  $this->lang->line('Land_Type') ?></th>
                            <th><?=  $this->lang->line('batch_no') ?></th>
                            <th><?=  $this->lang->line('area_no') ?></th>
                            <th><?=  $this->lang->line('date') ?></th>
                            <th><?=  $this->lang->line('amount') ?></th>
                            <th><?=  $this->lang->line('status') ?></th>
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




<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
    $(document).ready(function() {
        $("#amount").TouchSpin({
            min: 0,
            max: 9999999,
            step: 50,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            initval: 1
        });
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
        $('#mydt').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('expense/get_land_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                   "data": "name"
                },
                {
                    "data": "category"
                },
                
                {
                    "data": "land_type"
                },
                 {
                    "data": "batch_no"
                },
                 {
                    "data": "area_no"
                },
                {
                    "data": "date"
                },
                {
                    "data": "amount"
                },
                 {
                    "data": "status"
                },{
                    "data": "actions"
                }
            ]

        });
    });

    // Expense Delete Function
    $(document).on('click', ".btn-delete", function() {
        $expense_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Expense will be deleted",
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
                    url: "<?= base_url('expense/delete_expense/') ?>" + $expense_id,
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
        obj = this;
        $editing_id = $(obj).attr('code');
        $country_id = $(obj).attr('country');
        $province_id = $(obj).attr('province');
        // $obj = $(obj);
        ename = $(obj).parents('tr').children('td:first').text().trim();
        ecategory = $(obj).parents('tr').children('td').eq(1).text().trim();
        edate = $(obj).parents('tr').children('td').eq(2).text().trim();
        amount = $(obj).parents('tr').children('td').eq(3).text().trim();

        $("select#editing_expense_cat_id option").filter(function() {
            console.log("Compairing",$(this).text(),ecategory,$(this).text() == ecategory);
            if($(this).text() == ecategory){
                $('#editing_expense_cat_id').val($(this).val());
                $('#editing_expense_cat_id').select2().trigger('change');
                return true;
            }else{
                return false;
            }
        }).prop('selected', true);

        $('#editing_id').val($editing_id);
        $('#editing_name').val(ename);
        // $('#editing_expence_cat_id').text(ecategory);
        $('#editing_date').val(edate);
        $('#editing_amount').val(amount);

        $('#editModal').modal('show');

    });


    <?php if($this->input->post('id')){?>
        $('#editModal').modal('show');
    <?php } ?>
        $(document).on('click', ".btn-delete", function() {
        $edit_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Record will be deleted",
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
                    url: "<?= base_url('expense/delete_land_expense/') ?>" + $edit_id,
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
      $(document).on('click', ".btn-status", function() {
        var id = $(this).attr('code');
        var status = $(this).attr('data-status');
        var msg="";
        if(status==1){msg="Suspended";}else{msg="Active";}

        Swal.fire({
            title: 'are you sure ?',
            text: "This Record will be "+msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes! '+msg,
            cancelButtonText: 'No! Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-danger ml-2 mt-2',
            buttonsStyling: false
        }).then(function(action) {
            if (action.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('expense/updateStatus/') ?>",
                    method:'POST',
                    data:{id:id,status:status},
                    success: function(result) {},
                    complete: function(result) {
                        $('#mydt').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Success!',
                            text: 'Operation successfuly',
                            icon: 'success'
                        });
                    }
                });
            }
        });

    });
</script>