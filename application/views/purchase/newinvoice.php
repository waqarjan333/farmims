<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?=  $this->lang->line('create_invoice') ?></h4>
                <?php echo form_open('purchase/newinvoice', array('id' => 'po-form')) ?>
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
                    <div class="col-md-3 ">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('invoice_type') ?> <span class="text-danger">*</span></label>
                            <div class="form-check mb-3">
                                <input <?php if ($this->input->post('invoice_type') == INVOICE_CREDIT) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="invoice_type" id="invoice_credit" value="<?= INVOICE_CREDIT ?>" checked>
                                <label class="form-check-label" for="invoice_credit">
                                    <?=  $this->lang->line('credit') ?>
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input <?php if ($this->input->post('invoice_type') == INVOICE_CASH) {
                                            echo 'checked';
                                        } ?> class="form-check-input" type="radio" name="invoice_type" id="invoice_cash" value="<?= INVOICE_CASH ?>">
                                <label class="form-check-label" for="invoice_cash">
                                    <?=  $this->lang->line('cash') ?>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label><?=  $this->lang->line('date') ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input required type="text" id='date' value="<?= ($this->input->post('date')) ? $this->input->post('date') : date('d M, y') ?>" name="date" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="formrow-password-input"><?=  $this->lang->line('invoice_no') ?></label>
                            <input required type="text" name="show_invoice_no" value="<?= 'PI-' . sprintf('%02d', $order_no )?>" class="form-control" id="show_invoice_no">
                            <input type="hidden" value="<?php echo $order_no ?>" name="invoice_no">
                            <span class="text-danger"><?php echo form_error('invoice_no'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('supplier') ?> <span class="text-danger">*</span></label>
                            <select required name="supplier_id" id="supplier_id" onchange="get_supplier_invoices()" class="form-control select2">
                                <option  value="">--<?=  $this->lang->line('select_supplier') ?>--</option>
                                <?php foreach ($suppliers as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['partie_name'] . "( " . $c['partie_code'] . " )"; ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('productcatid'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('po_number') ?> <span class="text-danger">*</span></label>
                            <select onchange="get_po_details()" required name="po_id" id="po_id" class="form-control select2">
                                <option value="">--<?=  $this->lang->line('select_purchase_order') ?>--</option>
                                

                            </select>
                            <span class="text-danger"><?php echo form_error('productcatid'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row" id="podetails" style="display: none;">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?=  $this->lang->line('po_date') ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input readonly type="text" class="form-control" id='podate'>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-password-input"><?=  $this->lang->line('po_supplier_name') ?></label>
                            <input readonly type="text" class="form-control" id="po_supplier">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-password-input"><?=  $this->lang->line('phone_no') ?></label>
                            <input readonly type="text" class="form-control" id="po_supplier_number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('products') ?> <small>(<?=  $this->lang->line('multiple') ?>)</small></label>
                            <select id="product" name="products[]" class="form-control select2" multiple>
                                <?php foreach ($products as $c) { ?>
                                    <option data-price="<?= $c['purchase_price'] ?>" data-procode="<?= $c['product_code'] ?>" data-procode="<?= $c['product_code'] ?>" value="<?= $c['id'] ?>"><?= $c['product_name'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('productcatid'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?=  $this->lang->line('product_code') ?></th>
                                    <th><?=  $this->lang->line('product_name') ?></th>
                                    <th><?=  $this->lang->line('uom') ?></th>
                                    <th><?=  $this->lang->line('qty') ?></th>
                                    <th><?=  $this->lang->line('rate') ?></th>
                                    <th><?=  $this->lang->line('amount') ?></th>
                                </tr>
                            </thead>
                            <tbody id="product_list">

                                <tr>
                                    <td colspan="5"></td>
                                    <td>Total: <span id="net_total">0</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <input type="hidden" name="net_total" id="net_total_input">
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
    $(document).ready(function() {
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
    });

    function get_po_details() {
        $.ajax({
            url: "<?= base_url('purchase/get_po_details/') ?>" + $('#po_id').val(),
            success: function(result) {
                $('#podetails').show(500);
                data = JSON.parse(result);
                $('#podate').val(data.date);
                $('#po_supplier').val(data.party_name);
                $('#po_supplier_number').val(data.phone_no);
                var options = [];
                $.each(data.po_details, function(index, value) {
                    console.log(value)
                    options.push(value.product_id)
                     var productID=value.product_id;
                   $("#product option[value='"+productID+"']").attr("data-price",value.rate);
                   $("#product option[value='"+productID+"']").attr("data-qty",value.qty);
                   $("#product option[value='"+productID+"']").attr("data-uom",value.uom);
                   $("#product option[value='"+productID+"']").attr("data-pid",value.product_id);
                });
                $('#product').val(options);
                $('#product').trigger('change');
            }
        });
    }

    $('#product').on('change', function(e) {
        var cacheEle = $('#product_list');
        $(this).find('option').each(function(index, element) {
            if (element.selected) {
                if (cacheEle.find('#poitem' + element.value).length == 0) {
                    console.log($(this).val())
                    cacheEle.prepend('<tr id="poitem' + element.value + '">' +
                        '<td>' + $(this).data('procode') + '</td>' +
                        '<td>' + $(this).text() + '</td>' +
                        '<td><select id="siuom'+element.value+'"  required class="form-group form-control" type="text" name="uom[' + element.value + ']">'+
                        '<?php foreach($units as $u) {   ?> '+
                        '<option value="<?php echo $u['id']?>"  ><?php echo $u['name']; ?></option>'+

                        '<?php } ?>'+
                      '</select></td>'+
                        '<td><input required class="form-group form-control" value="'+$(this).data('qty')+'" id="qty' + element.value + '" onchange="rowtotal(' + element.value + ')" type="text" data-toggle="touchspin" name="qty[' + element.value + ']" placeholder="Quantity"></td>' +
                        '<td><input required class="form-group form-control" value='+ $(this).data('price') +' id="rate' + element.value + '" onchange="rowtotal(' + element.value + ')" type="text" data-toggle="touchspin" name="rate[' + element.value + ']" placeholder="Rate"></td>' +
                        '<td class="rowtotal" id="rowtotal' + element.value + '">0.00</td>' +
                        '</tr>');
                    $("#qty" + element.value).TouchSpin({
                        min: 0,
                        max: 9999999,
                        step: 0.1,
                        decimals: 2,
                        boostat: 5,
                        maxboostedstep: 10,
                        initval: 1
                    });
                    $("#rate" + element.value).TouchSpin({
                        min: 0,
                        max: 9999999,
                        step: 0.1,
                        decimals: 2,
                        boostat: 5,
                        maxboostedstep: 10,
                        prefix: 'Pkr',
                        initval: 0
                    });
                    var pID=$(this).data('pid');
                    var puom=$(this).data('uom');
                    // alert("#siuom"+pID+ " option[value='2']");
                    $("#siuom"+pID+ " option[value='"+puom+"']").attr('selected','selected'); 
                }
            } else {
                cacheEle.find('#poitem' + element.value).remove();
            }
        });
    });

    function get_supplier_invoices() {
        $.ajax({
            url: "<?= base_url('purchase/get_supplier_invoices/') ?>" + $('#supplier_id').val(),
            success: function(result) {
                $("#po_id").html(result);
            }
        });
    }
    function rowtotal(id) {
        var qty = parseFloat($('#qty' + id).val());
        var rate = parseFloat($('#rate' + id).val());
        var rowtot = rate * qty;
        var net_total = 0;
        $('#rowtotal' + id).html(rowtot.toFixed(2));
        $('.rowtotal').each(function(i, element) {
            net_total = net_total + parseFloat($(this).text());
        });
        $('#net_total').html(net_total);
        $('#net_total_input').val(net_total);
    }
</script>