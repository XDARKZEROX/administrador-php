<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url','html'));
        $this->load->model('cupon_model');
    }

    public function index()
    {
        $result = $this->cupon_model->getCupons();

        $this->data['cupones'] = $result;   
        $this->content = 'sections/content.html';
        $this->layout();
        
	}

}