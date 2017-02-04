<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url','html'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
        $this->load->helper('security');
        $this->load->model('user_model');
        
    }

    public function index()
    {
        $data['css'][] = 
        array('href' => 'assets/css/styles.css?ver=1.4');
        //var_dump($sections);
        
        //validacion de campos
        $this->form_validation->set_rules("email", "", "trim|required|xss_clean");
        $this->form_validation->set_rules("password", "", "trim|required|xss_clean");

        if ($this->form_validation->run() == FALSE)
        {
            if(isset($this->session->userdata['logged_in'])){
                redirect(base_url().'dashboard'); 
            }else{
                $this->load->view('login.html', $data);
            }
        }
        else
        {
            //verify with database
            $email = $this->input->post('email');
            $password =  $this->input->post('password');
            $result = $this->user_model->getUserCredential($email, $password);
            if ($result == TRUE) {
                $session_data = array(
                        'username' => $result["username"],
                        'email' => $result["password"]
                );
                $this->session->set_userdata('logged_in', $session_data);
                redirect(base_url().'dashboard'); 

            } else {
                $data['error'][] = array('error_message' => 'Invalid Username or Password');
                $this->load->view('login.html', $data);
            }
        }
    }

    public function logout() {

        // Removing session data
        $sess_array = array(
            'username' => ''
        );

        $this->session->unset_userdata('logged_in', $sess_array);
        redirect(base_url().'login'); 
    }




}