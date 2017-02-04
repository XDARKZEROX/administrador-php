<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class MY_Controller extends CI_Controller 
    { 
        //set the class variable.
        public $template  = array();
        public $data      = array();
		
        /*Loading the default libraries, helper, language */
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form','language','url'));
            $this->load->database();
            $this->load->helper('security');
            $this->load->library(array('session', 'form_validation'));
            if(!isset($this->session->userdata['logged_in'])){
                redirect(base_url().'login'); 
            }

            $this->template['css'] = array(
                array('href' => 'assets/css/bootstrap.min.css'),
                array('href' => 'assets/css/datepicker3.css'),
                array('href' => 'assets/css/bootstrap-table.css'),
                array('href' => 'assets/css/styles.css?ver=1.3')
            );

            $this->data['js'] = array(
                array('src' => 'assets/js/lumino.glyphs.js'),
                array('src' => 'assets/js/jquery-1.11.1.min.js'),
                array('src' => 'assets/js/bootstrap.min.js'),
                array('src' => 'assets/js/bootstrap-table.js?ver=1.3'),
                array('src' => 'assets/js/util.js?ver=1.5'),
            );

        }
		
        /*Front Page Layout*/
        public function layout() {
            // making template and send data to view.
            //$this->template['header']   = $this->load->view('layout/header', $this->data, true);
            $this->template['menu'] = $this->load->view('sections/menu.html', $this->data, true);
            $this->template['content'] = $this->load->view($this->content, $this->data, true);
            $this->load->view('panel.html', $this->template);
        }
    


    }