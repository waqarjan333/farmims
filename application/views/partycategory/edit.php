<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $this->lang->line('update_party_category'); ?></h4>
                <hr>
                <?php echo form_open('partycategory/get_single_partner_category') ?>
                <div class="form-group">
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
                        <label for="formrow-firstname-input"><?= $this->lang->line('Partner_Type'); ?></label>
                        <select name="type" class="form-control custom-select">
                            <option value="" selected><?= $this->lang->line('select_type'); ?></option>
                            <option <?php if($partnerCategory['type']==PARTY_TYPE_CUSTOMER){ echo "selected"; } ?> value="<?php echo PARTY_TYPE_CUSTOMER;?>"><?= $this->lang->line('customer'); ?></option>
                            <option <?php if($partnerCategory['type']==PARTY_TYPE_SUPPLIER){ echo "selected"; } ?> value="<?php echo PARTY_TYPE_SUPPLIER;?>"><?= $this->lang->line('supplier'); ?></option>
                        </select>
                        <span class="text-danger"><?php echo form_error('type'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="formrow-firstname-input"><?= $this->lang->line('Partner_Name'); ?></label>
                        <input type="text" value="<?php echo $partnerCategory['name']; ?>" name="partycategory" class="form-control" id="formrow-firstname-input">
                        <input type="hidden" name="party_category_id" value="<?php echo $partnerCategory['id']; ?>" >
                        <span class="text-danger"><?php echo form_error('partycategory'); ?></span>
                    </div>

                </div>

                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('update'); ?></button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div> 
</div> <!-- end row -->