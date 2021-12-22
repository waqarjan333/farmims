<style>
    .badge-pink {
        background-color: pink;
    }
</style>
<div class="row mb-4">
    <div class="col-xl-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="text-center">
                    <div class="dropdown float-right">
                        <a class="text-body dropdown-toggle font-size-18" href="#" role="button" data-toggle="dropdown" aria-haspopup="true">
                            <i class="uil uil-ellipsis-v"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><?= $this->lang->line('edit'); ?></a>
                            <a class="dropdown-item" href="#"><?= $this->lang->line('suspend'); ?></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div>
                        <img onerror='imgError(this);' src="<?= base_url('assets/images/animals/' . $animal['avatar']) ?>" alt="" class="avatar-lg img-thumbnail">
                    </div>
                    <h5 class="mt-3 mb-1"><?= $animal['code'] ?></h5>
                    <p class="text-muted"><?= $animal['name'] ?></p>

                </div>

                <hr class="my-4">

                <div class="text-muted">
                    <div class="table-responsive mt-4">
                        <div>
                            <p class="mb-1"><?= $this->lang->line('date_of_birth'); ?> :</p>
                            <h5 class="font-size-16"><?= date('d M,Y', strtotime($animal['dob'])) ?></h5>
                        </div>
                        <div class="mt-4">
                            <p class="mb-1"><?= $this->lang->line('date_of_purchase'); ?></p>
                            <h5 class="font-size-16"><?= date('d M,Y', strtotime($animal['dop'])) ?></h5>
                        </div>
                        <div class="mt-4">
                            <p class="mb-1"><?= $this->lang->line('age'); ?> :</p>
                            <h5 class="font-size-16">
                                <?php
                                $bday = new DateTime($animal['dob']); // Your date of birth
                                $today = new Datetime(date('m.d.y'));
                                $diff = $today->diff($bday);
                                printf('%d Years, %d Months, %d Days', $diff->y, $diff->m, $diff->d);
                                ?>
                            </h5>
                        </div>
                        <div class="mt-4">
                            <p class="mb-1">Gender : <?php if ($animal['sex'] == MALE) { ?>
                                    <span class="badge badge-info font-size-14"><?= $this->lang->line('male'); ?></span>
                                <?php } else if ($animal['sex'] == FEMALE) { ?>
                                    <span class="badge badge-pink font-size-14"><?= $this->lang->line('female'); ?></span>
                                <?php } ?>
                            </p>
                        </div>

                        <div class="mt-4">
                            <p class="mb-1">Status :
                                <?php
                                if ($animal['status'] == ACTIVE) {
                                    $status = '<span class="badge font-size-14 badge-pill badge-primary">MILKING</span>';
                                } else if ($animal['status'] == SUSPENDED) {
                                    $status = '<span class="badge font-size-14 badge-pill badge-dark">INACTIVE</span>';
                                } else if ($animal['status'] == PREGNENT) {
                                    $status = '<span class="badge font-size-14 badge-pill badge-success">PREGNENT</span>';
                                } else if ($animal['status'] == HEIFER) {
                                    $status = '<span class="badge font-size-14 badge-pill badge-warning">HEIFER</span>';
                                } else if ($animal['status'] == QUARANTINE) {
                                    
                                    $now = time(); // or your date as well
                                    $your_date = strtotime($animal['dop']);
                                    $datediff = $now - $your_date;
                                    $days_passed =  round($datediff / (60 * 60 * 24));
                                    $days_left = intval($animal['quarantine_period']) - intval($days_passed);

                                    // if ($days_left <= 1) {
                                    //     $unquarantine = "<br> <a href='" . base_url('animals/move_to_milking/' . $animal['id']) . "' class='btn btn-success btn-sm waves-effect waves-warning'>Move To Milking</a>";
                                    // } else {
                                    $unquarantine = "";
                                    // }
                                    $status = '<span class="badge font-size-14 badge-pill badge-danger">QUARANTINED</span><br>' . $days_left . ' Days Left' . $unquarantine;
                                } else if ($animal['status'] == DISEASED) {
                                    $status = '<span class="badge font-size-14 badge-pill badge-dark">DISEASES</span>';
                                }
                                echo $status;
                                ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card mb-0">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">

                <li class="nav-item" onclick="get_vaccine_history('<?php echo base64_encode($animal['id']); ?>')">
                    <a class="nav-link active" data-toggle="tab" href="#vaccination_history" role="tab">
                        <i class="uil uil-syringe font-size-20"></i>
                        <span class="d-none d-sm-block"><?= $this->lang->line('vaccination_history'); ?></span>
                    </a>
                </li>

                <li class="nav-item" onclick="get_weight_history('<?php echo base64_encode($animal['id']); ?>')">
                    <a class="nav-link " data-toggle="tab" href="#weight_history" role="tab">
                        <i class="uil uil-water-glass font-size-20"></i>
                        <span class="d-none d-sm-block"><?= $this->lang->line('weight_history'); ?></span>
                    </a>
                </li>

            </ul>
            <!-- Tab content -->
            <div class="tab-content p-4">
                <div class="tab-pane active" id="weight_history" role="tabpanel">
                    <table id="weighttable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th><?= $this->lang->line('date'); ?></th>
                                <th><?= $this->lang->line('weight1'); ?></th>
                                <!-- <th>Approx / Exact</th>
                                    <th>Routine</th> -->
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="vaccination_history" role="tabpanel">
                    <div class="table-responsive">

                        <table id="vaccinetable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('vaccine'); ?></th>
                                    <th><?= $this->lang->line('date'); ?></th>
                                    <th><?= $this->lang->line('next_vaccine'); ?></th>
                                    <th><?= $this->lang->line('status'); ?></th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function imgError(image) {
        image.onerror = "";
        image.src = "<?= base_url('assets/images/cow.png') ?>";
        return true;
    }

    function get_weight_history(animal_id) {
        $("#weighttable").dataTable().fnDestroy();
        var oTable = $('#weighttable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('fattening_animals/get_weight_history/') ?>" + animal_id,
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "date"
                },
                {
                    "data": "weight"
                },
                // {
                //     "data": "approx_exac"
                // },
                // {
                //     "data": "routine"
                // }
            ],
            "drawCallback": function(settings) {}

        });
    }

    function get_vaccine_history(animal_id) {
        $("#vaccinetable").dataTable().fnDestroy();
        var oTable = $('#vaccinetable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('fattening_animals/get_vaccine_history/') ?>" + animal_id,
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "vaccine"
                },
                {
                    "data": "date"
                },
                {
                    "data": "next_vaccine"
                }, {
                    "data": "next_taken"
                }
                // {
                //     "data": "approx_exac"
                // },
                // {
                //     "data": "routine"
                // }
            ],
            "drawCallback": function(settings) {}

        });
    }
</script>