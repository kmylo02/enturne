<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias_model extends CI_Model {

    public function add_categoria() {

        $this->db->insert("sf_producto_categoria", array(
            'descripcion' => $this->input->post("desc", TRUE),
            'created_at' => date('Y-m-d')
        ));
    }

    public function get_categorias() {

        $consulta = $this->db->get('sf_producto_categoria');

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }
    }

    public function get_categoria_xid($id) {

        $consulta = $this->db->get_where('sf_producto_categoria', array('idc' => $id));

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }
    }

    public function edit_categoria() {
        $id = $this->input->post('id');
        $data=array(
            'descripcion' => $this->input->post('desc'),
            'updated_at' => date('Y-m-d')
        );
        $this->db->where('idc', $id);
        $this->db->update('sf_producto_categoria', $data);
    }

}
