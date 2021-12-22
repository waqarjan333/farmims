<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Province extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Province_model');
        $this->load->model('Country_model');
        
    }

    function index()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Province Name', 'required');
        $this->form_validation->set_rules('country_id', 'Country', 'required');

        if ($this->form_validation->run()) {
            // Left is database column name, right side is value posted from form
            $params = array(
                'name' => $this->input->post('name'),
                'country_id' => $this->input->post('country_id'),
                'created_by' => $this->session->userdata('id')
            );
            $this->Province_model->add_province($params);
            $this->session->set_flashdata('success', 'Provice added successfuly');
            redirect('province');
        } else {
            $this->load->model('Country_model');
            $data['countries'] = $this->Country_model->get_all_country_for_dd();
            $data['_view'] = 'province/index';
            $this->load->view('layouts/main', $data);
        }
    }
    function get_list()
    {
        // This is for the sorting of columns, right side should match the column name of db
        $columns = array(
            0 => 'name',
            1 => 'country_id',
            2 => 'id'       
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end

    
        $totalData = $this->Province_model->get_all_province_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Province_model->get_all_province($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Province_model->province_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Province_model->province_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['name'] = $post->name;
                $nestedData['country'] = $post->country_name;
                $nestedData['actions'] = "<button class='btn btn-warning btn-xs btn-edit' code='".$post->id."'>Edit</button>&nbsp;<button class='btn btn-danger btn-xs btn-delete' code='".$post->id."'>Delete</button>";

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
    public function edit_country($id)
    {
        # code...
    }

    public function delete_province($id){
        $this->Province_model->delete_province($id);
        echo "1";
    }

    public function update_province($id){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Province Name', 'required');
        $this->form_validation->set_rules('country_id', 'Country', 'required');

        if ($this->form_validation->run()) {
            $this->Province_model->update_province($id,[
                'name'=>$this->input->post('name'),
                'country_id'=>$this->input->post('country_id')
            ]);
            echo 1;
        }

    }
}