<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Master_vaccine extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_vaccine_model');
    }

    function index()
    {
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('productcatid', 'Vaccine Category', 'required');
        $this->form_validation->set_rules('product_id', 'Vaccine Name', 'required');
        $this->form_validation->set_rules('expdate', 'Expire Date', 'required');
        $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
        $this->form_validation->set_rules('store_instruction', 'Store Instruction', 'required');
        $this->form_validation->set_rules('disease_name', 'Disease', 'required');
        $this->form_validation->set_rules('age_at_first_dose', 'Age at First Dose', 'required');
        $this->form_validation->set_rules('booster_dose', 'Booster Dose', 'required');
        $this->form_validation->set_rules('subsequent_dose', 'Subsequent Dose', 'required');




        if ($this->form_validation->run()) {


            $params = array(
                //'product_category_id' => $this->input->post('productcatid'),
                'product_id' => $this->input->post('product_id'),
                'expiry_date' => $this->input->post('expdate'),
                'purchase_date' => $this->input->post('purchase_date'),
                'store_instruction' => $this->input->post('store_instruction'),
                'disease_name' => ucwords($this->input->post('disease_name')),
                'age_at_first_dose' => $this->input->post('age_at_first_dose'),
                'booster_dose' => $this->input->post('booster_dose'),
                'subsequent_dose' => $this->input->post('subsequent_dose'),
                'farm_id' => $this->session->userdata('active_farm'),
                'created_by' => $this->session->userdata('id')
            );

            $this->Master_vaccine_model->add_vaccine_master($params);
            $this->session->set_flashdata('success', 'Master Vaccine added successfuly');
            redirect('master_vaccine');
        } else {
            $data['product'] = $this->Master_vaccine_model->get_category_products();
            $data['item_uom'] = $this->db->get('item_uom')->result_array();
            $data['disease'] = $this->db->get('disease')->result_array();
            $data['pro_code'] = $this->Master_vaccine_model->get_code();
            $data['_view'] = 'mastervaccine/index';
            $this->load->view('layouts/main', $data);
        }
    }

    function get_list()
    {
        $columns = array(
            0 => 'product_name',
            1 => 'expiry_date',
            2 => 'purchase_date',
            3 => 'store_instruction',
            4 => 'disease_name',
            5 => 'age_at_first_dose',
            6 => 'booster_dose',
            7 => 'subsequent_dose'
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Master_vaccine_model->get_all_master_vaccine_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Master_vaccine_model->get_all_master_vaccine($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Master_vaccine_model->master_vaccine_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Master_vaccine_model->master_vaccine_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                if ($post->store_instruction == 1) {
                    $store = "Room Tempreture";
                } elseif ($post->store_instruction == 2) {
                    $store = "Fridge";
                } elseif ($post->store_instruction == 3) {
                    $store = "Freezer";
                }

                if ($post->booster_dose == 1) {
                    $dose = "Yes";
                } else {
                    $dose = "No";
                }
                $nestedData['product_name'] = $post->product_name . "( " . $post->product_name . " )";
                //$nestedData['product_category_id'] = $post->pro_cat_name;
                $nestedData['expdate'] = $post->expiry_date;
                $nestedData['purchase_date'] = $post->purchase_date;
                $nestedData['store_instruction'] = $store;
                $nestedData['disease_name'] = $post->disease_name;
                $nestedData['age_at_first_dose'] = $post->age_at_first_dose;
                $nestedData['booster_dose'] = $dose;
                $nestedData['subsequent_dose'] = $post->subsequent_dose;


                $nestedData['actions'] = "<a href='" . base_url('master_vaccine/item/' . $post->id) . "'><button class='btn btn-warning btn-xs'>Edit</button></a>&nbsp;<button class='btn btn-danger btn-delete btn-xs' code='" . $post->id . "'>Delete</button>";

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


    function item($id)
    {
        if ($this->input->method(true) == 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('product_id', 'Vaccine Name', 'required');
            $this->form_validation->set_rules('expdate', 'Expire Date', 'required');
            $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
            $this->form_validation->set_rules('store_instruction', 'Store Instruction', 'required');
            $this->form_validation->set_rules('disease_name', 'Disease', 'required');
            $this->form_validation->set_rules('age_at_first_dose', 'Age at First Dose', 'required');
            $this->form_validation->set_rules('booster_dose', 'Booster Dose', 'required');
            $this->form_validation->set_rules('subsequent_dose', 'Subsequent Dose', 'required');




            if ($this->form_validation->run()) {


                $params = array(
                    'product_id' => $this->input->post('product_id'),
                    'expiry_date' => $this->input->post('expdate'),
                    'purchase_date' => $this->input->post('purchase_date'),
                    'store_instruction' => $this->input->post('store_instruction'),
                    'disease_name' => ucwords($this->input->post('disease_name')),
                    'age_at_first_dose' => $this->input->post('age_at_first_dose'),
                    'booster_dose' => $this->input->post('booster_dose'),
                    'subsequent_dose' => $this->input->post('subsequent_dose')
                );

                $this->Master_vaccine_model->update_vaccine_master($id, $params);
                $this->session->set_flashdata('success', 'Master Vaccine updated successfuly');
                redirect('master_vaccine');
            }
        }

        $data['item'] = $this->Master_vaccine_model->get_item($id);

        if (!$data['item']) {
            $this->session->set_flashdata('error', 'Invalid Master Vaccine');
            redirect('master_vaccine');
        }

        $data['item'] = (array)$data['item'];
        $data['product'] = $this->Master_vaccine_model->get_category_products();
        $data['item_uom'] = $this->db->get('item_uom')->result_array();
        $data['disease'] = $this->db->get('disease')->result_array();
        $data['pro_code'] = $this->Master_vaccine_model->get_code();
        $data['_view'] = 'mastervaccine/edit';
        $this->load->view('layouts/main', $data);
    }

    function get_category_products($cat_id)
    {

        $data = $this->Master_vaccine_model->get_category_products($cat_id);
        echo "<option value=''>Select Product</option>";
        foreach ($data['products'] as $pro) {
            echo "<option value='" . $pro['id'] . "'>" . $pro['product_name'] . "( " . $pro['product_code'] . " )" . "</option>";
        }
    }


    function delete_master_vaccine($id)
    {
        $this->Master_vaccine_model->delete_vaccine_master($id);
        echo '1';
    }

    // function get_product_details($pro_id)
    // {

    //     $data = $this->Master_vaccine_model->get_product_details($pro_id);
    //     $proname = $data['product_name'] . "( " . $data['product_code'] . " )";
    //     $string = "<div class='col-md-12'><div class='form-group'>";
    //     $string .= "<label for='formrow-firstname-input'>Name & Code<span class='text-danger'>*</span></label>";
    //     $string .= "<input type='text' readonly class='form-control' value='".$proname."'>";
    //     $string .= "</div></div>";
    //     echo $string;
    // }

}
