<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Marking_area_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function batch_count(){
        $this->filter_by_active_farm();
        $this->db->where('status!=',DELETED);
        $query = $this->db->get('land_batch'); 
        //print_r($this->db->last_query()); exit;
        return $query->num_rows();
        
    }

}