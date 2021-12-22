<?php

// use Mpdf\Tag\P;

class Symptoms_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    // function get_all_animal_test_dd(){
    //     $this->db->where('animal_tests.status!=',DELETED);
    //     // $this->filter_by_active_farm('animal_tests');
    //     $query = $this->db->order_by('animal_tests.symptom')->get('animal_tests'); 

    //     if ($query->num_rows() > 0) {
    //         return $query->result();
    //     } else {
    //         return [];
    //     }
    // }

    function get_all_symptom($limit, $start, $col, $dir)
    {
        $this->db->where('symptoms.status!=', DELETED);
        // $this->filter_by_active_farm('symptoms');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('symptoms');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function symptom_search($limit, $start, $search, $col, $dir)
    {
        $this->db->where('symptoms.status!=', DELETED);
        // $this->filter_by_active_farm('symptoms');
        $query = $this
            ->db
            ->where("(symptoms.name LIKE '%$search%' OR symptoms.description LIKE '%$search%')")
            ->limit($limit, $start)
            ->order_by($col, $dir)
            ->get('symptoms');


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function symptom_search_count($search)
    {
        $this->db->where('symptoms.status!=', DELETED);
        $this->filter_by_active_farm('symptoms');
        $query = $this
            ->db
            ->where("(symptoms.name  LIKE '%$search%')")
            // ->limit($limit,$start)
            // ->order_by($col,$dir)
            ->from('symptoms');


        return $this->db->count_all_results();
    }

    function get_all_symptom_count()
    {
        $this->db->where('symptoms.status!=', DELETED);
        // $this->filter_by_active_farm('symptoms');
        $this->db->from('symptoms');
        return $this->db->count_all_results();
    }

    function addtest($data)
    {
        $this->db->insert('symptoms', $data);
        return $this->db->insert_id() > 0;
    }

    function delete_symptom($id)
    {
        return $this->db->where('id', $id)
            ->update('symptoms', ['status' => DELETED]);
    }

    function update_symptom($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('symptoms', $data);
    }

    function add_symptom($data){
        return $this->db->insert('symptoms',$data);
    }

}
