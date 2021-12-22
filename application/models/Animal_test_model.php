<?php

use Mpdf\Tag\P;

class Animal_test_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function get_all_animal_test_dd(){
        $this->db->where('animal_tests.status!=',DELETED);
        // $this->filter_by_active_farm('animal_tests');
        $query = $this->db->order_by('animal_tests.test_name')->get('animal_tests'); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
    }

    function get_all_animal_test($limit, $start, $col, $dir)
    {
        $this->db->where('animal_tests.status!=',DELETED);
        // $this->filter_by_active_farm('animal_tests');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('animal_tests'); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function animal_test_search($limit,$start,$search,$col,$dir)
    {
        $this->db->where('animal_tests.status!=',DELETED);
        // $this->filter_by_active_farm('animal_tests');
        $query = $this
                ->db
                ->where("(animal_tests.test_name LIKE '%$search%' OR animal_tests.description LIKE '%$search%')")
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('animal_tests');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function animal_test_search_count($search)
    {
        $this->db->where('animal_tests.status!=',DELETED);
        $this->filter_by_active_farm('animal_tests');
        $query = $this
                ->db
                ->where("(animal_tests.test_name LIKE '%$search%' OR animal_tests.description LIKE '%$search%')")
                // ->limit($limit,$start)
                // ->order_by($col,$dir)
                ->from('animal_tests');
        
       
        return $this->db->count_all_results();
    }

    function get_all_animal_test_count(){
        $this->db->where('animal_tests.status!=',DELETED);
        // $this->filter_by_active_farm('animal_tests');
        $this->db->from('animal_tests');
        return $this->db->count_all_results();
    }

    function addtest($data){
        $this->db->insert('animal_tests',$data);
        return $this->db->insert_id()>0;
    }

    function delete_animal_test($id){
        return $this->db->where('id',$id)
        ->update('animal_tests',['status'=>DELETED]);
    }

    function update_animal_test($id,$data){
        $this->db->where('id',$id)
        ->update('animal_tests',$data);
    }

}