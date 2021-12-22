<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class User extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    function index()
    {


        if ($this->input->method(true) == 'POST') {
            $this->load->library('form_validation');

            if ($this->input->post('id')) {
                # Update Request
                $this->form_validation->set_rules('fnameu', 'First Name', 'required');
                $this->form_validation->set_rules('mobile_nou', 'Mobile No', 'required');
                $this->form_validation->set_rules('emailu', 'Email', 'required');
                // $this->form_validation->set_rules('password', 'Password', 'required');

                if ($this->form_validation->run()) {
                    $params = array(
                        'fname' => $this->input->post('fnameu'),
                        'lname' => $this->input->post('lnameu'),
                        'phone_no' => $this->input->post('phone_nou'),
                        'mobile_no' => $this->input->post('mobile_nou'),
                        'email' => $this->input->post('emailu'),

                        'role' => $this->input->post('roleu'),
                        // 'created_by' => $this->session->userdata('id')
                    );

                    if ($this->input->post('passwordu') & !empty($this->input->post('passwordu'))) {
                        $params['password'] = md5($this->input->post('passwordu'));
                    }

                    // Upload User Profile Image
                    if ($_FILES['image']['name'] != '') {
                        $config['upload_path'] = FCPATH . 'assets/images/users/';;
                        $config['allowed_types'] = 'gif|jpg|png|jepg|JPG|PNG|JPEG';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1280;
                        $config['max_height'] = 1280;

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('image')) {
                            $img_data = $this->upload->data();
                            $params['avatar'] = $img_data['file_name'];
                        } else {
                            // echo $config['upload_path'];
                            $this->session->set_flashdata('error', $this->upload->display_errors());
                        }
                    }
                    $this->db->trans_start();
                    $this->db->where('id', $this->input->post('id'))->update('users', $params);
                    $this->db->trans_complete();
                    $this->session->set_flashdata('success', 'User updated successfuly');
                    redirect('user');
                }
            } else {
                # New Insert
                $this->form_validation->set_rules('fname', 'First Name', 'required');
                $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');

                if ($this->form_validation->run()) {
                    $params = array(
                        'fname' => $this->input->post('fname'),
                        'lname' => $this->input->post('lname'),
                        'phone_no' => $this->input->post('phone_no'),
                        'mobile_no' => $this->input->post('mobile_no'),
                        'email' => $this->input->post('email'),
                        'password' => md5($this->input->post('password')),
                        'role' => $this->input->post('role'),
                        'created_by' => $this->session->userdata('id')
                    );
                    // Upload User Profile Image
                    if ($_FILES['image']['name'] != '') {
                        $config['upload_path'] = FCPATH . 'assets/images/users/';;
                        $config['allowed_types'] = 'gif|jpg|png|jepg|JPG|PNG|JPEG';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1280;
                        $config['max_height'] = 1280;

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('image')) {
                            $img_data = $this->upload->data();
                            $params['avatar'] = $img_data['file_name'];
                        } else {
                            // echo $config['upload_path'];
                            $this->session->set_flashdata('error', $this->upload->display_errors());
                        }
                    }
                    $this->db->trans_start();
                    $this->db->insert('users', $params);
                    $user_id = $this->db->insert_id();
                    $farm_id = $this->input->post('farm_id');
                    $user_farm = array(
                        'user_id' => $user_id,
                        'farm_id' => $farm_id,
                    );
                    $this->db->insert('user_farm', $user_farm);
                    $this->db->trans_complete();
                    $this->session->set_flashdata('success', 'User added successfuly');
                    redirect('user');
                }
            }
        }


        $data['_view'] = 'user/index';
        $this->load->view('layouts/main', $data);
    }

    function get_list()
    {
        $columns = array(
            0 => 'fname',
            1 => 'phone_no',
            2 => 'mobile_no',
            3 => 'email',
            4 => 'role',
            5 => 'status',
            6 => 'id'
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->User_model->get_all_user_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->User_model->get_all_user($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->User_model->user_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->User_model->user_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                if ($post->role == ROLE_FARM_OWNER) {
                    $role = "<span class='badge badge-success'>Owner</span>";
                } else if ($post->role == ROLE_FARM_MANAGER) {
                    $role = "<span class='badge badge-info'>Manager</span>";
                } else if ($post->role == ROLE_FARM_OPERATOR) {
                    $role = "<span class='badge badge-warning'>Operator</span>";
                } else {
                    $role = "<span class='badge badge-danger'>Admin</span>";
                }
                $nestedData['fname'] = $post->fname . ' ' . $post->lname;
                $nestedData['phone_no'] = $post->phone_no;
                $nestedData['mobile_no'] = $post->mobile_no;
                $nestedData['email'] = $post->email;
                $nestedData['role'] = $role;
                $nestedData['status'] = ($post->status == ACTIVE) ? "<span class='badge badge-success'>ACTIVE</span>" : "<span class='badge badge-danger'>SUSPENDED</span>";
                $nestedData['actions'] = "<button class='btn btn-warning btn-sm btn-edit' code='" . $post->id . "'><i class='uil-edit-alt'></i> Edit</button>&nbsp;<button class='btn btn-danger btn-sm btn-delete' code='" . $post->id . "'><i class='uil-trash-alt'></i> Delete</button>";

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

    public function delete_user($id)
    {
        $this->User_model->delete_user($id);
        echo 1;
    }

    function get_user($id)
    {
        echo json_encode($this->User_model->get_user($id));
    }
}