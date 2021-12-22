<?php


class Disease extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Disease_model');
    }

    function index()
    {
        $this->load->library('form_validation');


        if ($this->input->method(true)=='POST') {
            
            $this->form_validation->set_rules('name','Disease Name','trim|required|min_length[3]|max_length[225]');

            if ($this->form_validation->run()) {
                $this->Disease_model->add_disease([
                    'name'=>$this->input->post('name')
                ]);

                $this->session->set_flashdata('success', 'Disease added successfuly');

            } 
        }


        $data['diseases'] = $this->Disease_model->get_all_disease_dd();

        $data['_view'] = 'disease/index';
        $this->load->view('layouts/main', $data);
    }


    function get_list()
    {
        $columns = array(
            0 => 'name',
            1 => 'id'
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Disease_model->get_all_disease_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Disease_model->get_all_disease($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Disease_model->disease_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Disease_model->disease_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['name'] = $post->name;

                $nestedData['actions'] = "<button class='btn btn-warning btn-xs btn-edit' code='" . $post->id . "'>Edit</button>&nbsp;<button class='btn btn-danger btn-xs btn-delete' code='" . $post->id . "'>Delete</button>";

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


    public function delete($id)
    {
        echo $this->Disease_model->delete($id);
    }

    public function update($id)
    {
        echo $this->Disease_model->update($id,['name'=>$this->input->post('name')]);
    }
}
