<div class="row">
    <style>
           .datepicker{z-index:1151 !important;border: 1px solid lightgrey !important;}
    </style>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Land Management List</h4>

                <hr>

                <div class="row">

                    <div class="col-md-6 col-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Land Type</label>
                            <select style="width:100%" class="form-control select2" onchange="hide_show_list()" name="land_type" id="land_type">
                                <option value="">Select Land Type</option>
                                <?php foreach ($landType as $lt) { ?>
                                    <option value="<?= $lt['id'] ?>"><?= $lt['land_management_data'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>


            
        </div>

        <div class="card">
            <div class="card-body">
                <div class="card-body" id="owned_list">
                    <h4 class="card-title">Land Management</h4>
                    <table id="ownedListTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Purchase Date</th>
                                <th>Type Of Land</th>
                                <th>Value Per Unit</th>
                                <th>UOM</th>
                                <th>Crops Taken</th>
                                <th>Adjoint Section</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>


                <div class="card-body" id="leased_list" style="display:none;">
                    <h4 class="card-title">Leased Management</h4>
                    <table id="leasedListTable" class="table table-striped table-bordered table-condensed dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Contract Date</th>
                                <th>Contract Reg No</th>
                                <th>Type Of Land</th>
                                <th>Payment Method</th>
                                <th>Payment Term</th>
                                <th>Meter Number</th>
                                <th>Last Bill</th>
                                <th>Adjoint Section</th>
                                <th>Witness Detail</th>
                                <th>Owner Section</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>


                <div class="card-body" id="rent_list"  style="display:none;">
                    <h4 class="card-title">Rent Management</h4>
                    <table id="rentListTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>Rent Tenure</th>
                                <th>Rent Reg No</th>
                                <th>Rent Amount</th>
                                <th>Type Of Land</th>
                                <th>Payment Method</th>
                                <th>Payment Term</th>
                                <th>Meter Number</th>
                                <th>Last Bill</th>
                                <th>Adjoint Section</th>
                                <th>Owner Section</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div> <!-- end row -->
        <!-- Edit Model -->
        <div id="myModal"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 950px !important;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="float: right;
    margin-left: -22px;">&times;</button>
          <h4 class="modal-title">Witness Record</h4>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-info updateRecord">Update</button> -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Edit Model End Here -->

      <!-- Owner Model -->
        <div id="ownerModal"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ownerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 950px !important;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="float: right;
    margin-left: -22px;">&times;</button>
          <h4 class="modal-title">Owner Record</h4>
        </div>
        <div class="modal-body ownerModalBody">
          
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-info updateRecord">Update</button> -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Edit Model End Here -->
   <!-- Owner Model -->
        <div id="adjointModal"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="adjointModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 950px !important;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="float: right;
    margin-left: -22px;">&times;</button>
          <h4 class="modal-title">Adjoint Record</h4>
        </div>
        <div class="modal-body adjointModalBody">
          
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-info updateRecord">Update</button> -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Edit Model End Here -->


<script>
$(document).ready(function() {
    $(".select2").select2({
        width: 'resolve' // need to override the changed default
    });


    $(document).on('click','.witnessBtn',function(){
        // alert()
         var code = $(this).attr('code');
         $.ajax({
             url: '<?= base_url('Land_record_list/GetWitness/') ?>',
             type: 'POST',
             data: {id: code},
             success:function(data)
             {
                $('.modal-body').html(data)
             }
         })
        $("#myModal").modal();
    })
     $(document).on('click','.ownerBtn',function(){
        // alert()
         var code = $(this).attr('code');
         $.ajax({
             url: '<?= base_url('Land_record_list/GetOwner/') ?>',
             type: 'POST',
             data: {id: code},
             success:function(data)
             {
                $('.ownerModalBody').html(data)
             }
         })
        $("#ownerModal").modal();
    })
         $(document).on('click','.adjointBtn',function(){
        // alert()
         var code = $(this).attr('code');
         var formcode = $(this).attr('formcode');
         // alert(code)
         $.ajax({
             url: '<?= base_url('Land_record_list/GetAdjoint/') ?>',
             type: 'POST',
             data: {id: code,formcode:formcode},
             success:function(data)
             {
                $('.adjointModalBody').html(data)
             }
         })
        $("#adjointModal").modal();
    })

         // Leased Delete Function
    $(document).on('click', ".btn-delete", function() {
        var id = $(this).attr('code');
        var formcode = $(this).attr('formcode');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Leased Land Record will be deleted",
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
                    url: "<?= base_url('Land_record_list/delete_land_type/') ?>",
                    method:'post',
                    data:{id:id,formcode:formcode},
                    success: function(result) {},
                    complete: function(result) {
                        if(formcode=='Leased Form')
                        {
                            $('#leasedListTable').DataTable().ajax.reload();
                        }
                        else if(formcode=='Owned Form')
                        {
                            $('#ownedListTable').DataTable().ajax.reload();
                        }
                        else{
                            $('#rentListTable').DataTable().ajax.reload();
                        }
                        
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
///////////////////////////////////////////////////////////////////////////////
// OWNED LAND TABLE END
//////////////////////////////////////////////////////////////////////////////
    $('#ownedListTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('land_record_list/get_owned_land_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "purchase_date"
                },
                {
                    "data": "type_of_land"
                },
                {
                    "data": "value_per_unit"
                },

                {
                    "data": "area_uom"
                },
                {
                    "data": "crops_taken"
                },
                {
                    "data": "adjoint_section"
                },
                {
                    "data": "actions"
                }
                
            ]

        });
///////////////////////////////////////////////////////////////////////////////
// OWNED LAND TABLE END
//////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// LEASED LAND TABLE START
//////////////////////////////////////////////////////////////////////////////

        $('#leasedListTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('land_record_list/get_leased_land_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "contract_date"
                },
                {
                    "data": "contract_reg_number"
                },
                {
                    "data": "type_of_land_leased"
                },
                {
                    "data": "payment_method"
                },
                {
                    "data": "payment_term"
                },
                {
                    "data": "meter_number"
                },
                {
                    "data": "last_meter_reading_before_handover"
                },
                {
                    "data": "adjoint_section"
                },
                  {
                    "data": "witness_detail"
                },
                {
                    "data": "owner_section"
                },
                {
                    "data": "actions"
                }
            ]

        });

///////////////////////////////////////////////////////////////////////////////
// LEASED LAND TABLE END
//////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// RENT LAND TABLE START
//////////////////////////////////////////////////////////////////////////////

        $('#rentListTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('land_record_list/get_rent_land_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [
                {
                    "data": "rent_start_date"
                },
                {
                    "data": "rent_tenure"
                },
                {
                    "data": "rent_reg_number"
                },
                {
                    "data": "rent_amount"
                },
                {
                    "data": "type_of_land_rent"
                },
                {
                    "data": "payment_method_rent"
                },
                {
                    "data": "payment_term_rent"
                },
                {
                    "data": "meter_number_rent"
                },
                {
                    "data": "last_bill_before_handover_rent"
                },
                // {
                //     "data": "adjoint_section"
                // },
                {
                    "data": "owner_section"
                },
                {
                    "data": "actions"
                }
            ]

        });

///////////////////////////////////////////////////////////////////////////////
// RENT LAND TABLE END
//////////////////////////////////////////////////////////////////////////////
});

function hide_show_list() {
        var text = $("#land_type option:selected" ).text();
        
        if(text == "Leased"){
            $("#owned_list").hide('500');
            $("#leased_list").show('500');
            $("#rent_list").hide('500');
        } else if (text == "Owned"){
            $("#owned_list").show('500');
            $("#leased_list").hide('500');
            $("#rent_list").hide('500');
        } else if (text == "Rent"){
            $("#owned_list").hide('500');
            $("#leased_list").hide('500');
            $("#rent_list").show('500');
        } else {
            // $("#form_of_owner").hide();
            // $("#form_of_leased").hide();
            // $("#form_of_rent").hide();
        }
    }


// function hide_show_form() {
//         var text = $("#land_type option:selected" ).text();
        
// }



</script>