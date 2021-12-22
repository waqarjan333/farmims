<?php

// use Mpdf\Tag\P;

class Disease_model extends CI_Model
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

    function get_all_disease_dd()
    {
        return $this->db->where('disease.status!=', DELETED)
            ->order_by('disease.name')
            ->get('disease')
            ->result();
    }

    function get_all_disease($limit, $start, $col, $dir)
    {
        $this->db->where('disease.status!=', DELETED);
        // $this->filter_by_active_farm('diseases');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('disease');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function disease_search($limit, $start, $search, $col, $dir)
    {
        $this->db->where('disease.status!=', DELETED);
        // $this->filter_by_active_farm('disease');
        $query = $this
            ->db
            ->where("(disease.name LIKE '%$search%')")
            ->limit($limit, $start)
            ->order_by($col, $dir)
            ->get('disease');


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function disease_search_count($search)
    {
        $this->db->where('disease.status!=', DELETED);
        $this->filter_by_active_farm('disease');
        $query = $this
            ->db
            ->where("(disease.name LIKE '%$search%')")
            // ->limit($limit,$start)
            // ->order_by($col,$dir)
            ->from('disease');


        return $this->db->count_all_results();
    }

    function get_all_disease_count()
    {
        $this->db->where('disease.status!=', DELETED);
        // $this->filter_by_active_farm('disease');
        $this->db->from('disease');
        return $this->db->count_all_results();
    }

    function add_disease($data)
    {
        $this->db->insert('disease', $data);
        return $this->db->insert_id() > 0;
    }

    function delete($id)
    {
        return $this->db->where('id', $id)
            ->update('disease', ['status' => DELETED]);
    }

    function update($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('disease', $data);
    }
}
