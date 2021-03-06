<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Forget_password extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        
    }

    function index()
    { 
        $this->load->library('form_validation');   
        $this->form_validation->set_rules('email', 'Email', 'required');
        //echo $this->input->post('email'); //exit;
        if($this->form_validation->run()){
            $where = array(
                'email' => $this->input->post('email')
            );
            $query = $this->db->get_where('users', $where);
            //print_r($this->db->last_query());    exit;
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                // Send Mail
                    $from_email = "sales@farmims.com";
                    $to_email = $data[0]['email'];

                    //Load email library 
                    $this->load->library('email');
                    $config = array(
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE,
                        'mailtype' => 'html'
                    );

                    $this->email->initialize($config);
                    $this->email->from($from_email, 'Farm IMS');
                    $this->email->to($to_email);
                    $this->email->subject('Recover Password');
                    // $this->email->message('Farm Details & Account Setup Successful (Default Password: 123456)');
                    $msg = $this->load->view('welcome_mail', '', true);
                    $this->email->message($msg); 
        
                    if ($this->email->send()) {
                        $this->session->set_flashdata('success', '<b>Success!!</b> An Email has been sent to your email, Click on the link to recover your password');
                        redirect('login');
                    } else {
                        $this->session->set_flashdata('success', '<b>Success!!</b> Farm & Farm Owner Created (Default Password: 123456)');
                        redirect('login');
                    } 
            } else {
                return null;
            }
             
        } else {
            $this->load->view('forget_password');
        }
    }
}
