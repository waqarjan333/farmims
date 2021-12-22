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
.leasedBasicCard {
    min-height: 625px;
    max-height:625px;
}
#empTable,
.witness{
    width:100%;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update <?php echo ucfirst($this->uri->segment(3)) ?> Land Information</h4><hr>

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
            </div>
        </div>
        <?php
        $land_type=$this->uri->segment(3);
        $editID=$this->uri->segment(4);
         echo form_open('land_record_list/update_land_type/'.$land_type.'/'.$editID) ?>
            <?php if($this->uri->segment(3)=="owned"){ ?>
            <div class="card col-12" id="owner_basic_section"  style="float:left;">
                <div class="card-body">
                    <h4>Land Owner Informations</h4>
                    <input type="hidden" value="<?php echo $editID ?>" id="lastFormID">
                    <input type="hidden" value="<?php echo $land_type ?>" id="lastFormType">
                    <hr>
                    <?php //echo "<pre>"; print_r($owned_land_basic); exit; ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Purchase Date</label>
                                    <input type="text" id='purchase_date' value="<?php echo $owned_land_basic->purchase_date;  ?>" name="purchase_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                                    <span class="text-danger"><?php echo form_error('purchase_date'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Type Of Land <span class="text-danger">*</span></label>
                                    <select style="width:100%" name="type_of_land" class="form-control select2" id="type_of_land">
                                        <option value="">Select Type Of Land</option>
                                        <?php foreach ($TypeOfLand as $tol) { ?>
                                            <option <?php if($tol['id']==$owned_land_basic->type_of_land) { echo "selected"; } ?> value="<?= $tol['id'] ?>"><?= $tol['land_management_data'] ?></option>
                                        <?php } ?>

                                    </select>
                                    <span class="text-danger"><?php echo form_error('type_of_land'); ?></span>
                                </div>
                            </div>
                
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Value Per Unit</label>
                                        <input type="text" name="value_per_unit" value="<?php echo $owned_land_basic->value_per_unit;  ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('value_per_unit'); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Area UOM <span class="text-danger">*</span></label>
                                        <select style="width:100%" name="area_uom" class="form-control select2" id="area_uom">
                                            <option value="">Select Area UOM</option>
                                            <?php foreach ($areauom as $au) { ?>
                                                <option <?php if($au['id']==$owned_land_basic->area_uom) { echo "selected"; } ?> value="<?= $au['id'] ?>"><?= $au['areauom_name'] ?></option>
                                            <?php } ?>

                                        </select>
                                        <span class="text-danger"><?php echo form_error('area_uom'); ?></span>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label"> Acres <span class="text-danger">*</span></label>
                                        <input value="<?= $this->input->post('owned_land_acre') ?>" required class="form-group form-control owned_land_acre" data-toggle="touchspin" name="owned_land_acre" id="owned_land_acre" placeholder="Enter Acres">
                                        <span class="text-danger"><?php echo form_error('owned_land_acre'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="formrow-email-input">Calculate Time Of  Purchase<span class="text-danger">*</span></label>
                                            <input type="text" value="<?php echo $owned_land_basic->calculate_purchase_time;  ?>" name="calculate_purchase_time" class="form-control">
                                            <span class="text-danger"><?php echo form_error('calculate_purchase_time'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Crops Taken <span class="text-danger">*</span></label>
                                            <select style="width:100%" multiple name="crops_taken[]" class="form-control select2" id="crops_taken">
                                                <option value="">Select Crops Taken</option>
                                                <?php
                                                
                                                foreach ($cropstaken as $ct) { ?>
                                                    <option <?php if(in_array($ct['id'],explode(',', $owned_land_basic->crops_taken))){echo "selected"; }else{ echo ""; } ?> value="<?= $ct['id'] ?>"><?= $ct['land_management_data'] ?></option>
                                                <?php } ?>

                                            </select>
                                            <span class="text-danger"><?php echo form_error('crops_taken'); ?></span>
                                        </div>
                                    </div> 
                                  
                                </div>
                                  <div class="row">
                                      <div class="col-md-4">
                                           <button class="btn btn-success btn-sm waves-effect waves-light btn-block" type="submit"><i class="fa fa-check-circle"></i> Save</button>
                                      </div>
                                    </div>
                                      <?php echo form_close(); ?>
                    
                </div>
            </div>
          

            <?php }

        
          
             elseif($this->uri->segment(3)=="rent"){
                $land_type=$this->uri->segment(3);
        $editID=$this->uri->segment(4);
               echo form_open('land_record_list/update_land_type/'.$land_type.'/'.$editID); 
              ?>
            <div class="card col-6" id="rent_basic_section"  style="float:left;">
                <div class="card-body">
                    <h4>Rent Basic Informations</h4>
                      <input type="hidden" value="<?php echo $editID ?>" id="lastFormID">
                    <input type="hidden" value="<?php echo $land_type ?>" id="lastFormType">
                    <hr>
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Rent Start Date</label>
                            <input type="text" id='rent_start_date' value="<?php echo $rent_land_basic->rent_start_date;  ?>" name="rent_start_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <span class="text-danger"><?php echo form_error('rent_start_date'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Rent Tenure <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_basic->rent_tenure;  ?>" name="rent_tenure" class="form-control">
                            <span class="text-danger"><?php echo form_error('rent_tenure'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Rent Registration Number <span class="text-danger">*</span></label>
                            <input type="number" name="rent_reg_number" value="<?php echo $rent_land_basic->rent_reg_number;  ?>" class="form-control">
                            <span class="text-danger"><?php echo form_error('rent_reg_number'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Rent Amount <span class="text-danger">*</span></label>
                            <input type="number" value="<?php echo $rent_land_basic->rent_amount;  ?>" name="rent_amount" class="form-control">
                            <span class="text-danger"><?php echo form_error('rent_amount'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Type Of Land <span class="text-danger">*</span></label>
                            <select style="width:100%" name="type_of_land_rent" class="form-control select2" id="type_of_land_rent">
                                <option value="">Select Type Of Land</option>
                                <?php foreach ($TypeOfLand as $tol) { ?>
                                    <option <?php if($tol['id']==$rent_land_basic->type_of_land_rent){echo "selected";} ?> value="<?= $tol['id'] ?>"><?= $tol['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('type_of_land_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">No Of Sheds <span class="text-danger">*</span></label>
                            <input type="number" value="<?php echo $rent_land_basic->no_of_sheds; ?>" name="no_of_sheds" class="form-control">
                            <span class="text-danger"><?php echo form_error('no_of_sheds'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Built Area<span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_basic->built_area; ?>" name="built_area" class="form-control">
                            <span class="text-danger"><?php echo form_error('built_area'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Area UOM <span class="text-danger">*</span></label>
                            <select style="width:100%" name="area_uom_rent" class="form-control select2" id="area_uom_rent">
                                <option value="">Select Area UOM</option>
                                <?php foreach ($areauom as $au) { ?>
                                    <option <?php if($au['id']==$rent_land_basic->area_uom_rent){echo "selected";} ?> value="<?= $au['id'] ?>"><?= $au['areauom_name'] ?></option>
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
                                    <option <?php if($pm['id']==$rent_land_basic->payment_method_rent){echo "selected";} ?> value="<?= $pm['id'] ?>"><?= $pm['land_management_data'] ?></option>
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
                                    <option <?php if($pt['id']==$rent_land_basic->payment_term_rent){echo "selected";} ?> value="<?= $pt['id'] ?>"><?= $pt['land_management_data'] ?></option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('payment_term_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Meter Number<span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_basic->meter_number_rent; ?>" name="meter_number_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('meter_number_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formrow-email-input">Last Bill Before Handover<span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_basic->last_bill_before_handover_rent; ?>" name="last_bill_before_handover_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('last_bill_before_handover_rent'); ?></span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="card col-6" id="rent_owner_section"  style="float:left;">
                <div class="card-body">
                    <h4>Rent Owner Informations</h4>
                    <hr>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Name <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_owner->owner_name_rent; ?>" name="owner_name_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_name_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">ID Card<span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_owner->owner_id_card_rent; ?>" name="owner_id_card_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_id_card_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Email<span class="text-danger">*</span></label>
                            <input type="email" value="<?php echo $rent_land_owner->owner_email_rent; ?>" name="owner_email_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_email_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Contact <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_owner->owner_contact_rent; ?>" name="owner_contact_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_contact_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Address <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_owner->owner_address_rent; ?>" name="owner_address_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_address_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">City <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_owner->owner_city_rent; ?>" name="owner_city_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_city_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Country <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo $rent_land_owner->owner_country_rent; ?>" name="owner_country_rent" class="form-control">
                            <span class="text-danger"><?php echo form_error('owner_country_rent'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                         <button style="margin-top: 30px;" class="btn btn-success  waves-effect waves-light btn-block" type="submit"><i class="fa fa-check-circle"></i> Save</button>
                     </div>
                    </div>
                 </div> 
                </div>
               
            </div>
             
            <?php echo form_close(); ?>
            <?php } elseif ($this->uri->segment(3)=="leased") { 
                          $land_type=$this->uri->segment(3);
        $editID=$this->uri->segment(4);
               echo form_open('land_record_list/update_land_type/'.$land_type.'/'.$editID); 

                ?>
            <div class="card col-4 leaseCard" id="leased_basic_section"  style="float:left;">
                <div class="card-body">
                    <h4>Leased Basic Informations</h4>
                      <input type="hidden" value="<?php echo $editID ?>" id="lastFormID">
                    <input type="hidden" value="<?php echo $land_type ?>" id="lastFormType">
                    <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Contract Date</label>
                                        <input type="text" id='contract_date' value="<?= ($this->input->post('contract_date')) ? $this->input->post('contract_date') : $leased_land_basic->contract_date;  ?>" name="contract_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                                        <span class="text-danger"><?php echo form_error('contract_date'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Contract Registration Number <span class="text-danger">*</span></label>
                                        <input type="number" name="contract_reg_number" value="<?php echo $leased_land_basic->contract_reg_number; ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('contract_reg_number'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Yearly Increase <span class="text-danger">*</span></label>
                                        <input type="text" name="yearly_increase" value="<?php echo $leased_land_basic->yearly_increase; ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('yearly_increase'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Contract Tenure <span class="text-danger">*</span></label>
                                        <input type="text" name="contract_tenure" value="<?php echo $leased_land_basic->contract_tenure; ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('contract_tenure'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Amount Per UOM <span class="text-danger">*</span></label>
                                        <input type="text" name="unit_year" value="<?php echo $leased_land_basic->unit_year; ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('unit_year'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Area UOM <span class="text-danger">*</span></label>
                                        <select style="width:100%" name="area_uom_leased" class="form-control select2"  id="area_uom_leased">
                                            <option value="">Select Area UOM</option>
                                            <?php foreach ($areauom as $au) { ?>
                                                <option value="<?= $au['id'] ?>" <?php if($leased_land_basic->area_uom_leased==$au['id']){ echo 'selected=""'; }  ?> ><?= $au['areauom_name'] ?></option>
                                            <?php } ?>

                                        </select>
                                        <span class="text-danger"><?php echo form_error('area_uom_leased'); ?></span>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Type Of Land <span class="text-danger">*</span></label>
                                        <select style="width:100%" name="type_of_land_leased" class="form-control select2" id="type_of_land_leased">
                                            <option value="">Select Type Of Land</option>
                                            <?php foreach ($TypeOfLand as $tol) { ?>
                                                <option value="<?= $tol['id'] ?>" <?php if($leased_land_basic->type_of_land_leased==$tol['id']){ echo 'selected=""'; }  ?>><?= $tol['land_management_data'] ?></option>
                                            <?php } ?>

                                        </select>
                                        <span class="text-danger"><?php echo form_error('type_of_land_leased'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Payment Method <span class="text-danger">*</span></label>
                                        <select style="width:100%" name="payment_method" class="form-control select2" id="payment_method">
                                            <option value="">Select Payment Method</option>
                                            <?php foreach ($paymentMethod as $pm) { ?>
                                                <option value="<?= $pm['id'] ?>" <?php if($leased_land_basic->payment_method==$pm['id']){ echo 'selected=""'; }  ?>><?= $pm['land_management_data'] ?></option>
                                            <?php } ?>

                                        </select>
                                        <span class="text-danger"><?php echo form_error('payment_method'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Payment Term <span class="text-danger">*</span></label>
                                        <select style="width:100%" name="payment_term" class="form-control select2" id="payment_term">
                                            <option value="">Select Payment Term</option>
                                            <?php foreach ($paymentTerm as $pt) { ?>
                                                <option value="<?= $pt['id'] ?>" <?php if($leased_land_basic->payment_term==$pt['id']){ echo 'selected=""'; }  ?>><?= $pt['land_management_data'] ?></option>
                                            <?php } ?>

                                        </select>
                                        <span class="text-danger"><?php echo form_error('payment_term'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formrow-email-input">Meter Number<span class="text-danger">*</span></label>
                                            <input type="text" name="meter_number" value="<?php echo $leased_land_basic->meter_number; ?>" class="form-control">
                                            <span class="text-danger"><?php echo form_error('meter_number'); ?></span>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Last Bill Before Handover<span class="text-danger">*</span></label>
                                        <input type="text" name="last_meter_reading_before_handover" value="<?php echo $leased_land_basic->last_meter_reading_before_handover; ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('last_meter_reading_before_handover'); ?></span>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
            
            <div class="card col-4 leasedBasicCard" id="leased_owner_section"  style="float:left;">
                <div class="card-body">
                    <h4>Leased Owner Informations</h4>
                    <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="owner_name" value="<?php echo $leased_land_owner->owner_name; ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('owner_name'); ?></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="owner_email" value="<?php echo $leased_land_owner->owner_email; ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('owner_email'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-email-input">ID Card<span class="text-danger">*</span></label>
                                        <input type="text" name="owner_id_card" value="<?php echo $leased_land_owner->owner_id_card; ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('owner_id_card'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Contact <span class="text-danger">*</span></label>
                                        <input type="text" name="owner_contact" value="<?php echo $leased_land_owner->owner_contact; ?>" class="form-control">
                                        <span class="text-danger"><?php echo form_error('owner_contact'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="formrow-email-input">Address <span class="text-danger">*</span></label>
                                        <input type="text" name="owner_address" class="form-control">
                                        <span class="text-danger"><?php echo form_error('owner_address'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Country <span class="text-danger">*</span></label>
                                    <select style="width:100%;" id="owner_country" onchange="get_province_by_country_id()" name="owner_country" class="form-control select2">
                                            <option value="">Select Country</option>
                                            <?php foreach ($countries as $c) { ?>
                                                <option value="<?= $c['id'] ?>"><?= $c['country_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <span class="text-danger"><?php echo form_error('type_of_land'); ?></span>
                                </div>
                            </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="formrow-firstname-input">Province<span class="text-danger">*</span></label>
                                        <select style="width:100%;" name="owner_province" onchange="get_city_by_province_id()" id="owner_province" class="form-control select2">
                                            
                                        </select>
                                        <span class="text-danger"><?php echo form_error('owner_province'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="formrow-firstname-input">City<span class="text-danger">*</span></label>
                                        <select style="width:100%;" name="owner_city" id="owner_city" class="form-control select2">
                                            
                                        </select>
                                        <span class="text-danger"><?php echo form_error('owner_city'); ?></span>
                                    </div>
                                </div>
                                
                            </div>      

                </div>
            </div>
            


            <div class="card col-4 leasedBasicCard" id="leased_witness_section"  style="float:left;">
                <div class="card-body">
                    <h4>Leased Wintness Informations</h4>
                    <hr>
                    <div class="row witness">
                        <a class="btn btn-success" id="addRow" onclick="addRow()">Add New Witness</a>
                    </div>  
                    <div class="row witness" id="witnessForm">
                      <table id="empTable" class="table">
                        <thead>
                            <tr><th></th><th>Name</th><th>ID</th><th>Contact</th></tr>
                        </thead>
                        <tbody id="witness_detail">
                        <?php foreach($leased_land_witness as $witness){ ?>
                        <tr><td><input type="button" value="Remove" class="btn btn-danger btn-sm btn-block" onclick="removeRow(this)"></td><td><input type="text" name="witness_name[]" value="<?php echo $witness->witness_name ?>" class="form-control"></td><td><input type="text" name="witness_name[]" value="<?php echo $witness->witness_id_card ?>" class="form-control"></td><td><input type="text" name="witness_name[]" value="<?php echo $witness->witness_contact ?>" class="form-control"></td></tr>
                    <?php } ?>
                      </tbody></table>  
                    </div> 
                </div>
                <div class="col-md-6">
                        <div class="form-group">
                         <button style="margin-top: 30px;" class="btn btn-success  waves-effect waves-light btn-block" type="submit"><i class="fa fa-check-circle"></i> Save</button>
                     </div>
                    </div>
            </div>
            <?php echo form_close(); ?>
            <?php } ?>
            
    <div>
</div>
  <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <label>Address <small>(Search Goole Places)</small></label>
                            <?php 
                            if($owned_land_batch!=NULL)
                            {


                            $googleP='';
                            $count=0;
                            $googleLet=0;
                            $googleLong=0;
                            // var_dump();exit;
                            foreach($owned_land_batch as $googlePlace){
                                $count++;
                                $googleP=$googlePlace->google_search_place;
                                $googleLong=$googlePlace->google_search_address_longitude;
                                $googleLet=$googlePlace->google_search_address_latitude;
                               } 
                           }else{
                             $googleP='';
                             $googleLet='';
                             $googleLong=0;
                           }?>
                            <input type="text" class="form-control" id="address" value="<?php  echo $googleP; ?>" name="address" data-let="<?php echo $googleLet; ?>" data-long="<?php echo $googleLong; ?>" placeholder="Enter Business Name" required>
                            <input type="hidden" name="mapData" id="mapData" >
                            <input type="hidden" name="batch_count" id="batch_count" value="0" >
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                            
                        </div>
                    </div>
                </div>
<div class="row">
    <div class="col-md-8" style="padding-left: 0px;padding-right: 7px;">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Geo Fence &nbsp; <button type="button" onclick="initMap()" class="btn btn-sm btn-warning"><i class="fa fa-refresh fa-spin"></i>&nbsp; Redraw Fence</button>
                    <a name="add_batch" id="add_batch" class="btn btn-primary" style="float:right">Add Batch</a>
                </div>
                <hr>
            </div>
            <div class="card-body">
                <div style="height: 625px;">
                    <div id="mapx" style="height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4" style="padding-left: 0px;padding-right: 7px;"> 
        <div class="card">
            <div class="card-header">
                <h2>Batch Record</h2>

                <hr>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <?php
                        if($owned_land_batch !=NULL){
                         $batchNumber=0;
                         $area=0;
                         $areaCount=1;
                     foreach($owned_land_batch as $batch_no){
                        
                            if($batchNumber !=$batch_no->batch_no){
                                $batchNumber=$batch_no->batch_no;
                                // $areaCount=0;
                                $areaCount=$areaCount+$batch_no->area_no;
                         ?> 
                    <div class='card'>
                    <div class='card-header' id='heading"+batchCount+"'>

                        <h2 class='mb-0'>
                            <a class='btn btn-link' data-toggle='collapse' data-target='#collapse<?php echo $batchNumber; ?>'>
                            <i class='fa fa-angle-right'></i> Batch No <?php echo $batchNumber; ?></a>
                            <a class='btn btn-link'>Total Areas :<?php echo $areaCount; ?></a>
                            <button type="button" class="btn btn-danger btn-sm area-delete" code="<?php echo $batchNumber; ?>" style="margin-left: 12rem!important">&times;</button>
                            </h2></div><div id='collapse<?php echo $batchNumber; ?>' class='collapse' aria-labelledby='heading"+batchCount+"' data-parent='#accordionExample'>
                                <div class='card-body'>
                            <table class='table'>
                            <tbody>
                              <?php foreach($owned_land_batch as $area){ 
                                if($batchNumber==$area->batch_no)
                                {
                                ?>   
                             <input type='hidden' name='batch_no[]' value=''>  
                             <input type='hidden' name='area_no[]' value=''>
                             <input type='hidden' name='area_value[]' value=''>
                             
                             <tr><td><a href='#'>Area <?php echo $area->area_no; ?> </a></td>
                                <td><button type="button" class="btn btn-info btn-sm area-info" data-area="<?php echo $area->area_no; ?>" data-batch="<?php echo $area->batch_no; ?>">Insert Info </button> </td>
                                <td> <button type="button" class="btn btn-danger btn-sm area-delete" data-area="<?php echo $area->area_no; ?>" data-batch="<?php echo $area->batch_no; ?>" style="">&times;</button></td></tr>
                            <?php } } ?>
                            </tbody></table></div>
                    </div>
                    </div>   

                    <?php  } } } ?>
                </div>
            </div>
        </div>       
    </div>

    <div class="col-md-12" id="leasedFormButton">
        <button class="btn btn-success col-2 btn-block" style="float:right; margin-bottom:20px;"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
    </div>
</div>

<?php echo form_close() ?>
   <div id="areaInfo"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 950px !important;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="float: right;
    margin-left: -22px;">&times;</button>
          <h4 class="modal-title">Insert Area Information Here</h4>
        </div>
        <div class="modal-body">
          <div class='col-md-12'>
<h1>Area  Information</h1> </div>
<input type="hidden" id="selectedAreaID"  value="">
<input type="hidden" id="selectedBatchID"  value="">
<div class="row">
<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Area:</label>
<input type='text' id="adjoint_area" name='adjoint_area' class='form-control adj_area'>
<span class='text-danger'><?php echo form_error('adjoint_area'); ?></span></div></div>
<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>UOM:</label>
<input type='text' id="adjoint_uom" name='adjoint_uom' class='form-control adj_uom'>
<span class='text-danger'><?php echo form_error('adjoint_uom'); ?></span></div></div>
<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Near Land Mark:</label>
<input type='text' id="adjoint_near_landmark" name='adjoint_near_landmark' class='form-control adj_nlm'>
<span class='text-danger'><?php echo form_error('adjoint_near_landmark'); ?></span></div></div>    
</div>
<div class="row">
<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Address:</label>
<input type='text' id="adjoint_address" name='adjoint_address' class='form-control adj_address'>
<span class='text-danger'><?php echo form_error('adjoint_address'); ?></span></div></div>
<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>City:</label>
<input type='text' id="adjoint_city" name='adjoint_city' class='form-control adj_city'>
<span class='text-danger'><?php echo form_error('adjoint_city'); ?></span></div></div>
<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Province:</label>
<input type='text' id="adjoint_province" name='adjoint_province' class='form-control adj_province'>
<span class='text-danger'><?php echo form_error('adjoint_province'); ?></span></div></div>    
</div>
<div class="row">

<div class='col-md-4'><div class='form-group'><label for='formrow-email-input'>Country:</label>
<input type='text' id="adjoint_country" name='adjoint_country' class='form-control adj_country'>
<span class='text-danger'><?php echo form_error('adjoint_country'); ?></span></div></div>    
<div class="col-md-4">
     <div class="form-group">
     <button style="margin-top: 30px;" class="btn btn-success  waves-effect waves-light btn-block" id="saveareaoum" type="button"><i class="fa fa-check-circle"></i> Save</button>
                     </div>
</div>
</div>

</div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-info updateRecord">Update</button> -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script src="<?= base_url() ?>assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYos2QpHr6aZNyRtQzoBA6NsXEljXT8gg&callback=initMap&libraries=drawing,places&v=weekly" defer></script>
<script>
function get_province_by_country_id() {
        $.ajax({
            url: "<?=base_url('city/get_province_by_country_id/')?>"+$('#owner_country').val(),
            success: function(result) {
                $("#owner_province").html(result);
            }
        });
    }
function get_city_by_province_id() {
        $.ajax({
            url: "<?=base_url('city/get_city_by_province_id/')?>"+$('#owner_province').val(),
            success: function(result) {
                $("#owner_city").html(result);
            }
        });
    }
$(document).ready(function() {
    $(".owned_land_acre").TouchSpin({
            min: 0,
            max: 9999999,
            step: 1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            initval: 10
        });
    $(".contract_tenure").TouchSpin({
            min: 0,
            max: 9999999,
            step: 1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            initval: 1
        });
      $(document).on('click', '.batch-delete', function() {
       var batchID = $(this).attr('code');
       var LastFormID=$('#lastFormID').val();
       var lastFormType=$('#lastFormType').val();
       // alert(LastFormID)
        Swal.fire({
            title: 'are you sure ?',
            text: "This Batch will be deleted",
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
                    url: "<?= base_url('land_record_list/delete_batch') ?>",
                    method:"POST",
                    data:{batchID:batchID,LastFormID:LastFormID,lastFormType:lastFormType},
                    success: function(result) {},
                    complete: function(result) {
                        location.reload();
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
          $(document).on('click', '.area-delete', function() {
       var AreaID = $(this).attr('data-area');
       var batchID = $(this).attr('data-batch');
       var LastFormID=$('#lastFormID').val();
       var lastFormType=$('#lastFormType').val();
       // alert(batchID);
        Swal.fire({
            title: 'are you sure ?',
            text: "This Area will be deleted",
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
                    url: "<?= base_url('land_record_list/delete_area') ?>",
                    method:"POST",
                    data:{batchID:batchID,LastFormID:LastFormID,lastFormType:lastFormType,AreaID:AreaID},
                    success: function(result) {},
                    complete: function(result) {
                        location.reload();
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
    // createTable();
    $(document).on('click','.area-info',function(){
        var AreaID = $(this).attr('data-area');
       var batchID = $(this).attr('data-batch');
        $('#selectedAreaID').val(AreaID);
        $('#selectedBatchID').val(batchID);
        $("#areaInfo").modal();
       
    })
    $('#saveareaoum').on('click',function(){
       var AreaID =$('#selectedAreaID').val();
       var batchID = $('#selectedBatchID').val();
       var LastFormID=$('#lastFormID').val();
       var lastFormType=$('#lastFormType').val();
       var adjoint_area=$('#adjoint_area').val();
       var adjoint_uom=$('#adjoint_uom').val();
       var adjoint_near_landmark=$('#adjoint_near_landmark').val();
       var adjoint_address=$('#adjoint_address').val();
       var adjoint_city=$('#adjoint_city').val();
       var adjoint_province=$('#adjoint_province').val();
       var adjoint_country=$('#adjoint_country').val();

           $.ajax({
                    url: "<?= base_url('land_record_list/update_areaform') ?>",
                    method:"POST",
                    data:{batchID:batchID,LastFormID:LastFormID,lastFormType:lastFormType,AreaID:AreaID,area:adjoint_area,uom:adjoint_uom,landmark:adjoint_near_landmark,address:adjoint_address,city:adjoint_city,province:adjoint_province,country:adjoint_country},
                    success: function(result) {},
                    complete: function(result) {
                        location.reload();
                        Swal.fire({
                            title: 'Success!',
                            text: 'Inserted successfuly',
                            icon: 'success'
                        });
                    }
                });
    })
    //showbatchData();
    $(".select2").select2({
            width: 'resolve' // need to override the changed default
    }); 

    
        // Add down arrow icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-angle-down").removeClass("fa-angle-right");
        });
        
        // Toggle right and down arrow icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
        });
});

    
$('#address').on('focusout',function(){
    const input1 = $(this).val();
        $('#google_search_address').val(input1);
})
    var bounds = [];
    let drawingManager;
  var long=0;
    var leti=0;
    var latitude=Number($('#address').attr('data-let'));
    // alert(latitude);
    var longitude=Number($('#address').attr('data-long'));
    if(latitude !=0 && longitude !=0)
    {
     long=longitude; leti=latitude;
    }
    else{ long=73.110101;leti=30.676787;}
    function initMap() {
        const map = new google.maps.Map(document.getElementById("mapx"), {
            center: {
                lat:leti,
                lng:long 
            },
            zoom: 18,
            // mapTypeId: "terrain",
        });
        const input = document.getElementById("address");
        
        
        const searchBox = new google.maps.places.SearchBox(input);
        // alert(searchBox);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });
        let markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
            // alert(places);
            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach((marker) => {
                marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            const boundsx = new google.maps.LatLngBounds();
            places.forEach((place) => {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                        map,
                        icon,
                        title: place.name,
                        position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    boundsx.union(place.geometry.viewport);
                } else {
                    boundsx.extend(place.geometry.location);
                }
            });
            map.fitBounds(boundsx);
        });

        // Define the LatLng coordinates for the polygon's path.

        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [
                    google.maps.drawing.OverlayType.POLYGON
                ],
            },
            markerOptions: {
                icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
            },
            polygonOptions: {
                fillColor: "#1C7A8B",
                fillOpacity: .3,
                strokeColor: "#000000",
                strokeWeight: 4,
                strokeOpacity: 0.9,
                clickable: true,
                editable: false,
                zIndex: 1,
            },

        });
        drawingManager.setMap(map);
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
            var polygonBounds = polygon.getPath();
            bounds = [];
            for (var i = 0; i < polygonBounds.length; i++) {
                var point = {
                    lat: polygonBounds.getAt(i).lat(),
                    lng: polygonBounds.getAt(i).lng()
                };
                
                bounds.push(point);
            }
            // $('#mapData').val();
            var mapData = JSON.stringify(bounds);
            $("#mapData").val($("#mapData").val() + '-'+mapData.substring(1,mapData.length-1));
            //removeLine();
        });
    }

    function removeLine() {
        drawingManager.setMap(null);
    }
//     if($('#address').val() !='')
// {
    initMap();
    // const searchBox = new google.maps.places.SearchBox(input);
    // $(searchBox).trigger("change");

// }

$(document).on('click','.batch_form_model',function(e) {
    $('#batchFormData').html('');
    var batchID = $(this).attr('batchID');
    var formCount = $(this).attr('formCount');
    // alert(batchID);
    // alert(formCount);
    var form='';
    for (let index = 1; index <= formCount; index++) {
          form = "<div class='modal-body'><h1>Batch Form "+index+"</h1>"+
          "<input type='hidden' id='batchID' name='batchID[]' value="+batchID+" >"+
            "<div class='row'><div class='col-md-4'>"+
            "<input type='hidden' name='batch_id' id='batch_id'>"+
            "<div class='form-group'>"+
            "<label for='formrow-email-input'> Area: <span class='text-danger'>*</span></label>"+
            "<input type='text' value='<?= $this->input->post('batch_form_area') ?>' name='batch_form_area[]' class='form-control' id='batch_form_area'>"+
            "<span class='text-danger'><?php echo form_error('batch_form_area'); ?></span></div></div>"+
            "<div class='col-md-4'><div class='form-group'><label>UOM</label><div class='input-group'>"+
            "<input type='text' value='<?= $this->input->post('batch_form_uom') ?>' id='batch_form_uom' name='batch_form_uom[]' class='form-control'>"+
            "<div class='input-group-append'>"+
            "<span class='input-group-text'><i class='mdi mdi-calendar'></i></span>"+
            "</div></div><span class='text-danger'><?php echo form_error('batch_form_uom'); ?></span>"+
            "</div></div><div class='col-md-4'><div class='form-group'><label>Near Land Mark</label>"+
            "<div class='input-group'>"+
            "<input type='text' value='<?= $this->input->post('batch_form_nearLandMark') ?>' id='batch_form_nearLandMark' name='batch_form_nearLandMark[]' class='form-control'>"+
            "<div class='input-group-append'><span class='input-group-text'><i class='mdi mdi-calendar'></i></span>"+
            "</div></div><span class='text-danger'><?php echo form_error('batch_form_nearLandMark'); ?></span>"+
            "</div></div><div class='col-md-4'><div class='form-group'><label>Address : </label>"+
            "<div class='input-group'>"+
            "<input type='text' value='<?= $this->input->post('batch_form_address') ?>' id='batch_form_address' name='batch_form_address[]' class='form-control'>"+
            "<div class='input-group-append'>"+
            "<span class='input-group-text'><i class='mdi mdi-calendar'></i></span></div></div>"+
            "<span class='text-danger'><?php echo form_error('batch_form_address'); ?></span></div></div>"+
            "<div class='col-md-4'><div class='form-group'><label>City : </label><div class='input-group'>"+
            "<input type='text' value='<?= $this->input->post('batch_form_city') ?>' id='batch_form_city' name='batch_form_city[]' class='form-control'>"+
            "<div class='input-group-append'><span class='input-group-text'><i class='mdi mdi-calendar'></i></span>"+
            "</div></div><span class='text-danger'><?php echo form_error('batch_form_city'); ?></span>"+
            "</div></div><div class='col-md-4'><div class='form-group'><label>Province : </label>"+
            "<div class='input-group'>"+
            "<input type='text' value='<?= $this->input->post('batch_form_province') ?>' id='batch_form_province' name='batch_form_province[]' class='form-control'>"+
            "<div class='input-group-append'>"+
            "<span class='input-group-text'><i class='mdi mdi-calendar'></i></span></div></div>"+
            "<span class='text-danger'><?php echo form_error('batch_form_province'); ?></span></div>"+
            "</div><div class='col-md-4'><div class='form-group'><label>Country : </label>"+
            "<div class='input-group'>"+
            "<input type='text' value='<?= $this->input->post('batch_form_country') ?>' id='batch_form_country' name='batch_form_country[]' class='form-control'>"+
            "<div class='input-group-append'>"+
            "<span class='input-group-text'><i class='mdi mdi-calendar'></i></span></div></div>"+
            "<span class='text-danger'><?php echo form_error('batch_form_country'); ?></span></div></div>"+
            "</div></div>";

            // alert(form);
     $('#batchFormData').append(form);   
    }
    

});

$("#add_batch").click(function(e) {
    if($("#land_type").val()!=""){
        var googleaddress=$('#address').val();
        $('#google_search_address').val(googleaddress);

var geocoder = new google.maps.Geocoder();
    // alert(geocoder);
    geocoder.geocode({
      address: googleaddress
    }, function(results, status) {
      console.log(status);
      if (status == 'OK') {

        // console.log(results);
        longitude = results[0].geometry.location.lng();
        $('#google_search_address_longitude').val(longitude);
        latitude = results[0].geometry.location.lat();
        $('#google_search_address_latitude').val(latitude);
        
    }
});


    var batch_data = $('#mapData').val();
    if(batch_data!=''){
    var val1 = parseInt($('#batch_count').val());
    var val2 = parseInt(1);
    var batchCount = val1 + val2;
    var batch_Array = batch_data.split("-");
var i;
var batchData = "<div class='card'>"+
                    "<div class='card-header' id='heading"+batchCount+"'>"+
                        "<h2 class='mb-0'>"+
                            "<a class='btn btn-link' data-toggle='collapse' data-target='#collapse"+batchCount+"'>"+
                            "<i class='fa fa-angle-right'></i> Batch No "+batchCount+"</a>"+
                            "<a class='btn btn-link'>Total Areas : "+(batch_Array.length-1)+"</a>"+
                            "</h2></div><div id='collapse"+batchCount+"' class='collapse' aria-labelledby='heading"+batchCount+"' data-parent='#accordionExample'>"+
                            "<div class='card-body'>"+
                            "<table class='table'>"+
                            "<tbody>";
                            for (i = 0; i <= (batch_Array.length-1); ++i) {
                                
                                if(batch_Array[i]!=''){
                             batchData  += "<input type='hidden' name='batch_no[]' value='"+batchCount+"'>";  
                             batchData  += "<input type='hidden' name='area_no[]' value='"+i+"'>";
                             batchData  += "<input type='hidden' name='area_value[]' value='"+batch_Array[i]+"'>";
                             batchData  +=  "<tr><td><a href='#'>Area "+i+"</a></td></tr>";
                            }
                            }
                            batchData  += "</tbody></table></div></div></div>";
                            $("#accordionExample").append(batchData);
                            $('#mapData').val('');
                            $('#batch_count').val('');
                            $('#batch_count').val(batchCount);
                            initMap();
    } else {
        alert("Please select at least one area from the map");
        $('#mapData').val('')
        initMap();
    }
    } else {
       alert("Please select land type and fill the land information first");
       $('#mapData').val('')
        initMap(); 
    }
});


var n=1;
function addRow() {

       n=n+1;
      var row=' <tr><td><input type="button" value="Remove" class="btn btn-danger btn-sm btn-block" onclick="removeRow(this)"></td><td><input type="text" name="witness_name[]" value="" class="form-control"></td><td><input type="text" name="witness_name[]" value="" class="form-control"></td><td><input type="text" name="witness_name[]" value="" class="form-control"></td></tr>';
              $('#witness_detail').append(row);
    }   
         
    
function removeRow(oButton) {
        var empTab = document.getElementById('empTable');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // button -> td -> tr.
    }

 

    
</script>