<?php


class Symptoms extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Symptoms_model');
    }

    function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description','Description','trim|required');

        if ($this->form_validation->run()) {
            // Left is database column name, right side is value posted from form
            $params = array(
                'name' => $this->input->post('name'),
                'created_by' => $this->session->userdata('id'),
                'description' => $this->input->post('description')
            );
            $this->Symptoms_model->add_symptom($params);
            $this->session->set_flashdata('success', 'Symptom added successfuly');
            redirect('symptoms');
        } else {
            // $this->load->model('Productcategory_model');
            // $data['productcategory'] = $this->Productcategory_model->get_productcategory_for_dd();
            // $data['item_uom'] = $this->db->get('item_uom')->result_array();
            $data['_view'] = 'symptoms/index';
            $this->load->view('layouts/main', $data);
        }
    }
    
    function get_list()
    {
        $columns = array(
            0 => 'name',
            1 => 'description',
            2 => 'id',
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Symptoms_model->get_all_symptom_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Symptoms_model->get_all_symptom($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Symptoms_model->symptom_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Symptoms_model->symptom_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['name'] = $post->name;
                $nestedData['description'] = $post->description;
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

    public function delete_symptom($id)
    {
        echo $this->Symptoms_model->delete_symptom($id);
    }

    public function update_symptom()
    {
        $this->Symptoms_model->update_symptom($this->input->post('id'),[
            'name'=>$this->input->post('name'),
            'description'=>$this->input->post('description'),
        ]);

        echo 1;
    }

}
