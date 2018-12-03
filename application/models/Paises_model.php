<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Paises_model extends CI_Model {

	public function add_pais() {

		$this->db->insert("Paises", array(
			'nombre' => $this->input->post("name", TRUE),
			'codigo' => $this->input->post("code", TRUE),
			'created_at' => $this->input->post("date", TRUE)
		));
	}

	/* public function get_pais() {
	  $this->db->order_by('nombre_pais', 'asc');
	  $pais = $this->db->get('Paises');
	  if ($pais->num_rows() > 0) {
	  return $pais->result();
	  }
	  } */

	public function get_pais() {
		$this->db->order_by('nombre_dpto', 'asc');
		$pais = $this->db->get('Departamentos');
		if ($pais->num_rows() > 0) {
			return $pais->result();
		}
	}

	public function get_ciudades_app($id) {
		$consulta = "SELECT idCiudad,nombre_ciudad "
						. "FROM Ciudades "
						. "WHERE departamentos_id = '$id' "
						. "ORDER BY nombre_ciudad";
		$ciudad = $this->db->query($consulta);
		if ($ciudad->num_rows() > 0) {
			return $ciudad->result();
		}
	}

	public function get_ciudad($name) {
		$this->db->select('idCiudad');
		$this->db->from('Ciudades');
		$this->db->like('nombre_ciudad', $name);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
	}

	public function get_dptos_app() {
		$consulta = "SELECT idDepartamento,nombre_dpto "
						. "FROM Departamentos "
						. "ORDER BY nombre_dpto";
		$ciudad = $this->db->query($consulta);
		if ($ciudad->num_rows() > 0) {
			return $ciudad->result();
		}
	}

	/* public function provincias($pais) {
	  $this->db->where('pais_id', $pais);
	  $this->db->order_by('nombre_dpto', 'asc');
	  $provincias = $this->db->get('Departamentos');
	  if ($provincias->num_rows() > 0) {
	  return $provincias->result();
	  }
	  } */

	public function localidades($provincias) {
		$this->db->where('departamentos_id', $provincias);
		$this->db->order_by('nombre_ciudad', 'asc');
		$localidades = $this->db->get('Ciudades');
		if ($localidades->num_rows() > 0) {
			return $localidades->result();
		}
	}

}
