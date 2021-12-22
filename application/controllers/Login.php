<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Login extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        
    }

    function index()
    { 
        $this->load->library('form_validation');   
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()){
            $where = array(
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
            );
            $data = $this->db->get_where('users', $where)->row_array();
            if($data){
                if($data['role'] != ROLE_SUPER_ADMIN){
                    $this->db->select('user_farm.*, farm.farm_code, farm.title, farm.logo, farm.color_code, farm.quarantine_days, farm.quarantine_new_animal');
                    $this->db->join('farm','farm.id = user_farm.farm_id');
                    $data['farms'] = $this->db->get_where('user_farm',array('user_farm.user_id' => $data['id'],'farm.status' => ACTIVE))->result_array();
                    if(count($data['farms']) == 1){
                        $data['active_farm'] = $data['farms'][0]['farm_id'];
                        $data['active_farm_name'] = $data['farms'][0]['title'];
                        $data['quarantine_new_animal'] = $data['farms'][0]['quarantine_new_animal'];
                        $data['quarantine_days'] = $data['farms'][0]['quarantine_days'];
                    } else {
                        $data['active_farm'] = '';
                        $data['active_farm_name'] = '';
                        $data['quarantine_new_animal'] = '';
                        $data['quarantine_days'] = '';
                    }
                } 

                
                $this->session->set_userdata($data);
                
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid Login Credentials');
                redirect('login');
            } 
        } else {
            $this->load->view('login');
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
