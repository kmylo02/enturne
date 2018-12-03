<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function very_sesion_admin($usuario,$passw) {

        $consulta = $this->db->get_where('Users', array('usuario' => $usuario,
            'pass' => md5($passw), 'idNivel' => '1'));

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }

    public function very_sesion_empresa($usuario,$passw) {
        $consulta = $this->db->get_where('Users', array('usuario' => $usuario,
            'pass' => md5($passw), 'idNivel' => '2'));

        if ($consulta->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function very_sesion_conductor($usuario,$passw) {
        $consulta = $this->db->get_where('Users', array('usuario' => $usuario,
            'pass' => md5($passw), 'idNivel' => '3'));

        if ($consulta->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function very_sesion_gps($usuario,$passw) {
        $consulta = $this->db->get_where('Users', array('usuario' => $usuario,
            'pass' => md5($passw), 'idNivel' => '4'));

        if ($consulta->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
