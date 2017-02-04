<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User_model extends CI_Model {

	public function __construct() {
        parent::__construct();
    }

	public function getUserCredential($de_email, $de_clave) {
		$query = $this->db->query("select * from tbuser where useremail='$de_email' and password='$de_clave'");
        $retorno = $query->result_array();
        return (isset($retorno[0])) ? $retorno[0] : false;
    }
}