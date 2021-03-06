<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Animals_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get animal by id
     */
    function get_animal($id)
    {
        $this->db->where('animals.status!=',DELETED);
        return $this->db->get_where('animals', array('id' => $id))->row_array();
    }

    function get_code()
    {
        $this->filter_by_active_farm();
        $query = $this->db->get('animals');
        $numrows =  $query->num_rows();
        return 'LSD' . sprintf('%06d', $numrows + 1);
    }

    function get_all_milking_history_count($animal_id)
    {
        $this->filter_by_active_farm();
        $query = $this->db->get_where('milk_yeild', array('animal_id' => $animal_id));
        return $query->num_rows();
    }

    function get_all_weight_history_count($animal_id)
    {
        $this->filter_by_active_farm();
        $query = $this->db->get_where('animal_weight_history', array('animal_id' => $animal_id));
        return $query->num_rows();
    }

    function get_all_vaccine_history_count($animal_id)
    {
        $this->filter_by_active_farm();
        $query = $this->db->get_where('animal_vaccine', array('animal_id' => $animal_id));
        return $query->num_rows();
    }

    
    function get_all_milking_history($limit, $start, $col, $dir, $animal_id)
    {
        $this->db->select('milk_yeild.*');
        $this->filter_by_active_farm();
        $this->db->where('animal_id',$animal_id);
        $this->db->order_by('date','desc');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('milk_yeild');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function get_all_weight_history($limit, $start, $col, $dir, $animal_id)
    {
        $this->db->select('animal_weight_history.*');
        $this->filter_by_active_farm();
        $this->db->where('animal_id',$animal_id);
        $this->db->order_by('date','desc');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('animal_weight_history');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    


    function get_all_vaccine_history($limit, $start, $col, $dir, $animal_id)
    {
        $this->db->select('animal_vaccine.*, animals.name, animals.code');
        $this->db->join('animals', 'animals.id = animal_vaccine.animal_id');
        $this->db->where('animal_id',$animal_id);
        $this->filter_by_active_farm('animal_vaccine');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('animal_vaccine');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    /*
     * Get all animal count
     */
    function get_all_animals_count()
    {
        $this->db->where('animals.status!=',DELETED);
        $this->filter_by_active_farm();
        $query = $this->db->get('animals');
        return $query->num_rows();
    }

    function breed_by_animaltype_id($id)
    {
        $this->db->select('breed.id, breed.breed_name');
        $this->db->where('status', ACTIVE);
        $this->db->where('animal_type_id', $id);
        return  $this->db->get('breed')->result_array();
    }

    function animal_by_animaltype_id($id)
    {
        $this->db->where('animals.status!=',DELETED);
        $this->db->select('animals.id, animals.name as animals_name');
        $this->filter_by_active_farm();
        $this->db->where('status', ACTIVE);
        $this->db->where('sex', MALE);
        $this->db->where('animal_type', $id);
        $this->db->get('animals')->result_array();
        print_r($this->db->last_query());    


        $this->db->select('animals.id, animals.name as animals_name');
        $this->filter_by_active_farm();
        $this->db->where('status', ACTIVE);
        $this->db->where('sex', FEMALE);
        $this->db->where('animal_type', $id);
        $data['female'] =  $this->db->get('animals')->result_array();
        return $data;
    }
    /*
     * Get all animal
     */
    function get_all_animals($limit, $start, $col, $dir)
    {
        $this->db->where('a.status!=',DELETED);
        $this->db->select('a.*, af.name as father_name, am.name as mother_name, breed.breed_name, animal_type.type_of_animal as type,item_uom.symbol');
        $this->db->join('animals as af', 'af.id = a.father_id', 'left outer');
        $this->db->join('animals as am', 'am.id = a.mother_id', 'left outer');
        $this->db->join('breed', 'breed.id = a.animal_breed');
        $this->db->join('animal_type', 'animal_type.id = a.animal_type');
        $this->db->join('item_uom', 'item_uom.id = a.item_uom_id', 'left outer');
        $this->filter_by_active_farm('a');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('animals as a');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }


    function get_all_animals_vaccine_count()
    {
        $this->filter_by_active_farm();
        $query = $this->db->get('animal_vaccine');
        return $query->num_rows();
    }

    function get_all_animals_vaccine($limit, $start, $col, $dir)
    {
        $this->db->where('animals.status!=',DELETED);
        $this->db->select('animal_vaccine.*, animals.name, animals.code');
        $this->db->join('animals', 'animals.id = animal_vaccine.animal_id');
        $this->filter_by_active_farm('animal_vaccine');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('animal_vaccine');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function get_animals_vaccine_search_count($search)
    {
        $this->db->where('animals.status!=',DELETED);
        $this->db->select('animal_vaccine.*, a.name, a.code');
        $this->db->join('animals AS a', 'a.id = animal_vaccine.animal_id');
        $this->filter_by_active_farm('animal_vaccine');
        // $this->filter_by_active_farm('a');
        $query = $this
            ->db
            // ->like('a.name', $search)
            // ->or_like('animal_vaccine.vaccine_date', $search)
            // ->or_like('animal_vaccine.next_vaccine', $search)
            ->where("(a.name LIKE '%$search%' OR animal_vaccine.vaccine_date  LIKE '%$search%' OR animal_vaccine.next_vaccine  LIKE '%$search%')")
            ->from('animal_vaccine');

            return $this->db->count_all_results();
    }
    
    function get_animals_vaccine_search($limit, $start, $search ,$col, $dir)
    {
        $this->db->where('animals.status!=',DELETED);
        $this->db->select('animal_vaccine.*, a.name, a.code');
        $this->db->join('animals AS a', 'a.id = animal_vaccine.animal_id');
        $this->filter_by_active_farm('a');
        // $this->filter_by_active_farm('a');
        $query = $this
            ->db
            // ->like('a.name', $search)
            // ->or_like("DATE_FORMAT(animal_vaccine.vaccine_date,'%d %b,%Y')", $search)
            // ->or_like("DATE_FORMAT(animal_vaccine.next_vaccine,'%d %b,%Y')", $search)
            ->where("(a.name LIKE '%$search%' OR animal_vaccine.vaccine_date  LIKE '%$search%' OR animal_vaccine.next_vaccine  LIKE '%$search%')")
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

    function get_animals_eligible_for_pregnancy($animal_type)
    {
        $typeinfo = $this->db->get_where('animal_type', array('id' => $animal_type))->row_array();
        
        $this->db->where('animals.status!=',DELETED);
        
        $this->db->select("animals.*,ROUND(DATEDIFF(CURRENT_DATE,animals.dob) / 30.4) AS age");
        $this->db->where('animals.sex', FEMALE);
        $this->db->where('animals.status', ACTIVE);
        $this->db->where('ROUND(DATEDIFF(CURRENT_DATE,animals.dob) / 30.4) >=', $typeinfo['pregnancy_age']);
        $this->db->where('animals.animal_type', $animal_type);
        $this->filter_by_active_farm('animals');
        return $this->db->get('animals')->result_array();
    }

    function get_fathers()
    {
        
        $this->db->select("animals.*,ROUND(DATEDIFF(CURRENT_DATE,animals.dob) / 30.4) AS age");
        $this->db->where('animals.sex', MALE);
        $this->filter_by_active_farm('animals');
        return $this->db->get('animals')->result_array();
    }

    function get_all_pregnant_animals()
    {
        $this->db->where('animals.status!=',DELETED);
        $this->db->select('animal_pregnancy.*,animals.name,animals.animal_breed,animals.code,animal_type.pregnancy_period');
        $this->db->join('animal_type', 'animal_type.id = animal_pregnancy.animal_type');
        $this->db->join('animals', 'animals.id = animal_pregnancy.animal_id');
        $this->db->where('animal_pregnancy.actual_delivery_date', null);
        $this->filter_by_active_farm('animal_pregnancy');
        return $this->db->order_by('animal_pregnancy.date', 'asc')->get('animal_pregnancy')->result_array();
    }

    function animals_search($limit, $start, $search, $col, $dir)
    {
        // $this->db->select('a.*, af.name as father_name, am.name as mother_name, breed.breed_name, animal_type.type_of_animal as type');
        $this->db->where('a.status!=',DELETED);
        $this->db->select('a.*, af.name as father_name, am.name as mother_name, breed.breed_name, animal_type.type_of_animal as type,item_uom.symbol');
        $this->db->join('animals as af', 'af.father_id = a.id', 'left outer');
        $this->db->join('animals as am', 'am.mother_id = a.id', 'left outer');
        $this->db->join('breed', 'breed.id = a.animal_breed');
        $this->db->join('animal_type', 'animal_type.id = a.animal_type');
        $this->db->join('item_uom', 'item_uom.id = a.item_uom_id', 'left outer');
        $this->filter_by_active_farm('a');
        $query = $this
            ->db
            // ->like('a.name', $search)
            // ->or_like('a.code', $search)
            // ->or_like('a.dob', $search)
            // ->or_like('a.dop', $search)
            // ->or_like('breed.breed_name', $search)
            // ->or_like('animal_type.type_of_animal', $search)
            ->where("(a.name LIKE '%$search%' OR a.code  LIKE '%$search%' OR a.dob LIKE '%$search%' OR a.dop LIKE '%$search%' OR breed.breed_name LIKE '%$search%' OR animal_type.type_of_animal LIKE '%$search%')")
            ->limit($limit, $start)
            ->order_by($col, $dir)
            ->get('animals as a');


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function animals_search_count($search)
    {
        // $this->db->where('a.status!=',DELETED);
        $this->db->select('a.*, af.name as father_name, am.name as mother_name, breed.breed_name, animal_type.type_of_animal as type');
        $this->db->join('animals as af', 'af.father_id = a.id', 'left outer');
        $this->db->join('animals as am', 'am.mother_id = a.id', 'left outer');
        $this->db->join('breed', 'breed.id = a.animal_breed');
        $this->db->join('animal_type', 'animal_type.id = a.animal_type');
        $this->db->join('item_uom', 'item_uom.id = a.item_uom_id', 'left outer');
        $this->filter_by_active_farm('a');
        $query = $this
            ->db
            // ->like('a.name', $search)
            // ->or_like('a.code', $search)
            // ->or_like('a.dob', $search)
            // ->or_like('a.dop', $search)
            // ->or_like('breed.breed_name', $search)
            // ->or_like('animal_type.type_of_animal', $search)
            ->where('a.status!=',DELETED)
            ->where("(a.name LIKE '%$search%' OR a.code  LIKE '%$search%' OR a.dob LIKE '%$search%' OR a.dop LIKE '%$search%' OR breed.breed_name LIKE '%$search%' OR animal_type.type_of_animal LIKE '%$search%')")
            ->get('animals as a');

        return $query->num_rows();
    }

    /*
     * function to add new animal
     */
    function add_animals($params)
    {
        $this->db->insert('animals', $params);
        //print_r($this->db->last_query()); exit;
         $this->db->insert_id();
        $lastID= $this->db->insert_id();
         $params1 = array(
                        'acc_number' => '102001',
                        'item_id' =>$lastID,
                        'journal_details' =>'Add New Animal Entry',
                        'journal_amount' =>'100',
                        'type' =>'Animal'
                    );
         $this->db->insert('account_journal', $params1);
         $lastJournalID= $this->db->insert_id();
          $updateParam = array(
                        'ref_id' => $lastJournalID
                    );


          $this->db->where('journal_id', $lastJournalID);
         $this->db->update('account_journal', $updateParam);

           $params2 = array(
                        'ref_id' => $lastJournalID,
                        'acc_number' => '102002',
                        'item_id' =>$lastID,
                        'journal_details' =>'Add New Animal Entry',
                        'journal_amount' =>'-100',
                        'type' =>'Animal'
                    );
            $this->db->insert('account_journal', $params2);
            return $lastID;
    }

    /*
     * function to update animal
     */
    function update_animal($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('animals', $params);
    }

    /*
     * function to delete animal
     */
    function delete_animal($id)
    {
        return $this->db->where(array('id' => $id))->update('animals',['status'=>DELETED]);
    }

    public function get_animal_data($id)
    {
        $animal = $this->db->where('animals.id',$id)
        ->select("animals.*,DATE_FORMAT(animals.dob,'%d %b,%Y') AS preety_dob,DATE_FORMAT(animals.dop,'%d %b,%Y') AS preety_dop,breed.breed_name,animal_type.type_of_animal")
        ->join('animals as af', 'af.id = animals.father_id', 'left outer')
        ->join('animals as am', 'am.id = animals.mother_id', 'left outer')
        ->join('breed', 'breed.id = animals.animal_breed')
        ->join('animal_type', 'animal_type.id = animals.animal_type')
        ->get('animals')
        ->row();

        if ($animal) {
            $breeds = $this->db->where('breed.animal_type_id',$animal->animal_type)
            ->get('breed')
            ->result_array();
            $animal->breeds='';
            foreach ($breeds as $key => $breed) {
                $animal->breeds .= "<option value='{$breed['id']}'>{$breed['breed_name']}</option>";
            }


            // Fathers
            $animal->fathers = '';
            $fathers = $this->db->where(['animals.animal_type'=>$animal->animal_type,'sex'=>MALE])
            ->get('animals')
            ->result_array();
            foreach ($fathers as $key => $father) {
                $animal->fathers = "<option value='{$father['id']}'>{$father['name']}</option>";
            }
            // Mothers
            $animal->mothers = '';
            $mothers = $this->db->where(['animals.animal_type'=>$animal->animal_type,'sex'=>FEMALE])
            ->get('animals')
            ->result_array();
            foreach ($mothers as $key => $mother) {
                $animal->mothers = "<option value='{$mother['id']}'>{$mother['name']}</option>";
            }

        }


        return $animal;

    }

    function yield_animals_milking($id)
    {
        // echo $id;exit;
        $date=date('Y-m-d');
           $this->db->where('milk_yeild.animal_id=',$id);
        $this->db->where('milk_yeild.date=',$date);
        $this->db->group_by('milk_yeild.routine'); 
        $this->filter_by_active_farm();
        $query = $this->db->get('milk_yeild')->result();
        // print_r($this->db->last_query());    exit;

        // echo  $query->num_rows();exit;
        // var_dump($query);exit;
         $output='';
         // $routin='';
         foreach($query as $row)
         {
            if($row->routine==1){ $routin='Morning'; }elseif($row->routine==2){  $routin='Afternoon';}else{ $routin='Evening';}
            $output.='<div class="form-group"><label for="">'.$routin.' Milking Yield</label>
                         <input type="text" id="" value="'.$row->qty.'" class="form-control morningMilking">
                         <input type="hidden" id="" value="'.$row->animal_id.'" class="form-control animal_ids">
                         <input type="hidden" id="" value="'.$row->farm_id.'" class="form-control farm_id">
                         <input type="hidden" id="" value="'.$row->approx_exac.'" class="form-control approx_exac">
                         <input type="hidden" id="" value="'.$row->created_by.'" class="form-control created_by">
                         <input type="hidden" id="" value="'.$row->date_created.'" class="form-control date_created">
                         <input type="hidden" id="" value="'.$row->routine.'" class="form-control routine">
            </div>';
         }
         echo $output;
    }

    function update_yield_animals_milking($id,$data){
        $date=date('Y-m-d');
        $this->db->where('animal_id', $id);
        $this->db->where('date', $date);
        $this->db->delete('milk_yeild'); 


         for($i=0;$i<count($data['animal_id']);$i++){
        
          $insert = array(
            
            'farm_id'     => $data['farm_id'][$i],
            'animal_id'     => $data['animal_id'][$i],
            'qty'     => $data['qty'][$i],
            'date'     => $date,
            'approx_exac'     => $data['approx_exac'][$i],
            'routine'     => $data['routine'][$i],
            'created_by'     => $data['created_by'][$i],
            'date_created'     => $data['date_created'][$i]
        ); 
        $this->db->insert('milk_yeild',$insert);
        }



  }

}