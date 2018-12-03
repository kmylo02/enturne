<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aseguradoras_model extends CI_Model {

    public function get_aseguradoras() {
      $sql = $this->db->get('Aseguradoras');
        if($sql->num_rows()>0){
            return $sql->result();
        } else {
          return false;
        }
    }


}
