<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mensajeria_model extends CI_Model {

    public function getMensajes($id) {
        $query = $this->db->get_where('imgs_temp_usuarios', array(
            'id_usuario' => $id
        ));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
