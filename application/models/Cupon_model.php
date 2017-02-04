<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Cupon_model extends CI_Model {

	public function __construct() {
        parent::__construct();
    }

	public function getCupons() {
		$query = $this->db->query("select * from tbcupon");
        return $query->result_array();
    }

    public function insertCupon($codigo, $descripcion, $descuento, $estado) {
    	
    	$data = array(
            'codigo' => $codigo,
            'descripcion' => $descripcion,
            'porc_desc' => $descuento,
            'status' => $estado
		);

		$this->db->set('fecha_creacion', 'NOW()', FALSE);
		return $this->db->insert('tbcupon', $data);
	}

    public function deleteCupon($id) {
        return $this->db->delete('tbcupon', array('id' => $id)); 
    }

    public function getCuponById($id) {
        $query = $this->db->query("select * from tbcupon where id='$id'");
        return $query->result_array();
    }

    public function updateCupon($id, $codigo, $descripcion, $porc_desc, $status) {
        $data = array(
            'codigo' => $codigo,
            'descripcion' => $descripcion,
            'porc_desc' => $porc_desc,
            'status' => $status
        );

        $this->db->where('id', $id);
        return $this->db->update('tbcupon', $data);
    }
}





