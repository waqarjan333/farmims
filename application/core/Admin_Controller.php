<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Admin_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('login');
        }
    }

    function onlly_admin_check(){
        if($this->session->userdata('role') == ROLE_SUPER_ADMIN){
            return true;
        } else {
            return false;
        }
    }

}


