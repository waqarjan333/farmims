<?php


class Animal_test extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Animal_test_model');
    }

    function index()
    {
        $this->load->library('form_validation');


        if ($this->input->method(true)=='POST') {
            # Apply Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('test_name','Test Name','trim|required|min_length[3]|max_length[225]');
            $this->form_validation->set_rules('description','Test Description','trim|max_length[65000]');

            if ($this->form_validation->run()) {
                if ($this->Animal_test_model->addtest([
                    'test_name'=>$this->input->post('test_name'),
                    'description'=>$this->input->post('description'),
                    // 'farm_id'=>$this->session->active_farm
                ])) {
                    # Added With Success
                    $this->session->set_flashdata('success', 'Test added successfuly');
                    redirect(base_url('animal_test'));
                } else {
                    # Something Went Wrong
                    $this->session->set_flashdata('danger', 'Something went wrong !');
                }
                
            }

        }

        $data['_view'] = 'animal_test/index';
        $this->load->view('layouts/main', $data);

        // $this->load->view('animal_test/index');

    }


    function get_list(){
         // This is for the sorting of columns, right side should match the column name of db
         $columns = array(
            0 => 'test_name',
            1 => 'description',
            2 => 'id'       
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end

    
        $totalData = $this->Animal_test_model->get_all_animal_test_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Animal_test_model->get_all_animal_test($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Animal_test_model->animal_test_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Animal_test_model->animal_test_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['test_name'] = $post->test_name;
                $nestedData['description'] = $post->description;
                $nestedData['actions'] = "<button class='btn btn-warning btn-xs btn-edit' code='".$post->id."'>'".$this->lang->line('edit')."'</button>&nbsp;<button class='btn btn-danger btn-xs btn-delete' code='".$post->id."'>'".$this->lang->line('delete')."'</button>";

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

    function delete_animal_test($id){
        $this->Animal_test_model->delete_animal_test($id);
        echo 1;
    }

    function update_animal_test($id){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('test_name','Test Name','trim|required|min_length[3]|max_length[225]');
        $this->form_validation->set_rules('description','Test Description','trim|max_length[65000]');

        if ($this->form_validation->run()) {
            $this->Animal_test_model->update_animal_test($id,
            [
                'test_name'=>$this->input->post('test_name'),
                'description'=>$this->input->post('description'),
            ]
        );
            echo "1";
        }else{
            echo $this->form_validation->error_string(" "," ");
        }
    }

}
