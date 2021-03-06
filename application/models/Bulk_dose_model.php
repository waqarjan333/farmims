<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Bulk_dose_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        
    }

    function get_animaltype_for_dd(){
        
        $this->db->select('animal_type.id, animal_type.type_of_animal as animal_name');
        $this->db->where('status', ACTIVE);
        return $this->db->get('animal_type')->result_array();
    }

    function get_all_animals_vaccine_count()
    {
        $this->filter_by_active_farm();
        $query = $this->db->get('animal_vaccine');
        return $query->num_rows();
    }

    function get_all_animals_vaccine($limit, $start, $col, $dir)
    {
        // echo $this->session->userdata('active_farm');exit;
        $this->db->select('animal_vaccine.*, animals.name, animals.code, product.product_name AS vaccine_name, item_uom.name AS uom');
        $this->db->join('animals', 'animals.id = animal_vaccine.animal_id','left');
        $this->db->join('product', 'animal_vaccine.vaccine_id = product.id','left');
        $this->db->join('item_uom', 'animal_vaccine.uom = item_uom.id','left');
        $this->filter_by_active_farm('animal_vaccine');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('animal_vaccine');
        // echo $this->db->last_query(); die;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

        function get_all_fattening_animals_vaccine_count()
    {
        $this->db->where('a.status!=',DELETED);
        $this->filter_by_active_farm('fattening_animal_vaccine');
        $this->db->join('fattening_animals AS a', 'a.id = fattening_animal_vaccine.animal_id');
        // $query = 
        $this->db->from('fattening_animal_vaccine');
        
        return $this->db->count_all_results(); 
        // $query->num_rows();
    }
    function get_all_fattening_animals_vaccine($limit, $start, $col, $dir)
    {
        $this->db->where('fattening_animals.status!=',DELETED);
        $this->db->select('fattening_animal_vaccine.*, fattening_animals.name, fattening_animals.code, product.product_name AS vaccine_name, item_uom.name AS uom');
        $this->db->join('fattening_animals', 'fattening_animals.id = fattening_animal_vaccine.animal_id');
        $this->db->join('product', 'fattening_animal_vaccine.vaccine_id = product.id');
        $this->db->join('item_uom', 'fattening_animal_vaccine.uom = item_uom.id');
        $this->filter_by_active_farm('fattening_animal_vaccine');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('fattening_animal_vaccine');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

        function get_fattening_animals_vaccine_search($limit, $start, $search, $col, $dir)
    {
        $this->db->where('fattening_animals.status!=',DELETED);
        $this->db->select('fattening_animal_vaccine.*, fattening_animals.name, fattening_animals.code, product.product_name AS vaccine_name, item_uom.name AS uom');
        $this->db->join('fattening_animals', 'fattening_animals.id = fattening_animal_vaccine.animal_id');
        $this->db->join('product', 'fattening_animal_vaccine.vaccine_id = product.id');
        $this->db->join('item_uom', 'fattening_animal_vaccine.uom = item_uom.id');
        $this->filter_by_active_farm('fattening_animal_vaccine');

        $this->db
        ->like('fattening_animals.name', $search)
            ->or_like('fattening_animals.id', $search)
            ->or_like("DATE_FORMAT(fattening_animal_vaccine.vaccine_date,'%d %b,%Y')", $search)
            ->or_like("DATE_FORMAT(fattening_animal_vaccine.next_vaccine,'%d %b,%Y')", $search)
            // ->or_like('a.dop', $search)
            // ->or_like('breed.breed_name', $search)
            // ->or_like('animal_type.type_of_animal', $search)

            ->limit($limit, $start);

        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('fattening_animal_vaccine');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function get_animals_vaccine_search_count($search)
    {
        $this->db->select('animal_vaccine.*, a.name, a.code');
        $this->db->join('animals AS a', 'a.id = animal_vaccine.animal_id');
        $this->filter_by_active_farm('animal_vaccine');
        // $this->filter_by_active_farm('a');
        $query = $this
            ->db
            ->like('a.name', $search)
            ->or_like('animal_vaccine.vaccine_date', $search)
            ->or_like('animal_vaccine.next_vaccine', $search)
            ->from('animal_vaccine');

            return $this->db->count_all_results();
    }
    
    function get_animals_vaccine_search($limit, $start, $search ,$col, $dir)
    {
        $this->db->select('animal_vaccine.*, a.name, a.code, product.product_name AS vaccine_name, item_uom.name AS uom');
        $this->db->join('animals AS a', 'a.id = animal_vaccine.animal_id');
        $this->db->join('product', 'animal_vaccine.vaccine_id = product.id');
        $this->db->join('item_uom', 'animal_vaccine.uom = item_uom.id');
        $this->filter_by_active_farm('a');
        // $this->filter_by_active_farm('a');
        $query = $this
            ->db
            ->like('a.name', $search)
            ->or_like("DATE_FORMAT(animal_vaccine.vaccine_date,'%d %b,%Y')", $search)
            ->or_like("DATE_FORMAT(animal_vaccine.next_vaccine,'%d %b,%Y')", $search)
            // ->or_like('a.dop', $search)
            // ->or_like('breed.breed_name', $search)
            // ->or_like('animal_type.type_of_animal', $search)

            ->limit($limit, $start)
            ->order_by($col, $dir)
            ->get('animal_vaccine');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }    
    
}
