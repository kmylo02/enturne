<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monedas_model extends CI_Model {

    public function add_moneda() {

        $this->db->insert("df_divisas", array(
            'moneda' => $this->input->post("moneda", TRUE),
            'descripcion' => $this->input->post("desc", TRUE),
            'simbolo_left' => $this->input->post("sl", TRUE),
            'simbolo_right' => $this->input->post("sr", TRUE),
            'created_at'=>date('Y-m-d')
        ));
    }

    public function get_moneda() {
        
        $consulta = $this->db->get('df_divisas');

        if($consulta->num_rows()>0){
            return $consulta->result();
        }
    }

}
