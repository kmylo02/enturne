<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Idioma_model extends CI_Model {

	public function add_idioma() {

		$this->db->insert("Psaises", array(
			'nombre' => $this->input->post("name", TRUE),
			'codigo' => $this->input->post("code", TRUE),
			'created_at' => $this->input->post("date", TRUE)
		));
	}

	public function get_idioma() {

		$consulta = $this->db->get('df_idioma');

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

}
