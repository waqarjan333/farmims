<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $this->lang->line('add_account'); ?></h4>
                <hr>
                <?php echo form_open_multipart('Finance/index') ?>
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
                                <label for="formrow-firstname-input"><?= $this->lang->line('select_account_type'); ?><span class="text-danger">*</span></label>
                                <select name="accountType" class="form-control" id="">
                                    <option value="">Select Account</option>
                                   <?php foreach($accountType as $account){ ?>
                                        <option value="<?php echo $account->id ?>"><?php echo  $account->account_name ?></option>
                                   <?php } ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('accountType'); ?></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('account_name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" name="account_name" class="form-control" id="">
                                <span class="text-danger"><?php echo form_error('account_name'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('account_no'); ?> <span class="text-danger">*</span></label>
                                <input type="text" name="account_no" class="form-control" id="">
                                <span class="text-danger"><?php echo form_error('account_no'); ?></span>
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

                <h4 class="card-title">Users</h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Account Type</th>
                            <th>Account Name</th>
                            <th>Account No</th>
                            <th>Status</th>
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
  <!-- Owner Model -->
        <div id="EditModal"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ownerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 950px !important;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="float: right;
    margin-left: -22px;">&times;</button>
          <h4 class="modal-title">Update Record</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('select_account_type'); ?><span class="text-danger">*</span></label>
                                <select name="accountType" class="form-control" id="editaccount_type">
                                    <option value="">Select Account</option>
                                   <?php foreach($accountType as $account){ ?>
                                        <option value="<?php echo $account->id ?>"><?php echo  $account->account_name ?></option>
                                   <?php } ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('accountType'); ?></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('account_name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" name="account_name" class="form-control" id="editaccount_name">
                                <span class="text-danger"><?php echo form_error('account_name'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formrow-firstname-input"><?= $this->lang->line('account_no'); ?> <span class="text-danger">*</span></label>
                                <input type="text" name="account_no" class="form-control" id="editaccount_no">
                                <span class="text-danger"><?php echo form_error('account_no'); ?></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="editID">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info updateRecord">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



<script>
    function select_img() {
        $('#prof_img').trigger('click');
    }

    function get_file_name() {
        var filename = $('#prof_img').val().split('\\').pop();
        $('#select_file_btn').html(filename);
        // console.log(filename);
    }
    $(document).ready(function() {

        $('.s2ss').select2({
            placeholder: 'Search Farm User Has Access To',
            ajax: {
                url: '<?= base_url('farm/get_search_dd') ?>',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });


        $('#mydt').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('Finance/get_finance') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "account_type"
                },
                {
                    "data": "account_name"
                },

                {
                    "data": "account_no"
                },
                {
                    "data": "status"
                },
                {
                    "data": "actions"
                }
            ]

        });
    });

    // User Delete Function
    $(document).on('click', ".btn-delete", function() {
        $id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This User will be deleted",
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
                    url: "<?= base_url('Finance/delete_account/') ?>" + $id,
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
        if(status==1){msg="Suspend";}else{msg="Active";}

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
                    url: "<?= base_url('Finance/updateStatus/') ?>",
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
     $(document).on('click','.btn-edit',function(){
        // alert()
         var code = $(this).attr('code');
         $('#editID').val(code)
         var account_name = $(this).parents('tr').children('td').eq(1).text().trim();
         var account_no = $(this).parents('tr').children('td').eq(2).text().trim();
         var account_typeText = $(this).parents('tr').children('td').eq(0).text().trim();
         var account_type = document.getElementById('editaccount_type').options;
         var account_type_select_option = '';

        account_type.forEach(element => {
            account_type_select_option += '<option value="' + element.value + '"';

            if (element.text == account_typeText) {
                account_type_select_option += " selected ";
            }
            account_type_select_option += ">" + element.text + "</option>";
        });
        $('#editaccount_type').html('');
        $('#editaccount_type').append(account_type_select_option)
        // console.log(account_type_select_option);
        $('#editaccount_name').val(account_name);
         $('#editaccount_no').val(account_no);
            $("#EditModal").modal();




         
    })
     $(document).on('click','.updateRecord',function(){
        var code=$('#editID').val();
        // alert(code);
         var editAccType=$('#editaccount_type').val();
            var editAccName=$('#editaccount_name').val();
            var editAccNo=$('#editaccount_no').val();
         $.ajax({
             url: '<?= base_url('Finance/UpdateAccount/') ?>',
             type: 'POST',
             data: {type: editAccType,name:editAccName,no:editAccNo,id:code},
             success:function(data)
             {
                $('#mydt').DataTable().ajax.reload();
                // $('.ownerModalBody').html(data)
                $("#EditModal").modal('hide');
             }
         })
     })
    <?php if ($this->input->post('id')) { ?>
        $('#userModal').modal('show');
    <?php } ?>
</script>