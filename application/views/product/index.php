<style>
    .avatar-lgx {
        height: 6rem;
    }

    .floatingButtonWrap {
        display: block;
        position: fixed;
        top: 135px;
        right: 45px;
        z-index: 999999999;
    }

    .floatingButtonInner {
        position: relative;
    }

    .floatingButton {
        display: block;
        width: 65px;
        height: 65px;
        text-align: center;
        background: -webkit-linear-gradient(45deg, #8769a9, #507cb3);
        background: -o-linear-gradient(45deg, #8769a9, #507cb3);
        background: linear-gradient(45deg, #8769a9, #507cb3);
        color: #fff;
        line-height: 64px;
        position: absolute;
        border-radius: 50% 50%;
        bottom: 0px;
        right: 0px;
        border: 5px solid #b2bedc;
        /* opacity: 0.3; */
        opacity: 1;
        transition: all 0.4s;
    }

    .floatingButton .fa {
        font-size: 22px !important;
    }

    .floatingButton.open,
    .floatingButton:hover,
    .floatingButton:focus,
    .floatingButton:active {
        opacity: 1;
        color: #fff;
    }


    .floatingButton .fa {
        transform: rotate(0deg);
        transition: all 0.4s;
    }

    .floatingButton.open .fa {
        transform: rotate(270deg);
    }

    .floatingMenu {
        position: absolute;
        top: 24px;
        right: 0px;
        /* width: 200px; */
        display: none;
    }

    .floatingMenu li {
        width: 100%;
        float: right;
        list-style: none;
        text-align: right;
        margin-bottom: 5px;
    }

    .floatingMenu li a {
        padding: 8px 15px;
        display: inline-block;
        background: #ccd7f5;
        color: #6077b0;
        border-radius: 5px;
        overflow: hidden;
        white-space: nowrap;
        transition: all 0.4s;
        /* -webkit-box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22);
    box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22); */
        -webkit-box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
        box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
    }

    .floatingMenu li a:hover {
        margin-right: 10px;
        text-decoration: none;
    }

    .text-truncate {
        font-size: 12px;
    }
    .card-title {
        margin: 0px 20px 15px 0px !important;
    }
</style>
<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-title">
            <a href="#" style="float:right; margin-top:15px !important; width:20%;" class="btn btn-success btn-sm waves-effect waves-light" id="add_product_btn" data-toggle='modal' data-target='.bs-example-modal-sm' onclick="$('.floatingButton').trigger('click');"><?=  $this->lang->line('Add_Item') ?></a>
            </div>
            <div class="card-body">
    
                <h4 class="card-title"><?=  $this->lang->line('items') ?></h4>
                <hr>
                <table id="mydt" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?=  $this->lang->line('name') ?></th>
                            <th><?=  $this->lang->line('code') ?></th>
                            <th><?=  $this->lang->line('expiry_date') ?></th>
                            <th><?=  $this->lang->line('Serial_Number') ?></th>
                            <th><?=  $this->lang->line('Sale_Units') ?></th>
                            <th><?=  $this->lang->line('Purchase_Units') ?></th>
                            <th><?=  $this->lang->line('product_category') ?></th>
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


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel"><?=  $this->lang->line('Add_Item') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('product/index') ?>
            <div class="modal-body">
                <div class="col-md-12">
        <div class="card">
            
            <div class="card-body">
                <h4 class="card-title"><?=  $this->lang->line('Add_Item') ?></h4>
                <?php echo form_open('product/index') ?>
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
                            <label class="control-label"><?=  $this->lang->line('Item_Category') ?> <span class="text-danger">*</span></label>
                            <select name="productcatid" required class="form-control select2" style="width:100%;">
                                <option value=""><?=  $this->lang->line('select_item_category') ?></option>
                                <?php foreach ($productcategory as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['product_category_name'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('productcatid'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-firstname-input"><?=  $this->lang->line('name') ?> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required id="formrow-firstname-input">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?=  $this->lang->line('code') ?></label>
                            <input type="text" name="code" value="<?= $code; ?>" readonly class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?=  $this->lang->line('expiry_date') ?></label>
                            <input type="date" name="expdate" class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('expdate'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-password-input"><?=  $this->lang->line('Serial_Number') ?></label>
                            <input type="text" name="snumber" class="form-control" id="formrow-password-input">
                            <span class="text-danger"><?php echo form_error('snumber'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('Purchase_Units') ?> <span class="text-danger">*</span></label>
                            <select name="purchaseunit" class="form-control select2" required style="width:100%;">
                                <option value=""><?=  $this->lang->line('select_purchase_unit') ?></option>
                                <?php foreach ($item_uom as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?> (<?= $c['symbol'] ?>)</option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('purchaseunit'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('sale_unit') ?> <span class="text-danger">*</span></label>
                            <select name="saleunit" class="form-control select2" required style="width:100%;">
                                <option value=""><?=  $this->lang->line('select_sale_unit') ?></option>
                                <?php foreach ($item_uom as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?> (<?= $c['symbol'] ?>)</option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('saleunit'); ?></span>
                        </div>
                       
                    </div>

                </div>


            </div>
        </div>
    </div> <!-- end col -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm waves-effect waves-light btn-block" type="submit"><i class="fa fa-check-circle"></i> Save</button>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
    $(document).ready(function() {
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });

        $('#mydt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('product/get_list') ?>",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "code"
                },

                {
                    "data": "expdate"
                },

                {
                    "data": "snumber"
                },
                {
                    "data": "saleunit"
                },
                {
                    "data": "purchaseunit"
                },
                {
                    "data": "productcatid"
                },

                {
                    "data": "actions"
                }
            ]

        });
    });


    $(document).on('click', ".btn-delete", function() {
        $product_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This Product will be deleted",
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
                    url: "<?= base_url('product/delete_product/') ?>" + $product_id,
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
    $(document).ready(function() {
        $('.floatingButton').on('click',
            function(e) {
                e.preventDefault();
                $(this).toggleClass('open');
                if ($(this).children('.fa').hasClass('fa-plus')) {
                    $(this).children('.fa').removeClass('fa-plus');
                    $(this).children('.fa').addClass('fa-times');
                } else if ($(this).children('.fa').hasClass('fa-times')) {
                    $(this).children('.fa').removeClass('fa-times');
                    $(this).children('.fa').addClass('fa-plus');
                }
                $('.floatingMenu').stop().slideToggle();
            }
        );
        $(this).on('click', function(e) {
            var container = $(".floatingButton");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && $('.floatingButtonWrap').has(e.target).length === 0) {
                if (container.hasClass('open')) {
                    container.removeClass('open');
                }
                if (container.children('.fa').hasClass('fa-times')) {
                    container.children('.fa').removeClass('fa-times');
                    container.children('.fa').addClass('fa-plus');
                }
                $('.floatingMenu').hide();
            }
        });
    });
</script>