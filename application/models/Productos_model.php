<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos_model extends CI_Model {

    public function add_producto() {

        $this->db->insert("sf_producto", array(
            'descripcion' => $this->input->post("desc", TRUE),
            'created_at' => date('Y-m-d')
        ));
    }

    public function get_productos() {
        $this->db->select('*');
        $this->db->from('sf_producto');
        $this->db->join('sf_producto_categoria', 'sf_producto_categoria.idc = sf_producto.categoria');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    public function get_productos_conductor() {
        $consulta="SELECT t1.id,t1.codigo,t1.nombre_producto,t1.descripcion,t2.categoria FROM sf_producto t1 JOIN sf_producto_categoria t2 ON t2.idc=t1.categoria WHERE t1.tipouser='3'";  
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    public function get_productos_empresa() {
        $consulta="SELECT t1.id,t1.codigo,t1.nombre_producto,t1.descripcion,t2.categoria FROM sf_producto t1 JOIN sf_producto_categoria t2 ON t2.idc=t1.categoria WHERE t1.tipouser='1'";  
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function get_producto_xid($id) {

        $consulta = $this->db->get_where('sf_producto', array('id' => $id));

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }
    }

    public function edit_producto() {
        $id = $this->input->post('id');
        $data = array(
            'descripcion' => $this->input->post('desc'),
            'updated_at' => date('Y-m-d')
        );
        $this->db->where('id', $id);
        $this->db->update('sf_producto', $data);
    }

    public function activar($id) {
        $data = array(
            'activo'=>1,
            'updated_at' => date('Y-m-d')
        );
        $this->db->where('id', $id);
        $this->db->update('sf_producto', $data);
    }
    
    public function desactivar($id) {
        
        $data = array(
            'activo'=>0,
            'updated_at' => date('Y-m-d')
        );
        $this->db->where('id', $id);
        $this->db->update('sf_producto', $data);
    }
}
