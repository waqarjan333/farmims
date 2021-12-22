<style>
    .box1 {
  width: 180px;
  height: auto;
  background-color: black;
  color: #fff;
  padding: 20px;
  position: relative;
  margin: 13px;
  float: left;
}
 .box1.arrow-left:after {
  content: " ";
  position: absolute;
  left: -15px;
  top: 15px;
  border-top: 15px solid transparent;
  border-right: 15px solid black;
  border-left: none;
  border-bottom: 15px solid transparent;
}

</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $this->lang->line('land_management'); ?></h4>

                <hr>
                <div class="SuccessMsgDynamic">
                   
                </div>

                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-octagon mr-2"></i>
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-octagon mr-2"></i>
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>

                <div class="row">

                    <div class="col-md-6 col-6">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('land_type'); ?></label>
                            <select style="width:100%" class="form-control select2" onchange="hide_show_form()" name="land_type" id="land_type">
                                <option value=""><?= $this->lang->line('select_land_type'); ?></option>
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
            <div class="card-body"  id="form_of_owner" style="display:none;">
                <h4 class="card-title" id="cardTitle LandFormTitle"><?= $this->lang->line('owned_form'); ?></h4>
                <hr>
                <?php echo form_open('Land_record/owned_form') ?>
                <input type="hidden" value="<?php echo $this->session->userdata('LastOwnFormID') ?>" id="ownFormID">
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('purchase_date'); ?></label>
                            <input type="text" id='purchase_date' value="<?= ($this->input->post('purchase_date')) ? $this->input->post('purchase_date') : date('Y-m-d');  ?>" name="purchase_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <span class="text-danger"><?php echo form_error('purchase_date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('type_of_land'); ?> <span class="text-danger">*</span></label>
                            <select style="width:100%" name="type_of_land" class="form-control select2" id="type_of_land">
                                <option value=""><?= $this->lang->line('select_type_land'); ?></option>
                                <?php foreach ($TypeOfLand as $tol) { ?>
                                    <option value="<?= $tol['id'] ?>"><?= $tol['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('type_of_land'); ?></span>
                        </div>
                    </div>
                
                   <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('purchase_value'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="purchase_value" class="form-control">
                            <span class="text-danger"><?php echo form_error('purchase_value'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('area_uom'); ?> <span class="text-danger">*</span></label>
                            <select style="width:100%" name="area_uom" class="form-control select2" id="area_uom">
                                <option value=""><?= $this->lang->line('select_area_uom'); ?></option>
                                <?php foreach ($areauom as $au) { ?>
                                    <option value="<?= $au['id'] ?>"><?= $au['areauom_name'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('area_uom'); ?></span>
                        </div>
                    </div> 
                
                   <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('calculate_purchase_time'); ?><span class="text-danger">*</span></label>
                            <input type="text" name="calculate_purchase_time" class="form-control">
                            <span class="text-danger"><?php echo form_error('calculate_purchase_time'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('crops_taken'); ?> <span class="text-danger">*</span></label>
                            <select style="width:100%" name="crops_taken" class="form-control select2" id="crops_taken">
                                <option value=""><?= $this->lang->line('select_crop_token'); ?></option>
                                <?php foreach ($cropstaken as $ct) { ?>
                                    <option value="<?= $ct['id'] ?>"><?= $ct['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('crops_taken'); ?></span>
                        </div>
                        <button class="btn btn-success btn-block saveLandForm" style="width:50%; float: right;"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                    </div> 
                    
                </div>
                <?php echo form_close() ?>
                
            </div>
            <div class="card-body"  id="form_of_leased"  style="display:none;">
                <h4 class="card-title" id="cardTitle LandFormTitle"><?= $this->lang->line('leased_form'); ?></h4>
                <hr>
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#leasedForm" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block"><?= $this->lang->line('leased_form'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#witness_details" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block"><?= $this->lang->line('witness_detail'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#owner_section" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block"><?= $this->lang->line('ownner_form'); ?></span>
                        </a>
                    </li>
                </ul>
                <?php echo form_open('Land_record/leased_form') ?>
                <div class="tab-content p-3 text-muted">
                  
                <input type="hidden" value="<?php echo $this->session->userdata('LastLeaseFormID') ?>" id="LeaseFormID">
                <input type="hidden" value="" id="LandTypeID">
            <div class="tab-pane active" id="leasedForm" role="tabpanel">
                <div class="error"><span><?= $this->lang->line('required'); ?>.</span></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('contract_date'); ?></label>
                            <input type="text" id='contract_date' value="<?= ($this->input->post('contract_date')) ? $this->input->post('contract_date') : date('Y-m-d');  ?>" name="contract_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <span class="text-danger"><?php echo form_error('contract_date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('contract_reg_number'); ?> <span class="text-danger">*</span></label>
                            <input type="number" name="contract_reg_number" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('contract_reg_number'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('yearly_increase'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="yearly_increase" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('yearly_increase'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('contract_tenure'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="contract_tenure" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('contract_tenure'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('amount_per_uom'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="amount_per_uom" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('amount_per_uom'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('area_uom'); ?> <span class="text-danger">*</span></label>
                            <select style="width:100%" name="area_uom_leased" required="" class="form-control select2" id="area_uom_leased">
                                <option value=""><?= $this->lang->line('select_area_uom'); ?></option>
                                <?php foreach ($areauom as $au) { ?>
                                    <option value="<?= $au['id'] ?>"><?= $au['areauom_name'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('area_uom_leased'); ?></span>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('type_of_land'); ?> <span class="text-danger">*</span></label>
                            <select style="width:100%" name="type_of_land_leased" required="" class="form-control select2" id="type_of_land_leased">
                                <option value=""><?= $this->lang->line('select_type_land'); ?></option>
                                <?php foreach ($TypeOfLand as $tol) { ?>
                                    <option value="<?= $tol['id'] ?>"><?= $tol['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('type_of_land_leased'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('payment_method'); ?> <span class="text-danger">*</span></label>
                            <select style="width:100%" name="payment_method" required="" class="form-control select2" id="payment_method">
                                <option value=""><?= $this->lang->line('select_payment_method'); ?></option>
                                <?php foreach ($paymentMethod as $pm) { ?>
                                    <option value="<?= $pm['id'] ?>"><?= $pm['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('payment_method'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('payment_term'); ?> <span class="text-danger">*</span></label>
                            <select style="width:100%" name="payment_term" required="" class="form-control select2" id="payment_term">
                                <option value=""><?= $this->lang->line('select_payment_term'); ?></option>
                                <?php foreach ($paymentTerm as $pt) { ?>
                                    <option value="<?= $pt['id'] ?>"><?= $pt['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('payment_term'); ?></span>
                        </div>
                    </div>
                
                   <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('meter_number'); ?><span class="text-danger">*</span></label>
                            <input type="text" name="meter_number" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('meter_number'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('last_bill_before_handover'); ?><span class="text-danger">*</span></label>
                            <input type="text" required="" name="last_bill_before_handover" class="form-control">
                            <span class="text-danger"><?php echo form_error('last_bill_before_handover'); ?></span>
                        </div>
                    </div>
                     
                    
                </div>
                        
            </div>
            <div class="tab-pane" id="witness_details" role="tabpanel">
                <div class="error"><span><?= $this->lang->line('required'); ?>.</span></div>
                <div class="row">
                <?php for ($i=1; $i < 6; $i++) { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('name'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="witness_name[]" required="" id="w_name<?php echo $i; ?>" class="form-control">
                            <span class="text-danger"><?php echo form_error('witness_name'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('id'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="witness_id_card[]" required="" id="w_id<?php echo $i; ?>" class="form-control">
                            <span class="text-danger"><?php echo form_error('witness_id_card'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('contact'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="witness_contact[]" required="" id="w_contact<?php echo $i; ?>" class="form-control">
                            <span class="text-danger"><?php echo form_error('witness_contact'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                        <?php $margin = ""; if($i==1){ ?>
                            <label for="formrow-email-input">Action</label>
                            <?php } if($i!=1){ $margin = "margin-top:30px;"; } ?>
                            <button class="btn btn-success btn-block clearbtn" data-id="<?php echo $i; ?>" style="<?php echo $margin; ?>"><i class="fa fa-check-circle"></i>&nbsp;Clear</button>
                        </div>
                    </div>
                    <?php } ?>
                 </div>        
                       
            </div>
            <div class="tab-pane" id="owner_section" role="tabpanel">
                <div class="error"><span><?= $this->lang->line('required'); ?></span></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('name'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="owner_name"  required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_name'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('id_card'); ?><span class="text-danger">*</span></label>
                            <input type="text" name="owner_id_card" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_id_card'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('email'); ?><span class="text-danger">*</span></label>
                            <input type="email" name="owner_email" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_email'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('contact'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="owner_contact" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_contact'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('address'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="owner_address" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_address'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('city'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="owner_city" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_city'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('country'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="owner_country" required="" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_country'); ?></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    <button class="btn btn-success btn-block saveLandForm" id="saveLease" style="width:50%; float: center; margin-top:30px;"><i class="fa fa-check-circle"></i>&nbsp;<?= $this->lang->line('save'); ?></button>
                    </div>
                    
                 </div>   
                        
            </div>
            
        </div>
        <?php echo form_close() ?>
        </div>
        <div class="card-body"  id="form_of_rent"  style="display:none;">
                <h4 class="card-title LandFormTitle" id="cardTitle"><?= $this->lang->line('rent_form'); ?></h4>

                <hr>
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#rentForm" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block"><?= $this->lang->line('rent_form'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#owner_section_2" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block"><?= $this->lang->line('owner_section'); ?></span>
                        </a>
                    </li>
                </ul>
                <?php echo form_open('Land_record/rent_form') ?>
                <div class="tab-content p-3 text-muted">
                <!-- start rentForm -->
                <div class="tab-pane active" id="rentForm" role="tabpanel"> 
                <input type="hidden" value="<?php echo $this->session->userdata('LastRentFormID') ?>" id="LastRentFormID">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('rent_start_date'); ?></label>
                            <input type="text" id='rent_start_date' value="<?= ($this->input->post('rent_start_date')) ? $this->input->post('rent_start_date') : date('Y-m-d');  ?>" name="rent_start_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <span class="text-danger"><?php echo form_error('contract_date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('rent_tenure'); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="rent_tenure" class="form-control">
                            <span class="text-danger"><?php echo form_error('rent_tenure'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('rent_reg_number'); ?> <span class="text-danger">*</span></label>
                            <input type="number" name="rent_reg_number" class="form-control">
                            <span class="text-danger"><?php echo form_error('rent_reg_number'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('rent_amount'); ?> <span class="text-danger">*</span></label>
                            <input type="number" name="rent_amount" class="form-control">
                            <span class="text-danger"><?php echo form_error('rent_amount'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?= $this->lang->line('type_of_land'); ?> <span class="text-danger">*</span></label>
                            <select style="width:100%" name="type_of_land_rent" class="form-control select2" id="type_of_land_rent">
                                <option value=""><?= $this->lang->line('select_type_land'); ?></option>
                                <?php foreach ($TypeOfLand as $tol) { ?>
                                    <option value="<?= $tol['id'] ?>"><?= $tol['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('type_of_land_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input"><?= $this->lang->line('no_of_sheds'); ?> <span class="text-danger">*</span></label>
                            <input type="number" name="no_of_sheds" class="form-control">
                            <span class="text-danger"><?php echo form_error('no_of_sheds'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Built Area<span class="text-danger">*</span></label>
                            <input type="text" name="built_area" class="form-control">
                            <span class="text-danger"><?php echo form_error('built_area'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Area UOM <span class="text-danger">*</span></label>
                            <select style="width:100%" name="area_uom_rent" class="form-control select2" id="area_uom_rent">
                                <option value="">Select Area UOM</option>
                                <?php foreach ($areauom as $au) { ?>
                                    <option value="<?= $au['id'] ?>"><?= $au['areauom_name'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('area_uom_rent'); ?></span>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Payment Method <span class="text-danger">*</span></label>
                            <select style="width:100%" name="payment_method_rent" class="form-control select2" id="payment_method_rent">
                                <option value="">Select Payment Method</option>
                                <?php foreach ($paymentMethod as $pm) { ?>
                                    <option value="<?= $pm['id'] ?>"><?= $pm['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('payment_method_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Payment Term <span class="text-danger">*</span></label>
                            <select style="width:100%" name="payment_term_rent" class="form-control select2" id="payment_term_rent">
                                <option value="">Select Payment Term</option>
                                <?php foreach ($paymentTerm as $pt) { ?>
                                    <option value="<?= $pt['id'] ?>"><?= $pt['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('payment_term_rent'); ?></span>
                        </div>
                    </div>
                
                   <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Meter Number<span class="text-danger">*</span></label>
                            <input type="text" name="meter_number_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('meter_number_rent'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Last Bill Before Handover<span class="text-danger">*</span></label>
                            <input type="text" name="last_bill_before_handover_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('last_bill_before_handover_rent'); ?></span>
                        </div>
                    </div>
                     
                    
                </div>
                
                        
                </div>
                <!-- end rentForm -->
                <!-- start owner_section_2 -->
                <div class="tab-pane" id="owner_section_2" role="tabpanel"> 
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Name <span class="text-danger">*</span></label>
                            <input type="text" name="owner_name_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_name_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">ID Card<span class="text-danger">*</span></label>
                            <input type="text" name="owner_id_card_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_id_card_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Email<span class="text-danger">*</span></label>
                            <input type="email" name="owner_email_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_email_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Contact <span class="text-danger">*</span></label>
                            <input type="text" name="owner_contact_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_contact_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Address <span class="text-danger">*</span></label>
                            <input type="text" name="owner_address_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_address_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">City <span class="text-danger">*</span></label>
                            <input type="text" name="owner_city_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_city_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Country <span class="text-danger">*</span></label>
                            <input type="text" name="owner_country_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_country_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    <button class="btn btn-success btn-block saveLandForm"  style="width:50%; float: center; margin-top:30px;"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
                    </div>
                 </div>   
                
            </div> 
            <!-- end owner_section_2 -->
            <?php echo form_close() ?>
        </div>
    </div>
           
        </div>
        
    </div>
    
</div> <!-- end row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Adjoint Management</h4>

                <hr>
                
                <div class="row">
                    <div class="col-md-4 col-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Adjoint</label>
                            <select style="width:100%" class="form-control" onchange="show_adjoint_form()" name="adjoint" id="adjoint">
                                <option value="">Select Type</option>
                                <option value="Together">Together</option>
                                <option value="Separate">Separate</option>
                            </select>
                        </div>
                    </div>
                      <div class="col-md-4 col-4" id="InfoMSG">
                        <div class="form-group">
                         <div class="box1 arrow-left">
                          Almost Done Now Fill Thses Information Carefully With Your Choice.
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-4" style="display:none" id="area_count_textfield">
                        <div class="form-group">
                            <label for="formrow-email-input">How many area you have?</label>
                            <input type="text" id='areaCount' name="areaCount" class="form-control">
                            <span class="text-danger"><?php echo form_error('areaCount'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-2" style="display:none" id="area_count_button">
                        <button class="btn btn-success btn-block" style="width:100%; float: center; margin-top:30px;" id="show_area_form"><i class="fa fa-check-circle"></i>&nbsp;Show Area Forms</button>
                    </div>
                </div>
                <hr>
                <div class="row" id="togetherForm" style="display:none">
                
                    

                    

                    

                    
                
                
                
                
        </div>
            <div class="row">
                 <div class="col-sm-4">
                    <button class="btn btn-success btn-block saveAdjoint"  style="width:50%; float: center; margin-top:30px;"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
                    </div>
            </div>
        </div>
       

    </div>
</div>
<script>

$(document).ready(function() {
    $('.saveAdjoint').hide();
    $('#InfoMSG').hide();
    if(localStorage.getItem('successFormSubmit')=='true')
    {
        $('#InfoMSG').show();
    }
    
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });
       $(document).on('click','.clearbtn',function(e){
        e.preventDefault();
        var ID=$(this).data('id');
          $('#w_name'+ID).val('');
          $('#w_id'+ID).val('');
          $('#w_contact'+ID).val('');
       }) 
        });

    $(document).on('click','.saveLandForm',function(){
        localStorage.setItem('successFormSubmit',true);
    })
    
function hide_show_form() {
        var text = $("#land_type option:selected" ).text();
        var val = $("#land_type option:selected" ).val();

        // $("#LandTypeID").val(val);
        localStorage.setItem("LandTypeID", val);
        localStorage.setItem("LandTypeName", text);
        if(text == "Leased"){
            $("#form_of_owner").hide('500');
            $("#form_of_leased").show('500');
            $("#form_of_rent").hide('500');
        } else if (text == "Owned"){
            $("#form_of_owner").show('500');
            $("#form_of_leased").hide('500');
            $("#form_of_rent").hide('500');
        } else if (text == "Rent"){
            $("#form_of_owner").hide('500');
            $("#form_of_leased").hide('500');
            $("#form_of_rent").show('500');
        } else {
            // $("#form_of_owner").hide();
            // $("#form_of_leased").hide();
            // $("#form_of_rent").hide();
        }
    }
function show_adjoint_form() {
        var text = $("#adjoint option:selected" ).text();
        $('.saveAdjoint').show();
        $('#InfoMSG').hide();
       
        if(text == "Together"){
            
            $("#area_count_textfield").hide('500');
            $("#area_count_button").hide('500');
            var form = "<div class='col-md-12'><h1>Area  Information</h1> </div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Area:</label>"+
                        "<input type='text' name='adjoint_area[]' class='form-control adj_area'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_area'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>UOM:</label>"+
                        "<input type='text' name='adjoint_uom[]' class='form-control adj_uom'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_uom'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Near Land Mark:</label>"+
                        "<input type='text' name='adjoint_near_landmark[]' class='form-control adj_nlm'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_near_landmark'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Address:</label>"+
                        "<input type='text' name='adjoint_address[]' class='form-control adj_address'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_address'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>City:</label>"+
                        "<input type='text' name='adjoint_city[]' class='form-control adj_city'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_city'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Province:</label>"+
                        "<input type='text' name='adjoint_province[]' class='form-control adj_province'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_province'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Country:</label>"+
                        "<input type='text' name='adjoint_country[]' class='form-control adj_country'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_country'); ?></span></div></div></div>";
                $('#togetherForm').show("500");
                $('#togetherForm').html('');
                $('#togetherForm').html(form);
        } else if (text == "Separate"){
            $("#togetherForm").hide('500');
            $("#area_count_textfield").show('500');
            $("#area_count_button").show('500');
            $('.saveAdjoint').hide();
        } 
    }

 $( "#show_area_form" ).click(function() {
$('.saveAdjoint').show();
// $('#InfoMSG').hide();
            var form;
            var val = $('#areaCount').val();
            for(let i=0; i<val; i++) {
                form += "<div class='col-md-12'><h1>Area "+(i+1)+" Information</h1> </div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Area:</label>"+
                        "<input type='text' name='adjoint_area[]' class='form-control adj_area'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_area'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>UOM:</label>"+
                        "<input type='text' name='adjoint_uom[]' class='form-control adj_uom'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_uom'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Near Land Mark:</label>"+
                        "<input type='text' name='adjoint_near_landmark[]' class='form-control adj_nlm'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_near_landmark'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Address:</label>"+
                        "<input type='text' name='adjoint_address[]' class='form-control adj_address'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_address'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>City:</label>"+
                        "<input type='text' name='adjoint_city[]' class='form-control adj_city'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_city'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Province:</label>"+
                        "<input type='text' name='adjoint_province[]' class='form-control adj_province'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_province'); ?></span></div></div>"+
                        "<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Country:</label>"+
                        "<input type='text' name='adjoint_country[]' class='form-control adj_country'>"+
                        "<span class='text-danger'><?php echo form_error('adjoint_country'); ?></span></div></div></div>";
            }
            $('#togetherForm').show("500");
            $('#togetherForm').html('');
            $('#areaCount').val('');
            $('#togetherForm').html(form);
        });

$('.saveAdjoint').on('click',function(){
    // alert()
     var area = [];
  var uom = [];
  var adj_nlm = [];
  var address = [];
  var city = [];
  var province = [];
  var country = [];
  var adjoint=$('#adjoint').val();
  var LandFormTitle=$('#LandFormTitle').text();
  var landType=localStorage.getItem("LandTypeID");
  var LandTypeName=localStorage.getItem("LandTypeName");
  var FormID=0;
  var LandFormTitle='';
  if(LandTypeName=='Leased')
  {
   FormID=$('#LeaseFormID').val(); 
   LandFormTitle='Leased Form';
  }
  else if(LandTypeName=='Owned')
  {
    FormID=$('#ownFormID').val();
    LandFormTitle='Owned Form';
  }
  else{
    FormID=$('#LastRentFormID').val();
     LandFormTitle='Rent Form';
  }
  
    $('.adj_area').each(function(){
   area.push($(this).val());
  });

 $('.adj_uom').each(function(){
   uom.push($(this).val());
  });

   $('.adj_nlm').each(function(){
   adj_nlm.push($(this).val());
  });

   $('.adj_address').each(function(){
   address.push($(this).val());
  });

   $('.adj_city').each(function(){
   city.push($(this).val());
  });

   $('.adj_province').each(function(){
   province.push($(this).val());
  });

   $('.adj_country').each(function(){
   country.push($(this).val());
  });

   $.ajax({
   url:"<?php echo base_url('Land_record/saveAdjoint') ?>",
   method:"POST",
   data:{Adjoint:adjoint,landType:landType,FormID:FormID,LandFormTitle:LandFormTitle,Area:area,UOM:uom,AdjNLM:adj_nlm,Address:address,City:city,Province:province,Country:country},
   success:function(data){
    // console.log(data)
    // $('#LeaseFormID').val('off');
    // document.getElementById("").value = "0";
    localStorage.setItem('successFormSubmit',false);

     $('.SuccessMsgDynamic').append(' <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="uil uil-exclamation-octagon mr-2"></i>'+
                        'Data Inserted Successfully'+ 
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">×</span></button></div>'); 
            setTimeout(function(){
               location.reload(); 
            }, 2000);

   }
  });

})

</script>