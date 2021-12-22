<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-body">
            <?php echo form_open() ?>

                <div class="row">

                    <div class="col-md-4 col-4">
                        <div class="form-group">
                            <label><?=  $this->lang->line('date') ?> <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id='todate' name="todate" value="<?= ($this->input->post('todate')) ? $this->input->post('todate') : date('Y-m-d') ?>" name="todate" required class="form-control" data-provide="datepicker" data-date-format="MM yy" data-date-autoclose="true">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                            <span class="text-danger"><?php echo form_error('todate'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4 col-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?php echo $this->lang->line('category') ?></label>
                            <select name="category_product" id="category_product_id" onchange="get_category_products()" class="form-control select2" style="width: 100%">
                                <option value=""><?php echo $this->lang->line('select_category') ?></option>
                                <?php foreach ($product_categories as $category) { ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['product_category_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?php echo $this->lang->line('products') ?></label>
                            <select class="form-control select2" name="product_id" id="products">
                                <option value=""><?php echo $this->lang->line('select_product') ?></option>
                             </select>
                        </div>
                    </div>
                    <button class="btn btn-success btn-block waves-effect waves-light col-md-4 col-4" name="search"><i class="fa fa-check-circle"></i>&nbsp;<?php echo $this->lang->line('search') ?></button>
                </div>
                <?php echo form_close() ?>
        </div>
        </div>
        <div class="card">
        <div class="card-body">
        <div class="row">
                <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?=  $this->lang->line('product') ?></th>
                            <th><?=  $this->lang->line('Quantity') ?></th>
                            <th><?=  $this->lang->line('average_cost') ?></th>
                            <th><?=  $this->lang->line('total_value') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $AssetValue = $totalStock = $totalAssetValue=0;
                    foreach($products as $pro){ 
                            $AssetValue = $pro->stock*$pro->avg_cost;
                        ?>
                        <tr>
                            <td><?= $pro->product_name . "( " . $pro->product_code . " )"; ?></td>
                            <td><?= $pro->stock; ?></td>
                            <td><?= $pro->avg_cost; ?></td>
                            <td><?= $AssetValue; ?></td>
                        </tr>
                    <?php 
                    $totalStock += $pro->stock;
                    $totalAssetValue += $AssetValue;
                } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><?=  $this->lang->line('total') ?></th>
                            <th><?= $totalStock; ?></th>
                            <th></th>
                            <th><?= $totalAssetValue; ?></th>
                        </tr>
                    </tfoot>
                </table>
        </div>

        </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<script>
function get_category_products() {
        $.ajax({
            url: "<?= base_url('current_stock/get_category_products/') ?>" + $('#category_product_id').val(),
            success: function(result) {
                $("#products").html(result);
            }
        });
    }
</script>
