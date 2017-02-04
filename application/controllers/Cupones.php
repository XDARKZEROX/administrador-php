<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cupones extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url','html'));
        $this->load->model('cupon_model');
        
    }

    public function index($isCreated=false)
    {
        $result = $this->cupon_model->getCupons();
        $this->data['isCuponCreated'] = $isCreated;    
        $this->data['cupones'] = $result;    
        $this->content = 'sections/cupones.html';
        $this->layout();
    }

    public function create(){

        $this->form_validation->set_rules("codigo", "Código", "trim|required|xss_clean|alpha_numeric");
        $this->form_validation->set_rules("descripcion", "Descripción", "trim|required|xss_clean|alpha_numeric_spaces");
        $this->form_validation->set_rules("descuento", "Descuento", "trim|required|xss_clean|numeric");

        if ($this->form_validation->run() == FALSE)
        {
            $this->content = 'sections/crearcupon.html';
            $this->layout();
        
        } else {
            $codigo = $this->input->post('codigo');
            $descripcion =  $this->input->post('descripcion');
            $descuento =  $this->input->post('descuento');
            $estado =  $this->input->post('estado');
            
            $result = $this->cupon_model->insertCupon($codigo, $descripcion, $descuento, $estado);
            if($result){
                $this->index(true);
            }

        }
    }

    public function delete() {
        $id_cupon = $this->input->post('id_cupon');
        $result = $this->cupon_model->deleteCupon($id_cupon);
        echo $result;
    }

    public function edit(){
        $result = $this->cupon_model->updateCupon($this->input->post('id'), $this->input->post('codigo'), $this->input->post('descripcion'), $this->input->post('porc_desc'), $this->input->post('status'));
        echo $result;

    }

    public function getCuponById(){
        $id_cupon = $this->input->post('id_cupon');
        $result = $this->cupon_model->getCuponById($id_cupon);
        echo json_encode($result[0]);

    }





}