<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Land_record_list extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('LandManagementData_model');
        $this->load->model('Land_record_list_model');
        $this->load->model('Areauom_model');
        $this->load->model('Land_record_model');
        $this->load->model('Country_model');
        date_default_timezone_set('Asia/Karachi');
    }

    public function index (){
        $data['landType'] = $this->LandManagementData_model->get_all_LandType_data('Land Type');
        $data['TypeOfLand'] = $this->LandManagementData_model->get_all_LandType_data('Type Of Land');


        $data['areauom'] = $this->Areauom_model->get_areauom_for_dd();

        $data['_view'] = 'landrecord/land_record_list';

        $this->load->view('layouts/main', $data);
    }

    function get_owned_land_list()
    {
        $columns = array(
            0 => 'purchase_date',
            1 => 'type_of_land',
            2 => 'value_per_unit',
            3 => 'area_uom',
            4 => 'crops_taken',
            5 => 'adjoint_section'
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Land_record_list_model->get_all_owned_land_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Land_record_list_model->get_all_owned_land($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Land_record_list_model->owned_land_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Land_record_list_model->owned_land_search_count($search);
        }
        // var_dump($posts);exit;
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['purchase_date'] = $post->purchase_date;
                $nestedData['type_of_land'] = $this->Land_record_list_model->get_land_type_name($post->type_of_land)['land_management_data'];
                $nestedData['value_per_unit'] = $post->value_per_unit;
                $nestedData['area_uom'] = $this->Land_record_list_model->get_area_uom_name($post->area_uom)['name'];
                $nestedData['crops_taken'] = $this->Land_record_list_model->get_land_type_name($post->crops_taken)['land_management_data'];

                $nestedData['status'] = $post->status;
                $nestedData['adjoint_section'] = "<button class='btn btn-danger btn-xs adjointBtn' code='" . $post->id . "' formcode='Owned Form'>Adjoint Detail</button>";
                $nestedData['actions'] = "<a href='".base_url('land_record_list/edit_land_type/owned/'.$post->id)."'><button class='btn btn-warning btn-xs'>Edit</button></a>&nbsp;<button class='btn btn-danger btn-xs btn-delete' formcode='Owned Form' code='" . $post->id . "' formcode='Owned Form'>Delete</button>";


                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
    function get_leased_land_list()
    {
        $columns = array(
            0 => 'contract_date',
            1 => 'contract_reg_number',
            2 => 'type_of_land_leased',
            3 => 'payment_method',
            4 => 'payment_term',
            5 => 'meter_number',
            6 => 'last_meter_reading_before_handover',
            7 => 'adjoint_section',
            8 => 'witness_detail',
            9 => 'owner_section'
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Land_record_list_model->get_all_leased_land_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Land_record_list_model->get_all_leased_land($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Land_record_list_model->leased_land_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Land_record_list_model->leased_land_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['contract_date'] = $post->contract_date;
                $nestedData['contract_reg_number'] = $post->contract_reg_number;
                $nestedData['type_of_land_leased'] = $post->land_type;
                $nestedData['payment_method'] = $post->payment_method;
                $nestedData['payment_term'] = $post->payment_term;
                $nestedData['meter_number'] = $post->meter_number;
                $nestedData['last_meter_reading_before_handover'] = $post->last_meter_reading_before_handover;
                $nestedData['adjoint_section'] = "<button class='btn btn-danger btn-xs adjointBtn' code='" . $post->id . "' formcode='Leased Form'>Adjoint Detail</button>";
                $nestedData['witness_detail'] = "<button class='btn btn-danger btn-xs witnessBtn' code='" . $post->id . "'>Witness Detail</button>";
                $nestedData['owner_section'] = "<button class='btn btn-danger btn-xs ownerBtn' code='" . $post->id . "'>Owner Detail</button>";
                $nestedData['actions'] = "<a href='".base_url('land_record_list/edit_land_type/leased/'.$post->id)."'><button class='btn btn-warning btn-xs'>Edit</button></a>&nbsp;<button class='btn btn-danger btn-xs btn-delete' formcode='Leased Form' code='" . $post->id . "'>Delete</button>";

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    function get_rent_land_list()
    {
        $columns = array(
            0 => 'rent_start_date',
            1 => 'rent_tenure',
            2 => 'rent_reg_number',
            3 => 'rent_amount',
            4 => 'type_of_land_rent',
            5 => 'payment_method_rent',
            6 => 'payment_term_rent',
            7 => 'meter_number_rent',
            8 => 'Last_bill_before_handover_rent',
            9 => 'adjoint_section',
            10 => 'owner_section'
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Land_record_list_model->get_all_rent_land_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Land_record_list_model->get_all_rent_land($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Land_record_list_model->rent_land_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Land_record_list_model->rent_land_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['rent_start_date'] = $post->rent_start_date;
                $nestedData['rent_tenure'] = $post->rent_tenure;
                $nestedData['rent_reg_number'] = $post->rent_reg_number;
                $nestedData['rent_amount'] = $post->rent_amount;
                $nestedData['type_of_land_rent'] = $this->Land_record_list_model->get_land_type_name($post->type_of_land_rent)['land_management_data'];
                $nestedData['payment_method_rent'] = $this->Land_record_list_model->get_land_type_name($post->payment_method_rent)['land_management_data'];
                $nestedData['payment_term_rent'] = $this->Land_record_list_model->get_land_type_name($post->payment_term_rent)['land_management_data'];
                $nestedData['meter_number_rent'] = $post->meter_number_rent;
                $nestedData['last_bill_before_handover_rent'] = $post->last_bill_before_handover_rent;
                $nestedData['adjoint_section'] = "<button class='btn btn-danger btn-xs adjointBtn' code='" . $post->id . "' formcode='Rent Form'>Adjoint Detail</button>";
                $nestedData['owner_section'] = "<button class='btn btn-danger btn-xs btn-delete' code='" . $post->id . "'>Owner Detail</button>";
                $nestedData['status'] = "<button class='btn btn-danger btn-xs btn-delete' code='" . $post->id . "'>Active</button>";
                $nestedData['actions'] = "<a href='".base_url('land_record_list/edit_land_type/rent/'.$post->id)."'><button class='btn btn-warning btn-xs'>Edit</button></a>&nbsp;<button class='btn btn-danger btn-xs btn-delete' formcode='Rent Form' code='" . $post->id . "'>Delete</button>";

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function GetWitness()
    {
        $id=$this->input->post('id');

        $this->db->where('leased_land_id=', $id);
        $this->db->select('*');
        $query = $this->db->get('leased_land_witness');
        $output='';

        foreach ($query->result() as $row) {
            # code...
            $output.='<div class="row">';
            $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness Name</label><input type="text" value="'.$row->witness_name.'" readonly="" class="form-control"> </div></div>';
            $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness ID</label><input type="text" value="'.$row->witness_id_card.'" readonly="" class="form-control"> </div></div>';
            $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness Contact</label><input type="text" value="'.$row->witness_contact.'" readonly="" class="form-control"> </div></div>';
            $output.='</div>';
        }
        echo $output;
    }
       public function GetOwner()
    {
        $id=$this->input->post('id');

        $this->db->where('leased_land_id=', $id);
        $this->db->select('*');
        $query = $this->db->get('leased_land_owner');
        $row=$query->row_array();
        $output='';
            # code...
        $output.='<div class="row">';
        $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness Name</label><input type="text" style="font-weight:bold" value="'.$row['owner_name'].'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness ID</label><input type="text" style="font-weight:bold" value="'.$row['owner_id_card'].'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness Email</label><input type="text" style="font-weight:bold" value="'.$row['owner_email'].'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness Contact</label><input type="text" style="font-weight:bold" value="'.$row['owner_contact'].'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness Address</label><input type="text" style="font-weight:bold" value="'.$row['owner_address'].'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness City</label><input type="text" style="font-weight:bold" value="'.$row['owner_city'].'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-4"><div class="form-group"> <label for="">Witness Country</label><input type="text" style="font-weight:bold" value="'.$row['owner_country'].'" readonly="" class="form-control"> </div></div>';
        $output.='</div>';
        echo $output;
    }
   
   public function GetAdjoint()
   {
      $id=$this->input->post('id');
      $formcode=$this->input->post('formcode');

        $this->db->where(array('adjoint_land.land_form_id' => $id,'adjoint_land.land_form_title'=>$formcode));
          $this->db->select('adjoint_land.*, land_management.land_management_data AS land_type_data');
        $this->db->join('land_management_data land_management', 'land_management.id = adjoint_land.land_type');
        $query = $this->db->get('adjoint_land');
        $output='';
        foreach ($query->result() as $row) {
            # code...
            $output.='<div class="row">';
        $output.='<div class="col-md-3"><div class="form-group"> <label for="">Land Type</label><input type="text" value="'.$row->land_type_data.'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-3"><div class="form-group"> <label for="">Adjoint Type</label><input type="text" value="'.$row->adjoint_type.'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-3"><div class="form-group"> <label for="">Area</label><input type="text" value="'.$row->area.'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-3"><div class="form-group"> <label for="">UOM</label><input type="text" value="'.$row->uom.'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-3"><div class="form-group"> <label for="">Mear Land Mark</label><input type="text" value="'.$row->near_land_mark.'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-3"><div class="form-group"> <label for="">Address</label><input type="text" value="'.$row->address.'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-3"><div class="form-group"> <label for="">City</label><input type="text" value="'.$row->city.'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-3"><div class="form-group"> <label for="">Province</label><input type="text" value="'.$row->province.'" readonly="" class="form-control"> </div></div>';
        $output.='<div class="col-md-3"><div class="form-group"> <label for="">Country</label><input type="text" value="'.$row->country.'" readonly="" class="form-control"> </div></div>';
            $output.='</div>';
        }
        echo $output;
   } 

   public function edit_land_type (){

        $data['landType'] = $this->LandManagementData_model->get_all_LandType_data('Land Type');
        $data['TypeOfLand'] = $this->LandManagementData_model->get_all_LandType_data('Type Of Land');
        $data['cropstaken'] = $this->LandManagementData_model->get_all_LandType_data('Crops Taken');
        $data['paymentMethod'] = $this->LandManagementData_model->get_all_LandType_data('Payment Method');
        $data['paymentTerm'] = $this->LandManagementData_model->get_all_LandType_data('Payment Term');
        $data['countries'] = $this->Country_model->get_all_country_for_dd();

        $data['owned_land_basic'] = $this->Land_record_list_model->get_owned_land_basic_data($this->uri->segment(3),$this->uri->segment(4));
        $data['owned_land_batch'] = $this->Land_record_list_model->get_owned_land_batch($this->uri->segment(3),$this->uri->segment(4));

        $data['rent_land_basic'] = $this->Land_record_list_model->get_rent_land_basic_data($this->uri->segment(3),$this->uri->segment(4));
        $data['rent_land_owner'] = $this->Land_record_list_model->get_rent_land_owner_data($this->uri->segment(3),$this->uri->segment(4));
        $data['leased_land_basic'] = $this->Land_record_list_model->get_leased_land_basic_data($this->uri->segment(3),$this->uri->segment(4));
        $data['leased_land_owner'] = $this->Land_record_list_model->get_leased_land_owner_data($this->uri->segment(3),$this->uri->segment(4));
        $data['leased_land_witness'] = $this->Land_record_list_model->get_leased_land_witness_data($this->uri->segment(3),$this->uri->segment(4));
        
        // echo "<pre>";
        // print_r($data['leased_land_witness']);
        // echo "</pre>";
        // exit;
        $data['areauom'] = $this->Areauom_model->get_areauom_for_dd();
        $data['_view'] = 'landrecord/edit_land_type';
        $this->load->view('layouts/main', $data);
    }


    public function update_land_type()
    {
        $land_type=$this->uri->segment(3);
        $editID=$this->uri->segment(4);
        if($land_type=='owned')
        {
             if (isset($editID)) {
            $this->load->library('form_validation');

             $this->form_validation->set_rules('purchase_date', ' Purchase Date', 'required');
            $this->form_validation->set_rules('type_of_land', ' Type Of Land', 'required');
            $this->form_validation->set_rules('value_per_unit', 'Purchase Value', 'required');
            $this->form_validation->set_rules('area_uom', 'Area UOM', 'required');
            $this->form_validation->set_rules('calculate_purchase_time', 'Calculate Purchase Time', 'required');
            $this->form_validation->set_rules('crops_taken', 'Crops Taken', 'required');

            if ($this->form_validation->run()) {
                $params = array(
                   'purchase_date' => $this->input->post('purchase_date'),
                        'type_of_land' => $this->input->post('type_of_land'),
                        'value_per_unit' => $this->input->post('value_per_unit'),
                        'area_uom' => $this->input->post('area_uom'),
                        'owned_land_acre' => $this->input->post('owned_land_acre'),
                        'calculate_purchase_time' => $this->input->post('calculate_purchase_time'),
                        'crops_taken' => implode(',', $this->input->post('crops_taken'))
                );

                $this->Land_record_list_model->update_ownedform($editID, $params);
                redirect('Land_record_list/index');
            } else {
                $data['_view'] = 'landrecord/land_record_list';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The Owned Land you are trying to edit does not exist.');       
    }
    elseif($land_type=='rent')
    {
        if (isset($editID)) {
            $this->load->library('form_validation');
 
            $this->form_validation->set_rules('rent_start_date', ' Start Date', 'required');
            $this->form_validation->set_rules('rent_tenure', 'Tenure', 'required');
            $this->form_validation->set_rules('rent_reg_number', 'Registration Number', 'required');
            $this->form_validation->set_rules('rent_amount', 'Amount', 'required');
            $this->form_validation->set_rules('type_of_land_rent', 'Rent Land Type', 'required');
            $this->form_validation->set_rules('no_of_sheds', 'Number Of Sheds', 'required');
            $this->form_validation->set_rules('built_area', 'Built Area', 'required');
            $this->form_validation->set_rules('area_uom_rent', 'Area UOM', 'required');
            $this->form_validation->set_rules('payment_method_rent', 'Payment Method', 'required');
            $this->form_validation->set_rules('payment_term_rent', 'Payment Term', 'required');
            $this->form_validation->set_rules('meter_number_rent', 'Meter Number', 'required');
            $this->form_validation->set_rules('last_bill_before_handover_rent', 'Last Bill Before Handover', 'required');


            $this->form_validation->set_rules('owner_name_rent', 'Owner Name', 'required');
            $this->form_validation->set_rules('owner_id_card_rent', 'Owner ID Card', 'required');
            $this->form_validation->set_rules('owner_email_rent', 'Owner Email', 'required');
            $this->form_validation->set_rules('owner_contact_rent', 'Owner Contact', 'required');
            $this->form_validation->set_rules('owner_address_rent', 'Owner Address', 'required');
            $this->form_validation->set_rules('owner_city_rent', 'Owner City', 'required');
            $this->form_validation->set_rules('owner_country_rent', 'Owner Country', 'required');


            if ($this->form_validation->run()) {
               $params = array(
                        'rent_start_date' => $this->input->post('rent_start_date'),
                        'rent_tenure' => $this->input->post('rent_tenure'),
                        'rent_reg_number' => $this->input->post('rent_reg_number'),
                        'rent_amount' => $this->input->post('rent_amount'),
                        'type_of_land_rent' => $this->input->post('type_of_land_rent'),
                        'no_of_sheds' => $this->input->post('no_of_sheds'),
                        'built_area' => $this->input->post('built_area'),
                        'area_uom_rent' => $this->input->post('area_uom_rent'),
                        'payment_method_rent' => $this->input->post('payment_method_rent'),
                        'payment_term_rent' => $this->input->post('payment_term_rent'),
                        'meter_number_rent' => $this->input->post('meter_number_rent'),
                        'last_bill_before_handover_rent' => $this->input->post('last_bill_before_handover_rent')
                    );
                $params2 = array(
                        'owner_name_rent' => $this->input->post('owner_name_rent'),
                        'owner_id_card_rent' => $this->input->post('owner_id_card_rent'),
                        'owner_email_rent' => $this->input->post('owner_email_rent'),
                        'owner_contact_rent' => $this->input->post('owner_contact_rent'),
                        'owner_address_rent' => $this->input->post('owner_address_rent'),
                        'owner_city_rent' => $this->input->post('owner_city_rent'),
                        'owner_country_rent' => $this->input->post('owner_country_rent')
                    );
                $this->Land_record_list_model->update_rentform($editID, $params,$params2);
                redirect('Land_record_list/index');
            } else {
                $data['_view'] = 'landrecord/land_record_list';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The Owned Land you are trying to edit does not exist.'); 
    }
    else{
     if (isset($editID)) {
         $this->load->library('form_validation');

          $this->form_validation->set_rules('contract_date', ' Start Date', 'required');
                $this->form_validation->set_rules('contract_reg_number', 'Tenure', 'required');
                $this->form_validation->set_rules('yearly_increase', 'Registration Number', 'required');
                $this->form_validation->set_rules('contract_tenure', 'Amount', 'required');
                $this->form_validation->set_rules('unit_year', 'Unit/year', 'required');
                $this->form_validation->set_rules('area_uom_leased', 'Built Area', 'required');
                $this->form_validation->set_rules('type_of_land_leased', 'Area UOM', 'required');
                $this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
                $this->form_validation->set_rules('payment_term', 'Payment Term', 'required');
                $this->form_validation->set_rules('meter_number', 'Meter Number', 'required');
                $this->form_validation->set_rules('last_meter_reading_before_handover', 'Last Bill Before Handover', 'required');
                $this->form_validation->set_rules('owner_name', 'Owner Name', 'required');
                $this->form_validation->set_rules('owner_id_card', 'Owner ID Card', 'required');
                $this->form_validation->set_rules('owner_email', 'Owner Email', 'required');
                $this->form_validation->set_rules('owner_contact', 'Owner Contact', 'required');
                $this->form_validation->set_rules('owner_address', 'Owner Address', 'required');
                $this->form_validation->set_rules('owner_city', 'Owner City', 'required');
                $this->form_validation->set_rules('owner_country', 'Owner Country', 'required');
                 if ($this->form_validation->run()) {
                $params = array(
                        'contract_date' => $this->input->post('contract_date'),
                        'contract_reg_number' => $this->input->post('contract_reg_number'),
                        'yearly_increase' => $this->input->post('yearly_increase'),
                        'contract_tenure' => $this->input->post('contract_tenure'),
                        'unit_year' => $this->input->post('unit_year'),
                        'area_uom_leased' => $this->input->post('area_uom_leased'),
                        'type_of_land_leased' => $this->input->post('type_of_land_leased'),
                        'payment_method' => $this->input->post('payment_method'),
                        'payment_term' => $this->input->post('payment_term'),
                        'meter_number' => $this->input->post('meter_number'),
                        'last_meter_reading_before_handover' => $this->input->post('last_meter_reading_before_handover')
                    );
                $params2 = array(
                        'owner_name' => $this->input->post('owner_name'),
                        'owner_id_card' => $this->input->post('owner_id_card'),
                        'owner_email' => $this->input->post('owner_email'),
                        'owner_contact' => $this->input->post('owner_contact'),
                        'owner_address' => $this->input->post('owner_address'),
                        'owner_city' => $this->input->post('owner_city'),
                        'owner_country' => $this->input->post('owner_country')
                    );
                 $this->db->where('leased_land_id', $editID);
                  $this->db->delete('leased_land_witness'); 
                  $witnessData = array_chunk($this->input->post('witness_name'), 3, true);
                foreach ($witnessData as $key => $value) {
                    $array = array_values($value);
                    $params3 = array(
                        'leased_land_id' => $editID,
                        'witness_name' => $array[0],
                        'witness_id_card' => $array[1],
                        'witness_contact' => $array[2],
                        'status' => ACTIVE,
                        'farm_id' => $this->session->userdata('active_farm')
                    );
                    $this->Land_record_model->add('leased_land_witness', $params3);
                    }

                   $this->Land_record_list_model->update_leasedform($editID, $params,$params2);
                redirect('Land_record_list/index');
              }else {
                $data['_view'] = 'landrecord/land_record_list';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The Owned Land you are trying to edit does not exist.'); 

        }    
    }
    
   public function delete_land_type()
   {
    $id=$this->input->post('id');
    $formcode=$this->input->post('formcode');
    
    // echo $formcode;exit;
    if($formcode=='Leased Form')
    {
          if ($this->Land_record_list_model->delete_leased_land($id)) {
            $this->session->set_flashdata('success', 'owned land deleted successfully');
            echo true;
        } else {
            echo false;
        }
    }
    elseif($formcode=='Owned Form')
    {
          if ($this->Land_record_list_model->delete_owned_land($id)) {
            $this->session->set_flashdata('success', 'leased land deleted successfully');
            echo true;
        } else {
            echo false;
        }
    }
    else{
          if ($this->Land_record_list_model->delete_rent_land($id)) {
            $this->session->set_flashdata('success', 'rent land deleted successfully');
            echo true;
        } else {
            echo false;
        }
    }

   
   }

   function delete_batch()
   {
    $batch=$this->input->post('batchID');
    $LastFormID=$this->input->post('LastFormID');
    $lastFormType=ucfirst($this->input->post('lastFormType'));

    if ($this->Land_record_list_model->delete_batch($batch,$LastFormID,$lastFormType)) {
            $this->session->set_flashdata('success', 'Batch deleted successfully');
            echo true;
        } else {
            echo false;
        }
    // echo $LastFormID;exit;
   }
   function delete_area()
   {
    $batch=$this->input->post('batchID');
    $area=$this->input->post('AreaID');
    $LastFormID=$this->input->post('LastFormID');
    $lastFormType=ucfirst($this->input->post('lastFormType'));

    if ($this->Land_record_list_model->delete_area($batch,$LastFormID,$lastFormType,$area)) {
            $this->session->set_flashdata('success', 'Area deleted successfully');
            echo true;
        } else {
            echo false;
        }
    // echo $LastFormID;exit;
   }
   function update_areaform()
   {
    $batch=$this->input->post('batchID');
    $area=$this->input->post('AreaID');
    $LastFormID=$this->input->post('LastFormID');
    $lastFormType=ucfirst($this->input->post('lastFormType'));
    $params = array(
                        'area' => $this->input->post('area'),
                        'uom' => $this->input->post('uom'),
                        'near_land_mark' => $this->input->post('landmark'),
                        'address' => $this->input->post('address'),
                        'city' => $this->input->post('city'),
                        'province' => $this->input->post('province'),
                        'country' => $this->input->post('country'),
                        'farm_id' => $this->session->userdata('active_farm')
                    );
    $this->Land_record_list_model->update_areauom($batch,$LastFormID,$lastFormType,$area,$params);
   }
}
