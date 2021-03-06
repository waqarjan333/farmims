<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class LandManagementData_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    

    function get_all_LandManagementType_for_dd(){
        $this->db->where('status!=',DELETED);
        $this->db->select('id, land_management_type');
        $this->db->where('status', ACTIVE);
        return $this->db->order_by('land_management_type')
        ->get('land_management_type')->result_array();
    }

    function get_all_LandType_data($type){
        $this->db->where('lmd.status!=',DELETED);
        $this->db->where('lmt.land_management_type=',$type);
        $this->db->select('lmd.*, lmt.land_management_type as land_management_type');
        $this->db->join('land_management_type AS lmt','lmt.id = lmd.land_management_type_id');
        $query = $this->db->get('land_management_data AS lmd'); 
       // var_dump($query);exit;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function get_all_LandManagementData_count()
    {
        $query = $this->db->get('land_management_data'); 
        return $query->num_rows();
    }

    
    function get_all_LandManagementData($limit, $start, $col, $dir)
    {
        $this->db->where('land_management_data.status', ACTIVE);
        $this->db->select('land_management_data.*, land_management_type.land_management_type as land_management_type');
        $this->db->join('land_management_type','land_management_type.id = land_management_data.land_management_type_id');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('land_management_data'); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function LandManagementData_search($limit,$start,$search,$col,$dir)
    {
        $this->db->where('land_management_data.status', ACTIVE);
        $this->db->select('land_management_data.*, land_management_type.land_management_type as land_management_type');
        $this->db->join('land_management_type','land_management_type.id = land_management_data.land_management_type_id');
        $query = $this
                ->db
                ->like('land_management_data.land_management_data',$search) 
                ->or_like('land_management_type.land_management_type',$search) 
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('land_management_data');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function LandManagementData_search_count($search)
    {
        $this->db->where('land_management_data.status', ACTIVE);
        $this->db->select('land_management_data.*, land_management_type.land_management_type as land_management_type');
        $this->db->join('land_management_type','land_management_type.id = land_management_data.land_management_type_id');
        $query = $this
                ->db
                ->like('land_management_data.land_management_data',$search) 
                ->or_like('land_management_type.land_management_type',$search)
                ->get('land_management_data');
    
        return $query->num_rows();
    } 

    /*
     * function to add new brand
     */
    function add($params)
    {
        $this->db->insert('land_management_data', $params);
        return $this->db->insert_id();
    }

    
    function delete($id)
    {
        return $this->db->delete('land_management_data', array('id' => $id));
    }

    

    function update($id,$data){
        return $this->db->where('id',$id)
        ->update('land_management_data',$data);
    }
}
