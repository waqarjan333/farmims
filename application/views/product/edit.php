<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-4">
        <div class="card">
        <div class="card-body">
                <h4 class="card-title"><?=  $this->lang->line('Add_Item') ?></h4>
                <?php echo form_open() ?>
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
                                    <option value="<?= $c['id'] ?>" <?php if($c['id']==$item->product_category_id){echo 'selected';}?>><?= $c['product_category_name'] ?></option>
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
                            <input type="text" name="name" value="<?= $item->product_name ?>" class="form-control" required id="formrow-firstname-input">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?=  $this->lang->line('code') ?></label>
                            <input type="text" name="code" value="<?= $item->product_code; ?>" readonly class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?=  $this->lang->line('expiry_date') ?></label>
                            <input type="date" name="expdate" value="<?= $item->expiry_date?>" class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('expdate'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-password-input"><?=  $this->lang->line('Serial_Number') ?></label>
                            <input type="text" name="snumber" value="<?= $item->serial_number ?>" class="form-control" id="formrow-password-input">
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
                                    <option value="<?= $c['id'] ?>" <?php if($c['id']==$item->purchase_unit){echo 'selected';}?>><?= $c['name'] ?> (<?= $c['symbol'] ?>)</option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('purchaseunit'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><?=  $this->lang->line('Sale_Units') ?> <span class="text-danger">*</span></label>
                            <select name="saleunit" class="form-control select2" required style="width:100%;">
                                <option value=""><?=  $this->lang->line('select_sale_unit') ?></option>
                                <?php foreach ($item_uom as $c) { ?>
                                    <option value="<?= $c['id'] ?>" <?php if($c['id']==$item->sale_unit){echo 'selected';}?>><?= $c['name'] ?> (<?= $c['symbol'] ?>)</option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('saleunit'); ?></span>
                        </div>
                       
                    </div>
                    <div class="col-md-12">
                    <button class="btn btn-block btn-success"><?=  $this->lang->line('update') ?></button>
                    </div>

                </div>


            </div>
        </div>
    </div> <!-- end col -->

</div> <!-- end row -->
<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
    $(document).ready(function() {
        // Set Default Exp Date
        $('#expdate').val(new moment().add(1, 'M').format('YYYY-MM-DD'));
    });
</script>