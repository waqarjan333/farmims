<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $this->lang->line('farmims_farm_management_system') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Best Farm & Cattle Management System" name="description" />
    <meta content="<?php echo $this->lang->line('farmims_farm_management_system') ?>" name="Codefelix" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.ico">
    <!-- Light layout Bootstrap Css -->
    <link href="<?= base_url() ?>assets/css/bootstrap-dark.min.css" id="bootstrap-dark-style" disabled="disabled" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <link href="<?= base_url() ?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Icons Css -->
    <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url() ?>assets/css/app-dark.min.css" id="app-dark-style" disabled="disabled" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/app-rtl.min.css" id="app-rtl-style" disabled="disabled" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="<?= base_url() ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />



    <script src="<?= base_url() ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url() ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/jszip/jszip.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="<?= base_url() ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="<?= base_url() ?>assets/libs/select2/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <?php if(get_cookie('site_lang')=='urdu'){  ?>
        <style>
                @font-face
                {
                    font-family: alvi;
                    src: url('<?php echo base_url() ?>assets/fonts/jameel-noori-nastaleeq-regular.ttf');
                } 
                body, *{
                    font-family:alvi,Arial,Tahoma !important;
                    /*font-weight: bold;*/
                }
        </style>
    <?php } ?>

</head>
<style>
    .w100p {
        width: 100% !important;
    }

    .menu-iconx {
        height: 15px !important;
        display: inline-block;
        min-width: 1.3rem;
        min-height: 1rem;
        padding-bottom: .125rem;
        padding-right: .15rem;
        font-size: 1.2rem;
        line-height: 1.4rem;
        vertical-align: middle;
        color: #7b8190;
        -webkit-transition: all .4s;
        transition: all .4s;
        text-align: center;
    }

    .mt-20 {
        margin-top: 20px !important;
    }

    .datepicker {
        z-index: 10000 !important;
    }

    .selected {
        background-color: #AAB7D1 !important;
        -webkit-transition: background-color 200ms linear;
        -ms-transition: background-color 200ms linear;
        transition: background-color 200ms linear;
    }

    .select2-container .select2-selection--multiple .select2-selection__choice {
        background-color: #50A5F1 !important;
        border: #50A5F1 !important;
        border-radius: 12px !important;
    }

    /* Custom Radio Button Box */


    .btn_choose_sent input {
        -webkit-appearance: none;
        display: block;
        margin: 10px;
        width: 18px;
        height: 18px;
        border-radius: 12px;
        cursor: pointer;
        vertical-align: middle;
        box-shadow: hsla(0, 0%, 100%, .15) 0 1px 1px, inset hsla(0, 0%, 0%, .5) 0 0 0 1px;
        background-color: hsla(0, 0%, 0%, .2);
        background-image: -webkit-radial-gradient(#fff 0%, #fff 15%, #fff 28%, #fff 70%);
        background-repeat: no-repeat;
        -webkit-transition: background-position .15s cubic-bezier(.8, 0, 1, 1),
            -webkit-transform .25s cubic-bezier(.8, 0, 1, 1);
        outline: none;
    }

    .btn_choose_sent input:checked {
        -webkit-transition: background-position .2s .15s cubic-bezier(0, 0, .2, 1),
            -webkit-transform .25s cubic-bezier(0, 0, .2, 1);
    }

    .btn_choose_sent input:active {
        -webkit-transform: scale(1.5);
        -webkit-transition: -webkit-transform .1s cubic-bezier(0, 0, .2, 1);
    }



    /* The up/down direction logic */

    .btn_choose_sent input,
    .btn_choose_sent input:active {
        background-position: 0 24px;
    }

    .btn_choose_sent input:checked {
        background-position: 0 0;
    }

    .btn_choose_sent input:checked~input,
    .btn_choose_sent input:checked~input:active {
        background-position: 0 -24px;
    }

    .btn_choose_sent {
        background: #EF2D56;
        color: #fff;
        box-shadow: 0 10px 20px rgba(125, 147, 178, .3);
        border: none;
        border-radius: 3px;
        font-size: 14px;
        line-height: 10px;
        padding: 10px 12px 10px 28px;
        text-align: center;
        display: inline-block;
        text-decoration: none;
        margin-right: 5px;
        transition: all .3s;
        height: auto;
        cursor: pointer;
        position: relative;
        outline: none;
    }

    .btn_choose_sent input {
        position: absolute;
        left: 0;
        right: 0;
        z-index: 99;
        top: -4px;
    }

    .btn_choose_sent input:after {
        position: absolute;
        content: '';
        width: 15rem;
        left: 0;
        right: 0;
        height: 30px;
        top: -10px;
    }

    .bg_btn_chose_1 {
        background-color: #0054ad !important;
    }


    .bg_btn_chose_2 {
        background-color: #d100a0 !important;
    }


    .bg_btn_chose_3 {
        background-color: #359dcc !important;
    }


    /*-=p=--=*/




    .btn_choose_sent_check_b {
        background: #EF2D56;
        color: #fff;
        box-shadow: 0 10px 20px rgba(125, 147, 178, .3);
        border: none;
        border-radius: 3px;
        font-size: 16px;
        line-height: 10px;
        padding: 16px 20px 16px 46px;
        text-align: center;
        display: inline-block;
        text-decoration: none;
        margin-right: 30px;
        transition: all .3s;
        height: auto;
        cursor: pointer;
        position: relative;
        outline: none;
    }

    /* Custom Radio Button Box End*/
</style>

<!-- Image Upload Custom Button -->

<style>
    @import url("https://fonts.googleapis.com/icon?family=Material+Icons");
    @import url("https://fonts.googleapis.com/css?family=Raleway");

    .wrapperx {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    h1 {
        font-family: inherit;
        margin: 0 0 0.75em 0;
        color: #728c8d;
        text-align: center;
    }

    .box {
        display: block;
        min-width: 300px;
        height: 180px;
        margin: 10px;
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
    }

    .upload-options {
        position: relative;
        height: 40px;
        background-color: cadetblue;
        cursor: pointer;
        overflow: hidden;
        text-align: center;
        transition: background-color ease-in-out 150ms;
    }

    .upload-options:hover {
        background-color: #7fb1b3;
    }

    .upload-options input {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .upload-options label {
        display: flex;
        align-items: center;
        width: 100%;
        height: 100%;
        font-weight: 400;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        overflow: hidden;
    }

    .upload-options label::after {
        content: "add";
        font-family: "Material Icons";
        position: absolute;
        font-size: 2.5rem;
        color: #e6e6e6;
        top: calc(75% - 2.5rem);
        left: calc(50% - 1.25rem);
        z-index: 0;
    }

    .upload-options label span {
        display: inline-block;
        width: 50%;
        height: 100%;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        vertical-align: middle;
        text-align: center;
    }

    .upload-options label span:hover i.material-icons {
        color: lightgray;
    }

    .js--image-preview {
        height: 140px;
        width: 100%;
        position: relative;
        overflow: hidden;
        background-image: url("");
        background-color: white;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .js--image-preview::after {
        content: "photo_size_select_actual";
        font-family: "Material Icons";
        position: relative;
        font-size: 4.5em;
        color: #e6e6e6;
        top: calc(50% - 3rem);
        left: calc(50% - 2.25rem);
        z-index: 0;
    }

    .js--image-preview.js--no-default::after {
        display: none;
    }

    i.material-icons {
        transition: color 100ms ease-in-out;
        font-size: 2.25em;
        line-height: 35px;
        color: white;
        display: block;
    }

    .drop {
        display: block;
        position: absolute;
        background: rgba(95, 158, 160, 0.2);
        border-radius: 100%;
        transform: scale(0);
    }

    .animate {
        -webkit-animation: ripple 0.4s linear;
        animation: ripple 0.4s linear;
    }

    @-webkit-keyframes ripple {
        100% {
            opacity: 0;
            transform: scale(2.5);
        }
    }

    @keyframes ripple {
        100% {
            opacity: 0;
            transform: scale(2.5);
        }
    }

    .menu-logo-info {
        height: 50px !important;
        margin-top: 10px !important;
    }
</style>
<!-- Image Upload Custom Button -->

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="#" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?= base_url() ?>assets/images/logo.jpg" alt="">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url() ?>assets/images/logo.jpg" alt="">
                            </span>
                        </a>

                        <a href="#" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?= base_url() ?>assets/images/logo.jpg" alt="">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url() ?>assets/images/logo.jpg" alt="">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('search_placeholder') ?>">
                            <span class="uil-search"></span>
                        </div>
                    </form>
                </div>

                <div class="d-flex">
                    <?php if ($this->session->userdata('role') != ROLE_SUPER_ADMIN) { ?>
                        <button type="button" class="btn <?= ($this->session->userdata('active_farm') ? 'btn-info' : 'btn-danger') ?> btn-sm waves-effect waves-light" data-toggle="modal" data-target=".select_farm_model"><?= ($this->session->userdata('active_farm') ? $this->session->userdata('active_farm_name') :   $this->lang->line('no_form_selected')) ?></button>
                    <?php } ?>
                    <div class="dropdown d-inline-block d-lg-none ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-search"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ml-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="uil-minus-path"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?= base_url() ?>assets/images/logo.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ml-1 font-weight-medium font-size-15"><?= $this->session->userdata('partie_name') ?></span>
                            <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="uil uil-user-circle font-size-18 align-middle text-muted mr-1"></i> <span class="align-middle"><?php echo $this->lang->line('view_profile') ?></span></a>
                            <a class="dropdown-item" href="<?= base_url('login/logout') ?>"><i class="uil uil-sign-out-alt font-size-18 align-middle mr-1 text-muted"></i> <span class="align-middle"><?php echo $this->lang->line('sign_out') ?></span></a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="uil-cog"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img class="menu-logo-info" src="<?= base_url() ?>assets/images/logo.jpg" alt="" height="35" class="rounded-circle">
                    </span>
                    <span class="logo-lg">
                        <img class="menu-logo-info" src="<?= base_url() ?>assets/images/logo.jpg" alt="" height="80" class="rounded-circle">

                    </span>
                </a>

                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img class="menu-logo-info" src="<?= base_url() ?>assets/images/logo.jpg" alt="" height="35" class="rounded-circle">
                    </span>
                    <span class="logo-lg">
                        <img class="menu-logo-info" src="<?= base_url() ?>assets/images/logo.jpg" alt="" height="80" class="rounded-circle">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div data-simplebar class="sidebar-menu-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title"><?php echo $this->lang->line('menu') ?></li>

                        <li>
                            <a href="<?= base_url() ?>">
                                <i class="uil-home-alt"></i>
                                <span><?php echo $this->lang->line('dashboard') ?></span>
                            </a>
                        </li>
                        <?php if ($this->session->userdata('role') == ROLE_SUPER_ADMIN) { ?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-window-section"></i>
                                    <span><?php echo $this->lang->line('master_data') ?></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= base_url('user') ?>"><?php echo $this->lang->line('user') ?></a></li>
                                    <li><a href="<?= base_url('farm') ?>"><?php echo $this->lang->line('farm') ?></a></li>
                                    <li><a href="<?= base_url('country') ?>"><?php echo $this->lang->line('countries') ?></a></li>
                                    <li><a href="<?= base_url('province') ?>"><?php echo $this->lang->line('provinces') ?></a></li>
                                    <li><a href="<?= base_url('city') ?>"><?php echo $this->lang->line('cities') ?></a></li>
                                    <li><a href="<?= base_url('areauom') ?>"><?php echo $this->lang->line('areauom') ?></a></li>
                                    <li><a href="<?= base_url('itemuom') ?>"><?php echo $this->lang->line('itemuom') ?></a></li>
                                    <li><a href="<?= base_url('currency') ?>"><?php echo $this->lang->line('currency') ?></a></li>
                                    <li><a href="<?= base_url('feedcategory') ?>"><?php echo $this->lang->line('feedcategory') ?></a></li>
                                    <li><a href="<?= base_url('productcategory') ?>"><?php echo $this->lang->line('itemcategory') ?></a></li>
                                    <li><a href="<?= base_url('Animal_test') ?>"><?php echo $this->lang->line('animals_test') ?></a></li>
                                    <li><a href="<?= base_url('disease') ?>"><?php echo $this->lang->line('disease') ?></a></li>
                                    <li><a href="<?= base_url('symptoms') ?>"><?php echo $this->lang->line('symptoms') ?></a></li>
                                    <li><a href="<?= base_url('landManagementType') ?>"><?php echo $this->lang->line('land_management_type') ?></a></li>
                                    <li><a href="<?= base_url('landManagementData') ?>"><?php echo $this->lang->line('land_management_data') ?></a></li>
                                    <li><a href="<?= base_url('Cropform') ?>"><?php echo $this->lang->line('crop_form') ?></a></li>
                                    <li><a href="<?= base_url('Finance') ?>"><?php echo $this->lang->line('add_finance_account') ?></a></li>

                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <img class='menu-iconx' src="<?= base_url('assets/images/cow.png') ?>" alt="">
                                    <!-- <i class="uil-bug"></i>-->
                                    <span><?php echo $this->lang->line('livestock') ?></span>

                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= base_url('animaltype') ?>"><?php echo $this->lang->line('animal_type') ?></a></li>
                                    <li><a href="<?= base_url('animalbreed') ?>"><?php echo $this->lang->line('animal_bread') ?></a></li>
                                </ul>
                            </li>



                        <?php } ?>
                        <?php if ($this->session->userdata('role') != ROLE_SUPER_ADMIN && $this->session->userdata('active_farm') != "") { ?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <img class='menu-iconx' src="<?= base_url('assets/images/cow.png') ?>" alt="">
                                    <!-- <i class="uil-bug"></i>-->
                                    <span><?php echo $this->lang->line('livestock') ?></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= base_url('animals') ?>"><?php echo $this->lang->line('animals') ?></a></li>
                                    <li><a href="<?= base_url('animals/pregnancy') ?>"><?php echo $this->lang->line('pregnancy/vaccine') ?></a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <img class='menu-iconx' src="<?= base_url('assets/images/cow.png') ?>" alt="">
                                    <span><?php echo $this->lang->line('cattleManagement') ?></a></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= base_url('fattening_animals') ?>"><?php echo $this->lang->line('animals') ?></a></li>
                                    <li><a href="<?= base_url('fattening_animals/vaccine') ?>"><?php echo $this->lang->line('vaccination') ?></a></li>
                                    <li><a href="<?= base_url('bulk_weight') ?>"><?php echo $this->lang->line('bulk_weight') ?></a></li>
                                </ul>

                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <img class='menu-iconx' src="<?= base_url('assets/images/cow.png') ?>" alt="">
                                    <!-- <i class="uil-bug"></i>-->
                                    <span><?php echo $this->lang->line('farm_clinic') ?></a></span>

                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= base_url('master_vaccine') ?>"><?php echo $this->lang->line('vaccine_master') ?></a></li>
                                    <li><a href="<?= base_url('bulk_dose') ?>"><?php echo $this->lang->line('bulk_dose') ?></a></li>
                                    <li><a href="<?= base_url('quarantine_animals') ?>"><?php echo $this->lang->line('qurantine') ?></a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="<?= base_url('feed') ?>" class="waves-effect">
                                    <i class="uil-window-section"></i>
                                    <span><?php echo $this->lang->line('feed_management') ?></a></span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-users-alt"></i>
                                    <span><?php echo $this->lang->line('land_management') ?></a></span>
                                </a>

                                <ul class="sub-menu" aria-expanded="false">

                                    <li><a href="<?= base_url('land_record') ?>"><?php echo $this->lang->line('land_record') ?></a></li>
                                    <li><a href="<?= base_url('land_record_list') ?>"><?php echo $this->lang->line('land_record_list') ?></a></li>
                                    <li><a href="<?= base_url('Cropform/InsertCropInfo') ?>"><?php echo $this->lang->line('crop_update') ?></a></li>
                                </ul>

                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-users-alt"></i>
                                    <span><?php echo $this->lang->line('business_partners') ?></span>
                                </a>

                                <ul class="sub-menu" aria-expanded="false">

                                    <li><a href="<?= base_url('manageprice') ?>"><?php echo $this->lang->line('manageprice') ?></a></li>
                                    <li><a href="<?= base_url('parties') ?>"><?php echo $this->lang->line('partners') ?></a></li>
                                </ul>

                            </li>

                            <li>
                                <a href="<?= base_url('partycategory') ?>" class="waves-effect">
                                    <i class="uil-user"></i>
                                    <span><?php echo $this->lang->line('business_partners_type') ?></span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-store-alt"></i>
                                    <span><?php echo $this->lang->line('inventory/stock') ?></span>
                                </a>

                                <ul class="sub-menu" aria-expanded="false">

                                    <li><a href="<?= base_url('product') ?>"><?php echo $this->lang->line('item') ?></a></li>
                                </ul>

                            </li>


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-shopping-cart-alt"></i>
                                    <span><?php echo $this->lang->line('purchase') ?></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a class="waves-effect" href="<?= base_url('purchase/po') ?>"><?php echo $this->lang->line('purchase_order') ?></a></li>
                                    <li><a href="<?= base_url('purchase/invoice') ?>"><?php echo $this->lang->line('purchase_invoice') ?></a></li>
                                    <li><a href="<?= base_url('purchase/pv') ?>"><?php echo $this->lang->line('payment_voucher') ?></a></li>
                                </ul>

                            </li>


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-percentage"></i>
                                    <span><?php echo $this->lang->line('sales') ?></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= base_url('sale/so') ?>"><?php echo $this->lang->line('sale_order') ?></a></li>
                                    <li><a href="<?= base_url('sale/invoice') ?>"><?php echo $this->lang->line('sale_invoice') ?></a></li>
                                    <li><a href="<?= base_url('sale/rv') ?>"><?php echo $this->lang->line('receipt_voucher') ?></a></li>
                                </ul>

                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-percentage"></i>
                                    <span><?php echo $this->lang->line('expenses') ?></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= base_url('expense') ?>"><?php echo $this->lang->line('expense') ?></a></li>
                                    <li><a href="<?= base_url('expense/land_expense') ?>"><?php echo $this->lang->line('land_expense') ?></a></li>
                                    <li><a href="<?= base_url('expense_category') ?>"><?php echo $this->lang->line('expense_category') ?></a></li>
                                </ul>

                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-percentage"></i>
                                    <span><?php echo $this->lang->line('reports') ?></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= base_url('current_stock') ?>"><?php echo $this->lang->line('current_stock') ?></a></li>
                                    <li><a href="<?= base_url('report/balance_sheet') ?>"><?php echo $this->lang->line('balance_sheet') ?></a></li>
                                    <li><a href="<?= base_url('report/financial_statement') ?>"><?php echo $this->lang->line('financial_statement') ?></a></li>
                                    <li><a href="<?= base_url('report/income_statement') ?>"><?php echo $this->lang->line('income_statement') ?></a></li>
                                </ul>

                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php
                    if (isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © FarmIMS.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                <?php echo $this->lang->line('crafted_with') ?> <i class="mdi mdi-heart text-danger"></i> by <a href="https://themesbrand.com/" target="_blank" class="text-reset"><?php echo $this->lang->line('codefelix') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title px-3 py-4">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
                <h5 class="m-0"><?php echo $this->lang->line('settings') ?></h5>
                <input type="hidden" value="<?php echo get_cookie('site_lang'); ?>" id="checkLang">
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0"><?php echo $this->lang->line('choose_layout') ?></h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                    <label class="custom-control-label" for="light-mode-switch"><?php echo $this->lang->line('light_mode') ?></label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css" />
                    <label class="custom-control-label" for="dark-mode-switch"><?php echo $this->lang->line('dark_mode') ?></label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-5">
                    <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch"  />
                    <label class="custom-control-label" for="rtl-mode-switch"><?php echo $this->lang->line('rtl_mode') ?></label>
                </div>


            </div>
            <h6 class="text-center mb-0"><?php echo $this->lang->line('choose_language') ?></h6>
            <div class="p-4">
                <div class="mb-2">
                <div class="form-group">
                    <!-- <label for="">Langauges</label> -->
                    <select name="" class="form-control" id="language">
                        <option value=""><?php echo $this->lang->line('select_language') ?></option>
                        <option value="english"><?php echo $this->lang->line('english') ?></option>
                        <option value="urdu"><?php echo $this->lang->line('urdu') ?></option>
                        <option value="arabic"><?php echo $this->lang->line('arabic') ?></option>
                    </select>
                    <input type="hidden" value="" id="selectedLang">
                </div>
            </div>
            </div>
            

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>


    <!--  Large modal example -->
    <div class="modal fade select_farm_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"><?php echo $this->lang->line('select_active_form') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <table id="mydt" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('code') ?></th>
                            <th><?php echo $this->lang->line('logo') ?></th>
                            <th><?php echo $this->lang->line('name') ?></th>
                            <th><?php echo $this->lang->line('set') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->session->userdata('farms') as $farms) { ?>
                            <tr>
                                <td class="text-center">
                                    <?= $farms['farm_code'] ?>
                                    <br>
                                    <div class="spinner-grow m-1" style="color: <?= $farms['color_code'] ?>;" role="status">
                                        <span class="sr-only"><?php echo $this->lang->line('loading') ?>...</span>
                                    </div>
                                </td>
                                <td><img class="img-thumbnailx" src="<?= base_url('assets/images/farmlogo/' . $farms['logo']) ?>" alt="" onError="this.onerror=null;this.src='<?= base_url('assets/images/logo.png') ?>';"></td>
                                <td><?= $farms['title'] ?></td>
                                <td>
                                    <?php echo form_open('dashboard/setfarm') ?>
                                    <input type="hidden" name="farm_id" value="<?= $farms['farm_id'] ?>" />
                                    <input type="hidden" name="active_farm_name" value="<?= $farms['title'] ?>" />
                                    <input type="hidden" name="quarantine_new_animal" value="<?= $farms['quarantine_new_animal'] ?>" />
                                    <input type="hidden" name="quarantine_days" value="<?= $farms['quarantine_days'] ?>" />
                                    <button <?php if ($this->session->userdata('active_farm') == $farms['farm_id']) {
                                                echo 'disabled';
                                            } ?> type="submit" class="btn btn-success btn-sm wawe waves-effect waves-light"><?php echo $this->lang->line('set_active') ?></button>
                                    <?php echo form_close() ?>

                                </td>
                            </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- JAVASCRIPT -->

    <script>
        $(document).ready(function(){
            var chklang=$('#checkLang').val();
            if(chklang=="english")
            {
                $('#rtl-mode-switch').prop('checked', false);

                $('head').append('<link rel="stylesheet" href="<?= base_url() ?>assets/css/app.min.css" type="text/css" />');
                
                $('#light-mode-switch').prop('checked', true);   
            }
            else{
                $('#light-mode-switch').prop('checked', false);
                $('#rtl-mode-switch').prop('checked', true);
                $('head').append('<link rel="stylesheet" href="<?= base_url() ?>assets/css/app-rtl.min.css" type="text/css" />');

            }
            var lang=localStorage.getItem("languageselcted");
          $("#language option[value='"+lang+"']").attr("selected","selected");
  
        })
        $(function() {
            AOS.init();
            var d = new Date(),
                h = d.getHours(),
                m = d.getMinutes();
            if (h < 10) h = '0' + h;
            if (m < 10) m = '0' + m;
            $('input[type="time"]').each(function() {
                $(this).attr({
                    'value': h + ':' + m
                });
            });
        });


        // Custom image upload

            $(function() {
                $('#language').on('change',function(){
                    var lang=$(this).val();
                    if(lang!='')
                    {
                          $.ajax({
                        url: '<?php echo base_url('Dashboard/language') ?>',
                        type: 'POST',
                        data: {lang: lang},
                        success:function(data)
                        {
                            localStorage.setItem("languageselcted", data); 
                            location.reload();
                        }
                    })
                    }
                  
                    
                })
            });


        // Image Upload Start
        function initImageUpload(box) {
            let uploadField = box.querySelector('.image-upload');

            uploadField.addEventListener('change', getFile);

            function getFile(e) {
                let file = e.currentTarget.files[0];
                checkType(file);
            }

            function previewImage(file) {
                let thumb = box.querySelector('.js--image-preview'),
                    reader = new FileReader();

                reader.onload = function() {
                    thumb.style.backgroundImage = 'url(' + reader.result + ')';
                }
                reader.readAsDataURL(file);
                thumb.className += ' js--no-default';
            }

            function checkType(file) {
                let imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    throw 'Datei ist kein Bild';
                } else if (!file) {
                    throw 'Kein Bild gewählt';
                } else {
                    previewImage(file);
                }
            }

        }

        // initialize box-scope
        var boxes = document.querySelectorAll('.box');

        for (let i = 0; i < boxes.length; i++) {
            let box = boxes[i];
            initDropEffect(box);
            initImageUpload(box);
        }



        /// drop-effect
        function initDropEffect(box) {
            let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;

            // get clickable area for drop effect
            area = box.querySelector('.js--image-preview');
            area.addEventListener('click', fireRipple);

            function fireRipple(e) {
                area = e.currentTarget
                // create drop
                if (!drop) {
                    drop = document.createElement('span');
                    drop.className = 'drop';
                    this.appendChild(drop);
                }
                // reset animate class
                drop.className = 'drop';

                // calculate dimensions of area (longest side)
                areaWidth = getComputedStyle(this, null).getPropertyValue("width");
                areaHeight = getComputedStyle(this, null).getPropertyValue("height");
                maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

                // set drop dimensions to fill area
                drop.style.width = maxDistance + 'px';
                drop.style.height = maxDistance + 'px';

                // calculate dimensions of drop
                dropWidth = getComputedStyle(this, null).getPropertyValue("width");
                dropHeight = getComputedStyle(this, null).getPropertyValue("height");

                // calculate relative coordinates of click
                // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
                x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 100) / 2);
                y = e.pageY - this.offsetTop - (parseInt(dropHeight, 100) / 2) - 30;

                // position drop and animate
                drop.style.top = y + 'px';
                drop.style.left = x + 'px';
                drop.className += ' animate';
                e.stopPropagation();

            }
        }

        // Custom image upload end
    </script>
    <script src="<?= base_url() ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>

    <script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

    <script src="<?= base_url() ?>assets/js/app.js"></script>
    <!-- MomentJS -->
    <script src="<?= base_url() ?>assets/libs/moment/moment.min.js"></script>


</body>

</html>