<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class LandManagementType extends Admin_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('LandManagementType_model');
    }

    
    function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('land_management_type', 'Name', 'required');
       

        if ($this->form_validation->run()) {
            // Left is database column name, right side is value posted from form
            $params = array(
                'land_management_type' => $this->input->post('land_management_type'),
                'status'=>ACTIVE,
                'created_by' => $this->session->userdata('id')
            );
           $this->LandManagementType_model->add($params);
            $this->session->set_flashdata('success', 'Land Management Type added successfuly');
            redirect('landManagementType');
        } else {
   
            $data['_view'] = 'landManagementType/index';

            $this->load->view('layouts/main',$data);
        }
    }

    
    function get_list()
    {
        $columns = array(
            0 => 'land_management_type',
            1 => 'id'       
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->LandManagementType_model->get_all_LandManagementType_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->LandManagementType_model->get_all_LandManagementType($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->LandManagementType_model->LandManagementType_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->LandManagementType_model->LandManagementType_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['land_management_type'] = $post->land_management_type;
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

    public function delete_LandManagementType($id)
    {
        echo $this->LandManagementType_model->delete_LandManagementType($id);
    }

    public function update_LandManagementType($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('land_management_type', 'Name', 'required');

        if ($this->form_validation->run()) {
            $this->LandManagementType_model->update_LandManagementType($id,[
                'land_management_type'=>$this->input->post('land_management_type')
            ]);
            echo 1;
        }
    }

}
