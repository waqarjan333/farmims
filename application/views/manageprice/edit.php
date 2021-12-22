<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Price</h4>
                <?php echo form_open() ?>

                <div class="row">

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Price Amount</label>
                            <input type="text" value="<?= $item->price_amount ?>" class="form-control" name="amount" id="formrow-firstname-input">
                        </div>
                    </div>

                   

                </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Product</label>
                            <select class="form-control select2" name="product_id">
                                <option>Select Product </option>
                                <?php foreach ($products as $pro) { ?>
                                    <option value="<?= $pro['id'] ?>" <?php if($pro['id']==$item->product_id){echo 'selected';} ?>><?= $pro['product_name'] ?> (<?= $pro['product_code'] ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Party</label>
                            <select class="form-control select2" name="party_id">
                                <option>Select Party</option>
                                <?php foreach ($parties as $p) { ?>
                                    <option value="<?= $p['id'] ?>" <?php if($p['id']==$item->party_id){echo 'selected';} ?>><?= $p['partie_name'] ?> (<?= $p['partie_code'] ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                     <div class="col-md-6 col-6">
                        <div class="form-group">
                            <label for="formrow-email-input">UOM</label>
                            <select class="form-control select2" name="uom">
                                <option>Select UOM</option>
                                <?php foreach ($item_uom as $c) { ?>
                                    <option value="<?= $c['id'] ?>" <?php if($item->unit==$c['id']){echo 'selected';}?> ><?= $c['name'] ?> (<?= $c['symbol'] ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Update</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> <!-- end col -->
   
</div> <!-- end row -->
<script>
$(document).ready(function() {
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });

});
</script>