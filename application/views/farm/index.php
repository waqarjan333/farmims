<link href="<?= base_url() ?>assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<style>
.pac-container {
        z-index: 9999;
    }

    .my_height {
        height: 50px !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-octagon mr-2"></i>
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>
                <h4 class="card-title">Farm&nbsp;<button type="button" class="btn btn-success btn-sm waves-effect waves-light" id="add_new_farm_btn" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="uil-plus"></i>&nbsp;Add Farm</button></h4>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Area</th>
                            <th>Property Type</th>
                            <th>Open Area</th>
                            <th>Shed</th>
                            <th>Currency</th>
                            <th>Province </th>
                            <th>City </th>
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
<!--  Large modal example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add New Farm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('farm/index') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        &nbsp;</div>
                    <div class="col-md-4 wrapperx">
                        <div class="box">
                            <div class="js--image-preview"></div>
                            <div class="upload-options">
                                <label>
                                    <input type="file" name="farmlogo" class="image-upload" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-email-input">Code <small>(Auto Generated)</small></label>
                            <input readonly type="text" value="<?= $code ?>" name="code" class="form-control" id="formrow-email-input">
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Title <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('name') ?>" name="name" class="form-control" id="formrow-firstname-input">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Email <span class="text-danger">*</span></label>
                            <input type="email" value="<?= $this->input->post('email') ?>" name="email" class="form-control" id="formrow-firstname-input">
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-password-input">Phone <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('phone') ?>" name="phone" class="form-control" id="formrow-password-input">
                            <span class="text-danger"><?php echo form_error('phone'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Area UOM <span class="text-danger">*</span></label>
                            <select name="uom_id" class="form-control select2" style="width: 100%">
                                <option value="">Select Area UOM</option>
                                <?php foreach ($areauom as $c) { ?>
                                    <option <?php if ($this->input->post('uom_id') == $c['id']) {
                                                echo 'selected';
                                            } ?> value="<?= $c['id'] ?>"><?= $c['areauom_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('uom_id'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-password-input">Shed Count</label>
                            <input type="text" value="<?= $this->input->post('shed') ?>" name="shed" value="1" min="1" class="form-control" id="formrow-password-input">
                            <span class="text-danger"><?php echo form_error('shed'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="formrow-password-input">Area <span class="text-danger">*</span></label>
                        <input type="text" name="area" value="<?= $this->input->post('area') ?>" class="form-control" id="formrow-password-input">
                        <span class="text-danger"><?php echo form_error('area'); ?></span>
                    </div>
                    <div class="col-md-3">
                        <label for="formrow-password-input">Open Area <span class="text-danger">*</span></label>
                        <input type="text" value="<?= $this->input->post('openarea') ?>" name="openarea" class="form-control" id="formrow-password-input">
                        <span class="text-danger"><?php echo form_error('openarea'); ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Property Type <span class="text-danger">*</span></label>
                            <select name="propertytype" class="form-control select2" style="width: 100%">
                                <option value="">Select Property Type</option>
                                <option <?php if ($this->input->post('propertytype') == PROPERTY_TYPE_OWN) {
                                            echo 'selected';
                                        } ?> value="<?= PROPERTY_TYPE_OWN ?>">Own</option>
                                <option <?php if ($this->input->post('propertytype') == PROPERTY_TYPE_RENT) {
                                            echo 'selected';
                                        } ?> value="<?= PROPERTY_TYPE_RENT ?>">Rent</option>
                                <option <?php if ($this->input->post('propertytype') == PROPERTY_TYPE_LEASE) {
                                            echo 'selected';
                                        } ?> value="<?= PROPERTY_TYPE_LEASE ?>">Lease</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('propertytype'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Color Code</label>
                            <div class="input-group colorpicker-default" title="Using format option">
                                <input readonly type="text" name="colorcode" class="form-control input-lg" value="#5b8ce8" />
                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Currency <span class="text-danger">*</span></label>
                            <select name="currency_id" class="form-control select2" style="width: 100%">
                                <!-- <option value="<?= $r['id'] ?>"><?= $r['name'] ?> (<?= $r['symbol'] ?>)</option> -->
                                <option value="">Select Currency</option>
                                <?php foreach ($currency as $c) { ?>
                                    <option <?php if ($this->input->post('currency_id') == $c['id']) {
                                                echo 'selected';
                                            } ?> value="<?= $c['id'] ?>"><?= $c['currency_name'] ?> (<?= $c['currency_symbol'] ?>)</option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('currency_id'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Country <span class="text-danger">*</span></label>
                            <select style="width: 100%" id="country_id" onchange="get_province_by_country_id('country_id')" name="country_id" class="form-control select2">
                                <option value="">Select Country</option>
                                <?php foreach ($countries as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['country_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('country_id'); ?></span>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Province <span class="text-danger">*</span></label>

                            <select style="width: 100%" name="province_id" onchange="get_city_by_province_id('province_dd')" id="province_dd" class="form-control select2">
                                <option value="">Select Province</option>

                            </select>

                            <span class="text-danger"><?php echo form_error('province_id'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">City</label>
                            <select style="width: 100%" name="city_id" id="city_dd" class="form-control select2">
                                <option>Select City</option>

                            </select>
                            <span class="text-danger"><?php echo form_error('city_id'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="font-size-14 mb-3">New Animal Quarantine</h5>
                        <div class="square-switch">
                            <input type="checkbox" name="quarantine_new_animalu" id="quarantine_new_animalu" class="quarantine_new_animal" id="square-switch3" switch="bool" checked />
                            <label for="square-switch3" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-md-3 qd_div" id="qd_div">
                        <div class="form-group">
                            <label class="control-label"> Quarantine Days <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('quarantine_days') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="quarantine_days" id="quarantine_days" placeholder="Enter Quarantine Days">
                            <span class="text-danger"><?php echo form_error('quarantine_days'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Farm Description</label>

                            <textarea name="txtarea" id="txtarea" class="form-control"><?= $this->input->post('txtarea') ?></textarea>
                            <span class="text-danger"><?php echo form_error('txtarea'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:50px;">
                <div class="col-md-6">
                        <div class="form-group">
                            <label>Address <small>(Search Goole Places)</small></label>
                            <input type="text" class="form-control controls pac-container" id="address" name="address" placeholder="Enter Business Name" required>
                            <input type="hidden" name="mapData" id="mapData" >
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                        

                    <div class="col-md-12" style="padding-left: 0px;padding-right: 7px;">
                                    <div class="card">
                                        <div class="card-header ">
                                            <div class="card-title">Geo Fence &nbsp; <button type="button" onclick="initMap()" class="btn btn-sm btn-warning"><i class="fa fa-refresh fa-spin"></i>&nbsp; Redraw Fence</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div style="height: 300px;">
                                                <div id="mapx" style="height: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Update Farm Modal -->
<!--  Large modal example -->
<div class="modal fade " id="updateFarm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Update Farm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('farm/index') ?>
            <input type="hidden" id="id" name="id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        &nbsp;</div>
                    <div class="col-md-4 wrapperx">
                        <div class="box">
                            <div class="js--image-preview"></div>
                            <div class="upload-options">
                                <label>
                                    <input type="file" name="farmlogo" class="image-upload" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-email-input">Code <small>(Auto Generated)</small></label>
                            <input readonly type="text" value="<?= $code ?>" class="form-control" id="codeu">
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Title <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('nameu') ?>" name="nameu" class="form-control" id="nameu">
                            <span class="text-danger"><?php echo form_error('nameu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Email <span class="text-danger">*</span></label>
                            <input type="email" value="<?= $this->input->post('emailu') ?>" name="emailu" class="form-control" id="emailu">
                            <span class="text-danger"><?php echo form_error('emailu'); ?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-password-input">Phone <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $this->input->post('phoneu') ?>" name="phoneu" class="form-control" id="phoneu">
                            <span class="text-danger"><?php echo form_error('phoneu'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Area UOM <span class="text-danger">*</span></label>
                            <select name="uom_idu" id="uom_idu" class="form-control select2" style="width: 100%">
                                <option value="">Select Area UOM</option>
                                <?php foreach ($areauom as $c) { ?>
                                    <option <?php if ($this->input->post('uom_id') == $c['id']) {
                                                echo 'selected';
                                            } ?> value="<?= $c['id'] ?>"><?= $c['areauom_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('uom_idu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="formrow-password-input">Shed Count</label>
                            <input type="text" value="<?= $this->input->post('shedu') ?>" name="shedu" value="1" min="1" class="form-control" id="shedu">
                            <span class="text-danger"><?php echo form_error('shedu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="formrow-password-input">Area <span class="text-danger">*</span></label>
                        <input type="text" name="areau" value="<?= $this->input->post('areau') ?>" class="form-control" id="areau">
                        <span class="text-danger"><?php echo form_error('areau'); ?></span>
                    </div>
                    <div class="col-md-3">
                        <label for="formrow-password-input">Open Area <span class="text-danger">*</span></label>
                        <input type="text" value="<?= $this->input->post('openareau') ?>" name="openareau" class="form-control" id="openareau">
                        <span class="text-danger"><?php echo form_error('openareau'); ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Property Type <span class="text-danger">*</span></label>
                            <select name="propertytypeu" class="form-control select2" style="width: 100%" id="propertytypeu">
                                <option value="">Select Property Type</option>
                                <option <?php if ($this->input->post('propertytype') == PROPERTY_TYPE_OWN) {
                                            echo 'selected';
                                        } ?> value="<?= PROPERTY_TYPE_OWN ?>">Own</option>
                                <option <?php if ($this->input->post('propertytype') == PROPERTY_TYPE_RENT) {
                                            echo 'selected';
                                        } ?> value="<?= PROPERTY_TYPE_RENT ?>">Rent</option>
                                <option <?php if ($this->input->post('propertytype') == PROPERTY_TYPE_LEASE) {
                                            echo 'selected';
                                        } ?> value="<?= PROPERTY_TYPE_LEASE ?>">Lease</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('propertytypeu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Color Code</label>
                            <div class="input-group colorpicker-default" title="Using format option">
                                <input readonly type="text" id="colorcodeu" class="form-control input-lg" value="#5b8ce8" />
                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Currency <span class="text-danger">*</span></label>
                            <select name="currency_idu" id="currency_idu" class="form-control select2" style="width: 100%">
                                <!-- <option value="<?= $r['id'] ?>"><?= $r['name'] ?> (<?= $r['symbol'] ?>)</option> -->
                                <option value="">Select Currency</option>
                                <?php foreach ($currency as $c) { ?>
                                    <option <?php if ($this->input->post('currency_id') == $c['id']) {
                                                echo 'selected';
                                            } ?> value="<?= $c['id'] ?>"><?= $c['currency_name'] ?> (<?= $c['currency_symbol'] ?>)</option>
                                <?php } ?>

                            </select>
                            <span class="text-danger"><?php echo form_error('currency_idu'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Country <span class="text-danger">*</span></label>
                            <select style="width: 100%" id="country_idu" onchange="get_province_by_country_id('country_idu','#province_ddu')" name="country_idu" class="form-control select2">
                                <option value="">Select Country</option>
                                <?php foreach ($countries as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['country_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('country_idu'); ?></span>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Province <span class="text-danger">*</span></label>

                            <select style="width: 100%" name="province_idu" onchange="get_city_by_province_id('province_ddu','#city_ddu')" id="province_ddu" class="form-control select2">
                                <option value="">Select Province</option>

                            </select>

                            <span class="text-danger"><?php echo form_error('province_idu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">City</label>
                            <select style="width: 100%" name="city_idu" id="city_ddu" class="form-control select2">
                                <option>Select City</option>

                            </select>
                            <span class="text-danger"><?php echo form_error('city_idu'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="font-size-14 mb-3">Animal Quarantine</h5>
                        <div class="square-switch">
                            <input type="checkbox" name="quarantine_new_animal" class="quarantine_new_animal" id="square-switch3" switch="bool" checked />
                            <label for="square-switch3" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                        <span class="text-danger"><?php echo form_error('quarantine_new_animal'); ?></span>
                    </div>
                    <div class="col-md-3 qd_div" id="qd_div">
                        <div class="form-group">
                            <label class="control-label"> Quarantine Days <span class="text-danger">*</span></label>
                            <input value="<?= $this->input->post('quarantine_daysu') ?>" required class="form-group form-control weight" data-toggle="touchspin" name="quarantine_daysu" id="quarantine_daysu" placeholder="Enter Quarantine Days">
                            <span class="text-danger"><?php echo form_error('quarantine_daysu'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formrow-email-input">Farm Description</label>
                            <textarea name="txtareau" id="descriptionu" class="form-control"><?= $this->input->post('txtareau') ?></textarea>
                            <span class="text-danger"><?php echo form_error('txtareau'); ?></span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Update Modal -->
<script src="<?= base_url() ?>assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYos2QpHr6aZNyRtQzoBA6NsXEljXT8gg&callback=initMap&libraries=drawing,places&v=weekly" defer></script>
<script>
    var bounds = [];
    let drawingManager;

    function initMap() {
        const map = new google.maps.Map(document.getElementById("mapx"), {
            center: {
                lat: 30.676787,
                lng: 73.110101
            },
            zoom: 18,
            // mapTypeId: "terrain",
        });
        const input = document.getElementById("address");
        const searchBox = new google.maps.places.SearchBox(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });
        let markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

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
                    google.maps.drawing.OverlayType.POLYGON,
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
            $('#mapData').val();
            var mapData = JSON.stringify(bounds);
            $('#mapData').val(mapData.substring(1,mapData.length-1));
            removeLine();
        });
    }

    function removeLine() {
        drawingManager.setMap(null);
    }

    $('.quarantine_new_animal').change(function() {
        if ($(this).is(':checked')) {
            $('.qd_div').show(500);
        } else {
            $('.qd_div').hide(500);
        }
    });


    // For Updating Farm
    // For New Adding Farm
    <?php if ($this->input->post('id')) { ?>
        $('#updateFarm').modal('show');
    <?php } ?>

    // For New Adding Farm
    <?php if (isset($_POST) && count($_POST) > 0 && !isset($_POST['id'])) { ?>
        $('#add_new_farm_btn').trigger('click');
    <?php } ?>


    // Image Upload End
    function get_province_by_country_id(id, tar = null) {
        $.ajax({
            url: "<?= base_url('city/get_province_by_country_id/') ?>" + $('#' + id).val(),
            success: function(result) {
                defVal = '<option value="" selected>Select Province</option>';
                result = defVal + result;
                tar = (tar != null) ? tar : "#province_dd";
                $(tar).html(result);
            }
        });
    }

    function get_city_by_province_id(id, tar = null) {
        provinceId = $('#' + id).val();
        // console.log(provinceId);
        $.ajax({
            url: "<?= base_url('city/get_city_by_province_id/') ?>" + provinceId,
            success: function(result) {
                defVal = '<option value="" selected>Select City</option>';
                result = defVal + result;
                tar = (tar != null) ? tar : "#city_dd";
                $(tar).html(result);
            }
        });
    }
    $(document).ready(function() {
        $(".weight").TouchSpin({
            min: 0,
            max: 30,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10,
            initval: 7
        });
        $(".select2").select2({
            width: 'resolve' // need to override the changed default
        });


        // Set Bootstrap Touch Spin for Shed Count
        $("input[name='shed']").TouchSpin({
            min: 1,
            max: 10000,
            step: 1,
            // decimals: 2,
            boostat: 1,
            maxboostedstep: 10,
            postfix: '',
            initval: 1
        });

    });




    $(document).ready(function() {
        $('.colorpicker-default').colorpicker({
            format: 'hex'
        });
        $('#mydt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('farm/get_list') ?>",
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
                    "data": "email"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "area"
                },
                {
                    "data": "propertytype"
                },
                {
                    "data": "openarea"
                },
                {
                    "data": "shed"
                },
                {
                    "data": "currency_id"
                },
                {
                    "data": "province_id"
                },
                {
                    "data": "city_id"
                },

                {
                    "data": "actions"
                }
            ]

        });
    });


    // Delete Function
    $(document).on('click', ".btn-delete", function() {
        $farm_id = $(this).attr('code');
        Swal.fire({
            title: 'are you sure ?',
            text: "This farm deleted",
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
                    url: "<?= base_url('farm/delete_farm/') ?>" + $farm_id,
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

    $(document).on('click', ".btn-edit", function() {
        $farm_id = $(this).attr('code');
        $.ajax({
            url: "<?= base_url('farm/get_farm/') ?>" + $farm_id,
            success: function(result) {},
            complete: function(result) {

                // Set Values
                $farm = JSON.parse(result.responseText);
                $('#id').val($farm.id);
                $('#codeu').val($farm.farm_code);
                $('#nameu').val($farm.title);
                $('#phoneu').val($farm.phone);
                $('#uom_idu').select2('val', $farm.uom_id);
                $('#shedu').val($farm.shed);
                $('#areau').val($farm.area);
                $('#openreau').val($farm.openrea);
                $('#emailu').val($farm.email);
                $('#propertytypeu').val($farm.property_type);

                $('#openareau').val($farm.open_area);
                // Change Currency
                $('#currency_idu').val($farm.currency_id);
                $('#country_idu').val($farm.country_id);
                $('#province_ddu').val($farm.province_id);
                // Notify any JS components that the value changed
                $('#country_idu').trigger('change');
                $('#propertytypeu').trigger('change');
                $('#currency_idu').trigger('change');

                // For Province
                // Set the value, creating a new option if necessary
                if ($('#province_ddu').find("option[value='" + $farm.province_id + "']").length) {
                    $('#province_ddu').val($farm.province_id).trigger('change');
                } else {
                    // Create a DOM Option and pre-select by default
                    var newOption = new Option($farm.province_name, $farm.province_id, true, true);
                    // Append it to the select
                    $('#province_ddu').append(newOption).trigger('change');
                }

                // For Province
                // Set the value, creating a new option if necessary
                if ($('#city_ddu').find("option[value='" + $farm.city_id + "']").length) {
                    $('#city_ddu').val($farm.city_id).trigger('change');
                } else {
                    // Create a DOM Option and pre-select by default
                    var newOption = new Option($farm.city_name, $farm.city_id, true, true);
                    // Append it to the select
                    $('#city_ddu').append(newOption).trigger('change');
                }

                // $('#quarantine_new_animalu').val();
                $('#descriptionu').val($farm.farm_description);
                // console.log($farm);
                $('#updateFarm').modal('show');
            }
        });


    });
</script>